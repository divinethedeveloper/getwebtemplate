<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | GetBusinessWebsite</title>
    <link rel="stylesheet" href="../style/main.css">
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
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
            line-height: 1.5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
        }

        .main-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .header p {
            color: var(--text-secondary);
        }

        .settings-section {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .settings-section h2 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.9375rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .setting-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .setting-row:last-child {
            border-bottom: none;
        }

        .setting-info h3 {
            font-size: 0.9375rem;
            margin-bottom: 0.25rem;
        }

        .setting-info p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary-color);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        .button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .button:hover {
            background: var(--secondary-color);
        }

        .danger-zone {
            border: 1px solid var(--danger-color);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .danger-zone h2 {
            color: var(--danger-color);
        }

        .danger-button {
            background: var(--danger-color);
        }

        .danger-button:hover {
            background: #b91c1c;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        /* Side panel styles */
        .side_panel {
            background: var(--card-background);
            padding: 1.5rem;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            height: 100vh;
            width: 250px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo h4 {
            color: var(--text-primary);
            font-size: 1.25rem;
            margin: 0;
        }

        .items {
            margin-top: 2rem;
        }

        .item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-secondary);
        }

        .item:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .item.active {
            background: var(--primary-color);
            color: white;
        }

        .item i {
            font-size: 1.25rem;
        }

        .item h3 {
            font-size: 0.9375rem;
            font-weight: 500;
            margin: 0;
        }

        @media (max-width: 768px) {
            .side_panel {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <!-- <div class="side_panel">
            <div class="logo">
                <i class="bi bi-graph-up-arrow"></i>
                <h4>Analytics Dashboard</h4>
            </div>

            <div class="items">
                <div class="item active" onclick="location.href='./index.php'">
                    <i class="bi bi-house"></i>
                    <h3>Overview</h3>
                </div>
                <div class="item" onclick="location.href='./visitors.php'">
                    <i class="bi bi-people"></i>
                    <h3>Visitors</h3>
                </div>
                <div class="item" onclick="location.href='./products.php'">
                    <i class="bi bi-cart"></i>
                    <h3>Products</h3>
                </div>
                <div class="item" onclick="location.href='./newsletter.php'">
                    <i class="bi bi-envelope"></i>
                    <h3>Newsletter</h3>
                </div>
                <div class="item" onclick="location.href='./settings.php'">
                    <i class="bi bi-gear"></i>
                    <h3>Settings</h3>
                </div>
            </div>
        </div> -->
        <div class="main-content">
            <div class="main-container">
                <div class="header">
                    <h1>Settings</h1>
                    <p>Manage your account settings and preferences</p>
                </div>

                <div class="settings-section">
                    <h2>Account Settings</h2>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="admin@getbusinesswebsite.com" />
                    </div>
                    <div class="form-group">
                        <label>Display Name</label>
                        <input type="text" value="Admin User" />
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" value="Administrator" disabled />
                    </div>
                    <button class="button">Save Changes</button>
                </div>

                <div class="settings-section">
                    <h2>Notification Preferences</h2>
                    <div class="setting-row">
                        <div class="setting-info">
                            <h3>Email Notifications</h3>
                            <p>Receive email updates about your account activity</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="setting-row">
                        <div class="setting-info">
                            <h3>Order Notifications</h3>
                            <p>Get notified when new orders are placed</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="settings-section">
                    <h2>Security</h2>
                    <div class="setting-row">
                        <div class="setting-info">
                            <h3>Two-Factor Authentication</h3>
                            <p>Add an extra layer of security to your account</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="button">Change Password</button>
                    </div>
                </div>

                <div class="danger-zone">
                    <h2>Danger Zone</h2>
                    <p>Careful, these actions cannot be undone</p>
                    <button class="button danger-button">Delete Account</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
            });
        });

        // Handle toggle switches
        document.querySelectorAll('.toggle-switch input').forEach(toggle => {
            toggle.addEventListener('change', (e) => {
                // Add toggle handling logic here
            });
        });
    </script>
</body>
</html> 