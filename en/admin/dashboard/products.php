<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'backend/template_stats.php';
require_once 'backend/utilities.php';

$template_stats = getAllTemplateStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Analytics | GetBusinessWebsite</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Inherit base styles */
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

        /* Product-specific styles */
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .product-actions {
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

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: var(--card-background);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: relative;
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .product-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .product-stat {
            text-align: center;
            padding: 0.5rem;
            background: #f8fafc;
            border-radius: 0.5rem;
        }

        .product-stat span {
            display: block;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .product-stat strong {
            display: block;
            color: var(--text-primary);
            font-size: 1.25rem;
            margin-top: 0.25rem;
        }

        .performance-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .template-table {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .template-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .template-table th, .template-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .template-name {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .template-name img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 0.25rem;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge.trending {
            background: #e0f2fe;
            color: #0369a1;
        }

        .badge.new {
            background: #dcfce7;
            color: #15803d;
        }

        /* Add these new styles for the modal */
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
            border-radius: 0.75rem;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .template-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .image-uploads {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .submit-btn {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 500;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: var(--secondary-color);
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
                <div class="item active" onclick="location.href='./products.php'">
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
            <div class="product-header">
                <h2>Product Analytics</h2>
                <div class="product-actions">
                    <button class="action-button" onclick="toggleModal()">
                        <i class="bi bi-plus-lg"></i>
                        Add Template
                    </button>
                    <button class="action-button">
                        <i class="bi bi-download"></i>
                        Export Report
                    </button>
                </div>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Templates</h3>
                    <div class="value"><?php echo formatLargeNumber($template_stats['performance']['metrics']['total_templates']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        Active Templates
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Total Sales</h3>
                    <div class="value"><?php echo formatMoney($template_stats['performance']['metrics']['total_revenue']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        All Time Revenue
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
                    <h3>Avg. Template Price</h3>
                    <div class="value"><?php echo formatMoney($template_stats['performance']['metrics']['avg_price']); ?></div>
                    <div class="trend up">
                        <i class="bi bi-arrow-up"></i>
                        Per Template
                    </div>
                </div>
            </div>

            <div class="performance-grid">
                <div class="chart-card">
                    <h3>Category Performance</h3>
                    <canvas id="categoryChart"></canvas>
                </div>

                <div class="chart-card">
                    <h3>Top Categories by Revenue</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="template-table">
                <h3>Top Performing Templates</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Template</th>
                            <th>Category</th>
                            <th>Views</th>
                            <th>Sales</th>
                            <th>Revenue</th>
                            <th>Conversion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($template_stats['top_templates'] as $template): ?>
                        <tr>
                            <td>
                                <div class="template-name">
                                    <img src="<?php echo htmlspecialchars($template['main_image']); ?>" alt="<?php echo htmlspecialchars($template['name']); ?>">
                                    <div>
                                        <?php echo htmlspecialchars($template['name']); ?>
                                        <?php if ($template['conversion_rate'] > 5): ?>
                                            <span class="badge trending">Trending</span>
                                        <?php endif; ?>
                                        <?php if (strtotime($template['created_at']) > strtotime('-30 days')): ?>
                                            <span class="badge new">New</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo ucfirst(htmlspecialchars($template['category'])); ?></td>
                            <td><?php echo formatLargeNumber($template['views']); ?></td>
                            <td><?php echo formatLargeNumber($template['times_purchased']); ?></td>
                            <td><?php echo formatMoney($template['revenue']); ?></td>
                            <td><?php echo number_format($template['conversion_rate'], 1); ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Template Modal -->
    <div id="addTemplateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Template</h3>
                <button class="close-modal" onclick="toggleModal()">&times;</button>
            </div>
            <form class="template-form" id="add-template-form" action="../../../backend/upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter template name" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="portfolio">Portfolio</option>
                        <option value="digital_agency">Digital Agency</option>
                        <option value="corporate">Corporate</option>
                        <option value="ecommerce">E-Commerce</option>
                        <option value="blog">Blog</option>
                        <option value="nonprofit">Nonprofit</option>
                        <option value="education">Education</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="technology">Technology</option>
                        <option value="healthcare">Healthcare</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" placeholder="Enter price" required>
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea id="short_description" name="short_description" placeholder="Enter a brief description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="main_image">Main Image</label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="mobile_image">Mobile Image</label>
                    <input type="file" id="mobile_image" name="mobile_image" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label>Additional Template Images</label>
                    <div class="image-uploads">
                        <input type="file" name="shot_1" accept="image/*" required>
                        <input type="file" name="shot_2" accept="image/*">
                        <input type="file" name="shot_3" accept="image/*">
                        <input type="file" name="shot_4" accept="image/*">
                        <input type="file" name="shot_5" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" placeholder="Enter rating (1-5)">
                </div>

                <div class="form-group">
                    <label for="preview_url">Preview URL</label>
                    <input type="url" id="preview_url" name="preview_url" placeholder="Enter preview URL">
                </div>

                <button type="submit" class="submit-btn">Add Template</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare category data
            const categories = <?php echo json_encode($template_stats['categories']); ?>;
            
            // Category Performance Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: categories.map(cat => cat.category),
                    datasets: [{
                        label: 'Templates',
                        data: categories.map(cat => cat.template_count),
                        backgroundColor: '#2563eb'
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

            // Revenue by Category Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'doughnut',
                data: {
                    labels: categories.map(cat => cat.category),
                    datasets: [{
                        data: categories.map(cat => cat.total_sales),
                        backgroundColor: [
                            '#2563eb', '#16a34a', '#ca8a04', 
                            '#dc2626', '#64748b', '#9333ea',
                            '#0891b2', '#be185d', '#854d0e'
                        ]
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

        // Add this before the existing script
        function toggleModal() {
            const modal = document.getElementById('addTemplateModal');
            modal.classList.toggle('active');
        }

        // Update the Add Template button click handler
        document.querySelector('.action-button').addEventListener('click', toggleModal);

        // Form validation
        document.getElementById('add-template-form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const category = document.getElementById('category').value;
            const price = document.getElementById('price').value;
            const shortDescription = document.getElementById('short_description').value;
            
            if (!name || !category || !price || !shortDescription) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });

        // Close modal when clicking outside
        document.getElementById('addTemplateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleModal();
            }
        });
    </script>
</body>
</html> 