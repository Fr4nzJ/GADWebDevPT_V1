@extends('admin.layout')

@section('title', 'Create News - GAD Admin Panel')

@section('content')
<div class="page-header" style="display: flex; align-items: center; gap: 1rem;">
    <h1 class="page-title">Create News Article</h1>
</div>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    @if ($errors->any())
        <div class="notification is-danger" style="margin-bottom: 1.5rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="columns">
            <div class="column is-9">
                <div class="field">
                    <label class="label">Article Title</label>
                    <div class="control">
                        <input class="input @error('title') is-danger @enderror" 
                               type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    @error('title')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="label">Content</label>
                    <div class="control">
                        <textarea class="textarea @error('content') is-danger @enderror" 
                                  name="content" rows="10" required>{{ old('content') }}</textarea>
                    </div>
                    @error('content')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="label">Excerpt (Short summary)</label>
                    <div class="control">
                        <textarea class="textarea @error('excerpt') is-danger @enderror" 
                                  name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                    </div>
                    @error('excerpt')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="label">Article Images</label>
                    <div class="control">
                        <div style="border: 2px dashed #667eea; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;" onclick="document.getElementById('newsImageInput').click()">
                            <input type="file" id="newsImageInput" name="images[]" multiple accept="image/*" style="display: none;">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #667eea; margin-bottom: 1rem;"></i>
                            <p style="color: #667eea; font-weight: 600; margin-bottom: 0.5rem;">Click to upload images or drag and drop</p>
                            <p style="color: #999; font-size: 0.9rem;">PNG, JPG, GIF up to 50 MB each</p>
                        </div>
                        <div id="newsImagePreview" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;"></div>
                    </div>
                    @error('images')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="column is-3">
                <div style="background: #f5f7ff; border-radius: 12px; padding: 1.5rem; position: sticky; top: 2rem;">
                    <div class="field">
                        <label class="label">Author</label>
                        <div class="control">
                            <input class="input" type="text" name="author" value="{{ old('author', auth()->user()->name ?? 'Admin') }}" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Category</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="category" required>
                                    <option value="Events" {{ old('category') === 'Events' ? 'selected' : '' }}>Events</option>
                                    <option value="Policy" {{ old('category') === 'Policy' ? 'selected' : '' }}>Policy</option>
                                    <option value="Research" {{ old('category') === 'Research' ? 'selected' : '' }}>Research</option>
                                    <option value="Training" {{ old('category') === 'Training' ? 'selected' : '' }}>Training</option>
                                    <option value="Youth" {{ old('category') === 'Youth' ? 'selected' : '' }}>Youth</option>
                                    <option value="General" {{ old('category') === 'General' ? 'selected' : '' }}>General</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Status</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="status" required>
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field is-grouped" style="margin-top: 2rem;">
                        <div class="control" style="width: 100%;">
                            <button type="submit" class="button is-primary" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600; width: 100%;">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span>Create Article</span>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control" style="width: 100%;">
                            <a href="{{ route('admin.news.index') }}" class="button is-light" style="width: 100%;">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
    document.getElementById('newsImageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('newsImagePreview');
        preview.innerHTML = '';
        
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // Drag and drop support
    const dropZone = document.querySelector('[onclick*="newsImageInput"]');
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = '#f0edff';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.backgroundColor = 'transparent';
        }, false);
    });

    dropZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('newsImageInput').files = files;
        const event = new Event('change', { bubbles: true });
        document.getElementById('newsImageInput').dispatchEvent(event);
    }, false);
</script>
