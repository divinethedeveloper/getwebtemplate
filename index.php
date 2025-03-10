<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>Get Business Website | Professional Business Websites Within 3 Days</title>
    <meta name="title" content="Get Business Website | Professional Business Websites Within 3 Days">
    <meta name="description" content="Transform your African business with a professional, ready-made website. Get your business online within 3 days with our pre-built website templates. Affordable, SEO-optimized, and mobile-friendly solutions.">
    <meta name="keywords" content="get business website, african business website, buy prebuilt website, business website templates, professional website africa, ready-made business website, quick business website, affordable business website, web development africa">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://getbusinesswebsite.online/">
    <meta property="og:title" content="Get Business Website | Professional Business Websites Within 3 Days">
    <meta property="og:description" content="Transform your African business with a professional, ready-made website. Get your business online within 3 days with our pre-built website templates.">
    <meta property="og:image" content="https://getbusinesswebsite.online/assets/divinethedeveloper_hero_2.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://getbusinesswebsite.online/">
    <meta property="twitter:title" content="Get Business Website | Professional African Business Websites Within 3 Days">
    <meta property="twitter:description" content="Transform your business with a professional, ready-made website. Get your business online within 3 days with our pre-built website templates.">
    <meta property="twitter:image" content="https://getbusinesswebsite.online/assets/divinethedeveloper_hero_2.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://getbusinesswebsite.online/">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./assets/logo/getbusinesswebsite-logo.png">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/glass.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/chatbot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Get Business Website",
      "url": "https://getbusinesswebsite.online",
      "description": "Professional website solutions for African businesses",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://getbusinesswebsite.online/templates?search={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Get Business Website",
      "url": "https://getbusinesswebsite.online",
      "logo": "https://getbusinesswebsite.online/assets/logo/getbusinesswebsite-logo.png",
      "description": "Professional website solutions for African businesses",
      "sameAs": [
        "https://facebook.com/getbusinesswebsite",
        "https://twitter.com/getbusinessweb",
        "https://instagram.com/getbusinesswebsite"
      ]
    }
    </script>
</head>

<body>
    <div class="container">
    <?php require_once "./components/nav.php"; ?>

        <main>
            <section class="new_hero">
                <div class="f_image">
                    <img src="./assets/divinethedeveloper_hero_2.png" alt="Ready-Made Professional Business Websites" loading="lazy">
                </div>
                <div class="t_left"></div>
                <div class="b_left"></div>
                <div class="hero_text">
                    <div class="ft">
                        <span>INSTANT</span> BUSINESS WEBSITES
                    </div>
                    <h1>Get Your Professional Business Website Today</h1>
                    <div class="line"></div>
                    <div class="p">
                        Transform your business with a professional website in just 3 days. Our expertly crafted, ready-to-launch websites come with full technical support and a user-friendly dashboard. Get enterprise-level features at a fraction of custom development costs.
                    </div>
                    <button class="btn" onclick="location.href='./templates/'" aria-label="Browse Website Templates">View Ready-Made Websites</button>
                </div>
            </section>

            <section class="mockup">
                <img src="./assets/iPhone-App-Screen-Mockups.png" alt="Mobile-Friendly Business Websites" loading="lazy">
                <div class="sec">
                    <h2>Your Website, <span>Our Experts</span></h2>
                    <ul class="features-list" style="list-style: none; margin: 20px 0;">
                        <li>✓ 24/7 Expert Developer Support</li>
                        <li>✓ Easy-to-use Dashboard for Updates</li>
                        <li>✓ No Coding Knowledge Required</li>
                        <li>✓ Managed Website Maintenance</li>
                        <li>✓ Regular Security Updates</li>
                        <li>✓ Professional Content Management</li>
                    </ul>
                    <p class="normal_text" style="margin: 15px 0; font-size: 0.9em;">
                        Focus on your business while our expert team handles all technical aspects.
                        Simply use your dashboard when you need updates!
                    </p>
                    <button class="btn" onclick="location.href='./templates/'" aria-label="Browse All Templates">Start Your Website Journey</button>
                </div>
            </section>

            <section class="templates">
                <div class="fw mt6">
                    <h2>Ready-Made Business Website Templates</h2>
                    <p class="template-intro">Select your perfect website from our professional collection. Each template is customizable to match your brand.</p>
                </div>
                <?php
                require_once "./backend/conn.php";
                $sql = "SELECT id, name, main_image FROM templates ORDER BY id DESC LIMIT 10";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <article class="template" onclick="location.href='../checkout/?id=<?= $row['id'] ?>'" role="button" tabindex="0">
                            <div class="gif">
                                <img src="./assets/gif.gif" alt="Loading animation" loading="lazy">
                            </div>
                            <div class="t_scroll">
                                <img src="./backend/<?= htmlspecialchars($row['main_image']) ?>" alt="Preview of <?= htmlspecialchars($row['name']) ?> template" loading="lazy">
                            </div>
                            <h3><?= htmlspecialchars($row['name']) ?></h3>
                        </article>
                    <?php endwhile;
                else: ?>
                    <p>No templates available at the moment. Please check back soon.</p>
                <?php endif;
                $conn->close();
                ?>
            </section>

            <div class="see_more cen">
                <button class="btn" onclick="location.href='./templates/'" aria-label="View All Templates">Explore All Business Templates</button>
            </div>

            <section class="why-choose-us">
                <h2>Expert Website Solutions</h2>
                <div class="benefits-grid">
                    <div class="benefit">
                        <h3>Instant Deployment</h3>
                        <p>Your complete business website, live within 3 days. No waiting for months of development or revisions.</p>
                    </div>
                    <div class="benefit">
                        <h3>Managed Service</h3>
                        <p>Our expert team handles all technical aspects - hosting, security, updates, and maintenance, letting you focus on your business.</p>
                    </div>
                    <div class="benefit">
                        <h3>Business Dashboard</h3>
                        <p>Update your content easily through a user-friendly dashboard. No technical knowledge needed - we handle the complex stuff.</p>
                    </div>
                    <div class="benefit">
                        <h3>24/7 Expert Support</h3>
                        <p>Dedicated development team available round-the-clock for updates, changes, and technical assistance.</p>
                    </div>
                </div>
            </section>
        </main>

        <?php require_once "./components/footer.php";?>
    </div>

 
    <!-- <script src="./js/chatbot.js" defer></script> -->
    <script src="./js/script.js" ></script>
    <script src="./scripts/script.js" ></script>
</body>
</html>
<!-- Optimized for African businesses seeking professional web presence. Fast 3-day delivery, mobile-responsive templates, affordable pricing. Contact Divine The Developer for custom web solutions. -->
</html>

