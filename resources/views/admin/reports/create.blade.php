@extends('admin.layout')

@section('title', 'Create Report - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Create New Report</h1>
    <a href="{{ route('admin.reports.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-arrow-left"></i></span>
        <span>Back</span>
    </a>
</div>

<!-- ===== FORM ===== -->
<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="columns is-multiline">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Report Title *</label>
                    <div class="control">
                        <input class="input @error('title') is-danger @enderror" type="text" name="title" placeholder="Enter report title" value="{{ old('title') }}" required>
                    </div>
                    @error('title')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Publication Year *</label>
                    <div class="control">
                        <input class="input @error('year') is-danger @enderror" type="number" name="year" min="2000" max="{{ date('Y') }}" placeholder="2024" value="{{ old('year') }}" required>
                    </div>
                    @error('year')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Report Type *</label>
                    <div class="control">
                        <div class="select is-fullwidth @error('type') is-danger @enderror">
                            <select name="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="Survey" {{ old('type') === 'Survey' ? 'selected' : '' }}>Survey</option>
                                <option value="Analysis" {{ old('type') === 'Analysis' ? 'selected' : '' }}>Analysis</option>
                                <option value="Research Study" {{ old('type') === 'Research Study' ? 'selected' : '' }}>Research Study</option>
                                <option value="Assessment" {{ old('type') === 'Assessment' ? 'selected' : '' }}>Assessment</option>
                                <option value="Baseline Study" {{ old('type') === 'Baseline Study' ? 'selected' : '' }}>Baseline Study</option>
                                <option value="Audit" {{ old('type') === 'Audit' ? 'selected' : '' }}>Audit</option>
                                <option value="Budget Analysis" {{ old('type') === 'Budget Analysis' ? 'selected' : '' }}>Budget Analysis</option>
                                <option value="Health Study" {{ old('type') === 'Health Study' ? 'selected' : '' }}>Health Study</option>
                                <option value="Impact Study" {{ old('type') === 'Impact Study' ? 'selected' : '' }}>Impact Study</option>
                            </select>
                        </div>
                    </div>
                    @error('type')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Description *</label>
                    <div class="control">
                        <textarea class="textarea @error('description') is-danger @enderror" name="description" placeholder="Enter report description" rows="6" required>{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">PDF File (Optional)</label>
                    <div class="control">
                        <div class="file has-name">
                            <label class="file-label">
                                <input class="file-input @error('file_path') is-danger @enderror" type="file" name="file_path" accept=".pdf">
                                <span class="file-cta" style="background: #667eea; color: white; border: none;">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                </span>
                                <span class="file-name" id="fileName">No file selected</span>
                            </label>
                        </div>
                    </div>
                    @error('file_path')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Status *</label>
                    <div class="control">
                        <div class="select is-fullwidth @error('status') is-danger @enderror">
                            <select name="status" required>
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>
                    @error('status')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-12">
                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button type="submit" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                        <span class="icon"><i class="fas fa-save"></i></span>
                        <span>Create Report</span>
                    </button>
                    <a href="{{ route('admin.reports.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
                        <span>Cancel</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.querySelector('.file-input').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('fileName').textContent = fileName;
    });
</script>

@endsection
