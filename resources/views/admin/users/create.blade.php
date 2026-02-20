@extends('admin.layout')

@section('title', 'Create User - GAD Admin Panel')

@section('content')
<div class="page-header" style="display: flex; align-items: center; gap: 1rem;">
    <h1 class="page-title">Create New User</h1>
</div>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    @if ($errors->any())
        <div class="notification is-danger" style="margin-bottom: 1.5rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="field">
            <label class="label">Full Name</label>
            <div class="control">
                <input class="input @error('name') is-danger @enderror" 
                       type="text" name="name" value="{{ old('name') }}" placeholder="Enter user's full name" required>
            </div>
            @error('name')<p class="help is-danger">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label class="label">Email Address</label>
            <div class="control">
                <input class="input @error('email') is-danger @enderror" 
                       type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
            </div>
            @error('email')<p class="help is-danger">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input @error('password') is-danger @enderror" 
                       type="password" name="password" placeholder="Enter password (minimum 8 characters)" required>
            </div>
            @error('password')<p class="help is-danger">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
                <input class="input @error('password_confirmation') is-danger @enderror" 
                       type="password" name="password_confirmation" placeholder="Confirm password" required>
            </div>
            @error('password_confirmation')<p class="help is-danger">{{ $message }}</p>@enderror
        </div>

        <div class="field is-grouped" style="margin-top: 2rem;">
            <div class="control">
                <button type="submit" class="button is-primary" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span>Create User</span>
                </button>
            </div>
            <div class="control">
                <a href="{{ route('admin.users.index') }}" class="button is-light">
                    <span>Cancel</span>
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
