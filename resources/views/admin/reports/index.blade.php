@extends('admin.layout')

@section('title', 'Manage Reports - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Reports</h1>
    <a href="#" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Report</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Reports</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Enter report title...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Report Type</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Types</option>
                            <option>Research Study</option>
                            <option>Survey</option>
                            <option>Assessment</option>
                            <option>Policy Brief</option>
                            <option>Analysis</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Year</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Years</option>
                            <option>2024</option>
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== REPORTS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Report Title</th>
                <th style="padding: 1.25rem;">Type</th>
                <th style="padding: 1.25rem;">Year</th>
                <th style="padding: 1.25rem;">Author</th>
                <th style="padding: 1.25rem;">Pages</th>
                <th style="padding: 1.25rem;">Downloads</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Report 1 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">National Gender & Social Inclusion Survey (NGSInS) 2024</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Survey</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-weight: 500;">2024</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Rebecca Torres</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f5f7fa; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">156</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">4,285</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport1').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Report 2 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Women's Economic Participation & Labor Trends Report</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #fff8e1; color: #f0ad4e; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Analysis</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-weight: 500;">2023</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Maria Santos</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f5f7fa; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">89</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">3,156</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport2').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Report 3 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Violence Against Women and Girls Prevalence Study</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #ffe8e8; color: #e74c3c; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Research Study</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-weight: 500;">2023</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Clara Gonzales</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f5f7fa; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">203</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">6,421</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport3').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Report 4 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Gender Mainstreaming Assessment: Government Agencies 2023</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Assessment</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-weight: 500;">2023</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Jennifer Reyes</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f5f7fa; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">124</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">2,847</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport4').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Report 5 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">CatSu GAD Statistical Yearbook 2024</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #faf8ff; color: #764ba2; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Policy Brief</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-weight: 500;">2024</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Ramon Cruz</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f5f7fa; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">180</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">5,932</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport5').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
<nav class="pagination is-centered" role="navigation" aria-label="pagination" style="margin-top: 2rem;">
    <a class="pagination-previous">Previous</a>
    <a class="pagination-next">Next page</a>
    <ul class="pagination-list">
        <li><a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a></li>
        <li><a class="pagination-link">2</a></li>
        <li><a class="pagination-link">3</a></li>
    </ul>
</nav>

<!-- ===== DELETE MODALS ===== -->
@for ($i = 1; $i <= 5; $i++)
<div class="modal" id="deleteModalReport{{ $i }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModalReport{{ $i }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModalReport{{ $i }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete this report? This research document will be permanently removed from the system.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Note:</strong> All download records, citations, and associated metadata will also be removed.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModalReport{{ $i }}').classList.remove('is-active')">
                Cancel
            </button>
            <button class="button is-danger" style="background: #e74c3c; color: white;">
                <span class="icon"><i class="fas fa-trash"></i></span>
                <span>Delete</span>
            </button>
        </footer>
    </div>
</div>
@endfor

@endsection
