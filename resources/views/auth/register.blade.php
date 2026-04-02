@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .register-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }
    
    .register-card {
        background: linear-gradient(135deg, #1e1e2a 0%, #18181f 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 32px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(139, 92, 246, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .register-card:hover {
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
        margin-bottom: 1.25rem;
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
    
    .input-wrapper input.error {
        border-color: #ef4444 !important;
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
    
    /* Password Strength Meter */
    .password-strength {
        margin-top: 0.5rem;
    }
    
    .strength-bars {
        display: flex;
        gap: 6px;
        margin-bottom: 0.5rem;
    }
    
    .strength-bar {
        flex: 1;
        height: 4px;
        background: #3c3c48;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .strength-bar.weak { background: #ef4444; }
    .strength-bar.fair { background: #f59e0b; }
    .strength-bar.good { background: #10b981; }
    .strength-bar.strong { background: #8b5cf6; }
    
    .strength-text {
        font-size: 0.7rem;
        color: #9ca3af;
    }
    
    .strength-text span {
        font-weight: 600;
    }
    
    /* Validation Messages */
    .validation-message {
        font-size: 0.7rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .validation-message.error {
        color: #fca5a5;
    }
    
    .validation-message.success {
        color: #6ee7b7;
    }
    
    /* Terms Checkbox */
    .terms-group {
        margin: 1.5rem 0;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #9ca3af;
        cursor: pointer;
        font-size: 0.8rem;
    }
    
    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #8b5cf6;
        cursor: pointer;
    }
    
    .checkbox-label a {
        color: #8b5cf6;
        text-decoration: none;
    }
    
    .checkbox-label a:hover {
        text-decoration: underline;
    }
    
    /* Register Button */
    .register-btn {
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
    
    .register-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }
    
    .register-btn:hover i {
        transform: translateX(4px);
    }
    
    .register-btn:active {
        transform: translateY(0);
    }
    
    .register-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
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
    
    /* Social Register */
    .social-register {
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
    
    /* Login Link */
    .login-link {
        text-align: center;
        color: #9ca3af;
        font-size: 0.85rem;
    }
    
    .login-link a {
        color: #8b5cf6;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .login-link a:hover {
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
        
        .social-register {
            flex-direction: column;
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
    
    .register-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<div class="register-wrapper">
    <div class="col-md-6 col-lg-5">
        <div class="register-card">
            <div class="card-header-custom">
                <i class="fas fa-user-plus" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem;"></i>
                <h3>Create Account</h3>
                <p>Join DeepChat and start your AI journey</p>
            </div>
            
            <div class="card-body-custom">
                @if($errors->any())
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>
                            <span>Full Name</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-user"></i> --}}
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                        </div>
                        <div class="validation-message" id="nameError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            <span>Email Address</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-envelope"></i> --}}
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                        </div>
                        <div class="validation-message" id="emailError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            <span>Password</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-lock"></i> --}}
                            <input type="password" name="password" id="password" placeholder="Create a password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="fas fa-eye" id="toggleIcon1"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bars">
                                <div class="strength-bar" id="bar1"></div>
                                <div class="strength-bar" id="bar2"></div>
                                <div class="strength-bar" id="bar3"></div>
                                <div class="strength-bar" id="bar4"></div>
                            </div>
                            <div class="strength-text" id="strengthText">Password strength: <span>Not set</span></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-check-circle"></i>
                            <span>Confirm Password</span>
                        </label>
                        <div class="input-wrapper">
                            {{-- <i class="fas fa-check-circle"></i> --}}
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                <i class="fas fa-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                        <div class="validation-message" id="confirmError"></div>
                    </div>
                    
                    <div class="terms-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="terms" required>
                            <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="register-btn" id="submitBtn">
                        <span>Create Account</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                
                <div class="divider">
                    <span>OR SIGN UP WITH</span>
                </div>
                
                <div class="social-register">
                    <a href="#" class="social-btn">
                        <i class="fab fa-google"></i>
                        <span>Google</span>
                    </a>
                    <a href="#" class="social-btn">
                        <i class="fab fa-github"></i>
                        <span>GitHub</span>
                    </a>
                </div>
                
                <div class="login-link">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Password toggle function
    function togglePassword(fieldId, iconId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(iconId);
        
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
    
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthBars = ['bar1', 'bar2', 'bar3', 'bar4'];
    const strengthText = document.getElementById('strengthText');
    
    function checkPasswordStrength(password) {
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;
        
        return strength;
    }
    
    function updateStrengthMeter() {
        const password = passwordInput.value;
        const strength = checkPasswordStrength(password);
        
        // Reset bars
        strengthBars.forEach(bar => {
            document.getElementById(bar).className = 'strength-bar';
        });
        
        if (password.length === 0) {
            strengthText.innerHTML = 'Password strength: <span>Not set</span>';
            return;
        }
        
        let strengthLevel = '';
        let colorClass = '';
        
        switch(strength) {
            case 1:
                strengthLevel = 'Weak';
                colorClass = 'weak';
                for(let i = 0; i < 1; i++) {
                    document.getElementById(strengthBars[i]).classList.add('weak');
                }
                break;
            case 2:
                strengthLevel = 'Fair';
                colorClass = 'fair';
                for(let i = 0; i < 2; i++) {
                    document.getElementById(strengthBars[i]).classList.add('fair');
                }
                break;
            case 3:
                strengthLevel = 'Good';
                colorClass = 'good';
                for(let i = 0; i < 3; i++) {
                    document.getElementById(strengthBars[i]).classList.add('good');
                }
                break;
            case 4:
                strengthLevel = 'Strong';
                colorClass = 'strong';
                for(let i = 0; i < 4; i++) {
                    document.getElementById(strengthBars[i]).classList.add('strong');
                }
                break;
        }
        
        strengthText.innerHTML = `Password strength: <span style="color: ${getColorForStrength(strength)}">${strengthLevel}</span>`;
    }
    
    function getColorForStrength(strength) {
        switch(strength) {
            case 1: return '#ef4444';
            case 2: return '#f59e0b';
            case 3: return '#10b981';
            case 4: return '#8b5cf6';
            default: return '#9ca3af';
        }
    }
    
    // Confirm password validation
    function checkConfirmPassword() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;
        const confirmError = document.getElementById('confirmError');
        
        if (confirm.length > 0) {
            if (password === confirm) {
                confirmError.innerHTML = '<i class="fas fa-check-circle"></i> Passwords match';
                confirmError.className = 'validation-message success';
                return true;
            } else {
                confirmError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Passwords do not match';
                confirmError.className = 'validation-message error';
                return false;
            }
        } else {
            confirmError.innerHTML = '';
            return false;
        }
    }
    
    // Email validation
    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email.length > 0) {
            if (emailRegex.test(email)) {
                emailError.innerHTML = '<i class="fas fa-check-circle"></i> Valid email';
                emailError.className = 'validation-message success';
                return true;
            } else {
                emailError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Invalid email format';
                emailError.className = 'validation-message error';
                return false;
            }
        }
        return true;
    }
    
    // Name validation
    function validateName() {
        const name = document.getElementById('name').value;
        const nameError = document.getElementById('nameError');
        
        if (name.length > 0 && name.length < 2) {
            nameError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Name must be at least 2 characters';
            nameError.className = 'validation-message error';
            return false;
        } else if (name.length > 0) {
            nameError.innerHTML = '<i class="fas fa-check-circle"></i> Valid name';
            nameError.className = 'validation-message success';
            return true;
        }
        return true;
    }
    
    // Form validation before submit
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const termsCheckbox = document.getElementById('terms');
    
    function validateForm() {
        const nameValid = validateName();
        const emailValid = validateEmail();
        const passwordValid = passwordInput.value.length >= 6;
        const confirmValid = checkConfirmPassword();
        const termsValid = termsCheckbox.checked;
        
        if (nameValid && emailValid && passwordValid && confirmValid && termsValid) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
    
    // Add event listeners
    passwordInput.addEventListener('input', () => {
        updateStrengthMeter();
        checkConfirmPassword();
        validateForm();
    });
    
    confirmInput.addEventListener('input', () => {
        checkConfirmPassword();
        validateForm();
    });
    
    document.getElementById('email').addEventListener('input', () => {
        validateEmail();
        validateForm();
    });
    
    document.getElementById('name').addEventListener('input', () => {
        validateName();
        validateForm();
    });
    
    termsCheckbox.addEventListener('change', validateForm);
    
    // Initial validation
    validateForm();
</script>
@endsection