<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/index.css">
    <?php require_once '../components/nav.php'; ?>
    <style>
        .settings-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: var(--spacing-xl);
        }

        .settings-nav {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-xl);
            border-bottom: 2px solid var(--border-color);
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .settings-nav::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            padding: var(--spacing-md) var(--spacing-lg);
            color: var(--text-secondary);
            cursor: pointer;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            color: var(--primary-color);
        }

        .nav-item.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .settings-section {
            background: var(--card-background);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-md);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .section-title {
            font-size: 1.5rem;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-xs);
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            background: white;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--hover-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            cursor: pointer;
        }

        .switch {
            position: relative;
            width: 50px;
            height: 26px;
            background: var(--border-color);
            border-radius: 13px;
            transition: all 0.3s ease;
        }

        .switch::before {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            background: white;
            transition: all 0.3s ease;
        }

        .switch.active {
            background: var(--primary-color);
        }

        .switch.active::before {
            transform: translateX(24px);
        }

        .notification-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-md) 0;
            border-bottom: 1px solid var(--border-color);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-info h4 {
            margin-bottom: var(--spacing-xs);
            color: var(--text-primary);
        }

        .notification-info p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .api-key {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--hover-bg);
            border-radius: var(--radius-md);
            font-family: monospace;
        }

        .api-key button {
            padding: var(--spacing-xs) var(--spacing-sm);
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
        }

        .danger-zone {
            border: 2px solid #fee2e2;
            border-radius: var(--radius-lg);
            padding: var(--spacing-lg);
        }

        .danger-zone h3 {
            color: #dc2626;
            margin-bottom: var(--spacing-md);
        }

        .danger-zone p {
            color: var(--text-secondary);
            margin-bottom: var(--spacing-md);
        }

        .danger-button {
            background: #dc2626;
            color: white;
            padding: var(--spacing-sm) var(--spacing-lg);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .danger-button:hover {
            background: #b91c1c;
        }

        .verification-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .verification-card {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: var(--spacing-lg);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .verification-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-4px);
        }

        .verification-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: var(--spacing-md);
        }

        @media (max-width: 768px) {
            .settings-container {
                padding: var(--spacing-md);
            }

            .avatar-upload {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1>Settings</h1>
            </div>

            <div class="settings-container">
                <!-- Settings Navigation -->
                <div class="settings-nav">
                    <div class="nav-item active">Profile</div>
                    <div class="nav-item">Security</div>
                    <div class="nav-item">Notifications</div>
                    <div class="nav-item">API</div>
                    <div class="nav-item">Billing</div>
                </div>

                <!-- Profile Section -->
                <div class="settings-section">
                    <div class="section-header">
                        <h2 class="section-title">Profile Information</h2>
                        <button class="button button-primary">Save Changes</button>
                    </div>

                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            <img src="../../../assets/avatars/default.jpg" alt="Profile Picture">
                        </div>
                        <div>
                            <button class="button">Change Photo</button>
                            <p class="text-sm text-secondary">JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" value="John Doe">
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="john@example.com">
                    </div>

                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" value="Acme Inc">
                    </div>
                </div>

                <!-- Security Section -->
                <div class="settings-section">
                    <div class="section-header">
                        <h2 class="section-title">Security Settings</h2>
                    </div>

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password">
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password">
                    </div>

                    <h3 class="mb-4">Two-Factor Authentication</h3>
                    <div class="verification-methods">
                        <div class="verification-card">
                            <i class="bi bi-phone"></i>
                            <h4>SMS Authentication</h4>
                            <p>Receive codes via text message</p>
                        </div>
                        <div class="verification-card">
                            <i class="bi bi-shield-lock"></i>
                            <h4>Authenticator App</h4>
                            <p>Use an authentication app</p>
                        </div>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="settings-section">
                    <div class="section-header">
                        <h2 class="section-title">Notification Preferences</h2>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Update Notifications</h4>
                            <p>Receive notifications when updates are completed</p>
                        </div>
                        <div class="toggle-switch">
                            <div class="switch active"></div>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Credit Purchase Confirmations</h4>
                            <p>Get notified about successful credit purchases</p>
                        </div>
                        <div class="toggle-switch">
                            <div class="switch active"></div>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-info">
                            <h4>Marketing Updates</h4>
                            <p>Receive news about new features and promotions</p>
                        </div>
                        <div class="toggle-switch">
                            <div class="switch"></div>
                        </div>
                    </div>
                </div>

                <!-- API Section -->
                <div class="settings-section">
                    <div class="section-header">
                        <h2 class="section-title">API Settings</h2>
                    </div>

                    <p class="mb-4">Your API key provides access to our API endpoints.</p>
                    <div class="api-key">
                        <code>sk_live_51KjH2nK9m2U8V3pX...</code>
                        <button>Copy</button>
                        <button>Regenerate</button>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="settings-section">
                    <div class="danger-zone">
                        <h3>Delete Account</h3>
                        <p>Once you delete your account, there is no going back. Please be certain.</p>
                        <button class="danger-button">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle switches
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const switch_elem = toggle.querySelector('.switch');
                switch_elem.classList.toggle('active');
            });
        });

        // Settings navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // Copy API key
        document.querySelector('.api-key button').addEventListener('click', function() {
            const code = document.querySelector('.api-key code').textContent;
            navigator.clipboard.writeText(code);
            this.textContent = 'Copied!';
            setTimeout(() => {
                this.textContent = 'Copy';
            }, 2000);
        });

        // Delete account confirmation
        document.querySelector('.danger-button').addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html> 