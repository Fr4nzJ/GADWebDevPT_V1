<?php

namespace App\Http\Controllers;

use App\Mail\ContactReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminContactController extends Controller
{
    /**
     * Show form to create a new contact.
     */
    public function create(): View
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created contact.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:10|max:5000',
            'status' => 'required|string|in:new,read,replied,archived',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $contact = Contact::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'status' => $request->input('status'),
                'is_verified' => true,
                'verification_code' => 'MANUAL',
            ]);

            Log::info('Admin created contact manually', [
                'contact_id' => $contact->id,
                'admin_id' => Auth::id(),
                'admin_name' => Auth::user()->name,
                'email' => $contact->email,
            ]);

            return redirect()->route('admin.contacts.show', $contact)
                ->with('success', 'Contact created successfully.');

        } catch (\Exception $e) {
            Log::error('Contact creation error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['general' => 'An error occurred while creating the contact.'])
                ->withInput();
        }
    }

    /**
     * Show all contacts with filtering and pagination.
     */
    public function index(Request $request): View
    {
        $query = Contact::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by search term (name, email, subject)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('subject', 'like', '%' . $searchTerm . '%');
            });
        }

        // Sort by latest first
        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        $statusCounts = [
            'new' => Contact::where('status', 'new')->count(),
            'read' => Contact::where('status', 'read')->count(),
            'replied' => Contact::where('status', 'replied')->count(),
            'archived' => Contact::where('status', 'archived')->count(),
        ];

        return view('admin.contacts.index', [
            'contacts' => $contacts,
            'statusCounts' => $statusCounts,
            'currentStatus' => $request->input('status'),
            'searchTerm' => $request->input('search'),
        ]);
    }

    /**
     * Show a single contact with details.
     */
    public function show(Contact $contact): View
    {
        // Mark as read if it's new
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', ['contact' => $contact]);
    }

    /**
     * Show edit form for a contact.
     */
    public function edit(Contact $contact): View
    {
        return view('admin.contacts.edit', ['contact' => $contact]);
    }

    /**
     * Update a contact (admin notes).
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact->update([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        Log::info('Admin updated contact', [
            'contact_id' => $contact->id,
            'admin_id' => Auth::id(),
            'admin_name' => Auth::user()->name,
        ]);

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Send a reply to the contact.
     */
    public function reply(Request $request, Contact $contact): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'reply_message' => 'required|string|min:10|max:5000',
        ], [
            'reply_message.required' => 'Please provide a reply message.',
            'reply_message.min' => 'Reply message must be at least 10 characters.',
            'reply_message.max' => 'Reply message cannot exceed 5000 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update contact with reply
            $contact->update([
                'reply_message' => $request->input('reply_message'),
                'replied_at' => now(),
                'replied_by' => Auth::id(),
                'status' => 'replied',
            ]);

            // Send reply email to the contact
            try {
                Mail::send(
                    new ContactReplyMail(
                        $contact->name,
                        $contact->email,
                        $contact->subject,
                        $request->input('reply_message')
                    )
                );

                Log::info('Contact reply email sent', [
                    'contact_id' => $contact->id,
                    'recipient_email' => $contact->email,
                    'admin_id' => Auth::id(),
                    'admin_name' => Auth::user()->name,
                ]);
            } catch (\Exception $emailException) {
                Log::error('Contact reply email failed', [
                    'contact_id' => $contact->id,
                    'error' => $emailException->getMessage(),
                ]);
                // Continue anyway - reply is stored in database
            }

            Log::info('Admin replied to contact', [
                'contact_id' => $contact->id,
                'admin_id' => Auth::id(),
                'admin_name' => Auth::user()->name,
            ]);

            return redirect()->route('admin.contacts.show', $contact)
                ->with('success', 'Reply sent successfully to ' . $contact->email);

        } catch (\Exception $e) {
            Log::error('Contact reply error', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['general' => 'An error occurred while sending the reply.'])
                ->withInput();
        }
    }

    /**
     * Delete a contact.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        Log::info('Admin deleted contact', [
            'contact_id' => $contact->id,
            'contact_email' => $contact->email,
            'admin_id' => Auth::id(),
            'admin_name' => Auth::user()->name,
        ]);

        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Archive a contact.
     */
    public function archive(Contact $contact): RedirectResponse
    {
        $contact->update(['status' => 'archived']);

        Log::info('Admin archived contact', [
            'contact_id' => $contact->id,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact archived successfully.');
    }

    /**
     * Restore an archived contact.
     */
    public function restore(Contact $contact): RedirectResponse
    {
        $contact->update(['status' => 'read']);

        Log::info('Admin restored contact', [
            'contact_id' => $contact->id,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact restored successfully.');
    }
}
