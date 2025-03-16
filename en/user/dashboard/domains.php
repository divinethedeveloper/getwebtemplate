<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domains & Hosting | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/index.css">
    <?php require_once '../components/nav.php'; ?>
    <style>
        .domains-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-xl);
        }

        .domain-card {
            background: var(--card-background);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-lg);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .domain-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .domain-name {
            font-size: 1.5rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .domain-status {
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-expiring {
            background: #fef3c7;
            color: #92400e;
        }

        .domain-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .info-item {
            padding: var(--spacing-md);
            background: var(--hover-bg);
            border-radius: var(--radius-md);
        }

        .info-item h4 {
            color: var(--text-secondary);
            margin-bottom: var(--spacing-xs);
            font-size: 0.875rem;
        }

        .info-item p {
            color: var(--text-primary);
            font-weight: 500;
        }

        .domain-actions {
            display: flex;
            gap: var(--spacing-md);
            flex-wrap: wrap;
        }

        .action-button {
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-md);
            border: 2px solid var(--border-color);
            background: white;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .action-button:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .action-button.primary {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .action-button.primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .hosting-section {
            margin-top: var(--spacing-xl);
        }

        .hosting-info {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .hosting-info .action-button {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .hosting-info .action-button:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .hosting-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .hosting-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .stat-item h4 {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: var(--spacing-xs);
            color: rgba(255, 255, 255, 0.9);
        }

        .stat-item p {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .progress-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            margin-top: var(--spacing-sm);
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .progress-fill {
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 4px;
            transition: width 0.3s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .domain-search {
            margin-bottom: var(--spacing-xl);
        }

        .search-box {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .search-input {
            flex: 1;
            padding: var(--spacing-lg);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 1rem;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        @media (max-width: 768px) {
            .domains-container {
                padding: var(--spacing-md);
            }

            .domain-header {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--spacing-md);
            }

            .domain-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1>Domains & Hosting</h1>
            </div>

            <div class="domains-container">
                <!-- Domain Search -->
                <div class="domain-search">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Search for a domain name...">
                        <button class="action-button primary">Search Domain</button>
                    </div>
                </div>

                <!-- Active Domains -->
                <div class="domain-card">
                    <div class="domain-header">
                        <div class="domain-name">
                            <i class="bi bi-globe"></i>
                            example.com
                            <span class="domain-status status-active">Active</span>
                        </div>
                        <div class="domain-actions">
                            <button class="action-button"><i class="bi bi-gear"></i> Manage DNS</button>
                            <button class="action-button"><i class="bi bi-arrow-repeat"></i> Auto-renew</button>
                            <button class="action-button primary"><i class="bi bi-arrow-clockwise"></i> Renew Now</button>
                        </div>
                    </div>
                    <div class="domain-info">
                        <div class="info-item">
                            <h4>Registration Date</h4>
                            <p>Jan 15, 2023</p>
                        </div>
                        <div class="info-item">
                            <h4>Expiry Date</h4>
                            <p>Jan 15, 2024</p>
                        </div>
                        <div class="info-item">
                            <h4>Auto-renew</h4>
                            <p>Enabled</p>
                        </div>
                        <div class="info-item">
                            <h4>Time Remaining</h4>
                            <p>320 days</p>
                        </div>
                    </div>
                </div>

                <div class="domain-card">
                    <div class="domain-header">
                        <div class="domain-name">
                            <i class="bi bi-globe"></i>
                            another-example.com
                            <span class="domain-status status-expiring">Expiring Soon</span>
                        </div>
                        <div class="domain-actions">
                            <button class="action-button"><i class="bi bi-gear"></i> Manage DNS</button>
                            <button class="action-button"><i class="bi bi-arrow-repeat"></i> Auto-renew</button>
                            <button class="action-button primary"><i class="bi bi-arrow-clockwise"></i> Renew Now</button>
                        </div>
                    </div>
                    <div class="domain-info">
                        <div class="info-item">
                            <h4>Registration Date</h4>
                            <p>Mar 1, 2023</p>
                        </div>
                        <div class="info-item">
                            <h4>Expiry Date</h4>
                            <p>Mar 1, 2024</p>
                        </div>
                        <div class="info-item">
                            <h4>Auto-renew</h4>
                            <p>Disabled</p>
                        </div>
                        <div class="info-item">
                            <h4>Time Remaining</h4>
                            <p>15 days</p>
                        </div>
                    </div>
                </div>

                <!-- Hosting Section -->
                <div class="hosting-section">
                    <h2 class="mb-4">Hosting Plan</h2>
                    <div class="hosting-info">
                        <div class="domain-header">
                            <h3>Business Pro Hosting</h3>
                            <button class="action-button">Upgrade Plan</button>
                        </div>
                        <div class="hosting-stats">
                            <div class="stat-item">
                                <h4>Storage Used</h4>
                                <p>45.5 GB</p>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 45%;"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <h4>Bandwidth</h4>
                                <p>156 GB</p>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 32%;"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <h4>Time Remaining</h4>
                                <p>267 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Domain search functionality
        const searchInput = document.querySelector('.search-input');
        const searchButton = document.querySelector('.search-box .action-button');

        searchButton.addEventListener('click', () => {
            const domain = searchInput.value.trim();
            if (domain) {
                // Implement domain search functionality
                alert(`Searching for domain: ${domain}`);
            }
        });

        // Auto-renew toggle
        document.querySelectorAll('.action-button').forEach(button => {
            if (button.textContent.includes('Auto-renew')) {
                button.addEventListener('click', function() {
                    const isEnabled = this.classList.contains('primary');
                    if (isEnabled) {
                        this.classList.remove('primary');
                    } else {
                        this.classList.add('primary');
                    }
                });
            }
        });

        // Renew domain confirmation
        document.querySelectorAll('.action-button.primary').forEach(button => {
            if (button.textContent.includes('Renew Now')) {
                button.addEventListener('click', function() {
                    if (confirm('Would you like to renew this domain?')) {
                        // Implement renewal logic
                        alert('Domain renewal initiated!');
                    }
                });
            }
        });
    </script>
</body>
</html> 