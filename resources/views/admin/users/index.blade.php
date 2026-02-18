@extends('admin.layout')

@section('title', 'Manage Users - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Users</h1>
    <a href="#" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New User</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Users</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Name or email...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">User Role</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Roles</option>
                            <option>Administrator</option>
                            <option>Editor</option>
                            <option>Contributor</option>
                            <option>Viewer</option>
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
                            <option>Inactive</option>
                            <option>Suspended</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== USERS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">User Name</th>
                <th style="padding: 1.25rem;">Email</th>
                <th style="padding: 1.25rem;">Role</th>
                <th style="padding: 1.25rem;">Department</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem;">Last Login</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- User 1 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            MS
                        </div>
                        <strong style="color: #2c3e50;">Maria Santos</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">maria.santos@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Administrator</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Policy & Planning</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">Today, 09:30 AM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser1').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- User 2 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #48c774, #3aab6a); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            JR
                        </div>
                        <strong style="color: #2c3e50;">Jennifer Reyes</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">jennifer.reyes@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Editor</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Communications</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">Today, 08:45 AM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser2').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- User 3 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #f0ad4e, #e89a3c); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            CG
                        </div>
                        <strong style="color: #2c3e50;">Clara Gonzales</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">clara.gonzales@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #fff8e1; color: #f0ad4e; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Contributor</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Research & Data</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Yesterday, 04:15 PM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser3').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- User 4 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #e74c3c, #c1392b); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            RT
                        </div>
                        <strong style="color: #2c3e50;">Rebecca Torres</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">rebecca.torres@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Editor</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Programs & Projects</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #ffe8e8; color: #e74c3c; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Inactive</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Mar 5, 2024, 02:30 PM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser4').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- User 5 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #764ba2, #5a3a7a); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            RC
                        </div>
                        <strong style="color: #2c3e50;">Ramon Cruz</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">ramon.cruz@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #f3f3f3; color: #999; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Viewer</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Executive Office</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 600;">Today, 10:15 AM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser5').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <!-- User 6 -->
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #5568d3); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            MB
                        </div>
                        <strong style="color: #2c3e50;">Michelle Bautista</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">michelle.bautista@gad.gov.ph</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #fff8e1; color: #f0ad4e; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Contributor</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Gender Training</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">Mar 8, 2024, 11:20 AM</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser6').classList.add('is-active')" title="Delete">
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
@for ($i = 1; $i <= 6; $i++)
<div class="modal" id="deleteModalUser{{ $i }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModalUser{{ $i }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm User Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModalUser{{ $i }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete this user account? This action cannot be undone.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Warning:</strong> The user will lose access immediately. All activities and assignments will be logged in the system archive.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModalUser{{ $i }}').classList.remove('is-active')">
                Cancel
            </button>
            <button class="button is-danger" style="background: #e74c3c; color: white;">
                <span class="icon"><i class="fas fa-trash"></i></span>
                <span>Delete User</span>
            </button>
        </footer>
    </div>
</div>
@endfor

@endsection
