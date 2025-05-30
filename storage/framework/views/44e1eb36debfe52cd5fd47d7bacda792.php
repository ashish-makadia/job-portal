<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Register</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 1000px;
            margin: auto;
        }
        
        .register-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        
        .register-right {
            padding: 60px 40px;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .form-floating > label {
            color: #6c757d;
        }
        
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .alert {
            border-radius: 10px;
        }
        
        .role-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            font-size: 0.9em;
            color: #6c757d;
        }
        
        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.8em;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        
        .role-user { background: #e3f2fd; color: #1976d2; }
        .role-employer { background: #e8f5e8; color: #388e3c; }
        .role-admin { background: #fff3e0; color: #f57c00; }
        
        @media (max-width: 768px) {
            .register-left {
                padding: 30px 20px;
            }
            .register-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Creating your account...</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="register-container">
                    <div class="row g-0">
                        <!-- Left Side - Welcome -->
                        <div class="col-md-5 register-left">
                            <div>
                                <h2 class="mb-4">
                                    <i class="fas fa-user-plus me-2"></i>Join Us Today!
                                </h2>
                                <p class="lead mb-4">Create your account and start your journey to find the perfect job or hire amazing talent.</p>
                                
                                <div class="mb-4">
                                    <h5 class="mb-3">Choose Your Role:</h5>
                                    <div class="text-start">
                                        <span class="role-badge role-user">
                                            <i class="fas fa-user me-1"></i>Job Seeker
                                        </span>
                                        <span class="role-badge role-employer">
                                            <i class="fas fa-building me-1"></i>Employer
                                        </span>
                                        <span class="role-badge role-admin">
                                            <i class="fas fa-crown me-1"></i>Admin
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <p class="mb-2">Already have an account?</p>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-sign-in-alt me-1"></i>Sign In
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side - Registration Form -->
                        <div class="col-md-7 register-right">
                            <div class="mb-4">
                                <h3 class="text-center mb-1">Create Account</h3>
                                <p class="text-center text-muted">Fill in your details to get started</p>
                            </div>
                            
                            <!-- Alert Messages -->
                            <div id="alertContainer"></div>
                            
                            <!-- Registration Form -->
                            <form id="registerForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                                            <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                                            <div class="invalid-feedback" id="nameError"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="">Choose Role</option>
                                                <option value="user">Job Seeker</option>
                                                <option value="employer">Employer</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                            <label for="role"><i class="fas fa-user-tag me-2"></i>Role</label>
                                            <div class="invalid-feedback" id="roleError"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                    <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                    <div class="invalid-feedback" id="emailError"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 position-relative">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                            <div class="invalid-feedback" id="passwordError"></div>
                                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer; z-index:2;" id="togglePassword">
                                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 position-relative">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                            <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                                            <div class="invalid-feedback" id="passwordConfirmationError"></div>
                                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer; z-index:2;" id="togglePasswordConfirm">
                                                <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Role Information -->
                                <div class="role-info" id="roleInfo" style="display: none;">
                                    <div id="roleDescription"></div>
                                </div>
                                
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                    <div class="invalid-feedback" id="termsError"></div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-register btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </div>
                            </form>
                            
                            <div class="text-center mt-4">
                                <a href="<?php echo e(route('home')); ?>" class="text-decoration-none">
                                    <i class="fas fa-home me-1"></i>Back to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            });

            if (localStorage.getItem('auth_token')) {
                window.location.href = '/';
                return;
            }

            const roleDescriptions = {
                'user': {
                    title: 'Job Seeker',
                    description: 'Perfect for individuals looking for job opportunities. You can browse jobs, apply to positions, and manage your applications.',
                    features: ['Browse and search jobs', 'Apply to positions', 'Track applications', 'Create profile']
                },
                'employer': {
                    title: 'Employer',
                    description: 'Ideal for companies and recruiters. You can post job listings, manage applications, and find the right candidates.',
                    features: ['Post job listings', 'Manage applications', 'Search candidates', 'Company dashboard']
                },
                'admin': {
                    title: 'Administrator',
                    description: 'For platform administrators with full access to manage users, jobs, and system settings.',
                    features: ['Manage all users', 'Moderate content', 'System administration', 'Analytics dashboard']
                }
            };

            $('#role').on('change', function() {
                const selectedRole = $(this).val();
                const roleInfo = $('#roleInfo');
                const roleDescription = $('#roleDescription');
                
                if (selectedRole && roleDescriptions[selectedRole]) {
                    const role = roleDescriptions[selectedRole];
                    const featuresHtml = role.features.map(feature => 
                        `<li><i class="fas fa-check text-success me-2"></i>${feature}</li>`
                    ).join('');
                    
                    roleDescription.html(`
                        <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>${role.title}</h6>
                        <p class="mb-2">${role.description}</p>
                        <ul class="mb-0 ps-3">${featuresHtml}</ul>
                    `);
                    roleInfo.slideDown();
                } else {
                    roleInfo.slideUp();
                }
            });

            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const icon = $('#togglePasswordIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                icon.toggleClass('fa-eye fa-eye-slash');
            });
        
            $('#togglePasswordConfirm').on('click', function() {
                const passwordInput = $('#password_confirmation');
                const icon = $('#togglePasswordConfirmIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                icon.toggleClass('fa-eye fa-eye-slash');
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                clearErrors();
                
                const formData = {
                    name: $('#name').val().trim(),
                    email: $('#email').val().trim(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    role: $('#role').val()
                };

                if (!validateForm(formData)) {
                    return;
                }

                showLoading();

                $.ajax({
                    url: '/api/register',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        hideLoading();
                        
                        if (response.token) {
                            localStorage.setItem('auth_token', response.token);
                            localStorage.setItem('user_data', JSON.stringify(response.user));
                            
                            showAlert('Registration successful! Welcome aboard! Redirecting...', 'success');
                            
                            setTimeout(function() {
                                window.location.href = '/';
                            }, 2000);
                        } else {
                            showAlert('Registration completed, but login failed. Please try signing in.', 'warning');
                            setTimeout(function() {
                                window.location.href = '/login';
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        hideLoading();
                        
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            displayValidationErrors(errors);
                        } else if (xhr.status === 409) {
                            showAlert('An account with this email already exists. Please try signing in.', 'danger');
                        } else {
                            showAlert('Registration failed. Please check your connection and try again.', 'danger');
                        }
                        
                        console.error('Registration error:', error);
                    }
                });
            });

            function validateForm(data) {
                let isValid = true;

                if (!data.name || data.name.length < 2) {
                    $('#name').addClass('is-invalid');
                    $('#nameError').text('Name must be at least 2 characters long.');
                    isValid = false;
                }

                if (!data.email || !isValidEmail(data.email)) {
                    $('#email').addClass('is-invalid');
                    $('#emailError').text('Please enter a valid email address.');
                    isValid = false;
                }

                if (!data.password || data.password.length < 8) {
                    $('#password').addClass('is-invalid');
                    $('#passwordError').text('Password must be at least 8 characters long.');
                    isValid = false;
                }

                if (data.password !== data.password_confirmation) {
                    $('#password_confirmation').addClass('is-invalid');
                    $('#passwordConfirmationError').text('Passwords do not match.');
                    isValid = false;
                }

                if (!data.role) {
                    $('#role').addClass('is-invalid');
                    $('#roleError').text('Please select a role.');
                    isValid = false;
                }

                if (!$('#terms').is(':checked')) {
                    $('#terms').addClass('is-invalid');
                    $('#termsError').text('You must accept the terms and conditions.');
                    isValid = false;
                }

                if (!isValid) {
                    showAlert('Please correct the errors below and try again.', 'danger');
                }

                return isValid;
            }

            $('#name').on('blur', function() {
                const name = $(this).val().trim();
                if (name && name.length < 2) {
                    $(this).addClass('is-invalid');
                    $('#nameError').text('Name must be at least 2 characters long.');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#nameError').text('');
                }
            });

            $('#email').on('blur', function() {
                const email = $(this).val().trim();
                if (email && !isValidEmail(email)) {
                    $(this).addClass('is-invalid');
                    $('#emailError').text('Please enter a valid email address.');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#emailError').text('');
                }
            });

            $('#password').on('input', function() {
                const password = $(this).val();
                if (password.length > 0 && password.length < 8) {
                    $(this).addClass('is-invalid');
                    $('#passwordError').text('Password must be at least 8 characters long.');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#passwordError').text('');
                    
                    const confirmation = $('#password_confirmation').val();
                    if (confirmation && password !== confirmation) {
                        $('#password_confirmation').addClass('is-invalid');
                        $('#passwordConfirmationError').text('Passwords do not match.');
                    } else if (confirmation) {
                        $('#password_confirmation').removeClass('is-invalid');
                        $('#passwordConfirmationError').text('');
                    }
                }
            });

            $('#password_confirmation').on('input', function() {
                const password = $('#password').val();
                const confirmation = $(this).val();
                
                if (confirmation && password !== confirmation) {
                    $(this).addClass('is-invalid');
                    $('#passwordConfirmationError').text('Passwords do not match.');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#passwordConfirmationError').text('');
                }
            });

            function showLoading() {
                $('#loadingOverlay').css('display', 'flex');
            }

            function hideLoading() {
                $('#loadingOverlay').hide();
            }

            function showAlert(message, type) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        <i class="fas fa-${getAlertIcon(type)} me-2"></i>${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#alertContainer').html(alertHtml);
                
                if (type === 'success') {
                    setTimeout(function() {
                        $('.alert').alert('close');
                    }, 4000);
                }
            }

            function getAlertIcon(type) {
                const icons = {
                    'success': 'check-circle',
                    'danger': 'exclamation-triangle',
                    'warning': 'exclamation-triangle',
                    'info': 'info-circle'
                };
                return icons[type] || 'info-circle';
            }

            function clearErrors() {
                $('.form-control, .form-select').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('#alertContainer').html('');
            }

            function displayValidationErrors(errors) {
                $.each(errors, function(field, messages) {
                    const input = $('#' + field);
                    const errorDiv = $('#' + field + 'Error');
                    
                    input.addClass('is-invalid');
                    errorDiv.text(messages[0]);
                });
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            $('.form-control, .form-select').on('input change', function() {
                if ($(this).hasClass('is-invalid')) {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('#terms').on('change', function() {
                if ($(this).hasClass('is-invalid')) {
                    $(this).removeClass('is-invalid');
                    $('#termsError').text('');
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\job-board\resources\views/register.blade.php ENDPATH**/ ?>