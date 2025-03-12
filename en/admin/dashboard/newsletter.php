<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Management | GetBusinessWebsite</title>
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

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .campaign-card {
            background: var(--card-background);
            border-radius: 0.75rem;
            padding: 1.75rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
            border: 1px solid var(--border-color);
        }

        .campaign-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .campaign-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0.5rem 0;
            color: var(--text-primary);
        }

        .campaign-card p {
            margin-bottom: 1.25rem;
            color: var(--text-secondary);
        }

        .campaign-status {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.025em;
        }

        .status-draft {
            background: #f1f5f9;
            color: #475569;
        }

        .status-scheduled {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-sent {
            background: #dcfce7;
            color: #15803d;
        }

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

        .subscriber-table {
            background: var(--card-background);
            padding: 1.75rem;
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .subscriber-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .subscriber-table th {
            background: var(--background-color);
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
            color: var(--text-secondary);
            border-bottom: 2px solid var(--border-color);
        }

        .subscriber-table td {
            padding: 1rem 1.5rem;
            font-size: 0.9375rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .subscriber-table tr:hover td {
            background: var(--hover-bg);
        }

        .subscriber-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .subscriber-filters {
            display: flex;
            gap: 1rem;
        }

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

        .subscriber-status {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }

        .status-active {
            background: var(--success-color);
        }

        .status-inactive {
            background: var(--danger-color);
        }

        .action-button {
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            border: none;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .action-button:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal.active {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
        }

        .modal-content {
            background: var(--card-background);
            padding: 2rem;
            border-radius: 1rem;
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .email-editor {
            margin-top: 1rem;
        }

        .email-editor textarea {
            width: 100%;
            min-height: 300px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            resize: vertical;
            margin-top: 0.5rem;
        }

        .template-selector {
            margin-bottom: 1rem;
        }

        /* Typography enhancements */
        h2 {
            font-size: 1.875rem;
            font-weight: 600;
            letter-spacing: -0.025em;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        p {
            color: var(--text-secondary);
            font-size: 0.9375rem;
            line-height: 1.6;
            margin: 0.5rem 0;
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
                <h2>Newsletter Management</h2>
                <div class="actions">
                    <button class="action-button" onclick="toggleNewCampaignModal()">
                        <i class="bi bi-plus-lg"></i>
                        New Campaign
                    </button>
                </div>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Subscribers</h3>
                    <div class="value">2,847</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        12.5% vs last month
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Open Rate</h3>
                    <div class="value">68.4%</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        2.1% vs last campaign
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Click Rate</h3>
                    <div class="value">24.2%</div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        1.8% vs last campaign
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Unsubscribe Rate</h3>
                    <div class="value">0.8%</div>
                    <div class="trend down">
                        <i class="bi bi-arrow-down"></i>
                        0.2% vs last campaign
                    </div>
                </div>
            </div>

            <div class="campaign-grid">
                <div class="campaign-card">
                    <span class="campaign-status status-scheduled">Scheduled</span>
                    <h3>December Product Updates</h3>
                    <p>Announcing new template releases and holiday discounts</p>
                    <div class="campaign-metrics">
                        <div class="metric">
                            <span>Recipients</span>
                            <strong>2,847</strong>
                        </div>
                        <div class="metric">
                            <span>Scheduled</span>
                            <strong>Dec 15</strong>
                        </div>
                        <div class="metric">
                            <span>Status</span>
                            <strong>Ready</strong>
                        </div>
                    </div>
                </div>

                <div class="campaign-card">
                    <span class="campaign-status status-sent">Sent</span>
                    <h3>November Newsletter</h3>
                    <p>Monthly roundup of new features and customer success stories</p>
                    <div class="campaign-metrics">
                        <div class="metric">
                            <span>Opens</span>
                            <strong>72.4%</strong>
                        </div>
                        <div class="metric">
                            <span>Clicks</span>
                            <strong>28.1%</strong>
                        </div>
                        <div class="metric">
                            <span>Date</span>
                            <strong>Nov 15</strong>
                        </div>
                    </div>
                </div>

                <div class="campaign-card">
                    <span class="campaign-status status-draft">Draft</span>
                    <h3>Year in Review</h3>
                    <p>2023 achievements and what's coming in 2024</p>
                    <div class="campaign-metrics">
                        <div class="metric">
                            <span>Created</span>
                            <strong>Dec 5</strong>
                        </div>
                        <div class="metric">
                            <span>Last Edit</span>
                            <strong>2h ago</strong>
                        </div>
                        <div class="metric">
                            <span>Status</span>
                            <strong>Draft</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="subscriber-table">
                <div class="subscriber-header">
                    <h3>Subscribers</h3>
                    <div class="subscriber-filters">
                        <select class="filter-select">
                            <option>All Subscribers</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                        <select class="filter-select">
                            <option>Sort by Date</option>
                            <option>Sort by Name</option>
                            <option>Sort by Status</option>
                        </select>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Subscribed Date</th>
                            <th>Open Rate</th>
                            <th>Click Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>john.doe@example.com</td>
                            <td><span class="subscriber-status status-active"></span>Active</td>
                            <td>Dec 1, 2023</td>
                            <td>85%</td>
                            <td>32%</td>
                            <td>
                                <button class="action-button">Manage</button>
                            </td>
                        </tr>
                        <tr>
                            <td>sarah.smith@example.com</td>
                            <td><span class="subscriber-status status-active"></span>Active</td>
                            <td>Nov 28, 2023</td>
                            <td>92%</td>
                            <td>45%</td>
                            <td>
                                <button class="action-button">Manage</button>
                            </td>
                        </tr>
                        <tr>
                            <td>mike.brown@example.com</td>
                            <td><span class="subscriber-status status-inactive"></span>Inactive</td>
                            <td>Nov 15, 2023</td>
                            <td>12%</td>
                            <td>3%</td>
                            <td>
                                <button class="action-button">Manage</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- New Campaign Modal -->
    <div id="newCampaignModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Campaign</h3>
                <button class="close-modal" onclick="toggleNewCampaignModal()">&times;</button>
            </div>
            <form id="campaignForm">
                <div class="form-group">
                    <label for="campaign-name">Campaign Name</label>
                    <input type="text" id="campaign-name" required placeholder="Enter campaign name">
                </div>
                <div class="form-group">
                    <label for="campaign-subject">Email Subject</label>
                    <input type="text" id="campaign-subject" required placeholder="Enter email subject">
                </div>
                <div class="template-selector">
                    <label>Select Template</label>
                    <select>
                        <option>Basic Newsletter</option>
                        <option>Product Update</option>
                        <option>Monthly Roundup</option>
                        <option>Custom Template</option>
                    </select>
                </div>
                <div class="email-editor">
                    <label>Email Content</label>
                    <textarea placeholder="Compose your email content here..."></textarea>
                </div>
                <div class="form-group">
                    <label>Schedule Send</label>
                    <input type="datetime-local">
                </div>
                <button type="submit" class="action-button">Create Campaign</button>
            </form>
        </div>
    </div>

    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Add any chart initialization here
        });

        function toggleNewCampaignModal() {
            const modal = document.getElementById('newCampaignModal');
            modal.classList.toggle('active');
        }

        // Close modal when clicking outside
        document.getElementById('newCampaignModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleNewCampaignModal();
            }
        });

        // Form submission
        document.getElementById('campaignForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add campaign creation logic here
            toggleNewCampaignModal();
        });
    </script>
</body>
</html> 