<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
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
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">Welcome Back</h2>
                            <p class="text-muted">Sign in to your account</p>
                        </div>

                        <div id="alert-container"></div>

                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback" id="email-error"></div>
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
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-login btn-primary w-100 mb-3" id="loginBtn">
                                <span class="spinner-border spinner-border-sm me-2 d-none" id="loginSpinner"></span>
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="/api/register" class="text-decoration-none fw-semibold">Sign up here</a>
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

            // Login form submission
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                
                const loginBtn = $('#loginBtn');
                const loginSpinner = $('#loginSpinner');
                const alertContainer = $('#alert-container');
                
                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                alertContainer.empty();
                
                // Show loading state
                loginBtn.prop('disabled', true);
                loginSpinner.removeClass('d-none');
                
                const formData = {
                    email: $('#email').val(),
                    password: $('#password').val()
                };
                
                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Store token in localStorage
                        localStorage.setItem('auth_token', response.token);
                        localStorage.setItem('user_data', JSON.stringify(response.user));
                        
                        // Show success message
                        alertContainer.html(`
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>Login successful! Redirecting...
                            </div>
                        `);
                        
                        // Redirect to dashboard
                        setTimeout(function() {
                            window.location.href = '/dashboard';
                        }, 1500);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON;
                        
                        if (errors.errors) {
                            // Display field-specific errors
                            $.each(errors.errors, function(field, messages) {
                                $('#' + field).addClass('is-invalid');
                                $('#' + field + '-error').text(messages[0]);
                            });
                        } else if (errors.message) {
                            // Display general error message
                            alertContainer.html(`
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>${errors.message}
                                </div>
                            `);
                        } else {
                            alertContainer.html(`
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>Login failed. Please try again.
                                </div>
                            `);
                        }
                    },
                    complete: function() {
                        // Hide loading state
                        loginBtn.prop('disabled', false);
                        loginSpinner.addClass('d-none');
                    }
                });
            });

            // Check if user is already logged in
            // if (localStorage.getItem('auth_token')) {
            //     window.location.href = '/api/dashboard';
            // }
        });
    </script>
</body>
</html>
<?php /**PATH C:\wamp64\www\job-board\resources\views/auth/login.blade.php ENDPATH**/ ?>