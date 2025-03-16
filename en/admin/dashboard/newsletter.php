<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'backend/newsletter_stats.php';
require_once 'backend/utilities.php';

$newsletter_stats = getNewsletterStatistics();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Analytics | GetBusinessWebsite</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Enhanced base styles */
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
            --font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: var(--background-color);
            margin: 0;
            font-family: var(--font-sans);
            color: var(--text-primary);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Newsletter specific styles */
        .newsletter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .newsletter-actions {
            display: flex;
            gap: 1rem;
        }

        .action-button {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            background: var(--primary-color);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .subscriber-table {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        .subscriber-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .subscriber-table th,
        .subscriber-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .campaign-card {
            background: var(--card-background);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-badge.inactive {
            background: #fee2e2;
            color: #dc2626;
        }

        .chart-container {
            margin-top: 2rem;
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Enhanced card styles */
        .stat-card {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-card h3 {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        /* Enhanced filter styles */
        .filter-select {
            padding: 0.5rem 2rem 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: white;
            font-size: 0.875rem;
            color: var(--text-primary);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        /* Enhanced metrics display */
        .campaign-metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .metric {
            text-align: center;
        }

        .metric span {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
        }

        .metric strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-top: 0.25rem;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .campaign-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .subscriber-table {
                overflow-x: auto;
            }
        }

        .load-more-container {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
        }

        .load-more-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .load-more-button:hover {
            background-color: var(--secondary-color);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: var(--card-background);
            margin: 5% auto;
            padding: 20px;
            border-radius: 0.75rem;
            width: 80%;
            max-width: 600px;
            box-shadow: var(--shadow-md);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .close {
            color: var(--text-secondary);
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-actions {
            margin-top: 1.5rem;
            text-align: right;
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
                <div class="item" onclick="location.href='./visitors.php'">
                    <i class="bi bi-people"></i>
                    <h3>Visitors</h3>
                </div>
                <div class="item" onclick="location.href='./products.php'">
                    <i class="bi bi-cart"></i>
                    <h3>Products</h3>
                </div>
                <div class="item active" onclick="location.href='./newsletter.php'">
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
            <div class="newsletter-header">
                <h2>Newsletter Analytics</h2>
                <div class="newsletter-actions">
                    <button class="action-button" onclick="toggleSubscriberModal()">
                        <i class="bi bi-person-plus"></i>
                        Add Subscriber
                    </button>
                    <button class="action-button" onclick="toggleCampaignModal()">
                        <i class="bi bi-envelope-paper"></i>
                        New Campaign
                    </button>
                </div>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Subscribers</h3>
                    <div class="value"><?php echo formatLargeNumber($newsletter_stats['total_subscribers']); ?></div>
                    <div class="trend <?php echo $newsletter_stats['growth_rate'] > 0 ? 'up' : 'down'; ?>">
                        <i class="bi bi-arrow-<?php echo $newsletter_stats['growth_rate'] > 0 ? 'up' : 'down'; ?>"></i>
                        <?php echo abs($newsletter_stats['growth_rate']); ?>% this month
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Average Open Rate</h3>
                    <div class="value"><?php echo $newsletter_stats['avg_open_rate']; ?>%</div>
                    <div class="trend up">
                        <i class="bi bi-envelope-open"></i>
                        Industry avg: 21.33%
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Click Rate</h3>
                    <div class="value"><?php echo $newsletter_stats['avg_click_rate']; ?>%</div>
                    <div class="trend up">
                        <i class="bi bi-mouse"></i>
                        Industry avg: 2.62%
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Recent Campaign</h3>
                    <div class="value"><?php 
                        echo !empty($newsletter_stats['recent_campaigns']) ? 
                            formatLargeNumber($newsletter_stats['recent_campaigns'][0]['total_recipients']) : '0';
                    ?></div>
                    <div class="trend up">
                        <i class="bi bi-send"></i>
                        Recipients
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <h3>Subscriber Growth</h3>
                <canvas id="growthChart"></canvas>
            </div>

            <div class="subscriber-table">
                <h3>Newsletter Subscribers</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="subscribersTableBody">
                        <?php 
                        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
                        $subscribers = array_slice($newsletter_stats['recent_subscribers'], 0, $limit);
                        foreach ($subscribers as $subscriber): 
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subscriber['email']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['name']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($subscriber['subscription_date'])); ?></td>
                            <td><?php echo ucfirst(htmlspecialchars($subscriber['source'])); ?></td>
                            <td>
                                <span class="status-badge <?php echo $subscriber['status'] === 'subscribed' ? 'active' : 'inactive'; ?>">
                                    <?php echo ucfirst($subscriber['status']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="action-button" onclick="updateSubscriberStatus('<?php echo $subscriber['email']; ?>', '<?php echo $subscriber['status'] === 'subscribed' ? 'unsubscribed' : 'subscribed'; ?>')">
                                    <?php echo $subscriber['status'] === 'subscribed' ? 'Unsubscribe' : 'Resubscribe'; ?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (count($newsletter_stats['recent_subscribers']) > $limit): ?>
                <div class="load-more-container">
                    <button id="loadMoreBtn" class="load-more-button" onclick="loadMoreSubscribers(<?php echo $limit; ?>)">
                        Load More
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <div class="campaign-grid">
                <?php foreach ($newsletter_stats['recent_campaigns'] as $campaign): ?>
                <div class="campaign-card">
                    <h3><?php echo htmlspecialchars($campaign['subject']); ?></h3>
                    <p>Sent on <?php echo date('M d, Y', strtotime($campaign['send_date'])); ?></p>
                    <div class="campaign-stats">
                        <p>Recipients: <?php echo formatLargeNumber($campaign['total_recipients']); ?></p>
                        <p>Opens: <?php echo formatLargeNumber($campaign['opens']); ?> (<?php echo round(($campaign['opens'] / $campaign['total_recipients']) * 100, 1); ?>%)</p>
                        <p>Clicks: <?php echo formatLargeNumber($campaign['clicks']); ?> (<?php echo round(($campaign['clicks'] / $campaign['total_recipients']) * 100, 1); ?>%)</p>
                        <p>Unsubscribes: <?php echo formatLargeNumber($campaign['unsubscribes']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Campaign Modal -->
    <div id="campaignModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create New Campaign</h2>
                <span class="close">&times;</span>
            </div>
            <form id="campaignForm" onsubmit="saveCampaign(event)">
                <div class="form-group">
                    <label for="subject">Campaign Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="content">Campaign Content</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="send_date">Send Date</label>
                    <input type="datetime-local" id="send_date" name="send_date" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="draft">Draft</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="sent">Sent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_recipients">Total Recipients</label>
                    <input type="number" id="total_recipients" name="total_recipients" required>
                </div>
                <div class="form-group">
                    <label for="opens">Opens</label>
                    <input type="number" id="opens" name="opens" value="0">
                </div>
                <div class="form-group">
                    <label for="clicks">Clicks</label>
                    <input type="number" id="clicks" name="clicks" value="0">
                </div>
                <div class="form-group">
                    <label for="unsubscribes">Unsubscribes</label>
                    <input type="number" id="unsubscribes" name="unsubscribes" value="0">
                </div>
                <div class="form-actions">
                    <button type="submit" class="action-button">Save Campaign</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare growth data
            const growthData = <?php echo json_encode($newsletter_stats['growth_data']); ?>;
            
            // Growth Chart
            const growthCtx = document.getElementById('growthChart').getContext('2d');
            new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: growthData.map(data => data.date),
                    datasets: [{
                        label: 'New Subscribers',
                        data: growthData.map(data => data.new_subscribers),
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function updateSubscriberStatus(email, newStatus) {
            if (confirm('Are you sure you want to update this subscriber\'s status?')) {
                fetch('backend/update_subscriber.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to update subscriber status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the subscriber status');
                });
            }
        }

        function loadMoreSubscribers(currentLimit) {
            const newLimit = currentLimit + 5;
            window.location.href = 'newsletter.php?limit=' + newLimit;
        }

        // Campaign Modal Functions
        const campaignModal = document.getElementById('campaignModal');
        const closeBtn = document.querySelector('.close');

        function toggleCampaignModal() {
            campaignModal.style.display = campaignModal.style.display === 'block' ? 'none' : 'block';
        }

        closeBtn.onclick = function() {
            campaignModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == campaignModal) {
                campaignModal.style.display = 'none';
            }
        }

        function saveCampaign(event) {
            event.preventDefault();
            
            const formData = new FormData(document.getElementById('campaignForm'));
            const campaignData = Object.fromEntries(formData.entries());

            fetch('backend/save_campaign.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(campaignData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Campaign saved successfully!');
                    location.reload();
                } else {
                    alert('Error saving campaign: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the campaign');
            });
        }

        function updateCampaignStatus(campaignId, newStatus) {
            fetch('backend/update_campaign.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    campaign_id: campaignId,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update campaign status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the campaign');
            });
        }
    </script>
</body>
</html> 