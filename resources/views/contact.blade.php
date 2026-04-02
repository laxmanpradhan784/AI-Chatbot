@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<style>
    .contact-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .contact-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 100px;
        padding: 0.4rem 1.2rem;
        font-size: 0.8rem;
        color: #c084fc;
        margin-bottom: 1rem;
    }

    .contact-title {
        font-size: 2.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        -webkit-background-clip: text;
        color: transparent;
    }

    .contact-subtitle {
        color: #9ca3af;
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-container {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border-radius: 32px;
        padding: 3rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }

    .contact-card {
        background: rgba(30, 30, 42, 0.6);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid rgba(139, 92, 246, 0.15);
        transition: 0.3s;
    }

    .contact-card:hover {
        transform: translateY(-6px);
        border-color: rgba(139, 92, 246, 0.4);
    }

    .contact-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        -webkit-background-clip: text;
        color: transparent;
    }

    .contact-label {
        color: #9ca3af;
        font-size: 0.85rem;
    }

    .contact-value {
        color: #ffffff;
        font-weight: 600;
    }

    .contact-form {
        margin-top: 2rem;
    }

    .form-control {
        background: rgba(42, 42, 54, 0.8);
        border: 1px solid rgba(139, 92, 246, 0.2);
        color: #fff;
        border-radius: 12px;
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: #8b5cf6;
        box-shadow: none;
    }

    .btn-send {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border: none;
        border-radius: 40px;
        padding: 0.7rem 2rem;
        color: white;
        font-weight: 600;
        margin-top: 1rem;
        transition: 0.3s;
    }

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="contact-header">
    <div class="contact-badge">
        <i class="fas fa-envelope me-1"></i> Contact DeepChat AI
    </div>
    <h1 class="contact-title">Get In Touch</h1>
    <p class="contact-subtitle">
        Have questions, feedback, or need support? We're here to help you anytime.
    </p>
</div>

<div class="contact-container">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                <div class="contact-label">Email</div>
                <div class="contact-value">support@aichatbot.com</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                <div class="contact-label">Phone</div>
                <div class="contact-value">+1 (555) 123-4567</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="contact-label">Address</div>
                <div class="contact-value">123 AI Street, Tech City</div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
        <form method="POST" action="#">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn-send">
                <i class="fas fa-paper-plane me-1"></i> Send Message
            </button>
        </form>
    </div>
</div>

@endsection