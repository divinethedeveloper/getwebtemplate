<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updates | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/index.css">
    
    
   
    <?php require_once '../components/nav.php'; ?>


    <style>
        .updates-container {
            margin-bottom: var(--spacing-xl);
        }

        .pending-updates {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            margin-bottom: var(--spacing-xl);
        }

        .update-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-md);
            border-bottom: 2px solid var(--border-color);
        }

        .update-header h2 {
            font-size: 1.8rem;
            letter-spacing: -0.02em;
        }

        .update-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .stat-card {
            background: var(--hover-bg);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: var(--spacing-xs);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .update-tabs {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .tab {
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .tab.active {
            background: var(--primary-color);
            color: white;
        }

        .update-form {
            background: white;
            padding: var(--spacing-xl);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: var(--spacing-xl);
        }

        .form-row {
            margin-bottom: var(--spacing-lg);
        }

        .form-row label {
            display: block;
            margin-bottom: var(--spacing-xs);
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-row textarea {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            min-height: 120px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-row textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .credit-select {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            background: white;
            font-size: 1rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        .update-list {
            display: grid;
            gap: var(--spacing-md);
        }

        .update-item {
            background: white;
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            display: grid;
            grid-template-columns: 1fr auto;
            gap: var(--spacing-md);
            align-items: center;
        }

        .update-info h3 {
            font-size: 1.1rem;
            margin-bottom: var(--spacing-xs);
            color: var(--text-primary);
        }

        .update-meta {
            display: flex;
            gap: var(--spacing-md);
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .update-status {
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .image-preview {
            width: 100%;
            max-width: 300px;
            height: 200px;
            border-radius: var(--radius-md);
            border: 2px dashed var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: var(--spacing-sm);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            border-color: var(--primary-color);
        }

        .image-preview i {
            font-size: 2rem;
            color: var(--text-secondary);
        }

        .drag-active {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
        }

        @media (max-width: 768px) {
            .update-item {
                grid-template-columns: 1fr;
            }

            .update-meta {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1>Customization & Updates</h1>
                <div class="header-actions">
                    <button class="button button-primary">
                        <i class="bi bi-plus-lg"></i>
                        New Update Request
                    </button>
                </div>
            </div>

            <div class="updates-container">
                <div class="pending-updates">
                    <div class="update-header">
                        <h2>Pending Updates</h2>
                    </div>

                    <div class="update-stats">
                        <div class="stat-card">
                            <div class="stat-number">3</div>
                            <div class="stat-label">Pending Updates</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">2</div>
                            <div class="stat-label">Processing</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Completed</div>
                        </div>
                    </div>

                    <div class="update-list">
                        <div class="update-item">
                            <div class="update-info">
                                <h3>Header Text Update</h3>
                                <div class="update-meta">
                                    <span><i class="bi bi-clock"></i> Requested: 2 hours ago</span>
                                    <span><i class="bi bi-lightning-charge"></i> Instant Update</span>
                                </div>
                            </div>
                            <span class="update-status status-pending">Pending</span>
                        </div>

                        <div class="update-item">
                            <div class="update-info">
                                <h3>Hero Image Replacement</h3>
                                <div class="update-meta">
                                    <span><i class="bi bi-clock"></i> Requested: 5 hours ago</span>
                                    <span><i class="bi bi-clock"></i> Regular Update</span>
                                </div>
                            </div>
                            <span class="update-status status-processing">Processing</span>
                        </div>
                    </div>
                </div>

                <div class="update-tabs">
                    <div class="tab active">Text Update</div>
                    <div class="tab">Image Update</div>
                </div>

                <!-- Text Update Form -->
                <div class="update-form">
                    <div class="form-row">
                        <label>Current Text</label>
                        <textarea placeholder="Enter the existing text that needs to be updated..."></textarea>
                    </div>

                    <div class="form-row">
                        <label>New Text</label>
                        <textarea placeholder="Enter the new text that will replace the current text..."></textarea>
                    </div>

                    <div class="form-row">
                        <label>Select Update Speed</label>
                        <select class="credit-select">
                            <option value="">Choose credit type...</option>
                            <option value="instant">Instant Update (1 hour) - 1 Credit</option>
                            <option value="regular">Regular Update (24 hours) - 1 Credit</option>
                            <option value="standard">Standard Update (3-7 days) - 1 Credit</option>
                        </select>
                    </div>

                    <button class="button button-primary">Submit Update Request</button>
                </div>

                <!-- Image Update Form (Initially Hidden) -->
                <div class="update-form" style="display: none;">
                    <div class="form-row">
                        <label>Current Image</label>
                        <div class="image-preview">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <label>New Image</label>
                        <div class="image-preview">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <label>Select Update Speed</label>
                        <select class="credit-select">
                            <option value="">Choose credit type...</option>
                            <option value="instant">Instant Update (1 hour) - 1 Credit</option>
                            <option value="regular">Regular Update (24 hours) - 1 Credit</option>
                            <option value="standard">Standard Update (3-7 days) - 1 Credit</option>
                        </select>
                    </div>

                    <button class="button button-primary">Submit Update Request</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab');
        const forms = document.querySelectorAll('.update-form');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                // Update active tab
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Show corresponding form
                forms.forEach(form => form.style.display = 'none');
                forms[index].style.display = 'block';
            });
        });

        // Image upload preview
        const imagePreviewAreas = document.querySelectorAll('.image-preview');

        imagePreviewAreas.forEach(area => {
            area.addEventListener('dragover', (e) => {
                e.preventDefault();
                area.classList.add('drag-active');
            });

            area.addEventListener('dragleave', () => {
                area.classList.remove('drag-active');
            });

            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('drag-active');
                
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        area.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%; border-radius: var(--radius-md);">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            area.addEventListener('click', () => {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            area.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%; border-radius: var(--radius-md);">`;
                        };
                        reader.readAsDataURL(file);
                    }
                };
                input.click();
            });
        });
    </script>
</body>
</html>
