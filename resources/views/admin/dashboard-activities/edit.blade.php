@extends('admin.layout')

@section('title', 'Edit Dashboard Activity - GAD Admin Panel')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="title is-3">Edit Activity</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="notification is-danger is-light">
            <button class="delete"></button>
            <p><strong>Validation Errors:</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box">
        <form method="POST" action="{{ route('admin.dashboard-activities.update', $dashboardActivity) }}">
            @csrf
            @method('PUT')

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">User Name <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <input class="input @error('user_name') is-danger @enderror" type="text" name="user_name" 
                                   value="{{ old('user_name', $dashboardActivity->user_name) }}" required>
                        </div>
                        @error('user_name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-6">
                    <div class="field">
                        <label class="label">Action <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <div class="select @error('action') is-danger @enderror">
                                <select name="action" required>
                                    <option value="created" {{ old('action', $dashboardActivity->action) === 'created' ? 'selected' : '' }}>Created</option>
                                    <option value="updated" {{ old('action', $dashboardActivity->action) === 'updated' ? 'selected' : '' }}>Updated</option>
                                    <option value="deleted" {{ old('action', $dashboardActivity->action) === 'deleted' ? 'selected' : '' }}>Deleted</option>
                                </select>
                            </div>
                        </div>
                        @error('action')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Module <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <input class="input @error('module') is-danger @enderror" type="text" name="module" 
                                   value="{{ old('module', $dashboardActivity->module) }}" required>
                        </div>
                        @error('module')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-6">
                    <div class="field">
                        <label class="label">Status <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <div class="select @error('status') is-danger @enderror">
                                <select name="status" required>
                                    <option value="published" {{ old('status', $dashboardActivity->status) === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="pending" {{ old('status', $dashboardActivity->status) === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                    <option value="active" {{ old('status', $dashboardActivity->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="archived" {{ old('status', $dashboardActivity->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                                    <option value="inactive" {{ old('status', $dashboardActivity->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        @error('status')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Description <span class="has-text-danger">*</span></label>
                <div class="control">
                    <input class="input @error('description') is-danger @enderror" type="text" name="description" 
                           value="{{ old('description', $dashboardActivity->description) }}" required max="255">
                </div>
                @error('description')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Activity Time <span class="has-text-danger">*</span></label>
                <div class="control">
                    <input class="input @error('action_time') is-danger @enderror" type="datetime-local" name="action_time" 
                           value="{{ old('action_time', $dashboardActivity->action_time?->format('Y-m-d\TH:i')) }}" required>
                </div>
                @error('action_time')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $dashboardActivity->is_active) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        <span class="icon"><i class="fas fa-save"></i></span>
                        <span>Update Activity</span>
                    </button>
                </div>
                <div class="control">
                    <a href="{{ route('admin.dashboard-activities.index') }}" class="button is-light">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (document.querySelectorAll('.notification .delete') || []).forEach(function($delete) {
            var $notification = $delete.parentNode;
            $delete.addEventListener('click', function() {
                $notification.parentNode.removeChild($notification);
            });
        });
    });
</script>
@endsection
