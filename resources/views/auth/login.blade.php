@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }
    
    .login-card {
        background: linear-gradient(135deg, #1e1e2a 0%, #18181f 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 32px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(139, 92, 246, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(139, 92, 246, 0.3);
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(59, 130, 246, 0.05));
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        padding: 1.5rem;
        text-align: center;
    }
    
    .card-header-custom h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff, #c084fc);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .card-header-custom p {
        margin: 0.5rem 0 0;
        color: #9ca3af;
        font-size: 0.85rem;
    }
    
    .card-body-custom {
        padding: 2rem;
    }
    
    /* Form Group Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #d1d5db;
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }
    
    .form-label i {
        color: #8b5cf6;
        font-size: 0.9rem;
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .input-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 1rem;
        transition: color 0.3s ease;
        pointer-events: none;
    }
    
    .input-wrapper input {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 2.8rem;
        background: #2a2a36 !important;
        border: 1.5px solid #3c3c48 !important;
        border-radius: 16px !important;
        color: #f0f0f5 !important;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .input-wrapper input:focus {
        border-color: #8b5cf6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    }
    
    .input-wrapper input:focus + i {
        color: #c084fc;
    }
    
    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        transition: color 0.3s ease;
        z-index: 2;
    }
    
    .password-toggle:hover {
        color: #c084fc;
    }
    
    /* Options Row */
    .options-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        font-size: 0.8rem;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #9ca3af;
        cursor: pointer;
    }
    
    .checkbox-label input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #8b5cf6;
        cursor: pointer;
    }
    
    .forgot-link {
        color: #8b5cf6;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .forgot-link:hover {
        color: #c084fc;
        text-decoration: underline;
    }
    
    /* Login Button */
    .login-btn {
        width: 100%;
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border: none;
        border-radius: 40px;
        padding: 0.85rem;
        font-weight: 600;
        font-size: 0.95rem;
        color: white;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .login-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }
    
    .login-btn:hover i {
        transform: translateX(4px);
    }
    
    .login-btn:active {
        transform: translateY(0);
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #6b7280;
        font-size: 0.75rem;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #3c3c48;
    }
    
    .divider::before {
        margin-right: 1rem;
    }
    
    .divider::after {
        margin-left: 1rem;
    }
    
    /* Social Login */
    .social-login {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .social-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.7rem;
        background: #2a2a36;
        border: 1px solid #3c3c48;
        border-radius: 40px;
        color: #d1d5db;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .social-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .social-btn:hover {
        background: #3a3a4a;
        border-color: #8b5cf6;
        transform: translateY(-2px);
    }
    
    .social-btn:hover i {
        transform: scale(1.1);
    }
    
    /* Register Link */
    .register-link {
        text-align: center;
        color: #9ca3af;
        font-size: 0.85rem;
    }
    
    .register-link a {
        color: #8b5cf6;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .register-link a:hover {
        color: #c084fc;
        text-decoration: underline;
    }
    
    /* Alert Messages */
    .alert-custom {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 16px;
        color: #fca5a5;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
    }
    
    .alert-custom i {
        font-size: 1rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-body-custom {
            padding: 1.5rem;
        }
        
        .social-login {
            flex-direction: column;
        }
        
        .options-row {
            flex-direction: column;
            gap: 0.8rem;
            align-items: flex-start;
        }
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .login-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<div class="login-wrapper">
    <div class="col-md-5 col-lg-4">
        <div class="login-card">
            <div class="card-header-custom">
                <i class="fas fa-robot" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem;"></i>
                <h3>Welcome Back!</h3>
                <p>Sign in to continue your AI conversations</p>
            </div>
            
            <div class="card-body-custom">
                @if($errors->any())
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            <span>Email Address</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-envelope"></i> --}}
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            <span>Password</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-lock"></i> --}}
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="options-row">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="login-btn">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                
                <div class="divider">
                    <span>OR CONTINUE WITH</span>
                </div>
                
                <div class="social-login">
                    <a href="#" class="social-btn">
                        <i class="fab fa-google"></i>
                        <span>Google</span>
                    </a>
                    <a href="#" class="social-btn">
                        <i class="fab fa-github"></i>
                        <span>GitHub</span>
                    </a>
                </div>
                
                <div class="register-link">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection