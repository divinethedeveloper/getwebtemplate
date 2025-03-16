<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
require_once 'backend/visitor_stats.php';
require_once 'backend/template_stats.php';
require_once 'backend/utilities.php';

$visitor_stats = getVisitorStatistics();
$template_stats = getOverviewStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard | GetBusinessWebsite</title>
    <link rel="stylesheet" href="../style/style.css">
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

        .side_panel {
            background: var(--card-background);
            padding: 1.5rem;
            border-right: 1px solid #e2e8f0;
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

        .info {
            padding: 2rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .stat-card h3 {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin: 0 0 0.5rem 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-card .value {
            color: var(--text-primary);
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
        }

        .stat-card .trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            font-size: 0.875rem;
        }

        .trend.up { color: var(--success-color); }
        .trend.down { color: var(--danger-color); }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .chart-card h3 {
            color: var(--text-primary);
            margin: 0 0 1rem 0;
        }

        .live-visitors {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .pulse {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success-color);
            margin-right: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
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
        </div>

        <div class="info">
            <div class="live-visitors">
                <div class="pulse"></div>
                <strong><?php echo isset($visitor_stats['current_visitors']) ? formatLargeNumber($visitor_stats['current_visitors']) : '0'; ?> people</strong> are currently browsing the website
            </div>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Templates</h3>
                    <div class="value"><?php echo formatLargeNumber($template_stats['performance']['metrics']['total_templates']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        Total Active Templates
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Total Revenue</h3>
                    <div class="value"><?php echo formatMoney($template_stats['performance']['metrics']['total_revenue']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        From All Sales
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Total Views</h3>
                    <div class="value"><?php echo formatLargeNumber($template_stats['performance']['metrics']['total_views']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        Across All Templates
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Conversion Rate</h3>
                    <div class="value"><?php echo number_format($template_stats['performance']['metrics']['conversion_rate'], 1); ?>%</div>
                    <div class="trend <?php echo $template_stats['performance']['metrics']['conversion_rate'] > 3 ? 'up' : 'down'; ?>">
                        <i class="bi bi-arrow-<?php echo $template_stats['performance']['metrics']['conversion_rate'] > 3 ? 'up' : 'down'; ?>"></i>
                        Views to Sales
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Current Visitors</h3>
                    <div class="value">
                        <?php echo isset($visitor_stats['current_visitors']) ? formatLargeNumber($visitor_stats['current_visitors']) : '0'; ?>
                    </div>
                    <div class="trend up">
                        <i class="bi bi-people"></i>
                        people are currently browsing the website
                    </div>
                </div>
            </div>

            <div class="charts-grid">
                <div class="chart-card">
                    <h3>Most Viewed Templates</h3>
                    <div class="chart-content">
                        <?php foreach ($template_stats['most_viewed'] as $template): ?>
                        <div class="stat-item">
                            <span><?php echo htmlspecialchars($template['name']); ?></span>
                            <strong><?php echo formatLargeNumber($template['views']); ?> views</strong>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Top Performing Templates</h3>
                    <div class="chart-content">
                        <?php foreach ($template_stats['performance']['top_performers'] as $template): ?>
                        <div class="stat-item">
                            <span><?php echo htmlspecialchars($template['name']); ?></span>
                            <strong><?php echo $template['times_purchased']; ?> sales</strong>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Category Distribution</h3>
                    <div class="chart-content">
                        <?php foreach ($template_stats['recent_sales']['categories'] as $category): ?>
                        <div class="stat-item">
                            <span><?php echo ucfirst(htmlspecialchars($category['category'])); ?></span>
                            <strong><?php echo $category['count']; ?> templates</strong>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Revenue by Category</h3>
                    <div class="chart-content">
                        <?php foreach ($template_stats['recent_sales']['categories'] as $category): ?>
                        <div class="stat-item">
                            <span><?php echo ucfirst(htmlspecialchars($category['category'])); ?></span>
                            <strong><?php echo formatMoney($category['revenue']); ?></strong>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chart-content {
            margin-top: 1rem;
        }
        
        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .stat-item:last-child {
            border-bottom: none;
        }
        
        .stat-item span {
            color: var(--text-secondary);
        }
        
        .stat-item strong {
            color: var(--text-primary);
        }
    </style>
</body>
</html>