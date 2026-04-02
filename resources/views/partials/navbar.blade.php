<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <div class="brand-icon-wrapper">
                <i class="fas fa-robot"></i>
            </div>
            <div class="brand-text">
                <span class="brand-name">DeepChat</span>
                <span class="brand-badge">AI</span>
            </div>
        </a>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-info-circle me-2"></i>
                        <span>About</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        <i class="fas fa-envelope me-2"></i>
                        <span>Contact</span>
                    </a>
                </li>

                <!-- Chatbot Link - Only visible when logged in -->
                @if (session('user_id'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('chatbot') ? 'active' : '' }}"
                            href="{{ route('chatbot') }}">
                            <i class="fas fa-comment-dots me-2"></i>
                            <span>Chatbot</span>
                        </a>
                    </li>
                @endif

                @if (session('user_id'))
                    @if (session('user_type') == 'admin')
                        <li class="nav-item">
                            <a class="nav-link admin-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-shield-alt me-2"></i>
                                <span>Admin Panel</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <span class="user-name">{{ session('user_name') }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}"><i
                                        class="fas fa-cog me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link login-btn" href="{{ route('login') }}">
                            <i class="fas fa-key me-2"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link register-btn" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>
                            <span>Register</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Enhanced Navbar Styles */
    .navbar {
        background: rgba(10, 10, 15, 0.98) !important;
        backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        padding: 0.65rem 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        padding: 0.4rem 1rem;
        background: rgba(10, 10, 15, 0.95) !important;
        border-bottom-color: rgba(139, 92, 246, 0.4);
    }

    /* Brand Styles */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.02);
    }

    .brand-icon-wrapper {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        animation: pulse 2s infinite;
    }

    .brand-icon-wrapper i {
        font-size: 1.3rem;
        color: white;
        background: none;
        -webkit-background-clip: unset;
        background-clip: unset;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-name {
        font-size: 1.4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        letter-spacing: -0.5px;
    }

    .brand-badge {
        font-size: 0.65rem;
        font-weight: 600;
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        padding: 2px 8px;
        border-radius: 20px;
        color: white;
        display: inline-block;
        width: fit-content;
        letter-spacing: 0.5px;
    }

    /* Nav Links */
    .navbar-nav .nav-link {
        color: #a1a1aa !important;
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-nav .nav-link i {
        font-size: 1rem;
        transition: transform 0.2s ease;
    }

    .navbar-nav .nav-link:hover {
        color: white !important;
        background: rgba(139, 92, 246, 0.15);
        transform: translateY(-2px);
    }

    .navbar-nav .nav-link:hover i {
        transform: scale(1.1);
        color: #c084fc;
    }

    .navbar-nav .nav-link.active {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.2));
        color: white !important;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .navbar-nav .nav-link.active i {
        color: #c084fc;
    }

    /* Login & Register Buttons */
    .login-btn {
        border: 1px solid rgba(139, 92, 246, 0.4);
        background: rgba(139, 92, 246, 0.05);
    }

    .login-btn:hover {
        background: rgba(139, 92, 246, 0.15);
        border-color: rgba(139, 92, 246, 0.6);
    }

    .register-btn {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        color: white !important;
        box-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
    }

    .register-btn:hover {
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
        color: white !important;
    }

    .register-btn i {
        color: white !important;
    }

    /* Admin Link */
    .admin-link {
        border: 1px solid rgba(239, 68, 68, 0.3);
        background: rgba(239, 68, 68, 0.05);
    }

    .admin-link:hover {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.5);
    }

    .admin-link i {
        color: #ef4444;
    }

    /* User Dropdown */
    .user-dropdown {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(30, 30, 42, 0.6);
        border-radius: 40px;
        padding: 0.4rem 1rem 0.4rem 0.6rem !important;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-avatar i {
        font-size: 1.1rem;
        color: white;
        margin: 0;
    }

    .user-name {
        font-weight: 500;
        font-size: 0.9rem;
        color: white;
    }

    .dropdown-menu-dark {
        background: #1e1e2a;
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 16px;
        padding: 0.5rem;
        margin-top: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .dropdown-menu-dark .dropdown-item {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        color: #d1d5db;
        transition: all 0.2s ease;
    }

    .dropdown-menu-dark .dropdown-item:hover {
        background: rgba(139, 92, 246, 0.2);
        color: white;
        transform: translateX(4px);
    }

    .dropdown-menu-dark .dropdown-item i {
        width: 20px;
    }

    /* Custom Toggler */
    .custom-toggler {
        border: none;
        padding: 0;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(139, 92, 246, 0.1);
        transition: all 0.3s ease;
    }

    .custom-toggler:hover {
        background: rgba(139, 92, 246, 0.2);
    }

    .custom-toggler:focus {
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3);
    }

    /* Animations */
    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        50% {
            box-shadow: 0 4px 25px rgba(139, 92, 246, 0.6);
        }
    }

    /* Responsive */
    @media (max-width: 991px) {
        .navbar-nav {
            margin-top: 1rem;
            padding: 0.5rem 0;
        }

        .navbar-nav .nav-link {
            justify-content: center;
            margin: 4px 0;
        }

        .user-dropdown {
            justify-content: center;
            width: fit-content;
            margin: 0 auto;
        }

        .register-btn,
        .login-btn {
            text-align: center;
            justify-content: center;
        }

        .brand-name {
            font-size: 1.2rem;
        }

        .brand-icon-wrapper {
            width: 35px;
            height: 35px;
        }
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 0.5rem 1rem;
        }

        .brand-name {
            font-size: 1.1rem;
        }
    }
</style>

<script>
    // Add scroll effect to navbar
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Active link highlighting based on current URL
        const currentUrl = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && currentUrl.includes(href)) {
                link.classList.add('active');
            }
        });
    });
</script>
