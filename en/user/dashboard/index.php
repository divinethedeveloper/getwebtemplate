<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #16a34a;
            --warning-color: #ca8a04;
            --danger-color: #dc2626;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --hover-bg: #f1f5f9;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 16px 24px rgba(0, 0, 0, 0.12);
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--background-color);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
            letter-spacing: 0.01em;
        }

        .container {
            display: flex;
            min-height: 100vh;
            gap: var(--spacing-xl);
        }

        /* Side Panel Styles */
        .side_panel {
            background: var(--card-background);
            padding: var(--spacing-xl) var(--spacing-lg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            width: 280px;
            z-index: 10;
            box-shadow: var(--shadow-md);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding-bottom: var(--spacing-xl);
            border-bottom: 2px solid var(--border-color);
            margin-bottom: var(--spacing-xl);
        }

        .logo h4 {
            color: var(--text-primary);
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .credit-info {
            margin: var(--spacing-xl) 0;
            padding: var(--spacing-lg);
            background: var(--hover-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .credit-type {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            padding: var(--spacing-sm) 0;
        }

        .credit-type:last-child {
            margin-bottom: 0;
        }

        .credit-type i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .credit-count {
            font-weight: 600;
            color: var(--text-primary);
            margin-left: auto;
        }

        .items {
            margin-top: var(--spacing-xl);
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
        }

        .item {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-secondary);
            text-decoration: none;
        }

        .item:hover {
            background: var(--hover-bg);
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .item.active {
            background: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .item i {
            font-size: 1.4rem;
        }

        .item h3 {
            font-size: 1rem;
            font-weight: 500;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: var(--spacing-xl);
            max-width: 1400px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
            padding-bottom: var(--spacing-lg);
            border-bottom: 2px solid var(--border-color);
        }

        .header h1 {
            font-size: 2.2rem;
            color: var(--text-primary);
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .button {
            padding: var(--spacing-sm) var(--spacing-lg);
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            font-size: 0.95rem;
        }

        .button-primary {
            background: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .button-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Template Grid */
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
        }

        .template-card {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
        }

        .template-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .template-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }

        .template-content {
            padding: var(--spacing-xl);
        }

        .template-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--spacing-lg);
        }

        .template-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .template-status {
            padding: var(--spacing-xs) var(--spacing-md);
            border-radius: var(--radius-xl);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .status-active {
            background: #dcfce7;
            color: #15803d;
        }

        .template-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        /* Customization Section */
        .customization-section {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
            box-shadow: var(--shadow-md);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
            padding-bottom: var(--spacing-lg);
            border-bottom: 2px solid var(--border-color);
        }

        .section-header h2 {
            font-size: 1.8rem;
            letter-spacing: -0.02em;
        }

        .form-group {
            margin-bottom: var(--spacing-xl);
        }

        .form-group label {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input[type="text"]:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .color-picker {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--spacing-lg);
            margin: var(--spacing-xl) 0;
        }

        .color-input {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .color-input label {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Update Credits Section */
        .credits-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
        }

        .credit-card {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 2px solid var(--border-color);
            transition: all 0.4s ease;
        }

        .credit-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .credit-card h3 {
            color: var(--primary-color);
            font-size: 1.6rem;
            margin-bottom: var(--spacing-sm);
            letter-spacing: -0.02em;
        }

        .credit-card p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .credit-price {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: var(--spacing-lg) 0;
            letter-spacing: -0.03em;
        }

        .credit-features {
            list-style: none;
            margin: var(--spacing-lg) 0;
        }

        .credit-features li {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .credit-features i {
            color: var(--success-color);
            font-size: 1.2rem;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .side_panel {
                transform: translateX(-100%);
                transition: transform 0.4s ease;
                width: 100%;
                max-width: 320px;
            }

            .side_panel.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: var(--spacing-lg);
            }

            .templates-grid,
            .credits-section {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: var(--spacing-md);
                align-items: flex-start;
            }
        }

        /* Mobile Menu Button */
        .mobile-menu {
            display: none;
            position: fixed;
            bottom: var(--spacing-xl);
            right: var(--spacing-xl);
            background: var(--primary-color);
            color: white;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            z-index: 100;
            font-size: 1.4rem;
        }

        @media (max-width: 768px) {
            .mobile-menu {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="side_panel">
            <div class="logo">
                <i class="bi bi-grid-1x2"></i>
                <h4>My Dashboard</h4>
            </div>

            <div class="credit-info">
                <div class="credit-type">
                    <i class="bi bi-lightning-charge"></i>
                    <span>Instant Credits:</span>
                    <span class="credit-count">2</span>
                </div>
                <div class="credit-type">
                    <i class="bi bi-clock"></i>
                    <span>Regular Credits:</span>
                    <span class="credit-count">5</span>
                </div>
                <div class="credit-type">
                    <i class="bi bi-calendar"></i>
                    <span>Standard Credits:</span>
                    <span class="credit-count">8</span>
                </div>
            </div>

            <div class="items">
                <a href="#" class="item active">
                    <i class="bi bi-grid"></i>
                    <h3>My Templates</h3>
                </a>
                <a href="#" class="item">
                    <i class="bi bi-palette"></i>
                    <h3>Customization</h3>
                </a>
                <a href="#" class="item">
                    <i class="bi bi-arrow-clockwise"></i>
                    <h3>Updates</h3>
                </a>
                <a href="#" class="item">
                    <i class="bi bi-credit-card"></i>
                    <h3>Credits</h3>
                </a>
                <a href="#" class="item">
                    <i class="bi bi-gear"></i>
                    <h3>Settings</h3>
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>My Templates</h1>
                <div class="header-actions">
                    <button class="button button-primary">
                        <i class="bi bi-plus-lg"></i>
                        Browse Templates
                    </button>
                </div>
            </div>

            <div class="templates-grid">
                <div class="template-card">
                    <img src="../../../assets/templates/business-pro.jpg" alt="Business Pro Template" class="template-image">
                    <div class="template-content">
                        <div class="template-header">
                            <h3 class="template-title">Business Pro</h3>
                            <span class="template-status status-active">Active</span>
                        </div>
                        <p>Professional business template with modern design</p>
                        <div class="template-actions">
                            <button class="button button-primary">Customize</button>
                            <button class="button">Preview</button>
                        </div>
                    </div>
                </div>

                <div class="template-card">
                    <img src="../../../assets/templates/ecommerce-plus.jpg" alt="E-commerce Plus Template" class="template-image">
                    <div class="template-content">
                        <div class="template-header">
                            <h3 class="template-title">E-commerce Plus</h3>
                            <span class="template-status status-active">Active</span>
                        </div>
                        <p>Complete e-commerce solution with advanced features</p>
                        <div class="template-actions">
                            <button class="button button-primary">Customize</button>
                            <button class="button">Preview</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="customization-section">
                <div class="section-header">
                    <h2>Customize Your Website</h2>
                    <button class="button button-primary">Save Changes</button>
                </div>

                <div class="form-group">
                    <label>Website Name</label>
                    <input type="text" placeholder="Enter your website name" value="My Business Site">
                </div>

                <div class="form-group">
                    <label>Upload Logo</label>
                    <input type="file" accept="image/*">
                </div>

                <div class="color-picker">
                    <div class="color-input">
                        <label>Primary Color</label>
                        <input type="color" value="#2563eb">
                    </div>
                    <div class="color-input">
                        <label>Secondary Color</label>
                        <input type="color" value="#1e40af">
                    </div>
                    <div class="color-input">
                        <label>Accent Color</label>
                        <input type="color" value="#16a34a">
                    </div>
                </div>
            </div>

            <h2>Update Credits</h2>
            <div class="credits-section">
                <div class="credit-card">
                    <h3>Instant Update</h3>
                    <p>Get your updates within 1 hour</p>
                    <div class="credit-price">$49</div>
                    <ul class="credit-features">
                        <li><i class="bi bi-check2"></i> Priority handling</li>
                        <li><i class="bi bi-check2"></i> Under 1 hour delivery</li>
                        <li><i class="bi bi-check2"></i> 24/7 support</li>
                    </ul>
                    <button class="button button-primary">Purchase Credits</button>
                </div>

                <div class="credit-card">
                    <h3>Regular Update</h3>
                    <p>Get your updates within 24 hours</p>
                    <div class="credit-price">$29</div>
                    <ul class="credit-features">
                        <li><i class="bi bi-check2"></i> Standard handling</li>
                        <li><i class="bi bi-check2"></i> Under 24 hours delivery</li>
                        <li><i class="bi bi-check2"></i> Business hours support</li>
                    </ul>
                    <button class="button button-primary">Purchase Credits</button>
                </div>

                <div class="credit-card">
                    <h3>Standard Update</h3>
                    <p>Get your updates within 3-7 days</p>
                    <div class="credit-price">$19</div>
                    <ul class="credit-features">
                        <li><i class="bi bi-check2"></i> Regular handling</li>
                        <li><i class="bi bi-check2"></i> 3-7 days delivery</li>
                        <li><i class="bi bi-check2"></i> Email support</li>
                    </ul>
                    <button class="button button-primary">Purchase Credits</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu">
        <i class="bi bi-list"></i>
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            document.querySelector('.side_panel').classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.side_panel') && !e.target.closest('.mobile-menu')) {
                document.querySelector('.side_panel').classList.remove('active');
            }
        });
    </script>
</body>
</html> 