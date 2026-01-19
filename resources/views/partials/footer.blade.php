<style>
    .site-footer {
        background: rgba(15, 23, 42, 0.7);
        background-image: 
            radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(30, 58, 138, 0.2) 0px, transparent 50%);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        color: #e2e8f0;
        padding: 2.5rem 2rem 1.5rem;
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-family: 'Inter', sans-serif;
    }

    .footer-container {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 2rem;
    }

    .footer-brand h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #fff 0%, #e2e8f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .footer-brand p {
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.6;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .footer-socials {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-link:hover {
        background: rgba(0, 188, 212, 0.1);
        color: #00d4ff;
        border-color: rgba(0, 188, 212, 0.3);
        transform: translateY(-2px);
    }

    .footer-column h4 {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-links a:hover {
        color: #00d4ff;
        padding-left: 4px;
    }

    @media (max-width: 1024px) {
        .footer-container {
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
    }

    @media (max-width: 640px) {
        .footer-container {
            grid-template-columns: 1fr;
        }
        
        /* Fix mobile gaps */
        .site-footer {
            padding: 2rem 1.25rem 6rem; /* Reduced side padding, added bottom padding for mobile nav */
        }
    }
</style>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column footer-brand">
            <h3>Vacancy Hunting</h3>
            <p>We are dedicated to finding the perfect match between ambitious candidates and forward-thinking employers.</p>
            <div class="footer-socials">
                <a href="https://www.facebook.com/Vacancy.Hunting" class="social-link" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="#" class="social-link" aria-label="Twitter">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                </a>
                <a href="#" class="social-link" aria-label="LinkedIn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
                <a href="#" class="social-link" aria-label="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                </a>
            </div>
            
            <div class="footer-address" style="margin-top: 1.5rem; color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; line-height: 1.6;">
                <p style="margin-bottom: 0.5rem; display: flex; align-items: flex-start; gap: 0.5rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink: 0; margin-top: 3px; color: #00d4ff;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>
                        123 Business Avenue, Suite 400<br>
                        Dhaka, Bangladesh 1212
                    </span>
                </p>
                <p style="display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink: 0; color: #00d4ff;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <span>+880 1234 567890</span>
                </p>
            </div>
        </div>

        <div class="footer-column">
            <h4>Company</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Services</h4>
            <ul class="footer-links">
                <li><a href="#">Headhunting</a></li>
                <li><a href="#">Corporate Workshop</a></li>
                <li><a href="#">Career Counselling</a></li>
                <li><a href="#">Skill Development</a></li>
                <li><a href="#">People Empowerment</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Legal</h4>
            <ul class="footer-links">
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                <li><a href="{{ route('cookie-policy') }}">Cookie Policy</a></li>
                <li><a href="#">GDPR Compliance</a></li>
            </ul>
        </div>
    </div>

    <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.4); font-size: 0.9rem;">
        <p>&copy; {{ date('Y') }} Vacancy Hunting. All rights reserved.</p>
    </div>
</footer>
