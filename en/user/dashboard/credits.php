<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Credits | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/index.css">
    <?php require_once '../components/nav.php'; ?>
    <style>
        .credits-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-xl);
        }

        .credits-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .credit-stat {
            background: var(--card-background);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: all 0.3s ease;
        }

        .credit-stat:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: var(--spacing-xs);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
        }

        .package-card {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 2px solid var(--border-color);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .package-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .package-card.popular::before {
            content: 'Most Popular';
            position: absolute;
            top: 1rem;
            right: -2rem;
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 3rem;
            transform: rotate(45deg);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .package-header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-md);
            border-bottom: 2px solid var(--border-color);
        }

        .package-name {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: var(--spacing-xs);
        }

        .package-price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: var(--spacing-md) 0;
        }

        .price-period {
            font-size: 1rem;
            color: var(--text-secondary);
        }

        .package-features {
            list-style: none;
            margin: var(--spacing-lg) 0;
        }

        .package-features li {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            color: var(--text-secondary);
        }

        .package-features i {
            color: var(--success-color);
            font-size: 1.2rem;
        }

        .purchase-btn {
            width: 100%;
            padding: var(--spacing-md);
            border: none;
            border-radius: var(--radius-lg);
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .purchase-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .history-section {
            margin-top: var(--spacing-xl);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card-background);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .history-table th,
        .history-table td {
            padding: var(--spacing-md);
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .history-table th {
            background: var(--hover-bg);
            font-weight: 500;
            color: var(--text-primary);
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .history-table tr:hover td {
            background: var(--hover-bg);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-success {
            background: #dcfce7;
            color: #15803d;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        @media (max-width: 768px) {
            .credits-container {
                padding: var(--spacing-md);
            }

            .history-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1>Update Credits</h1>
            </div>

            <div class="credits-container">
                <!-- Credits Overview -->
                <div class="credits-overview">
                    <div class="credit-stat">
                        <div class="stat-value">5</div>
                        <div class="stat-label">Instant Credits</div>
                    </div>
                    <div class="credit-stat">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Regular Credits</div>
                    </div>
                    <div class="credit-stat">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Standard Credits</div>
                    </div>
                    <div class="credit-stat">
                        <div class="stat-value">25</div>
                        <div class="stat-label">Total Updates Made</div>
                    </div>
                </div>

                <!-- Credit Packages -->
                <h2>Purchase Credits</h2>
                <div class="packages-grid">
                    <!-- Instant Update Package -->
                    <div class="package-card popular">
                        <div class="package-header">
                            <div class="package-name">Instant Update</div>
                            <div class="package-price">$49</div>
                            <div class="price-period">per 5 credits</div>
                        </div>
                        <ul class="package-features">
                            <li><i class="bi bi-check2"></i> Updates within 1 hour</li>
                            <li><i class="bi bi-check2"></i> Priority handling</li>
                            <li><i class="bi bi-check2"></i> 24/7 support access</li>
                            <li><i class="bi bi-check2"></i> Emergency requests</li>
                            <li><i class="bi bi-check2"></i> Instant confirmation</li>
                        </ul>
                        <button class="purchase-btn">Purchase Now</button>
                    </div>

                    <!-- Regular Update Package -->
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-name">Regular Update</div>
                            <div class="package-price">$29</div>
                            <div class="price-period">per 5 credits</div>
                        </div>
                        <ul class="package-features">
                            <li><i class="bi bi-check2"></i> Updates within 24 hours</li>
                            <li><i class="bi bi-check2"></i> Standard handling</li>
                            <li><i class="bi bi-check2"></i> Business hours support</li>
                            <li><i class="bi bi-check2"></i> Regular requests</li>
                            <li><i class="bi bi-check2"></i> Email notifications</li>
                        </ul>
                        <button class="purchase-btn">Purchase Now</button>
                    </div>

                    <!-- Standard Update Package -->
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-name">Standard Update</div>
                            <div class="package-price">$19</div>
                            <div class="price-period">per 5 credits</div>
                        </div>
                        <ul class="package-features">
                            <li><i class="bi bi-check2"></i> Updates within 3-7 days</li>
                            <li><i class="bi bi-check2"></i> Regular handling</li>
                            <li><i class="bi bi-check2"></i> Email support</li>
                            <li><i class="bi bi-check2"></i> Basic requests</li>
                            <li><i class="bi bi-check2"></i> Status tracking</li>
                        </ul>
                        <button class="purchase-btn">Purchase Now</button>
                    </div>
                </div>

                <!-- Purchase History -->
                <div class="history-section">
                    <div class="history-header">
                        <h2>Purchase History</h2>
                        <button class="button">Export History</button>
                    </div>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Package</th>
                                <th>Credits</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-02-15</td>
                                <td>Instant Update</td>
                                <td>5</td>
                                <td>$49.00</td>
                                <td><span class="status-badge status-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2024-02-10</td>
                                <td>Regular Update</td>
                                <td>5</td>
                                <td>$29.00</td>
                                <td><span class="status-badge status-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2024-02-05</td>
                                <td>Standard Update</td>
                                <td>5</td>
                                <td>$19.00</td>
                                <td><span class="status-badge status-pending">Processing</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scroll to package cards
        document.querySelectorAll('.package-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                card.style.transform = `
                    perspective(1000px)
                    rotateX(${(y - rect.height / 2) / 20}deg)
                    rotateY(${(x - rect.width / 2) / 20}deg)
                    translateY(-8px)
                `;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Purchase button click animation
        document.querySelectorAll('.purchase-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
    </script>
</body>
</html> 