@extends('layouts.app')

@section('title', 'About')

@section('content')
<style>
    .about-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.6s ease-out;
    }
    
    .about-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 100px;
        padding: 0.4rem 1.2rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #c084fc;
        margin-bottom: 1rem;
    }
    
    .about-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
    }
    
    .about-subtitle {
        font-size: 1.1rem;
        color: #9ca3af;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border-radius: 32px;
        padding: 3rem;
        margin-bottom: 3rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }
    
    .hero-icon {
        font-size: 4rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
    }
    
    .hero-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #ffffff;
    }
    
    .hero-text {
        color: #9ca3af;
        line-height: 1.8;
        font-size: 1rem;
    }
    
    /* Features Grid */
    .features-section {
        margin-bottom: 3rem;
    }
    
    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #ffffff, #c084fc);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .feature-card {
        background: rgba(30, 30, 42, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(139, 92, 246, 0.15);
        border-radius: 24px;
        padding: 1.8rem;
        transition: all 0.3s ease;
        height: 100%;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .feature-card:nth-child(1) { animation-delay: 0.1s; }
    .feature-card:nth-child(2) { animation-delay: 0.2s; }
    .feature-card:nth-child(3) { animation-delay: 0.3s; }
    .feature-card:nth-child(4) { animation-delay: 0.4s; }
    .feature-card:nth-child(5) { animation-delay: 0.5s; }
    .feature-card:nth-child(6) { animation-delay: 0.6s; }
    
    .feature-card:hover {
        transform: translateY(-8px);
        border-color: rgba(139, 92, 246, 0.4);
        background: rgba(35, 35, 50, 0.8);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }
    
    .feature-icon i {
        font-size: 1.8rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .feature-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: #ffffff;
    }
    
    .feature-description {
        color: #9ca3af;
        line-height: 1.5;
        font-size: 0.85rem;
    }
    
    /* Tech Stack Section */
    .tech-section {
        background: linear-gradient(135deg, #1a1a24, #14141c);
        border-radius: 32px;
        padding: 2.5rem;
        margin-bottom: 3rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .tech-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .tech-item {
        background: rgba(42, 42, 54, 0.8);
        border-radius: 20px;
        padding: 1rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        min-width: 120px;
    }
    
    .tech-item:hover {
        transform: translateY(-5px);
        background: rgba(139, 92, 246, 0.15);
        border-color: rgba(139, 92, 246, 0.3);
    }
    
    .tech-item i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .tech-item .php-icon { color: #777bb4; }
    .tech-item .laravel-icon { color: #ff2d20; }
    .tech-item .js-icon { color: #f7df1e; }
    .tech-item .ai-icon { color: #8b5cf6; }
    .tech-item .db-icon { color: #00758f; }
    .tech-item .bootstrap-icon { color: #7952b3; }
    
    .tech-item span {
        font-size: 0.85rem;
        font-weight: 500;
        color: #e5e5e5;
    }
    
    /* Stats Section */
    .stats-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 2rem;
        margin-bottom: 3rem;
        padding: 2rem;
        background: rgba(30, 30, 42, 0.4);
        border-radius: 32px;
        border: 1px solid rgba(139, 92, 246, 0.15);
    }
    
    .stat-item {
        text-align: center;
        flex: 1;
        min-width: 120px;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .stat-label {
        color: #9ca3af;
        font-size: 0.85rem;
        margin-top: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* CTA Section */
    .cta-section {
        text-align: center;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(59, 130, 246, 0.05));
        border-radius: 32px;
        padding: 3rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .cta-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #ffffff;
    }
    
    .cta-text {
        color: #9ca3af;
        margin-bottom: 1.5rem;
    }
    
    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border: none;
        border-radius: 40px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        color: white;
    }
    
    .btn-outline-custom {
        background: transparent;
        border: 1px solid rgba(139, 92, 246, 0.5);
        border-radius: 40px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: #c084fc;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-outline-custom:hover {
        background: rgba(139, 92, 246, 0.1);
        border-color: #c084fc;
        transform: translateY(-2px);
        color: #c084fc;
    }
    
    /* Animations */
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
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .about-title {
            font-size: 2rem;
        }
        
        .hero-section {
            padding: 2rem;
        }
        
        .hero-title {
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.5rem;
        }
        
        .stats-section {
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }
        
        .tech-grid {
            gap: 1rem;
        }
        
        .tech-item {
            min-width: 100px;
            padding: 0.8rem 1rem;
        }
        
        .cta-section {
            padding: 2rem;
        }
        
        .cta-title {
            font-size: 1.3rem;
        }
    }
</style>

<div class="about-header">
    <div class="about-badge">
        <i class="fas fa-info-circle me-1"></i> About DeepChat AI
    </div>
    <h1 class="about-title">Revolutionizing Conversations<br>with Artificial Intelligence</h1>
    <p class="about-subtitle">Built with cutting-edge technology to provide intelligent, responsive, and meaningful conversations</p>
</div>

<div class="hero-section">
    <div class="text-center">
        <div class="hero-icon">
            <i class="fas fa-robot"></i>
        </div>
        <h2 class="hero-title">Your Intelligent Virtual Assistant</h2>
        <p class="hero-text">
            DeepChat AI is a state-of-the-art chatbot application that leverages the power of Ollama AI and Laravel framework 
            to deliver seamless, intelligent conversations. Whether you need assistance with research, creative writing, 
            coding help, or just a friendly chat, our AI is here 24/7 to help you.
        </p>
    </div>
</div>

<div class="features-section">
    <h2 class="section-title">
        <i class="fas fa-star me-2"></i> Powerful Features
    </h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="feature-title">Secure Authentication</h3>
                <p class="feature-description">Robust user authentication system with session management, protecting your data and conversations.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="feature-title">AI-Powered Responses</h3>
                <p class="feature-description">Advanced Ollama AI integration providing intelligent, context-aware responses in real-time.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Admin Dashboard</h3>
                <p class="feature-description">Comprehensive admin panel for user management, system monitoring, and configuration control.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="feature-title">Chat History</h3>
                <p class="feature-description">Automatically saves and organizes conversation history for easy reference and continuity.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3 class="feature-title">Customizable Settings</h3>
                <p class="feature-description">Tailor the chatbot behavior, response styles, and preferences to match your needs.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="feature-title">Multi-Language Support</h3>
                <p class="feature-description">Communicate in multiple languages with intelligent translation and understanding capabilities.</p>
            </div>
        </div>
    </div>
</div>

<div class="tech-section">
    <div class="text-center">
        <h2 class="section-title" style="margin-bottom: 0.5rem;">
            <i class="fas fa-code me-2"></i> Technology Stack
        </h2>
        <p class="text-secondary mb-4">Built with modern, industry-leading technologies</p>
    </div>
    <div class="tech-grid">
        <div class="tech-item">
            <i class="fab fa-php php-icon"></i>
            <span>PHP 8.x</span>
        </div>
        <div class="tech-item">
            <i class="fab fa-laravel laravel-icon"></i>
            <span>Laravel</span>
        </div>
        <div class="tech-item">
            <i class="fab fa-js js-icon"></i>
            <span>JavaScript</span>
        </div>
        <div class="tech-item">
            <i class="fas fa-microchip ai-icon"></i>
            <span>Ollama AI</span>
        </div>
        <div class="tech-item">
            <i class="fas fa-database db-icon"></i>
            <span>MySQL</span>
        </div>
        <div class="tech-item">
            <i class="fab fa-bootstrap bootstrap-icon"></i>
            <span>Bootstrap</span>
        </div>
    </div>
</div>

<div class="stats-section">
    <div class="stat-item">
        <div class="stat-number">500+</div>
        <div class="stat-label">Active Users</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">10K+</div>
        <div class="stat-label">Conversations</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">99%</div>
        <div class="stat-label">Uptime</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">24/7</div>
        <div class="stat-label">Support</div>
    </div>
</div>

<div class="cta-section">
    <h3 class="cta-title">Ready to experience the future of conversation?</h3>
    <p class="cta-text">Join thousands of users who are already enjoying intelligent conversations with our AI chatbot.</p>
    <div class="cta-buttons">
        @if(!session('user_id'))
            <a href="{{ route('register') }}" class="btn-primary-custom">
                <i class="fas fa-user-plus"></i> Get Started Free
            </a>
            <a href="{{ route('login') }}" class="btn-outline-custom">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        @else
            <a href="{{ route('chatbot') }}" class="btn-primary-custom">
                <i class="fas fa-comment-dots"></i> Start Chatting
            </a>
        @endif
    </div>
</div>

<script>
    // Animated counter for stats (optional)
    function animateNumber(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 30);
    }
    
    // Trigger animations when stats come into view
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const originalText = stat.textContent;
                    const value = parseInt(originalText);
                    if (!isNaN(value) && !stat.hasAttribute('data-animated')) {
                        stat.setAttribute('data-animated', 'true');
                        animateNumber(stat, value);
                    }
                });
                observer.disconnect();
            }
        });
    }, observerOptions);
    
    observer.observe(document.querySelector('.stats-section'));
</script>
@endsection