<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <input type="hidden" id="currentUserId" value="">
    
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="p-4">
                    <h4 class="text-white mb-4 text-center">
                        <i class="fas fa-briefcase me-2"></i>Job Portal
                    </h4>
                    
                    <div class="card user-info-card text-white mb-4">
                        <div class="card-body text-center">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-primary fs-4"></i>
                            </div>
                            <div id="userInfo">
                                <h6 id="userName" class="mb-1">Loading...</h6>
                                <small id="userEmail" class="opacity-75 d-block">Loading...</small>
                                <div class="mt-2">
                                    <span id="userRole" class="badge bg-light text-dark">Loading...</span>
                                </div>
                                <small id="joinDate" class="d-block mt-2 opacity-75">Loading...</small>
                            </div>
                        </div>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#" data-section="overview">
                            <i class="fas fa-tachometer-alt me-2"></i>Overview
                        </a>
                        <a class="nav-link" href="#" data-section="jobs">
                            <i class="fas fa-briefcase me-2"></i>My Jobs
                        </a>
                        <a class="nav-link" href="#" data-section="applications">
                            <i class="fas fa-file-alt me-2"></i>Applications
                        </a>
                        <a class="nav-link" href="#" data-section="create-job">
                            <i class="fas fa-plus me-2"></i>Post New Job
                        </a>
                        <hr class="text-white-50">
                        <a class="nav-link" href="#" onclick="logout()">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4 main-content">
                <div id="overview-section" class="content-section">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h2 class="text-dark mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>Dashboard Overview
                        </h2>
                        <button class="btn btn-primary" onclick="refreshData()">
                            <i class="fas fa-sync-alt me-2"></i>Refresh
                        </button>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4 stats-card">
                            <div class="card h-100">
                                <div class="card-body text-center position-relative">
                                    <i class="fas fa-briefcase fa-3x mb-3"></i>
                                    <h2 id="totalJobs" class="display-4 fw-bold">0</h2>
                                    <p class="mb-0 text-uppercase">Total Jobs Posted</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stats-card">
                            <div class="card h-100">
                                <div class="card-body text-center position-relative">
                                    <i class="fas fa-file-alt fa-3x mb-3"></i>
                                    <h2 id="totalApplications" class="display-4 fw-bold">0</h2>
                                    <p class="mb-0 text-uppercase">Total Applications</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stats-card">
                            <div class="card h-100">
                                <div class="card-body text-center position-relative">
                                    <i class="fas fa-eye fa-3x mb-3"></i>
                                    <h2 id="activeJobs" class="display-4 fw-bold">0</h2>
                                    <p class="mb-0 text-uppercase">Active Jobs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-clock me-2 text-primary"></i>Recent Jobs
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="recentJobs">
                                        <div class="text-center p-4">
                                            <div class="loading-spinner"></div>
                                            <p class="mt-2 text-muted">Loading...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-users me-2 text-success"></i>Recent Applications
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="recentApplications">
                                        <div class="text-center p-4">
                                            <div class="loading-spinner"></div>
                                            <p class="mt-2 text-muted">Loading...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Jobs Section -->
                <div id="jobs-section" class="content-section" style="display: none;">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h2 class="text-dark mb-0">
                            <i class="fas fa-briefcase me-2 text-primary"></i>My Posted Jobs
                        </h2>
                        <button class="btn btn-success" onclick="showSection('create-job')">
                            <i class="fas fa-plus me-2"></i>Post New Job
                        </button>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div id="jobsList">
                                <div class="text-center p-4">
                                    <div class="loading-spinner"></div>
                                    <p class="mt-2 text-muted">Loading jobs...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Applications Section -->
                <div id="applications-section" class="content-section" style="display: none;">
                    <div class="section-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <h2 class="text-dark mb-3 mb-md-0">
                            <i class="fas fa-file-alt me-2 text-success"></i>Job Applications
                        </h2>
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary active" onclick="filterApplications('all')">All</button>
                            <button class="btn btn-outline-warning" onclick="filterApplications('pending')">Pending</button>
                            <button class="btn btn-outline-success" onclick="filterApplications('accepted')">Approved</button>
                            <button class="btn btn-outline-danger" onclick="filterApplications('rejected')">Rejected</button>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div id="applicationsList">
                                <div class="text-center p-4">
                                    <div class="loading-spinner"></div>
                                    <p class="mt-2 text-muted">Loading applications...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="create-job-section" class="content-section" style="display: none;">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h2 class="text-dark mb-0">
                            <i class="fas fa-plus me-2 text-success"></i>Post New Job(s)
                        </h2>
                        <button class="btn btn-secondary" onclick="showSection('jobs')">
                            <i class="fas fa-arrow-left me-2"></i>Back to Jobs
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form id="multiJobForm">
                                <div id="multiJobFields">
                                    <!-- Job form groups will be appended here -->
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="button" class="btn btn-outline-info" id="addJobBtn">
                                        <i class="fas fa-plus me-2"></i>Add Another Job
                                    </button>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-outline-secondary me-2" onclick="resetMultiJobForm()">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitAllJobsBtn">
                                        <i class="fas fa-save me-2"></i>Post All Jobs
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Job Details Modal -->
    <div class="modal fade" id="jobDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-briefcase me-2"></i>Job Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="jobDetailsContent">
                    <!-- Job details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="editJobBtn">
                        <i class="fas fa-edit me-2"></i>Edit Job
                    </button>
                    <button type="button" class="btn btn-danger" id="deleteJobBtn">
                        <i class="fas fa-trash me-2"></i>Delete Job
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Application Details Modal -->
    <div class="modal fade" id="applicationDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user me-2"></i>Application Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="applicationDetailsContent">
                    <!-- Application details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="approveApplicationBtn">
                        <i class="fas fa-check me-2"></i>Approve
                    </button>
                    <button type="button" class="btn btn-danger" id="rejectApplicationBtn">
                        <i class="fas fa-times me-2"></i>Reject
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div class="modal fade" id="editJobModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit Job
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editJobForm">
                        <input type="hidden" id="editJobId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editJobTitle" class="form-label fw-bold">Job Title *</label>
                                <input type="text" class="form-control" id="editJobTitle" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editJobCompany" class="form-label fw-bold">Company *</label>
                                <input type="text" class="form-control" id="editJobCompany" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editJobLocation" class="form-label fw-bold">Location *</label>
                                <input type="text" class="form-control" id="editJobLocation" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editJobSalary" class="form-label fw-bold">Salary</label>
                                <input type="text" class="form-control" id="editJobSalary">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editJobSalaryType" class="form-label fw-bold">Salary Type</label>
                                <select class="form-select" id="editJobSalaryType" required>
                                    <option value="hour">Hour</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editJobDescription" class="form-label fw-bold">Job Description *</label>
                            <textarea class="form-control" id="editJobDescription" rows="5" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editJobType" class="form-label fw-bold">Job Type *</label>
                                <select class="form-select" id="editJobType" required>
                                    <option value="">Select Job Type</option>
                                    <option value="full-time">Full Time</option>
                                    <option value="part-time">Part Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editJobStatus" class="form-label fw-bold">Status *</label>
                                <select class="form-select" id="editJobStatus" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateJob()">
                        <i class="fas fa-save me-2"></i>Update Job
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentUser = null;
        let userJobs = [];
        let userApplications = [];
        let currentFilter = 'all';
        let currentEditJobId = null;
        let currentApplicationId = null;

        // API Base URL
        const API_BASE = 'http://127.0.0.1:8000/api';

        $(document).ready(function() {
            const token = localStorage.getItem('auth_token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            initializeDashboard();
        });

        async function initializeDashboard() {
            try {
                await loadUserInfo();
                setupNavigation();
                setupFormHandlers();
                await loadDashboardData();
            } catch (error) {
                console.error('Dashboard initialization failed:', error);
                showError('Failed to initialize dashboard');
            }
        }

        function setupNavigation() {
            $('.nav-link[data-section]').click(function(e) {
                e.preventDefault();
                const section = $(this).data('section');
                showSection(section);
                
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
        }

        function showSection(section) {
            $('.content-section').hide();
            $(`#${section}-section`).show();

            switch(section) {
                case 'overview':
                    loadDashboardData();
                    break;
                case 'jobs':
                    loadUserJobs();
                    break;
                case 'applications':
                    loadUserApplications();
                    break;
            }
        }

        function loadUserInfo() {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${API_BASE}/user`,
                    method: 'GET',
                    success: function(response) {
                        currentUser = response.data || response;
                        displayUserInfo(currentUser);
                        resolve(currentUser);
                    },
                    error: function(xhr) {
                        console.error('Error loading user info:', xhr);
                        if (xhr.status === 401) {
                            logout();
                        }
                        reject(xhr);
                    }
                });
            });
        }

        function displayUserInfo(user) {
            $('#userName').text(user.name || 'N/A');
            $('#userEmail').text(user.email || 'N/A');
            $('#userRole').text(user.role || 'User');
            
            const joinDate = user.created_at ? new Date(user.created_at).toLocaleDateString() : 'N/A';
            $('#joinDate').text(`Member since: ${joinDate}`);
        }

        async function loadDashboardData() {
            try {
                await Promise.all([
                    loadUserJobs(),
                    loadUserApplications()
                ]);
                updateDashboardStats();
            } catch (error) {
                console.error('Error loading dashboard data:', error);
                showError('Failed to load dashboard data');
            }
        }

        function loadUserJobs() {
            return new Promise((resolve, reject) => {
                if (!currentUser) {
                    reject('User not loaded');
                    return;
                }

                $.ajax({
                    url: `${API_BASE}/jobs?user_id=${currentUser.id}`,
                    method: 'GET',
                    success: async function(response) {
                        userJobs = response.data || response || [];
                        await Promise.all(userJobs.map(async (job) => {
                            try {
                                const res = await $.ajax({
                                    url: `http://127.0.0.1:8000/api/applications?job_id=${job.id}`,
                                    method: 'GET'
                                });
                                job.applicationCount = (res.data || res || []).length;
                            } catch (e) {
                                job.applicationCount = 0;
                            }
                        }));
                        displayUserJobs(userJobs);
                        displayRecentJobs(userJobs.slice(0, 5));
                        resolve(userJobs);
                    },
                    error: function(xhr) {
                        console.error('Error loading user jobs:', xhr);
                        userJobs = [];
                        displayUserJobs([]);
                        displayRecentJobs([]);
                        reject(xhr);
                    }
                });
            });
        }

        async function loadUserApplications() {
            if (!userJobs.length) {
                userApplications = [];
                displayUserApplications([]);
                displayRecentApplications([]);
                return;
            }
            try {
                const allApplications = [];
                await Promise.all(userJobs.map(async (job) => {
                    try {
                        const response = await $.ajax({
                            url: `http://127.0.0.1:8000/api/applications?job_id=${job.id}`,
                            method: 'GET'
                        });
                        const applications = response.data || response || [];
                        applications.forEach(app => {
                            app.job_title = job.title;
                            app.job_company = job.company;
                            app.job_id = job.id;
                        });
                        allApplications.push(...applications);
                    } catch (error) {
                        console.error(`Error loading applications for job ${job.id}:`, error);
                    }
                }));
                userApplications = allApplications;
                displayUserApplications(userApplications);
                displayRecentApplications(userApplications.slice(0, 5));
            } catch (error) {
                console.error('Error loading user applications:', error);
                userApplications = [];
                displayUserApplications([]);
                displayRecentApplications([]);
            }
        }

        function updateDashboardStats() {
            $('#totalJobs').text(userJobs.length);
            $('#totalApplications').text(userApplications.length);
            $('#activeJobs').text(userJobs.filter(job => job.status === 'active').length);
        }

        function displayRecentJobs(jobs) {
            const container = $('#recentJobs');

            if (!jobs.length) {
                container.html(`
                    <div class="empty-state">
                        <i class="fas fa-briefcase"></i>
                        <p>No jobs posted yet</p>
                        <button class="btn btn-primary btn-sm" onclick="showSection('create-job')">
                            Post Your First Job
                        </button>
                    </div>
                `);
                return;
            }
        
            let html = '';
            jobs.forEach(job => {
                const statusBadge = job.status === 'active' ? 'success' : 'secondary';
                const statusText = job.status ? job.status.charAt(0).toUpperCase() + job.status.slice(1) : 'N/A';
                html += `
                    <div class="job-card card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="card-title mb-1">${job.title}</h6>
                                    <p class="text-muted small mb-1">${job.company}</p>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-map-marker-alt me-1"></i>${job.location}
                                    </p>
                                </div>
                                <span class="badge bg-${statusBadge}">${statusText}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    Posted: ${new Date(job.created_at).toLocaleDateString()}
                                </small>
                            </div>
                        </div>
                    </div>
                `;
            });
            container.html(html);
        }

        function displayRecentApplications(applications) {
            const container = $('#recentApplications');
            
            if (!applications.length) {
                container.html(`
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <p>No applications received yet</p>
                    </div>
                `);
                return;
            }

            let html = '';
            applications.forEach(app => {
                const statusClass = {
                    'pending': 'warning',
                    'reviewed': 'warning',
                    'accepted': 'success',
                    'rejected': 'danger'
                };
                const badgeClass = statusClass[app.status] || 'secondary';
                
                html += `
                    <div class="application-card card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="card-title mb-1">${app.name || 'N/A'}</h6>
                                    <p class="text-muted small mb-1">${app.job_title}</p>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-envelope me-1"></i>${app.email || 'N/A'}
                                    </p>
                                </div>
                                <span class="badge bg-${badgeClass}">${app.status}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    Applied: ${new Date(app.created_at).toLocaleDateString()}
                                </small>
                            </div>
                        </div>
                    </div>
                `;
            });
            container.html(html);
        }

        function displayUserJobs(jobs) {
            const container = $('#jobsList');
            
            if (!jobs.length) {
                container.html(`
                    <div class="empty-state">
                        <i class="fas fa-briefcase"></i>
                        <h5>No Jobs Posted Yet</h5>
                        <p>Start by posting your first job to attract candidates.</p>
                        <button class="btn-post-job btn-primary" column-gap: 1rem;" onclick="showSection('create-job')">
                            <i class="fas fa-plus plus"></i>Post Your First Job
                        </button>
                    </div>
                `);
                return;
            }
        
            let html = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Applications</th>
                                <th>Posted Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
        
            jobs.forEach(job => {
                const applicationCount = typeof job.applicationCount !== 'undefined' ? job.applicationCount : 0;
                html += `
                    <tr>
                        <td>
                            <strong>${job.title}</strong>
                            ${job.salary ? `<br><small class="text-muted">${job.salary} <span class="badge salary_type">/ ${job.salary_type || ''}</span></small>` : ''}
                        </td>
                        <td>${job.company}</td>
                        <td>
                            <i class="fas fa-map-marker-alt me-1"></i>${job.location}
                        </td>
                        <td>
                            <span class="badge bg-info">${job.job_type || ''}</span>
                        </td>
                        <td>
                            <span class="badge ${job.status === 'active' ? 'bg-success' : job.status === 'inactive' ? 'bg-danger' : 'bg-secondary'}">
                                ${job.status === 'active' ? 'Active' : job.status === 'inactive' ? 'Inactive' : ''}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-primary">${applicationCount}</span>
                        </td>
                        <td>${new Date(job.created_at).toLocaleDateString()}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewJobDetails(${job.id})" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" onclick="editJob(${job.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" onclick="deleteJob(${job.id})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        
            html += `
                        </tbody>
                    </table>
                </div>
            `;
            container.html(html);
        }

        function displayUserApplications(applications) {
            const container = $('#applicationsList');
            
            let filteredApplications = applications;
            if (currentFilter !== 'all') {
                filteredApplications = applications.filter(app => app.status === currentFilter);
            }
            
            if (!filteredApplications.length) {
                const message = currentFilter === 'all' ? 'No applications received yet' : `No ${currentFilter} applications`;
                container.html(`
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <h5>${message}</h5>
                        <p>Applications will appear here when candidates apply to your jobs.</p>
                    </div>
                `);
                return;
            }

            let html = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Job</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Applied Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            filteredApplications.forEach(app => {
                const statusClass = {
                    'pending': 'warning',
                    'reviewed': 'warning',
                    'accepted': 'success',
                    'rejected': 'danger'
                };
                const badgeClass = statusClass[app.status] || 'secondary';
                
                html += `
                    <tr>
                        <td>
                            <strong>${app.name || 'N/A'}</strong>
                        </td>
                        <td>
                            <strong>${app.job_title}</strong>
                            <br><small class="text-muted">${app.job_company}</small>
                        </td>
                        <td>${app.email || 'N/A'}</td>
                        <td>${app.phone || 'N/A'}</td>
                        <td>
                            <span class="badge bg-${badgeClass}">${app.status}</span>
                        </td>
                        <td>${new Date(app.created_at).toLocaleDateString()}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewApplicationDetails(${app.id})" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                ${app.status === 'pending' ? `
                                    <button class="btn btn-outline-success" onclick="updateApplicationStatus(${app.id}, 'accepted')" title="Accepted">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="updateApplicationStatus(${app.id}, 'rejected')" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                ` : ''}
                            </div>
                        </td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                </div>
            `;
            container.html(html);
        }

        function setupFormHandlers() {
            $('#createJobForm').submit(function(e) {
                e.preventDefault();
                createJob();
            });

            $('#editJobForm').submit(function(e) {
                e.preventDefault();
                updateJob();
            });
        }

        function createJob() {
            const formData = {
                title: $('#jobTitle').val(),
                company: $('#jobCompany').val(),
                location: $('#jobLocation').val(),
                salary: $('#jobSalary').val(),
                salary_type: $('#jobSalaryType').val(),
                description: $('#jobDescription').val(),
                job_type: $('#jobType').val(), 
                status: $('#jobStatus').val(),
                user_id: currentUser.id
            };
        
            if (!formData.title || !formData.company || !formData.location || !formData.description || !formData.job_type || !formData.salary_type) {
                showError('Please fill in all required fields');
                return;
            }
        
            $.ajax({
                url: `${API_BASE}/jobs`,
                method: 'POST',
                data: JSON.stringify(formData),
                success: function(response) {
                    showSuccess('Job posted successfully!');
                    resetJobForm();
                    loadUserJobs();
                    showSection('jobs');
                },
                error: function(xhr) {
                    console.error('Error creating job:', xhr);
                    const message = xhr.responseJSON?.message || 'Failed to create job';
                    showError(message);
                }
            });
        }

        function resetJobForm() {
            $('#createJobForm')[0].reset();
        }

        function viewJobDetails(jobId) {
            const job = userJobs.find(j => j.id == jobId);
            if (!job) {
                showError('Job not found');
                return;
            }
        
            const applications = userApplications.filter(app => app.job_id == jobId);
            const statusText = job.status ? job.status.charAt(0).toUpperCase() + job.status.slice(1) : 'N/A';
        
            const content = `
                <div class="row">
                    <div class="col-md-8">
                        <h4>${job.title}</h4>
                        <p class="text-muted mb-3">${job.company} • ${job.location}</p>
        
                        <div class="mb-3">
                            <strong>Job Type:</strong> 
                            <span class="badge bg-info ms-2">${job.job_type || 'N/A'}</span>
                        </div>
        
                        ${job.salary ? `
                            <div class="mb-3">
                                <strong>Salary:</strong> ${job.salary} <span class="badge salary_type">/ ${job.salary_type || ''}</span>
                            </div>
                        ` : ''}
        
                        <div class="mb-3">
                            <strong>Status:</strong> 
                            <span class="badge ${job.status === 'active' ? 'bg-success' : job.status === 'inactive' ? 'bg-danger' : 'bg-secondary'} ms-2">
                                ${job.status === 'active' ? 'Active' : job.status === 'inactive' ? 'Inactive' : ''}
                            </span>
                        </div>
        
                        <div class="mb-3">
                            <strong>Description:</strong>
                            <div class="mt-2 p-3 bg-light rounded">
                                ${job.description.replace(/\n/g, '<br>')}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Job Statistics</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Applications:</span>
                                    <strong>${applications.length}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pending:</span>
                                    <strong class="text-warning">${applications.filter(app => app.status === 'pending').length}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Approved:</span>
                                    <strong class="text-success">${applications.filter(app => app.status === 'accepted').length}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Rejected:</span>
                                    <strong class="text-danger">${applications.filter(app => app.status === 'rejected').length}</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Posted:</span>
                                    <strong>${new Date(job.created_at).toLocaleDateString()}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        
            $('#jobDetailsContent').html(content);
            currentEditJobId = jobId;
        
            $('#editJobBtn').off('click').on('click', function() {
                $('#jobDetailsModal').modal('hide');
                editJob(jobId);
            });
        
            $('#deleteJobBtn').off('click').on('click', function() {
                $('#jobDetailsModal').modal('hide');
                deleteJob(jobId);
            });
        
            $('#jobDetailsModal').modal('show');
        }

        function editJob(jobId) {
            const job = userJobs.find(j => j.id == jobId);
            if (!job) {
                showError('Job not found');
                return;
            }
        
            $('#editJobId').val(job.id);
            $('#editJobTitle').val(job.title);
            $('#editJobCompany').val(job.company);
            $('#editJobLocation').val(job.location);
            $('#editJobSalary').val(job.salary || '');
            $('#editJobDescription').val(job.description);
            $('#editJobType').val(job.job_type); 
            $('#editJobStatus').val(job.status);
            $('#editJobSalaryType').val(job.salary_type || 'month');
        
            currentEditJobId = jobId;
            $('#editJobModal').modal('show');
        }

        function updateJob() {
            const jobId = $('#editJobId').val();
            const formData = {
                title: $('#editJobTitle').val(),
                company: $('#editJobCompany').val(),
                location: $('#editJobLocation').val(),
                salary: $('#editJobSalary').val(),
                salary_type: $('#editJobSalaryType').val(),
                description: $('#editJobDescription').val(),
                job_type: $('#editJobType').val(), 
                status: $('#editJobStatus').val()
            };
        
            if (!formData.title || !formData.company || !formData.location || !formData.description || !formData.job_type || !formData.salary_type) {
                showError('Please fill in all required fields');
                return;
            }
        
            $.ajax({
                url: `${API_BASE}/jobs/${jobId}`,
                method: 'PUT',
                data: JSON.stringify(formData),
                success: function(response) {
                    showSuccess('Job updated successfully!');
                    $('#editJobModal').modal('hide');
                    loadUserJobs();
                },
                error: function(xhr) {
                    console.error('Error updating job:', xhr);
                    const message = xhr.responseJSON?.message || 'Failed to update job';
                    showError(message);
                }
            });
        }

        function deleteJob(jobId) {
            if (!confirm('Are you sure you want to delete this job? This action cannot be undone.')) {
                return;
            }

            $.ajax({
                url: `${API_BASE}/jobs/${jobId}`,
                method: 'DELETE',
                success: function(response) {
                    showSuccess('Job deleted successfully!');
                    loadUserJobs();
                },
                error: function(xhr) {
                    console.error('Error deleting job:', xhr);
                    const message = xhr.responseJSON?.message || 'Failed to delete job';
                    showError(message);
                }
            });
        }

        function viewApplicationDetails(applicationId) {
            const application = userApplications.find(app => app.id == applicationId);
            if (!application) {
                showError('Application not found');
                return;
            }

            const content = `
                <div class="row">
                    <div class="col-md-6">
                        <h5>Applicant Information</h5>
                        <div class="mb-3">
                            <strong>Name:</strong> ${application.name || 'N/A'}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> ${application.email || 'N/A'}
                        </div>
                        <div class="mb-3">
                            <strong>Phone:</strong> ${application.phone || 'N/A'}
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong> 
                            <span class="badge bg-${
                                application.status === 'accepted' ? 'success' :
                                application.status === 'pending' ? 'warning' :
                                application.status === 'rejected' ? 'danger' :
                                'secondary'
                            } ms-2">
                                ${application.status}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Job Information</h5>
                        <div class="mb-3">
                            <strong>Position:</strong> ${application.job_title}
                        </div>
                        <div class="mb-3">
                            <strong>Company:</strong> ${application.job_company}
                        </div>
                        <div class="mb-3">
                            <strong>Applied Date:</strong> ${new Date(application.created_at).toLocaleDateString()}
                        </div>
                    </div>
                </div>
                ${application.cover_letter ? `
                    <div class="mt-4">
                        <h5>Cover Letter</h5>
                        <div class="p-3 bg-light rounded">
                            ${application.cover_letter.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                ` : ''}
                ${application.resume_url ? `
                    <div class="mt-4">
                        <h5>Resume</h5>
                        <a href="${application.resume_url}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i>Download Resume
                        </a>
                    </div>
                ` : ''}
            `;

            $('#applicationDetailsContent').html(content);
            currentApplicationId = applicationId;

            if (application.status === 'pending') {
                $('#approveApplicationBtn').show().off('click').on('click', function() {
                    updateApplicationStatus(applicationId, 'accepted');
                });
                $('#rejectApplicationBtn').show().off('click').on('click', function() {
                    updateApplicationStatus(applicationId, 'rejected');
                });
            } else {
                $('#approveApplicationBtn').hide();
                $('#rejectApplicationBtn').hide();
            }

            $('#applicationDetailsModal').modal('show');
        }

        function updateApplicationStatus(applicationId, status) {
            $.ajax({
                url: `${API_BASE}/applications/${applicationId}`,
                method: 'PUT',
                data: JSON.stringify({ status: status }),
                success: function(response) {
                    showSuccess(`Application ${status} successfully!`);
                    $('#applicationDetailsModal').modal('hide');
                    loadUserApplications();
                },
                error: function(xhr) {
                    console.error('Error updating application status:', xhr);
                    const message = xhr.responseJSON?.message || 'Failed to update application status';
                    showError(message);
                }
            });
        }

        function filterApplications(filter) {
            currentFilter = filter;
            
            $('.btn-group button').removeClass('active');
            $(event.target).addClass('active');
            
            displayUserApplications(userApplications);
        }

        function refreshData() {
            loadDashboardData();
            showSuccess('Data refreshed successfully!');
        }

        function logout() {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }

        function showSuccess(message) {
            $('.alert').remove();
            
            const alert = `
                <div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
                    <i class="fas fa-check-circle me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            $('body').append(alert);
            
            setTimeout(() => {
                $('.alert-success').fadeOut();
            }, 5000);
        }

        function showError(message) {
            $('.alert').remove();
            
            const alert = `
                <div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
                    <i class="fas fa-exclamation-circle me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            $('body').append(alert);
            
            setTimeout(() => {
                $('.alert-danger').fadeOut();
            }, 7000);
        }

        function showInfo(message) {
            $('.alert').remove();
            
            const alert = `
                <div class="alert alert-info alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
                    <i class="fas fa-info-circle me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            $('body').append(alert);
            
            setTimeout(() => {
                $('.alert-info').fadeOut();
            }, 5000);
        }

        $(document).ajaxError(function(event, xhr, settings, thrownError) {
            if (xhr.status === 401) {
                showError('Session expired. Please login again.');
                setTimeout(() => {
                    logout();
                }, 2000);
            } else if (xhr.status === 403) {
                showError('Access denied. You do not have permission to perform this action.');
            } else if (xhr.status === 404) {
                showError('Resource not found.');
            } else if (xhr.status >= 500) {
                showError('Server error. Please try again later.');
            }
        });

        $(document).ajaxComplete(function(event, xhr, settings) {
            if (xhr.status === 0 && xhr.statusText === 'error') {
                showError('Network error. Please check your internet connection.');
            }
        });
    </script>

<script>
    function getJobFormGroup(index) {
        return `
        <div class="multi-job-group border rounded p-3 mb-3 position-relative" data-index="${index}">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Remove" onclick="removeJobField(this)"></button>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Job Title *</label>
                    <input type="text" class="form-control jobTitle" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Company *</label>
                    <input type="text" class="form-control jobCompany" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Location *</label>
                    <input type="text" class="form-control jobLocation" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Salary</label>
                    <input type="text" class="form-control jobSalary" placeholder="e.g., $50,000 - $70,000">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Salary Type</label>
                    <select class="form-select jobSalaryType" required>
                        <option value="hour">Hour</option>
                        <option value="month" selected>Month</option>
                        <option value="year">Year</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Job Description *</label>
                <textarea class="form-control jobDescription" rows="3" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Job Type *</label>
                    <select class="form-select jobType" required>
                        <option value="">Select Job Type</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="freelance">Freelance</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status *</label>
                    <select class="form-select jobStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        `;
    }

    function addJobField() {
        const index = $('#multiJobFields .multi-job-group').length;
        $('#multiJobFields').append(getJobFormGroup(index));
    }

    function removeJobField(btn) {
        $(btn).closest('.multi-job-group').remove();
    }

    function resetMultiJobForm() {
        $('#multiJobFields').empty();
        addJobField();
    }

    $(document).ready(function() {
        if ($('#multiJobFields').length) {
            resetMultiJobForm();
        }
        $('#addJobBtn').off('click').on('click', function() {
            addJobField();
        });
    });

    $('#multiJobForm').submit(function(e) {
        e.preventDefault();
        const jobs = [];
        let valid = true;

        $('#multiJobFields .multi-job-group').each(function() {
        const job = {
            title: $(this).find('.jobTitle').val(),
            company: $(this).find('.jobCompany').val(),
            location: $(this).find('.jobLocation').val(),
            salary: $(this).find('.jobSalary').val(),
            salary_type: $(this).find('.jobSalaryType').val(),
            description: $(this).find('.jobDescription').val(),
            job_type: $(this).find('.jobType').val(),
            status: $(this).find('.jobStatus').val()
            // user_id: currentUser.id // user_id is set server-side
        };
        if (!job.title || !job.company || !job.location || !job.description || !job.job_type || !job.salary_type) {
            valid = false;
            return false;
        }
        jobs.push(job);
    });

    if (!valid || jobs.length === 0) {
        showError('Please fill in all required fields for each job.');
        return;
    }
    
    $('#submitAllJobsBtn').prop('disabled', true);
    
    let successCount = 0;
    let errorCount = 0;
    let errorMessages = [];
    let completed = 0;
    
    jobs.forEach(function(job, idx) {
        $.ajax({
            url: `${API_BASE}/jobs`,
            method: 'POST',
            data: JSON.stringify(job),
            contentType: 'application/json',
            success: function(response) {
                successCount++;
            },
            error: function(xhr) {
                errorCount++;
                let msg = `Job #${idx+1}: `;
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg += Object.values(xhr.responseJSON.errors).map(arr => arr.join(', ')).join('; ');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg += xhr.responseJSON.message;
                } else {
                    msg += 'Unknown error';
                }
                errorMessages.push(msg);
            },
            complete: function() {
                completed++;
                if (completed === jobs.length) {
                    $('#submitAllJobsBtn').prop('disabled', false);
                    if (successCount > 0) {
                        showSuccess(`${successCount} job(s) posted successfully!`);
                        resetMultiJobForm();
                        loadUserJobs();
                        showSection('jobs');
                    }
                        if (errorCount > 0) {
                            showError('Some jobs failed to post:<br>' + errorMessages.join('<br>'));
                        }
                    }
                }
            });
        });
    });
</script>

</body>
</html><?php /**PATH C:\wamp64\www\job-board\resources\views/dashboard.blade.php ENDPATH**/ ?>