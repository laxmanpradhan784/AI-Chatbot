<footer class="main-footer">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <i class="fas fa-brain"></i>
                        <span>DeepChat</span>
                    </div>
                    <p class="footer-description">
                        Your intelligent virtual assistant powered by advanced AI. 
                        Experience seamless conversations, smart insights, and 24/7 availability.
                    </p>
                    <div class="footer-badge">
                        <i class="fas fa-shield-alt"></i> Privacy First
                    </div>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    <li><a href="{{ route('chatbot') }}"><i class="fas fa-chevron-right"></i> Chatbot</a></li>
                </ul>
            </div>

            <!-- Resources Column -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Resources</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Documentation</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> API Reference</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Support Center</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Status Page</a></li>
                </ul>
            </div>

            <!-- Legal & Social Column -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Connect With Us</h5>
                <div class="footer-social">
                    <a href="#" class="social-icon" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="Discord">
                        <i class="fab fa-discord"></i>
                    </a>
                    <a href="#" class="social-icon" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                
                <div class="footer-contact">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:support@deepchat.ai">support@deepchat.ai</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-globe"></i>
                        <span>www.deepchat.ai</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>San Francisco, CA</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="footer-divider">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="fas fa-robot"></i>
            </div>
            <div class="divider-line"></div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="copyright">
                        <i class="far fa-copyright"></i> 2024 DeepChat — AI assistant with intelligence
                    </span>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <div class="legal-links">
                        <a href="#">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="#">Terms of Service</a>
                        <span class="separator">|</span>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .main-footer {
        background: linear-gradient(180deg, #0a0a0f 0%, #050508 100%);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        color: #8e8ea4;
        font-size: 0.85rem;
        margin-top: 4rem;
        padding: 3rem 0 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated gradient border on top */
    .main-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #8b5cf6, #3b82f6, #8b5cf6, transparent);
        animation: borderGlow 3s linear infinite;
    }
    
    @keyframes borderGlow {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* Footer Logo */
    .footer-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }
    
    .footer-logo i {
        font-size: 2rem;
        background: linear-gradient(135deg, #c084fc, #60a5fa);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .footer-logo span {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff, #c084fc);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
    
    .footer-description {
        color: #9ca3af;
        line-height: 1.6;
        margin-bottom: 1rem;
        font-size: 0.85rem;
    }
    
    .footer-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(139, 92, 246, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 40px;
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
        color: #c084fc;
    }
    
    /* Footer Titles */
    .footer-title {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        position: relative;
        display: inline-block;
    }
    
    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 30px;
        height: 2px;
        background: linear-gradient(90deg, #8b5cf6, #3b82f6);
        border-radius: 2px;
    }
    
    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.7rem;
    }
    
    .footer-links a {
        color: #9ca3af;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .footer-links a i {
        font-size: 0.7rem;
        transition: transform 0.3s ease;
    }
    
    .footer-links a:hover {
        color: #c084fc;
        transform: translateX(5px);
    }
    
    .footer-links a:hover i {
        transform: translateX(3px);
        color: #c084fc;
    }
    
    /* Social Icons */
    .footer-social {
        display: flex;
        gap: 12px;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .social-icon {
        width: 38px;
        height: 38px;
        background: rgba(30, 30, 42, 0.8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        color: #9ca3af;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .social-icon i {
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        transform: translateY(-4px);
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        border-color: transparent;
        color: white;
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }
    
    .social-icon:hover i {
        transform: scale(1.1);
    }
    
    /* Contact Items */
    .footer-contact {
        margin-top: 1rem;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0.8rem;
        font-size: 0.8rem;
    }
    
    .contact-item i {
        width: 20px;
        color: #8b5cf6;
        font-size: 0.85rem;
    }
    
    .contact-item a {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-item a:hover {
        color: #c084fc;
    }
    
    /* Footer Divider */
    .footer-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin: 2rem 0 1.5rem;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), rgba(59, 130, 246, 0.3), transparent);
    }
    
    .divider-icon {
        width: 30px;
        height: 30px;
        background: rgba(139, 92, 246, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .divider-icon i {
        font-size: 0.8rem;
        color: #8b5cf6;
        animation: spin 4s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Footer Bottom */
    .footer-bottom {
        padding-top: 1rem;
    }
    
    .copyright {
        color: #6b7280;
        font-size: 0.75rem;
    }
    
    .legal-links {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .legal-links a {
        color: #6b7280;
        text-decoration: none;
        font-size: 0.75rem;
        transition: color 0.3s ease;
    }
    
    .legal-links a:hover {
        color: #c084fc;
    }
    
    .separator {
        color: #374151;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .main-footer {
            padding: 2rem 0 1rem;
            margin-top: 2rem;
        }
        
        .footer-title {
            margin-top: 1rem;
        }
        
        .footer-social {
            justify-content: center;
        }
        
        .footer-contact {
            text-align: center;
        }
        
        .contact-item {
            justify-content: center;
        }
        
        .legal-links {
            justify-content: center;
            margin-top: 0.5rem;
        }
        
        .footer-divider {
            margin: 1.5rem 0;
        }
    }
    
    /* Hover effect for brand */
    .footer-brand {
        transition: transform 0.3s ease;
    }
    
    .footer-brand:hover {
        transform: translateY(-3px);
    }
    
    /* Subtle glow on contact items */
    .contact-item:hover i {
        filter: drop-shadow(0 0 3px #8b5cf6);
    }
</style>