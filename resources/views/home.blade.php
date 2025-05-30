<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
<style>
    .job-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .salary-badge {
        color: #28a745;
        font-size: 17px;
    }
    .loading-spinner {
        text-align: center;
        padding: 3rem;
        display: none;
    }
    .no-jobs {
        text-align: center;
        padding: 3rem;
        display: none;
    }
    .filter-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
    }
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
    }
    .salary_type{
        color: black;
        margin: 0;
        padding: 0;
    }
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 700px;
            margin: 1.75rem auto;
        }
    }
</style>
</head>
<body>
    <!-- Toast Container -->
    <div class="toast-container"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-briefcase me-2"></i>Job Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Applications</a>
                    </li> -->
                </ul>
                <ul class="navbar-nav">
                    <!-- Authentication Section -->
                    <li class="nav-item" id="guestSection">
                        <div class="d-flex">
                            <a class="btn btn-outline-light me-2" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Sign In
                            </a>
                            <a class="btn btn-light" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown" id="userSection" style="display: none;">
                        <a class="nav-link dropdown-toggle user-info" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><span id="userName">User</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}" id="profileLink"><i class="fas fa-user me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-4 text-center mb-3">Find Your Dream Job</h1>
                <p class="lead text-center text-muted">Discover amazing opportunities that match your skills</p>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filter-section">
            <h4 class="mb-3"><i class="fas fa-filter me-2"></i>Filter Jobs</h4>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="searchFilter" class="form-label">Search</label>
                    <input type="text" class="form-control" id="searchFilter" placeholder="Job title, company...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="locationFilter" class="form-label">Location</label>
                    <select class="form-select" id="locationFilter">
                        <option value="">All Locations</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="salaryFilter" class="form-label">Salary Range</label>
                    <select class="form-select" id="salaryFilter">
                        <option value="">Select Salary</option>
                        <option value="any">Any Salary</option>
                        <option value="10000-50000">$10,000 - $50,000</option>
                        <option value="50000-100000">$50,000 - $100,000</option>
                        <option value="100000+">$100,000+</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <button class="btn btn-primary me-2" style="margin-top: 2rem !important;" id="applyFilters">
                        <i class="fas fa-search me-1"></i>Apply Filters
                    </button>
                    <button class="btn btn-outline-secondary" style="margin-top: 2rem !important;" id="clearFilters">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading jobs...</p>
        </div>

        <!-- No Jobs Message -->
        <div class="no-jobs" id="noJobsMessage">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4>No jobs found</h4>
            <p>Try adjusting your filters to see more results.</p>
        </div>

        <!-- Jobs Listing -->
        <div class="row" id="jobsContainer">
            <!-- Jobs will be loaded here via AJAX -->
        </div>

        <!-- Pagination -->
        <nav aria-label="Job listings pagination" class="mt-4">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination will be loaded here -->
            </ul>
        </nav>
    </div>

    <!-- Job Details Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Job Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="jobModalBody">
                    <!-- Job details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="applyJobBtn">
                        <i class="fas fa-paper-plane me-1"></i>Apply Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applicationModalLabel">Apply for Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="applicationForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"></input>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email"></input>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone NO.</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone no."></input>
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter (Optional)</label>
                            <textarea class="form-control" id="coverLetter" rows="5" placeholder="Tell us why you're the perfect fit for this role..."></textarea>
                        </div>
                        <input type="hidden" id="applicationJobId" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitApplication">
                            <i class="fas fa-paper-plane me-1"></i>Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Configuration
            const API_BASE_URL = 'http://127.0.0.1:8000/api';
            
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currentPage = 1;
            let currentFilters = {};

            // Initialize
            init();

            function init() {
                checkAuthStatus();
                loadJobs();
                loadFilterOptions();
                bindEvents();
            }

            function bindEvents() {
                $('#applyFilters').click(() => { currentPage = 1; loadJobs(); });
                $('#clearFilters').click(clearFilters);
                $('#applyJobBtn').click(showApplicationModal);
                $('#applicationForm').submit(submitApplication);
                $('#logoutBtn').click(logout);
                $('#searchFilter').keypress(function(e) {
                    if (e.which == 13) { currentPage = 1; loadJobs(); }
                });
            }

            // Authentication Functions
            function checkAuthStatus() {
                const token = localStorage.getItem('auth_token');
                const user = localStorage.getItem('user_data');
                
                if (token && user) {
                    setupAuthenticatedUser(token, JSON.parse(user));
                } else {
                    showGuestSection();
                }
            }

            function setupAuthenticatedUser(token, userData) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });
                showUserSection(userData);
            }

            function showUserSection(user) {
                $('#guestSection').hide();
                $('#userSection').show();
                $('#userName').text(user.name || user.email);
                
                if (user.role === 'admin' || user.role === 'employer') {
                    $('#dashboardLink').show();
                } else {
                    $('#dashboardLink').hide();
                }
            }

            function showGuestSection() {
                $('#guestSection').show();
                $('#userSection').hide();
            }

            function logout(e) {
                if (e) e.preventDefault();
                
                const token = localStorage.getItem('auth_token');
                
                if (token) {
                    $.ajax({
                        url: `${API_BASE_URL}/logout`,
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        },
                        complete: function() {
                            clearAuthData();
                            showToast('Logged out successfully!', 'success');
                        }
                    });
                } else {
                    clearAuthData();
                }
            }

            function clearAuthData() {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user_data');
                checkAuthStatus();
            }

            // Job Loading Functions
            function loadJobs(page = 1) {
                showLoading();
                
                currentFilters = {
                    location: $('#locationFilter').val(),
                    salary: $('#salaryFilter').val(),
                    search: $('#searchFilter').val(),
                    page: page
                };
                // Remove salary if "any" is selected
                if (currentFilters.salary === 'any' || !currentFilters.salary) {
                    delete currentFilters.salary;
                }

                $.ajax({
                    url: `${API_BASE_URL}/jobs`,
                    method: 'GET',
                    data: currentFilters,
                    success: function(response) {
                        hideLoading();
                        displayJobs(response.data || response);
                        displayPagination(response);
                    },
                    error: function(xhr, status, error) {
                        hideLoading();
                        console.error('Error loading jobs:', error);
                        showToast('Failed to load jobs. Please try again.', 'error');
                    }
                });
            }

            function displayJobs(jobs) {
                const container = $('#jobsContainer');
                container.empty();

                if (!jobs || jobs.length === 0) {
                    $('#noJobsMessage').show();
                    return;
                }

                $('#noJobsMessage').hide();

                jobs.forEach(function(job) {
                    const jobCard = createJobCard(job);
                    container.append(jobCard);
                });

                bindJobCardEvents();
            }

            function createJobCard(job) {
                return `
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card job-card h-100" data-job-id="${job.id}">
                            <div class="card-body">
                                <h5 class="card-title">${job.title || 'Job Title'}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-building me-1"></i>${job.company || 'Company Name'}
                                </h6>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>${job.location || 'Location'}
                                    </small>
                                </p>
                                <p class="card-text">${truncateText(job.description || 'Job description...', 100)}</p>
                                ₹${job.salary ? `<span class="badge salary-badge mb-2">${formatSalary(job.salary)} <span class="badge salary_type">/ ${job.salary_type || ''}</span></span>` : ''}
                            </div>
                            <div class="card-footer bg-transparent">
                                <button class="btn btn-primary btn-sm view-job" data-job-id="${job.id}">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </button>
                                <button class="btn btn-success btn-sm apply-job" data-job-id="${job.id}">
                                    <i class="fas fa-paper-plane me-1"></i>Apply
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            function bindJobCardEvents() {
                $('.view-job').click(function() {
                    const jobId = $(this).data('job-id');
                    viewJobDetails(jobId);
                });

                $('.apply-job').click(function() {
                    const jobId = $(this).data('job-id');
                    initiateJobApplication(jobId);
                });
            }

            // Job Application Functions
            function initiateJobApplication(jobId) {
                if (!isAuthenticated()) {
                    showToast('Please login to apply for jobs.', 'warning');
                    return;
                }
                // Hide the job details modal before showing the application modal
                $('#jobModal').modal('hide');
                $('#applicationJobId').val(jobId);
                $('#applicationModal').modal('show');
            }

            function showApplicationModal() {
                const jobId = $(this).data('job-id');
                if (jobId) {
                    initiateJobApplication(jobId);
                }
            }

            function submitApplication(e) {
                e.preventDefault();
                
                const jobId = $('#applicationJobId').val();
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const phone = $('#phone').val().trim();
                const coverLetter = $('#coverLetter').val().trim();
                const submitBtn = $('#submitApplication');
                
                if (!jobId) {
                    showToast('Invalid job selection.', 'error');
                    return;
                }

                // Disable submit button
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Submitting...');

                $.ajax({
                    url: `${API_BASE_URL}/applications`,
                    method: 'POST',
                    data: {
                        job_id: jobId,
                        name: name || null,
                        email: email || null,
                        phone: phone || null,
                        cover_letter: coverLetter || null,
                        status: 'pending'
                    },
                    success: function(response) {
                        $('#applicationModal').modal('hide');
                        $('#applicationForm')[0].reset();
                        showToast('Application submitted successfully!', 'success');
                        
                        // Update apply button to show applied status
                        $(`.apply-job[data-job-id="${jobId}"]`)
                            .removeClass('btn-success')
                            .addClass('btn-outline-success')
                            .prop('disabled', true)
                            .html('<i class="fas fa-check me-1"></i>Applied');
                    },
                    error: function(xhr) {
                        handleApplicationError(xhr);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane me-1"></i>Submit Application');
                    }
                });
            }

            function handleApplicationError(xhr) {
                let message = 'Failed to submit application. Please try again.';
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors?.job_id && errors.job_id.includes('already applied')) {
                        message = 'You have already applied for this job.';
                    }
                } else if (xhr.status === 401) {
                    message = 'Please login to apply for jobs.';
                    clearAuthData();
                }
                
                showToast(message, 'error');
            }

            // Job Details Functions
            function viewJobDetails(jobId) {
                $.ajax({
                    url: `${API_BASE_URL}/jobs/${jobId}`,
                    method: 'GET',
                    success: function(response) {
                        // Handles both {data: {...}} and {...} formats
                        const job = response.data || response;
                        displayJobModal(job);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading job details:', error);
                        showToast('Failed to load job details.', 'error');
                    }
                });
            }

            function displayJobModal(job) {
                const modalBody = $('#jobModalBody');
                modalBody.html(`
                    <div class="row">
                        <div class="col-12">
                            <h4>${job.title || 'Job Title'}</h4>
                            <p class="text-muted mb-3">
                                <i class="fas fa-building me-2"></i>${job.company || 'Company Name'} | 
                                <i class="fas fa-map-marker-alt me-2"></i>${job.location || 'Location'}
                            </p>
                            ${job.salary ? `<p><strong>Salary:</strong> ₹${formatSalary(job.salary)} <span class="badge salary_type">/ ${job.salary_type || ''}</span></p>` : ''}
                            <h5 class="mt-4">Job Description</h5>
                            <p>${job.description || 'No description available.'}</p>
                        </div>
                    </div>
                `);
                $('#applyJobBtn').data('job-id', job.id);
                $('#jobModal').modal('show');
            }

            // Filter Functions
            function loadFilterOptions() {
                $.ajax({
                    url: `${API_BASE_URL}/jobs`,
                    method: 'GET',
                    success: function(response) {
                        const jobs = response.data || response;
                        populateFilterOptions(jobs);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading filter options:', error);
                    }
                });
            }

            function populateFilterOptions(jobs) {
                const locations = [...new Set(jobs.map(job => job.location).filter(Boolean))];
                const locationSelect = $('#locationFilter');

                locations.forEach(location => {
                    locationSelect.append(`<option value="${location}">${location}</option>`);
                });
            }

            function clearFilters() {
                $('#locationFilter, #salaryFilter').val('');
                $('#searchFilter').val('');
                currentPage = 1;
                loadJobs();
            }

            // Pagination Functions
            function displayPagination(response) {
                const pagination = $('#pagination');
                pagination.empty();
            
                if (!response.meta || !response.meta.links || response.meta.links.length <= 1) {
                    return;
                }

                response.meta.links.forEach(link => {
                    let label = link.label.replace('&laquo;', '«').replace('&raquo;', '»');
                    label = label.replace(/(<([^>]+)>)/gi, "");
                
                    let li = $('<li></li>').addClass('page-item');
                    if (link.active) li.addClass('active');
                    if (!link.url) li.addClass('disabled');
                
                    let a = $('<a></a>')
                        .addClass('page-link')
                        .attr('href', link.url ? link.url : '#')
                        .html(label);
                
                    if (link.url) {
                        const url = new URL(link.url);
                        const page = url.searchParams.get('page');
                        a.data('page', page ? parseInt(page) : 1);
                    }
                
                    a.click(function(e) {
                        e.preventDefault();
                        if (!link.url || link.active) return;
                        const page = $(this).data('page');
                        if (page) {
                            currentPage = page;
                            loadJobs(page);
                        }
                    });
                
                    li.append(a);
                    pagination.append(li);
                });
            }

            // UI Helper Functions
            function showLoading() {
                $('#loadingSpinner').show();
                $('#jobsContainer').hide();
                $('#noJobsMessage').hide();
            }

            function hideLoading() {
                $('#loadingSpinner').hide();
                $('#jobsContainer').show();
            }

            function showToast(message, type = 'info') {
                const bgClass = {
                    'success': 'bg-success',
                    'error': 'bg-danger',
                    'warning': 'bg-warning',
                    'info': 'bg-info'
                };

                const toast = $(`
                    <div class="toast align-items-center text-white ${bgClass[type]} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `);

                $('.toast-container').append(toast);
                const toastBootstrap = new bootstrap.Toast(toast[0]);
                toastBootstrap.show();

                // Remove toast after it's hidden
                toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Utility Functions
            function isAuthenticated() {
                return localStorage.getItem('auth_token') !== null;
            }

            function truncateText(text, length) {
                return text.length <= length ? text : text.substring(0, length) + '...';
            }

            function formatSalary(salary) {
                return new Intl.NumberFormat('en-US').format(salary);
            }
        });
    </script>
</body>
</html>