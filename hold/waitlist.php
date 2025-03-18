<?php
require_once './track_visitor.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>Join Waitlist | Get Your Professional Business Website Instantly</title>
    <meta name="title" content="Join Waitlist | Get Your Professional Business Website Instantly">
    <meta name="description" content="Transform your business with a modern, high-converting website. Ready to launch immediately with built-in SEO, mobile-first design, and 24/7 expert support.">
    <meta name="keywords" content="business website, instant website, professional website, website builder, business online presence, mobile-first design, SEO optimized website, web development, instant setup, business solutions">
    <meta name="author" content="Get Business Website">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://getbusinesswebsite.online/waitlist">
    <meta property="og:title" content="Join Waitlist | Get Your Professional Business Website Instantly">
    <meta property="og:description" content="Transform your business with a modern, high-converting website. Ready to launch immediately with built-in SEO, mobile-first design, and 24/7 expert support.">
    <meta property="og:image" content="https://getbusinesswebsite.online/assets/mb.webp">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://getbusinesswebsite.online/waitlist">
    <meta property="twitter:title" content="Join Waitlist | Get Your Professional Business Website Instantly">
    <meta property="twitter:description" content="Transform your business with a modern, high-converting website. Ready to launch immediately with built-in SEO, mobile-first design, and 24/7 expert support.">
    <meta property="twitter:image" content="https://getbusinesswebsite.online/assets/mb.webp">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://getbusinesswebsite.online/waitlist">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./waitlist.css">
     <!-- JSON-LD Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Get Business Website",
      "url": "https://getbusinesswebsite.online",
      "description": "Professional instant business website solutions with built-in SEO and mobile-first design.",
      "potentialAction": {
        "@type": "JoinAction",
        "target": "https://getbusinesswebsite.online/waitlist",
        "actionPlatform": ["https://getbusinesswebsite.online/waitlist"]
      }
    }
    </script>
</head>
<body>
    <section class="hero">
        
        <div class="hero-image">
        <div class="logo">
            <img src="./assets/logo/getbusinesswebsite-logo.png" alt="" srcset="">
        </div>
            <img src="./assets/mb.webp" alt="Professional Business Website Preview - Get Business Website">
            <div class="overlay">
                <div class="hero-content">
                    <h1>Professional Websites Instantly</h1>
                    <p class="hero-subtitle">Transform your business with a modern, high-converting website. Ready to launch immediately.</p>
                    <div class="hero-cta">
                        <a href="#waitlist" class="scroll-button">Join the Waitlist</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="features-grid">
            <div class="feature">
                <i class="bi bi-lightning"></i>
                <h3>Instant Setup</h3>
                <p>Get your professional website up and running instantly. No waiting periods, no delays.</p>
            </div>
            <div class="feature">
                <i class="bi bi-gear"></i>
                <h3>Full Support</h3>
                <p>Dedicated developer support available 24/7. We handle all technical aspects while you focus on your business.</p>
            </div>
            <div class="feature">
                <i class="bi bi-phone"></i>
                <h3>Mobile-First Design</h3>
                <p>Every website is crafted with a mobile-first approach, ensuring perfect performance across all devices.</p>
            </div>
            <div class="feature">
                <i class="bi bi-shield-check"></i>
                <h3>Built-in SEO</h3>
                <p>Optimized for search engines from day one, helping your business get discovered online.</p>
            </div>
        </div>
    </section>

    <section class="waitlist" id="waitlist">
        <div class="waitlist-content">
            <h2>Join the Waitlist</h2>
            <form id="waitlistForm">
                <div class="form-group">
                    <input type="text" id="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="business" placeholder="Business Name (Optional)">
                </div>
                <button type="submit">Join Waitlist</button>
            </form>
            <div id="successMessage" class="success-message">
                <i class="bi bi-check-circle"></i> Thank you for joining! We'll be in touch soon.
            </div>
        </div>
    </section>

    <script>
        document.getElementById('waitlistForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="bi bi-arrow-repeat"></i> Processing...';
            button.style.opacity = '0.7';
            
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                business: document.getElementById('business').value
            };

            try {
                const response = await fetch('backend/join_waitlist.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('waitlistForm').reset();
                } else {
                    throw new Error(data.message || 'Failed to join waitlist');
                }
            } catch (error) {
                console.error('Error:', error);
                alert(error.message || 'Failed to join waitlist. Please try again.');
            } finally {
                button.innerHTML = originalText;
                button.style.opacity = '1';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>
</body>
</html>