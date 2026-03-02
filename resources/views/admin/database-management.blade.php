@extends('admin.layout')

@section('title', 'Database Management - GAD Admin Panel')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px 12px 0 0;
    }

    .btn-action {
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-seed {
        background: linear-gradient(135deg, #48c774, #2eb869);
        border: none;
        color: white;
    }

    .btn-seed:hover {
        background: linear-gradient(135deg, #2eb869, #1f8a48);
        color: white;
    }

    .btn-danger-action {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        border: none;
        color: white;
    }

    .btn-danger-action:hover {
        background: linear-gradient(135deg, #c0392b, #a93226);
        color: white;
    }

    .alert-warning {
        border-left: 4px solid #f0ad4e;
        background: #fffaf0;
    }

    .alert-info {
        border-left: 4px solid #3273dc;
        background: #f0f7ff;
    }

    .stats-table {
        font-size: 14px;
    }

    .stats-table th {
        background: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .stats-table td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
    }

    .table-row-total {
        background: #f8f9fa;
        font-weight: 600;
    }

    .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .checkbox-confirm {
        margin-right: 10px;
    }

    .info-badge {
        display: inline-block;
        background: #e7f3ff;
        border-left: 3px solid #3273dc;
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #004085;
    }

    .success-message {
        display: none;
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .error-message {
        display: none;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid py-4">
    {{-- Page Header --}}
    <div class="mb-4">
        <h1 class="h2 mb-1">
            <i class="fas fa-database mr-2"></i>Database Management
        </h1>
        <p class="text-muted">Manage database operations including seeding sample data and clearing data</p>
    </div>

    {{-- Success/Error Messages --}}
    <div id="successMessage" class="success-message alert alert-success">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="successText"></span>
    </div>

    <div id="errorMessage" class="error-message alert alert-danger">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <span id="errorText"></span>
    </div>

    <div class="row">
        {{-- Seeder Card --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-leaf mr-2"></i>Run Database Seeder
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Populate the database with sample data for all tables (except users).
                    </p>

                    <div class="info-badge">
                        <strong>Note:</strong> You can optionally clear existing data before seeding.
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="clearDataCheckbox">
                        <label class="form-check-label" for="clearDataCheckbox">
                            <strong>Clear existing data before seeding</strong>
                            <div class="text-muted small mt-1">
                                This will delete all data except user accounts, migrations, and personal access tokens.
                            </div>
                        </label>
                    </div>

                    <div class="loading-spinner" id="seederSpinner">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Processing seeder...</p>
                    </div>

                    <button type="button" class="btn btn-action btn-seed btn-lg btn-block" id="runSeederBtn">
                        <i class="fas fa-play mr-2"></i>Run Seeder
                    </button>

                    <div class="mt-3 alert alert-info">
                        <strong>Tables Seeded:</strong>
                        <small>
                            Statistics, Programs, Events, News, Reports, Milestones, Process Steps, Page Values, 
                            Page Sections, Achievements, Program Statistics, Event Statistics, Report Statistics, 
                            Policy Briefs, Resources, Statistical Yearbooks, Chart Data, Monthly Event Charts, 
                            Program Distribution Charts, Contacts, Dashboard Statistics, and Dashboard Activities.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Deletion Card --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                    <h5 class="mb-0">
                        <i class="fas fa-trash-alt mr-2"></i>Delete All Data
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Remove all data from the database while preserving user accounts.
                    </p>

                    <div class="alert alert-warning">
                        <strong>
                            <i class="fas fa-exclamation-triangle mr-2"></i>Warning!
                        </strong>
                        This action will permanently delete all data except:
                        <ul class="mb-0 mt-2">
                            <li>User accounts</li>
                            <li>Migration history</li>
                            <li>Personal access tokens</li>
                        </ul>
                    </div>

                    <div class="loading-spinner" id="deleteSpinner">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Processing deletion...</p>
                    </div>

                    <button type="button" class="btn btn-action btn-danger-action btn-lg btn-block" id="deleteDataBtn"
                        data-toggle="modal" data-target="#confirmDeleteModal">
                        <i class="fas fa-trash-alt mr-2"></i>Delete All Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Database Statistics Card --}}
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar mr-2"></i>Database Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-outline-primary" id="refreshStatsBtn">
                        <i class="fas fa-sync-alt mr-2"></i>Refresh Statistics
                    </button>

                    <div class="loading-spinner mt-3" id="statsSpinner">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading statistics...</p>
                    </div>

                    <div id="statsContent" style="display: none; margin-top: 20px;">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #667eea, #3273dc); padding: 20px; border-radius: 8px; color: white;">
                                    <p class="mb-2 text-white-80">Total Records</p>
                                    <h3 id="totalRowsDisplay" class="mb-0">0</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #48c774, #2eb869); padding: 20px; border-radius: 8px; color: white;">
                                    <p class="mb-2 text-white-80">Tables with Data</p>
                                    <h3 id="tablesWithDataDisplay" class="mb-0">0</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card" style="background: linear-gradient(135deg, #f0ad4e, #ffb81c); padding: 20px; border-radius: 8px; color: white;">
                                    <p class="mb-2 text-white-80">Database</p>
                                    <h3 class="mb-0">{{ DB::getDatabaseName() }}</h3>
                                </div>
                            </div>
                        </div>

                        <h6 class="my-3">Table Breakdown</h6>
                        <div style="max-height: 400px; overflow-y: auto;">
                            <table class="table stats-table">
                                <thead>
                                    <tr>
                                        <th>Table Name</th>
                                        <th class="text-right">Records</th>
                                    </tr>
                                </thead>
                                <tbody id="statsTableBody">
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Confirmation Modal for Delete --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Data Deletion
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <strong>Are you absolutely sure?</strong> This action will permanently delete all data from the
                    database except user accounts.
                </p>
                <p class="text-muted small">
                    This includes all programs, events, news, reports, and other content.
                </p>
                <div class="form-check mt-3">
                    <input class="form-check-input checkbox-confirm" type="checkbox" id="confirmCheckbox">
                    <label class="form-check-label" for="confirmCheckbox">
                        I understand and want to proceed with deletion
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                    <i class="fas fa-trash-alt mr-2"></i>Delete All Data
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // CSRF Token - with proper error handling
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;
    
    if (!csrfToken) {
        console.error('CSRF token not found! This may cause POST requests to fail.');
    }

    // Elements
    const runSeederBtn = document.getElementById('runSeederBtn');
    const clearDataCheckbox = document.getElementById('clearDataCheckbox');
    const deleteDataBtn = document.getElementById('deleteDataBtn');
    const refreshStatsBtn = document.getElementById('refreshStatsBtn');
    const confirmCheckbox = document.getElementById('confirmCheckbox');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const seederSpinner = document.getElementById('seederSpinner');
    const deleteSpinner = document.getElementById('deleteSpinner');
    const statsSpinner = document.getElementById('statsSpinner');
    const statsContent = document.getElementById('statsContent');

    // Run Seeder Handler
    runSeederBtn.addEventListener('click', async function () {
        if (confirm('Are you sure you want to run the seeder?' +
            (clearDataCheckbox.checked ? ' All existing data will be cleared first.' : ''))) {
            
            if (!csrfToken) {
                showError('Security token is missing. Please refresh the page and try again.');
                return;
            }
            
            seederSpinner.style.display = 'block';
            runSeederBtn.disabled = true;

            try {
                const response = await fetch('{{ route("admin.database-management.run-seeder") }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        clear_data: clearDataCheckbox.checked,
                    }),
                });

                // Check for CSRF validation error
                if (response.status === 419) {
                    showError('Security token expired. Please refresh the page and try again.');
                    return;
                }

                const data = await response.json();

                if (data.success) {
                    showSuccess(data.message);
                    loadStatistics();
                } else {
                    showError(data.message || 'An error occurred while running the seeder.');
                }
            } catch (error) {
                showError('Error: ' + error.message);
            } finally {
                seederSpinner.style.display = 'none';
                runSeederBtn.disabled = false;
            }
        }
    });

    // Confirm Checkbox Handler
    confirmCheckbox.addEventListener('change', function () {
        confirmDeleteBtn.disabled = !this.checked;
    });

    // Confirm Delete Handler
    confirmDeleteBtn.addEventListener('click', async function () {
        if (!csrfToken) {
            showError('Security token is missing. Please refresh the page and try again.');
            return;
        }
        
        deleteSpinner.style.display = 'block';
        confirmDeleteBtn.disabled = true;

        try {
            const response = await fetch('{{ route("admin.database-management.delete-data") }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    confirmed: true,
                }),
            });

            // Check for CSRF validation error
            if (response.status === 419) {
                showError('Security token expired. Please refresh the page and try again.');
                return;
            }

            const data = await response.json();

            if (data.success) {
                showSuccess(data.message);
                $('#confirmDeleteModal').modal('hide');
                confirmCheckbox.checked = false;
                loadStatistics();
            } else {
                showError(data.message || 'An error occurred while deleting data.');
            }
        } catch (error) {
            showError('Error: ' + error.message);
        } finally {
            deleteSpinner.style.display = 'none';
            confirmDeleteBtn.disabled = !confirmCheckbox.checked;
        }
    });

    // Refresh Statistics Handler
    refreshStatsBtn.addEventListener('click', loadStatistics);

    // Load Statistics
    async function loadStatistics() {
        statsSpinner.style.display = 'block';
        statsContent.style.display = 'none';
        refreshStatsBtn.disabled = true;

        try {
            const response = await fetch('{{ route("admin.database-management.stats") }}');
            const data = await response.json();

            if (data.success) {
                displayStatistics(data);
            } else {
                showError('Failed to load statistics: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            showError('Error loading statistics: ' + error.message);
        } finally {
            statsSpinner.style.display = 'none';
            refreshStatsBtn.disabled = false;
        }
    }

    // Display Statistics
    function displayStatistics(data) {
        document.getElementById('totalRowsDisplay').textContent = data.total_rows.toLocaleString();
        document.getElementById('tablesWithDataDisplay').textContent = Object.keys(data.tables).length;

        const tableBody = document.getElementById('statsTableBody');
        tableBody.innerHTML = '';

        let totalRows = 0;
        Object.entries(data.tables).sort((a, b) => b[1] - a[1]).forEach(([table, rows]) => {
            totalRows += rows;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${table}</td>
                <td class="text-right">${rows.toLocaleString()}</td>
            `;
            tableBody.appendChild(row);
        });

        const totalRow = document.createElement('tr');
        totalRow.className = 'table-row-total';
        totalRow.innerHTML = `
            <td><strong>TOTAL</strong></td>
            <td class="text-right"><strong>${totalRows.toLocaleString()}</strong></td>
        `;
        tableBody.appendChild(totalRow);

        statsContent.style.display = 'block';
    }

    // Show Success Message
    function showSuccess(message) {
        successMessage.style.display = 'block';
        document.getElementById('successText').textContent = message;
        errorMessage.style.display = 'none';

        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    }

    // Show Error Message
    function showError(message) {
        errorMessage.style.display = 'block';
        document.getElementById('errorText').textContent = message;
        successMessage.style.display = 'none';

        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 5000);
    }

    // Load statistics on page load
    document.addEventListener('DOMContentLoaded', loadStatistics);
</script>
@endsection
