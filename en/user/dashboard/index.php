<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <?php include '../components/nav.php'; ?>
       

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

 

    <script>
       
    </script>
</body>
</html> 