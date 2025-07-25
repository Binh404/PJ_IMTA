

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .row {
            min-height: 550px;
        }

        .logo-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/api/placeholder/400/320') center/cover;
            opacity: 0.2;
        }

        .brand {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
        }

        .tagline {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 30px;
            position: relative;
        }

        .form-section {
            padding: 40px;
        }

        .login-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            position: relative;
        }

        .login-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            height: 4px;
            width: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 5px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #764ba2;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 0;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
            color: #6c757d;
        }

        .social-login {
            margin-top: 30px;
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .facebook {
            background-color: #3b5998;
        }

        .google {
            background-color: #db4437;
        }

        .linkedin {
            background-color: #0077b5;
        }

        .register-link {
            color: #764ba2;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .register-link:hover {
            color: #667eea;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .form-floating-group {
            position: relative;
        }

        /* Animation classes */
        .floating-label {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .logo-section {
                padding: 30px 15px;
                min-height: 200px;
            }

            .form-section {
                padding: 30px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container animate__animated animate__fadeIn">
            <div class="row g-0">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="logo-section h-100">
                        <h1 class="brand animate__animated animate__fadeInUp">By Bình Boong</h1>
                        <p class="tagline animate__animated animate__fadeInUp animate__delay-1s">Chào mừng bạn quay trở lại! Đăng nhập để truy cập tài khoản của bạn.</p>
                        <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="feature-item text-center mx-3">
                                <i class="fas fa-shield-alt fa-2x mb-2"></i>
                                <div>An toàn</div>
                            </div>
                            <div class="feature-item text-center mx-3">
                                <i class="fas fa-bolt fa-2x mb-2"></i>
                                <div>Nhanh chóng</div>
                            </div>
                            <div class="feature-item text-center mx-3">
                                <i class="fas fa-user-lock fa-2x mb-2"></i>
                                <div>Bảo mật</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-section">
                        <h2 class="login-title">Đăng Nhập</h2>

                        <div id="errorContainer" class="alert alert-danger d-none">
                            <ul id="errorList" class="mb-0">
                                <!-- Errors will be inserted here dynamically -->
                            </ul>
                        </div>

                        <form id="loginForm" action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email">Địa chỉ Email</label>
                                <div class="invalid-feedback">
                                    Vui lòng nhập địa chỉ email hợp lệ.
                                </div>
                            </div>

                            <div class="form-floating-group mb-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Mật khẩu</label>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu.
                                    </div>
                                </div>
                                <span class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <a href="#" class="register-link">Quên mật khẩu?</a>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-login" id="loginButton">
                                    <span class="spinner-border spinner-border-sm d-none me-2" id="loginSpinner" role="status" aria-hidden="true"></span>
                                    Đăng Nhập
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p>Chưa có tài khoản? <a href="{{ route('register') }}" class="register-link">Đăng ký ngay</a></p>
                            </div>

                            <div class="social-login text-center">
                                {{-- <p class="mb-3">Hoặc đăng nhập với</p>
                                <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-btn google"><i class="fab fa-google"></i></a>
                                <a href="#" class="social-btn linkedin"><i class="fab fa-linkedin-in"></i></a> --}}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Form validation
            const form = document.getElementById('loginForm');
            const errorContainer = document.getElementById('errorContainer');
            const errorList = document.getElementById('errorList');
            const loginButton = document.getElementById('loginButton');
            const loginSpinner = document.getElementById('loginSpinner');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                // Show loading spinner
                loginButton.disabled = true;
                loginSpinner.classList.remove('d-none');

                // Simulate form submission delay (remove in production)
                setTimeout(function() {
                    // Simulating server validation (for demo purposes)
                    const email = document.getElementById('email').value;
                    const pass = document.getElementById('password').value;

                    // Check email format with regex
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const errors = [];

                    if (!emailRegex.test(email)) {
                        errors.push('Địa chỉ email không hợp lệ.');
                    }

                    if (pass.length < 6) {
                        errors.push('Mật khẩu phải có ít nhất 6 ký tự.');
                    }

                    if (errors.length > 0) {
                        // Display errors
                        errorList.innerHTML = '';
                        errors.forEach(function(error) {
                            const li = document.createElement('li');
                            li.textContent = error;
                            errorList.appendChild(li);
                        });

                        errorContainer.classList.remove('d-none');

                        // Shake animation for error feedback
                        errorContainer.classList.add('animate__animated', 'animate__shakeX');

                        // Remove animation class after animation completes
                        errorContainer.addEventListener('animationend', function() {
                            errorContainer.classList.remove('animate__animated', 'animate__shakeX');
                        }, {once: true});
                    } else {
                        // Submit the form if validation passes
                        form.submit();
                    }

                    // Hide loading spinner
                    loginButton.disabled = false;
                    loginSpinner.classList.add('d-none');
                }, 1000);
            });

            // Clear errors when input changes
            const inputs = form.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    errorContainer.classList.add('d-none');
                    form.classList.remove('was-validated');
                });
            });

            // Floating label animation enhancements
            document.querySelectorAll('.form-floating input').forEach(input => {
                if (input.value) {
                    input.classList.add('filled');
                }

                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', () => {
                    input.parentElement.classList.remove('focused');
                    if (input.value) {
                        input.classList.add('filled');
                    } else {
                        input.classList.remove('filled');
                    }
                });
            });
        });
    </script>
</body>
</html>
