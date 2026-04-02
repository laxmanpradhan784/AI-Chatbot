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
        font-weight: 500;
        color: #c084fc;
        margin-bottom: 1rem;
    }
    
    .contact-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
    }
    
    .contact-subtitle {
        font-size: 1.1rem;
        color: #9ca3af;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    /* Contact Info Cards */
    .contact-info-section {
        margin-bottom: 3rem;
    }
    
    .info-card {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 24px;
        padding: 1.8rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .info-card:nth-child(1) { animation-delay: 0.1s; }
    .info-card:nth-child(2) { animation-delay: 0.2s; }
    .info-card:nth-child(3) { animation-delay: 0.3s; }
    
    .info-card:hover {
        transform: translateY(-8px);
        border-color: rgba(139, 92, 246, 0.4);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .info-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
    }
    
    .info-icon i {
        font-size: 2rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .info-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }
    
    .info-content {
        color: #9ca3af;
        line-height: 1.5;
        font-size: 0.9rem;
    }
    
    .info-content a {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .info-content a:hover {
        color: #c084fc;
    }
    
    /* Contact Form Section */
    .form-section {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 32px;
        padding: 2.5rem;
        margin-bottom: 3rem;
        animation: fadeInUp 0.6s ease-out 0.2s;
        animation-fill-mode: both;
    }
    
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #ffffff, #c084fc);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
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
    
    .input-wrapper input,
    .input-wrapper textarea {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 2.8rem;
        background: #2a2a36 !important;
        border: 1.5px solid #3c3c48 !important;
        border-radius: 16px !important;
        color: #f0f0f5 !important;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .input-wrapper textarea {
        padding: 0.85rem 1rem 0.85rem 2.8rem;
        resize: vertical;
        min-height: 120px;
    }
    
    .input-wrapper input:focus,
    .input-wrapper textarea:focus {
        border-color: #8b5cf6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    }
    
    .input-wrapper input:focus + i,
    .input-wrapper textarea:focus + i {
        color: #c084fc;
    }
    
    /* Submit Button */
    .submit-btn {
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
    
    .submit-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }
    
    .submit-btn:hover i {
        transform: translateX(4px);
    }
    
    .submit-btn:active {
        transform: translateY(0);
    }
    
    /* Map Section */
    .map-section {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 32px;
        padding: 2rem;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out 0.3s;
        animation-fill-mode: both;
    }
    
    .map-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff;
    }
    
    .map-title i {
        color: #8b5cf6;
    }
    
    .map-container {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .map-container iframe {
        width: 100%;
        height: 300px;
        border: none;
        display: block;
    }
    
    /* FAQ Section */
    .faq-section {
        background: linear-gradient(135deg, #1e1e2a, #18181f);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 32px;
        padding: 2rem;
        animation: fadeInUp 0.6s ease-out 0.4s;
        animation-fill-mode: both;
    }
    
    .faq-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff;
    }
    
    .faq-title i {
        color: #8b5cf6;
    }
    
    .accordion-item {
        background: #2a2a36;
        border: 1px solid #3c3c48;
        margin-bottom: 1rem;
        border-radius: 16px !important;
        overflow: hidden;
    }
    
    .accordion-button {
        background: #2a2a36;
        color: #ffffff;
        font-weight: 500;
        padding: 1rem 1.2rem;
    }
    
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.1));
        color: #c084fc;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(139, 92, 246, 0.3);
    }
    
    .accordion-body {
        background: #1f1f2b;
        color: #9ca3af;
        padding: 1rem 1.2rem;
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
    
    .alert-success-custom {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6ee7b7;
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
        .contact-title {
            font-size: 2rem;
        }
        
        .form-section {
            padding: 1.5rem;
        }
        
        .form-title {
            font-size: 1.3rem;
        }
        
        .map-section,
        .faq-section {
            padding: 1.5rem;
        }
        
        .map-container iframe {
            height: 200px;
        }
    }
</style>

<div class="contact-header">
    <div class="contact-badge">
        <i class="fas fa-headset me-1"></i> Get in Touch
    </div>
    <h1 class="contact-title">We'd Love to Hear From You</h1>
    <p class="contact-subtitle">Have questions, feedback, or need support? Our team is here to help you 24/7.</p>
</div>

<!-- Contact Information Cards -->
<div class="contact-info-section">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="info-title">Email Us</h3>
                <div class="info-content">
                    <a href="mailto:support@deepchat.ai">support@deepchat.ai</a><br>
                    <a href="mailto:hello@deepchat.ai">hello@deepchat.ai</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="info-title">Call Us</h3>
                <div class="info-content">
                    <a href="tel:+15551234567">+1 (555) 123-4567</a><br>
                    <span>Mon-Fri, 9AM - 6PM EST</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="info-title">Visit Us</h3>
                <div class="info-content">
                    123 AI Street, Tech City,<br>
                    Silicon Valley, CA 12345
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->
<div class="form-section">
    <h2 class="form-title">Send Us a Message</h2>
    
    @if(session('contact_success'))
        <div class="alert-custom alert-success-custom">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('contact_success') }}</span>
        </div>
    @endif
    
    <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        <span>Full Name</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" id="name" placeholder="John Doe" required>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        <span>Email Address</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="john@example.com" required>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        <span>Phone Number (Optional)</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone" id="phone" placeholder="+1 (555) 123-4567">
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>
                        <span>Subject</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-tag"></i>
                        <input type="text" name="subject" id="subject" placeholder="How can we help?" required>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-comment"></i>
                <span>Message</span>
            </label>
            <div class="input-wrapper">
                <i class="fas fa-comment" style="top: 20px; transform: none;"></i>
                <textarea name="message" id="message" placeholder="Tell us about your inquiry or feedback..." required></textarea>
            </div>
        </div>
        
        <button type="submit" class="submit-btn">
            <span>Send Message</span>
            <i class="fas fa-paper-plane"></i>
        </button>
    </form>
</div>

<!-- Map Section -->
<div class="map-section">
    <h3 class="map-title">
        <i class="fas fa-map-marked-alt"></i>
        Find Us Here
    </h3>
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3172.332530152831!2d-122.0838516846948!3d37.33182597984114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5b1f5c1f8b1%3A0x8e5c6b2b2b2b2b2b!2sSilicon%20Valley%2C%20CA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<!-- FAQ Section -->
<div class="faq-section">
    <h3 class="faq-title">
        <i class="fas fa-question-circle"></i>
        Frequently Asked Questions
    </h3>
    
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    How quickly can I expect a response?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We typically respond within 24 hours during business days. For urgent inquiries, please call our support line.
                </div>
            </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    Is my data secure when contacting you?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Absolutely! We take your privacy seriously. All communications are encrypted and we never share your information with third parties.
                </div>
            </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Do you offer phone support?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, we offer phone support from Monday to Friday, 9AM to 6PM EST. You can reach us at +1 (555) 123-4567.
                </div>
            </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    Can I get a demo of the AI chatbot?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Absolutely! Simply register for a free account and start chatting with our AI immediately. No credit card required.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation before submit
    const form = document.getElementById('contactForm');
    
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
        
        if (!name || !email || !subject || !message) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return false;
        }
    });
</script>
@endsection