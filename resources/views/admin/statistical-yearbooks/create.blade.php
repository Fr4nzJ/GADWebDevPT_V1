@extends('layouts.app')

@section('title', 'Create Statistical Yearbook')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="title is-3">Create Statistical Yearbook</h1>
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
        <form method="POST" action="{{ route('admin.statistical-yearbooks.store') }}">
            @csrf

            <!-- Title -->
            <div class="field">
                <label class="label">Title <span class="has-text-danger">*</span></label>
                <div class="control">
                    <input class="input @error('title') is-danger @enderror" type="text" name="title" 
                           value="{{ old('title') }}" placeholder="CatSu GAD Statistical Yearbook 2024" required>
                </div>
                @error('title')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="field">
                <label class="label">Description <span class="has-text-danger">*</span></label>
                <div class="control">
                    <textarea class="textarea @error('description') is-danger @enderror" name="description" 
                              rows="4" placeholder="Comprehensive description of the yearbook..." required>{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publication Date -->
            <div class="field">
                <label class="label">Publication Date</label>
                <div class="control">
                    <input class="input @error('publication_date') is-danger @enderror" type="date" 
                           name="publication_date" value="{{ old('publication_date') }}">
                </div>
                @error('publication_date')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pages -->
            <div class="field">
                <label class="label">Number of Pages</label>
                <div class="control">
                    <input class="input @error('pages') is-danger @enderror" type="number" 
                           name="pages" value="{{ old('pages') }}" placeholder="180">
                </div>
                @error('pages')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Format -->
            <div class="field">
                <label class="label">Format</label>
                <div class="control">
                    <input class="input @error('format') is-danger @enderror" type="text" 
                           name="format" value="{{ old('format') }}" placeholder="PDF + Excel Data Tables">
                </div>
                @error('format')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Languages -->
            <div class="field">
                <label class="label">Languages</label>
                <div class="control">
                    <input class="input @error('languages') is-danger @enderror" type="text" 
                           name="languages" value="{{ old('languages') }}" placeholder="English, Filipino">
                </div>
                @error('languages')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Path -->
            <div class="field">
                <label class="label">File Path/URL</label>
                <div class="control">
                    <input class="input @error('file_path') is-danger @enderror" type="text" 
                           name="file_path" value="{{ old('file_path') }}" placeholder="/storage/files/yearbook-2024.pdf">
                </div>
                @error('file_path')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Download Size -->
            <div class="field">
                <label class="label">Download Size</label>
                <div class="control">
                    <input class="input @error('download_size') is-danger @enderror" type="text" 
                           name="download_size" value="{{ old('download_size') }}" placeholder="15 MB">
                </div>
                @error('download_size')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Active -->
            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        <span class="icon"><i class="fas fa-save"></i></span>
                        <span>Create Yearbook</span>
                    </button>
                </div>
                <div class="control">
                    <a href="{{ route('admin.statistical-yearbooks.index') }}" class="button is-light">Cancel</a>
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
