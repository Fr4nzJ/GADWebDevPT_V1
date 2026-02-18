@extends('admin.layout')

@section('title', 'Manage Programs - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Programs</h1>
    <a href="#" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Program</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Programs</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Enter program name...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Program Type</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Types</option>
                            <option>Safety & Protection</option>
                            <option>Economic Empowerment</option>
                            <option>Education & Health</option>
                            <option>Leadership & Advocacy</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Planned</option>
                            <option>Completed</option>
                            <option>Suspended</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== PROGRAMS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Program Name</th>
                <th style="padding: 1.25rem;">Focal Area</th>
                <th style="padding: 1.25rem;">Duration</th>
                <th style="padding: 1.25rem;">Beneficiaries</th>
                <th style="padding: 1.25rem;">Budget (PHP)</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Program 1 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Violence Against Women and Girls Prevention</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #ffe8e8; color: #e74c3c; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Safety</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">2024 - 2026</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">50,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱125,000,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge status-active">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalProgram1').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Program 2 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Women Farmers Economic Empowerment</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Economic</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">2023 - 2025</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">35,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱87,500,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge status-active">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalProgram2').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Program 3 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Girls Education Access Initiative</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Education</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">2024 - 2027</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">120,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱250,000,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge status-pending">Planned</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalProgram3').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Program 4 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">LGBTQ+ Rights and Inclusion Program</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #faf8ff; color: #764ba2; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Advocacy</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">2024 - 2025</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">15,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱42,500,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge status-active">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalProgram4').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Program 5 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">Women Managers and Leaders Development</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #fff8e1; color: #f0ad4e; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Leadership</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">2022 - 2024</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">8,500</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱65,000,000</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge status-published">Completed</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalProgram5').classList.add('is-active')" title="Delete">
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
    </ul>
</nav>

<!-- ===== DELETE MODALS ===== -->
@for ($i = 1; $i <= 5; $i++)
<div class="modal" id="deleteModalProgram{{ $i }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModalProgram{{ $i }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModalProgram{{ $i }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete this program? All associated data, beneficiaries, and activities will be permanently removed.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Critical:</strong> This action cannot be undone. All program records and related information will be deleted.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModalProgram{{ $i }}').classList.remove('is-active')">
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
