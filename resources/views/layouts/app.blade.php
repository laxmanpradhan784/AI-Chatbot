<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Chatbot · DeepSeek Style · @yield('title')</title>
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ---------- DARK THEME RESET (CHATGPT VIBE) ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
            background: #0f0f0f;
            color: #ececf1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1e1e2f;
        }
        ::-webkit-scrollbar-thumb {
            background: #444654;
            border-radius: 8px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #565869;
        }

        /* ========= NAVBAR STYLES ========= */
        .navbar {
            background: rgba(20, 20, 26, 0.95) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(64, 64, 80, 0.4);
            padding: 0.75rem 1rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #E0E7FF, #A78BFA);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent !important;
            letter-spacing: -0.3px;
        }
        .navbar-brand i {
            background: none;
            background-clip: unset;
            -webkit-background-clip: unset;
            color: #a78bfa;
            margin-right: 6px;
            font-size: 1.5rem;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: #d1d5db;
            font-weight: 500;
            margin: 0 4px;
            border-radius: 28px;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            background: #2c2c3a;
            color: white;
        }
        .navbar-nav .nav-link.active {
            background: #3c3c4e;
            color: white;
        }

        /* ========= FOOTER STYLES ========= */
        .main-footer {
            background: #0a0a0f !important;
            border-top: 1px solid #24242e;
            color: #8e8ea4;
            font-size: 0.85rem;
            margin-top: 3rem;
            padding: 2rem 0 1.5rem 0;
        }
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 0.85rem;
        }
        .footer-links a:hover {
            color: #c084fc;
        }
        .footer-social i {
            font-size: 1.2rem;
            transition: transform 0.2s ease, color 0.2s ease;
            cursor: pointer;
        }
        .footer-social i:hover {
            transform: translateY(-2px);
            color: #c084fc !important;
        }

        /* main container */
        .container {
            max-width: 1280px;
            width: 100%;
            padding: 0 1.5rem;
            margin: 0 auto;
        }

        .main-card, .card-chat {
            background: #1e1e2a;
            border: 1px solid #2d2d3a;
            border-radius: 28px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .card-chat {
            background: #18181f;
        }

        /* alert styles dark mode */
        .alert-success {
            background-color: #0f2e1c;
            border-color: #1e4d2e;
            color: #b9f6ca;
        }
        .alert-danger {
            background-color: #3b1e1e;
            border-color: #7f2e2e;
            color: #ffc9c9;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 40px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-primary:hover {
            background: #2563eb;
            transform: scale(0.98);
            box-shadow: 0 0 8px rgba(59,130,246,0.5);
        }

        .btn-outline-light {
            border-color: #3e3e4a;
            color: #e2e2e8;
        }
        .btn-outline-light:hover {
            background: #2d2d3a;
            color: white;
        }

        /* form inputs dark */
        input, textarea, select {
            background-color: #2a2a36 !important;
            border: 1px solid #3c3c48 !important;
            color: #f0f0f5 !important;
            border-radius: 20px !important;
            padding: 0.6rem 1rem !important;
        }
        input:focus, textarea:focus {
            border-color: #8b5cf6 !important;
            outline: none;
            box-shadow: 0 0 0 2px rgba(139,92,246,0.3);
        }

        label {
            font-weight: 500;
            color: #cbd5e6;
            margin-bottom: 0.3rem;
        }

        .chat-message {
            background: #252531;
            border-radius: 24px;
            padding: 0.8rem 1.2rem;
            margin-bottom: 1rem;
        }
        .chat-message.user {
            background: #2c2c3e;
            border-left: 4px solid #8b5cf6;
        }
        .chat-message.bot {
            background: #1f1f2b;
            border-left: 4px solid #3b82f6;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            .navbar-brand {
                font-size: 1.3rem;
            }
            .footer-links {
                text-align: center;
                margin-bottom: 1rem;
            }
            .footer-social {
                text-align: center;
                margin-top: 0.5rem;
            }
        }

        .gradient-text {
            background: linear-gradient(120deg, #c084fc, #60a5fa);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ========= NAVIGATION BAR ========= -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-brain"></i> DeepChat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}"><i class="fas fa-info-circle me-1"></i>About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}"><i class="fas fa-envelope me-1"></i>Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('chatbot') }}"><i class="fas fa-comment-dots me-1"></i>Chatbot</a></li>
                    @if(session('user_id'))
                        @if(session('user_type') == 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-shield-alt me-1"></i>Admin Panel</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-1"></i>Logout ({{ session('user_name') }})</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-key me-1"></i>Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- ========= MAIN CONTENT AREA ========= -->
    <main class="flex-grow-1">
        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <!-- ========= FOOTER WITH LINKS ========= -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-brain fs-4" style="color: #a78bfa;"></i>
                        <span class="fw-bold fs-5" style="background: linear-gradient(135deg, #E0E7FF, #A78BFA); background-clip: text; -webkit-background-clip: text; color: transparent;">DeepChat AI</span>
                    </div>
                    <p class="small text-secondary">Your intelligent virtual assistant powered by advanced AI. Experience seamless conversations, smart insights, and 24/7 availability.</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="fw-semibold mb-3" style="color: #d4d4d8;">Quick Links</h6>
                    <div class="d-flex flex-wrap gap-3 footer-links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('about') }}">About Us</a>
                        <a href="{{ route('contact') }}">Contact</a>
                        <a href="{{ route('chatbot') }}">Chatbot</a>
                        @if(!session('user_id'))
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-semibold mb-3" style="color: #d4d4d8;">Connect With Us</h6>
                    <div class="d-flex gap-3 footer-social">
                        <i class="fab fa-twitter text-secondary" style="cursor: pointer;"></i>
                        <i class="fab fa-github text-secondary" style="cursor: pointer;"></i>
                        <i class="fab fa-linkedin-in text-secondary" style="cursor: pointer;"></i>
                        <i class="fab fa-discord text-secondary" style="cursor: pointer;"></i>
                    </div>
                    <div class="mt-3 small text-secondary">
                        <i class="fas fa-envelope me-2"></i> support@deepchat.ai<br>
                        <i class="fas fa-globe me-2 mt-1"></i> www.deepchat.ai
                    </div>
                </div>
            </div>
            <hr class="my-3" style="border-color: #24242e;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span><i class="far fa-copyright me-1"></i> 2024 DeepChat — AI assistant with intelligence</span>
                <span class="mt-2 mt-md-0"><i class="fas fa-robot me-1"></i> Powered by Ollama & Next‑gen models</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                let alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    let bsAlert = new bootstrap.Alert(alert);
                    setTimeout(() => bsAlert.close(), 300);
                });
            }, 5000);
        });
    </script>
    @stack('scripts')
</body>
</html>