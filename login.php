<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-header {
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="card mt-5">
                    <div class="card-header text-center bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </h5>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="text-center mb-3">Welcome Back</h5>
                        <form>
                            <div class="mb-3">
                                <label for="loginUsername" class="form-label">Username</label>
                                <input type="text" class="form-control form-control-sm" id="loginUsername" placeholder="Enter your username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-sm" id="loginPassword" placeholder="Enter your password" required>
                                    <i class="bi bi-eye password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                                </div>
                            </div>
                            
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label small" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none small">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 btn-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">Don't have an account? 
                                <a href="#" class="text-decoration-none fw-bold">Sign up here</a>
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-2">
                    <small class="text-muted">
                        © 2024 Your Company. All rights reserved.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle the eye icon
            if (type === 'password') {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>