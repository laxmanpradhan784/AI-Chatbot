@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .hero-section {
        position: relative;
        padding: 4rem 0;
        overflow: hidden;
    }
    
    .hero-badge {
        display: inline-block;
        background: rgba(139, 92, 246, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 100px;
        padding: 0.5rem 1.25rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #c084fc;
        margin-bottom: 1.5rem;
        letter-spacing: 0.3px;
    }
    
    .hero-badge i {
        margin-right: 8px;
        font-size: 0.9rem;
    }
    
    .gradient-title {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff 0%, #c084fc 40%, #60a5fa 70%, #a78bfa 100%);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }
    
    .lead-text {
        font-size: 1.2rem;
        color: #a1a1aa;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    .btn-glow {
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
    }
    
    .feature-card {
        background: rgba(30, 30, 42, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(64, 64, 80, 0.5);
        border-radius: 24px;
        padding: 1.75rem;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        border-color: rgba(139, 92, 246, 0.5);
        background: rgba(35, 35, 50, 0.8);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.2));
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }
    
    .feature-icon i {
        font-size: 2rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .feature-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #ffffff;
    }
    
    .feature-desc {
        color: #9ca3af;
        line-height: 1.5;
        font-size: 0.9rem;
    }
    
    .stats-container {
        background: rgba(20, 20, 26, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 32px;
        padding: 2rem;
        margin-top: 3rem;
        border: 1px solid rgba(64, 64, 80, 0.4);
    }
    
    .stat-item {
        text-align: center;
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
        margin-top: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .cta-section {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(59, 130, 246, 0.05));
        border-radius: 32px;
        padding: 3rem;
        margin-top: 3rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    @media (max-width: 768px) {
        .gradient-title {
            font-size: 2.2rem;
        }
        
        .lead-text {
            font-size: 1rem;
        }
        
        .hero-section {
            padding: 2rem 0;
        }
        
        .stats-container {
            padding: 1.5rem;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .cta-section {
            padding: 2rem;
        }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .floating-icon {
        animation: float 3s ease-in-out infinite;
    }
    
    .btn-outline-custom {
        background: transparent;
        border: 1px solid rgba(139, 92, 246, 0.5);
        color: #c084fc;
        border-radius: 40px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-custom:hover {
        background: rgba(139, 92, 246, 0.1);
        border-color: #c084fc;
        transform: translateY(-2px);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border: none;
        border-radius: 40px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
</style>

<div class="hero-section">
    <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
            <div class="hero-badge">
                <i class="fas fa-robot"></i> Powered by Ollama AI
            </div>
            
            <h1 class="gradient-title">
                Your Intelligent AI<br>Conversation Partner
            </h1>
            
            <p class="lead-text mb-4">
                Experience the future of conversation with our advanced AI chatbot. 
                Get instant answers, creative insights, and meaningful assistance 24/7.
            </p>
            
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                @if(!session('user_id'))
                    <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-rocket me-2"></i>Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-custom btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                @else
                    <a href="{{ route('chatbot') }}" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-comment-dots me-2"></i>Start Chatting
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="row mt-5 g-4">
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <h3 class="feature-title">Lightning Fast</h3>
            <p class="feature-desc">Get responses in milliseconds with our optimized Ollama AI integration. No waiting, just instant answers.</p>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-brain"></i>
            </div>
            <h3 class="feature-title">Smart & Contextual</h3>
            <p class="feature-desc">Advanced language understanding that remembers context and provides relevant, accurate responses.</p>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="feature-title">Privacy First</h3>
            <p class="feature-desc">Your conversations are private and secure. We prioritize your data protection and confidentiality.</p>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-globe"></i>
            </div>
            <h3 class="feature-title">Multi-Language</h3>
            <p class="feature-desc">Communicate in multiple languages. Our AI understands and responds in your preferred language.</p>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-infinity"></i>
            </div>
            <h3 class="feature-title">Unlimited Chats</h3>
            <p class="feature-desc">No restrictions, no limits. Chat as much as you want and explore endless possibilities.</p>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="feature-title">Continuous Learning</h3>
            <p class="feature-desc">Our AI constantly improves and learns to provide better assistance over time.</p>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-container">
    <div class="row">
        <div class="col-md-3 col-6 mb-3 mb-md-0">
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Active Users</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 mb-md-0">
            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Conversations</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 mb-md-0">
            <div class="stat-item">
                <div class="stat-number">99%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 mb-md-0">
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Availability</div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section text-center">
    <i class="fas fa-comments floating-icon" style="font-size: 3rem; color: #c084fc; margin-bottom: 1rem;"></i>
    <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem;">Ready to experience the future of conversation?</h2>
    <p style="color: #9ca3af; max-width: 500px; margin: 0 auto 1.5rem auto;">Join thousands of users who are already enjoying intelligent conversations with our AI chatbot.</p>
    @if(!session('user_id'))
        <a href="{{ route('register') }}" class="btn btn-primary-custom">
            <i class="fas fa-user-plus me-2"></i>Create Free Account
        </a>
    @else
        <a href="{{ route('chatbot') }}" class="btn btn-primary-custom">
            <i class="fas fa-comment-dots me-2"></i>Start Your First Chat
        </a>
    @endif
</div>

<!-- Floating animated background elements (optional) -->
<div style="position: fixed; bottom: 20px; right: 20px; opacity: 0.05; pointer-events: none; z-index: -1;">
    <i class="fas fa-robot" style="font-size: 150px;"></i>
</div>
@endsection