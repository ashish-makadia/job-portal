
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Register - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
        .strength-weak { background-color: #dc3545; }
        .strength-medium { background-color: #ffc107; }
        .strength-strong { background-color: #28a745; }
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container-fluid register-container">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card register-card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">Create Account</h2>
                            <p class="text-muted">Join our job portal today</p>
                        </div>

                        <div id="alert-container"></div>

                        <form id="registerForm">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">
                                    <i class="fas fa-briefcase me-2"></i>Account Type
                                </label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select your role</option>
                                    <option value="user">Job Seeker</option>
                                    <option value="employer">Employer</option>
                                    <option value="admin">Administrator</option>
                                </select>
                                <div class="invalid-feedback" id="role-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength" id="passwordStrength"></div>
                                <div class="invalid-feedback" id="password-error"></div>
                                <small class="text-muted">
                                    Password must be at least 8 characters with uppercase, lowercase, number and special character
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2"></i>Confirm Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="password_confirmation-error"></div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> 
                                        and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                    <div class="invalid-feedback" id="terms-error"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                    <label class="form-check-label" for="newsletter">
                                        Subscribe to our newsletter for job updates
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-register btn-primary w-100 mb-3" id="registerBtn">
                                <span class="spinner-border spinner-border-sm me-2 d-none" id="registerSpinner"></span>
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="mb-0">Already have an account? 
                                <a href="/api/login" class="text-decoration-none fw-semibold">Sign in here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Toggle password visibility
            $('#togglePassword').click(function() {
                const passwordField = $('#password');
                const passwordFieldType = passwordField.attr('type');
                const icon = $(this).find('i');
                
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Toggle confirm password visibility
            $('#togglePasswordConfirm').click(function() {
                const passwordField = $('#password_confirmation');
                const passwordFieldType = passwordField.attr('type');
                const icon = $(this).find('i');
                
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Password strength checker
            $('#password').on('input', function() {
                const password = $(this).val();
                const strengthBar = $('#passwordStrength');
                let strength = 0;

                // Check password criteria
                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                // Update strength bar
                strengthBar.removeClass('strength-weak strength-medium strength-strong');
                
                if (strength < 3) {
                    strengthBar.addClass('strength-weak').css('width', '33%');
                } else if (strength < 5) {
                    strengthBar.addClass('strength-medium').css('width', '66%');
                } else {
                    strengthBar.addClass('strength-strong').css('width', '100%');
                }
            });

            // Password confirmation validation
            $('#password_confirmation').on('input', function() {
                const password = $('#password').val();
                const confirmPassword = $(this).val();
                
                if (confirmPassword && password !== confirmPassword) {
                    $(this).addClass('is-invalid');
                    $('#password_confirmation-error').text('Passwords do not match');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#password_confirmation-error').text('');
                }
            });

            // Register form submission
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                
                const registerBtn = $('#registerBtn');
                const registerSpinner = $('#registerSpinner');
                const alertContainer = $('#alert-container');
                
                // Clear previous errors
                $('.form-control, .form-select').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                alertContainer.empty();
                
                // Validate passwords match
                const password = $('#password').val();
                const confirmPassword = $('#password_confirmation').val();
                
                if (password !== confirmPassword) {
                    $('#password_confirmation').addClass('is-invalid');
                    $('#password_confirmation-error').text('Passwords do not match');
                    return;
                }
                
                // Validate terms checkbox
                if (!$('#terms').is(':checked')) {
                    $('#terms').addClass('is-invalid');
                    $('#terms-error').text('You must agree to the terms and conditions');
                    return;
                }
                
                // Show loading state
                registerBtn.prop('disabled', true);
                registerSpinner.removeClass('d-none');
                
                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: password,
                    password_confirmation: confirmPassword,
                    role: $('#role').val()
                };
                
                $.ajax({
                    url: '/api/register',
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    dataType: 'json',
                    xhrFields: { withCredentials: true }, // Important for CSRF/session!
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Store token in localStorage
                        localStorage.setItem('auth_token', response.token);
                        localStorage.setItem('user_data', JSON.stringify(response.user));
                        
                        // Show success message
                        alertContainer.html(`
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>Registration successful! Redirecting to dashboard...
                            </div>
                        `);
                        
                        // Redirect to dashboard
                        setTimeout(function() {
                            window.location.href = '/api/login';
                        }, 2000);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON;
                        
                        if (errors && errors.errors) {
                            // Display field-specific errors
                            $.each(errors.errors, function(field, messages) {
                                $('#' + field).addClass('is-invalid');
                                $('#' + field + '-error').text(messages[0]);
                            });
                        } else if (errors && errors.message) {
                            // Display general error message
                            alertContainer.html(`
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>${errors.message}
                                </div>
                            `);
                        } else {
                            alertContainer.html(`
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>Registration failed. Please try again.
                                </div>
                            `);
                        }
                    },
                    complete: function() {
                        // Hide loading state
                        registerBtn.prop('disabled', false);
                        registerSpinner.addClass('d-none');
                    }
                });
            });

            // Real-time email validation
            $('#email').on('blur', function() {
                const email = $(this).val();
                if (email) {
                    // Basic email format validation
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        $(this).addClass('is-invalid');
                        $('#email-error').text('Please enter a valid email address');
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#email-error').text('');
                    }
                }
            });

            // Real-time name validation
            $('#name').on('input', function() {
                const name = $(this).val();
                if (name.length > 0 && name.length < 2) {
                    $(this).addClass('is-invalid');
                    $('#name-error').text('Name must be at least 2 characters long');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#name-error').text('');
                }
            });

            // Role selection validation
            $('#role').on('change', function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                    $('#role-error').text('Please select your account type');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#role-error').text('');
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\wamp64\www\job-board\resources\views/auth/register.blade.php ENDPATH**/ ?>