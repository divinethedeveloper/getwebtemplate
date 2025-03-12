<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Analytics | GetBusinessWebsite</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Inherit base styles from index.html */
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
        }

        body {
            background-color: var(--background-color);
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Additional styles for visitors page */
        .visitor-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .date-filter {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .date-filter select {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            background-color: white;
        }

        .map-container {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            height: 300px;
        }

        .visitor-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .visitor-table {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .visitor-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .visitor-table th, .visitor-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .visitor-table th {
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .device-icon {
            font-size: 1.25rem;
            margin-right: 0.5rem;
        }

        .location-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            background: #f1f5f9;
            border-radius: 1rem;
            font-size: 0.875rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: var(--primary-color);
            border-radius: 4px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="side_panel">
            <div class="logo">
                <i class="bi bi-graph-up-arrow"></i>
                <h4>Analytics Dashboard</h4>
            </div>

            <div class="items">
                <div class="item" onclick="location.href='./index.php'">
                    <i class="bi bi-house"></i>
                    <h3>Overview</h3>
                </div>
                <div class="item active" onclick="location.href='./visitors.php'">
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
        </div>

        <div class="info">
            <div class="visitor-header">
                <h2>Visitor Analytics</h2>
                <div class="date-filter">
                    <select>
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                        <option>Last year</option>
                    </select>
                </div>
            </div>

            <div class="visitor-grid">
                <div class="stat-card">
                    <h3>Unique Visitors</h3>
                    <div class="value">8,492</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        15.3% vs last period
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Average Time on Site</h3>
                    <div class="value">6:18</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        +1:24 vs last period
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Return Visitors</h3>
                    <div class="value">42%</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        5.7% vs last period
                    </div>
                </div>
            </div>

            <div class="map-container">
                <h3>Visitor Locations</h3>
                <canvas id="visitorMap"></canvas>
            </div>

            <div class="charts-grid">
                <div class="chart-card">
                    <h3>Device Distribution</h3>
                    <canvas id="deviceChart"></canvas>
                    <div class="chart-content">
                        <div class="stat-item">
                            <span><i class="bi bi-phone device-icon"></i>Mobile</span>
                            <strong>58%</strong>
                        </div>
                        <div class="stat-item">
                            <span><i class="bi bi-laptop device-icon"></i>Desktop</span>
                            <strong>34%</strong>
                        </div>
                        <div class="stat-item">
                            <span><i class="bi bi-tablet device-icon"></i>Tablet</span>
                            <strong>8%</strong>
                        </div>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Browser Usage</h3>
                    <canvas id="browserChart"></canvas>
                    <div class="chart-content">
                        <div class="stat-item">
                            <span>Chrome</span>
                            <strong>64%</strong>
                        </div>
                        <div class="stat-item">
                            <span>Safari</span>
                            <strong>22%</strong>
                        </div>
                        <div class="stat-item">
                            <span>Firefox</span>
                            <strong>14%</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="visitor-table">
                <h3>Recent Visitors</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Device</th>
                            <th>Browser</th>
                            <th>Time on Site</th>
                            <th>Pages Viewed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="location-badge"><i class="bi bi-geo-alt"></i> Lagos, Nigeria</span></td>
                            <td><i class="bi bi-phone device-icon"></i>iPhone 13</td>
                            <td>Safari</td>
                            <td>5:42</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td><span class="location-badge"><i class="bi bi-geo-alt"></i> Nairobi, Kenya</span></td>
                            <td><i class="bi bi-laptop device-icon"></i>Windows PC</td>
                            <td>Chrome</td>
                            <td>8:15</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td><span class="location-badge"><i class="bi bi-geo-alt"></i> Accra, Ghana</span></td>
                            <td><i class="bi bi-phone device-icon"></i>Samsung S21</td>
                            <td>Chrome</td>
                            <td>3:28</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td><span class="location-badge"><i class="bi bi-geo-alt"></i> Cape Town, SA</span></td>
                            <td><i class="bi bi-tablet device-icon"></i>iPad Pro</td>
                            <td>Safari</td>
                            <td>6:53</td>
                            <td>9</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Initialize charts when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Device Distribution Chart
            const deviceCtx = document.getElementById('deviceChart').getContext('2d');
            new Chart(deviceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Mobile', 'Desktop', 'Tablet'],
                    datasets: [{
                        data: [58, 34, 8],
                        backgroundColor: ['#2563eb', '#16a34a', '#ca8a04']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Browser Usage Chart
            const browserCtx = document.getElementById('browserChart').getContext('2d');
            new Chart(browserCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Chrome', 'Safari', 'Firefox'],
                    datasets: [{
                        data: [64, 22, 14],
                        backgroundColor: ['#2563eb', '#16a34a', '#ca8a04']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html> 