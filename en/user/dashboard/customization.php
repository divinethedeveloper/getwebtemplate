<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Customization | GetBusinessWebsite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/index.css">
    <?php require_once '../components/nav.php'; ?>
    <style>
        .customization-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-card {
            background: var(--card-background);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-4px);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-md);
            border-bottom: 2px solid var(--border-color);
        }

        .section-header h2 {
            font-size: 1.6rem;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .color-scheme {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .color-picker {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
        }

        .color-preview {
            height: 100px;
            border-radius: var(--radius-lg);
            border: 2px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .color-preview:hover {
            transform: scale(1.02);
        }

        .font-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-md);
        }

        .font-card {
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .font-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .font-card.active {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
        }

        .font-preview {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-sm);
        }

        .section-manager {
            display: grid;
            gap: var(--spacing-md);
        }

        .section-item {
            background: white;
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: move;
        }

        .section-item:hover {
            border-color: var(--primary-color);
        }

        .section-controls {
            display: flex;
            gap: var(--spacing-sm);
        }

        .control-button {
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-button:hover {
            transform: translateY(-2px);
        }

        .add-section {
            background: var(--hover-bg);
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-lg);
            padding: var(--spacing-lg);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-section:hover {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
        }

        .template-preview {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin: var(--spacing-lg) 0;
            box-shadow: var(--shadow-lg);
        }

        .template-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .template-preview:hover .preview-overlay {
            opacity: 1;
        }

        .spacing-control {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
        }

        .spacing-input {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .spacing-input input[type="range"] {
            flex: 1;
        }

        .custom-select {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            background: white;
            font-size: 1rem;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .animation-preview {
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            text-align: center;
            margin-top: var(--spacing-sm);
        }

        .preview-text {
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .section-header {
                flex-direction: column;
                gap: var(--spacing-md);
            }

            .section-item {
                flex-direction: column;
                gap: var(--spacing-md);
                text-align: center;
            }
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-md);
        }

        .option-card {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .option-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .option-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .option-content {
            padding: var(--spacing-md);
            text-align: center;
        }

        .button-customization {
            padding: var(--spacing-lg);
        }

        .style-options h3 {
            margin: var(--spacing-md) 0;
            color: var(--text-primary);
        }

        .button-shapes,
        .button-styles,
        .button-hovers {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .style-button {
            padding: var(--spacing-sm) var(--spacing-lg);
            border: 2px solid var(--primary-color);
            background: var(--primary-color);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .style-button.rounded {
            border-radius: var(--radius-md);
        }

        .style-button.pill {
            border-radius: 50px;
        }

        .style-button.sharp {
            border-radius: 0;
        }

        .style-button.outlined {
            background: transparent;
            color: var(--primary-color);
        }

        .style-button.ghost {
            background: transparent;
            border-color: transparent;
            color: var(--primary-color);
        }

        .style-button.hover-scale:hover {
            transform: scale(1.1);
        }

        .style-button.hover-slide {
            position: relative;
            overflow: hidden;
        }

        .style-button.hover-slide:hover {
            background: var(--secondary-color);
        }

        .style-button.hover-glow:hover {
            box-shadow: 0 0 20px var(--primary-color);
        }

        .social-grid {
            display: grid;
            gap: var(--spacing-md);
        }

        .social-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
        }

        .social-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .social-content {
            display: flex;
            gap: var(--spacing-md);
            flex: 1;
        }

        .social-content input {
            flex: 1;
            padding: var(--spacing-sm);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
        }

        .css-editor {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .editor-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-md);
            background: var(--hover-bg);
            border-bottom: 1px solid var(--border-color);
        }

        .editor-tabs {
            display: flex;
            gap: var(--spacing-sm);
        }

        .editor-tab {
            padding: var(--spacing-sm) var(--spacing-md);
            border: none;
            background: none;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .editor-tab.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .code-editor {
            width: 100%;
            min-height: 200px;
            padding: var(--spacing-md);
            font-family: monospace;
            font-size: 14px;
            line-height: 1.5;
            border: none;
            resize: vertical;
        }

        .seo-settings .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .custom-input,
        .custom-textarea {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
        }

        .custom-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .custom-input:focus,
        .custom-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .image-upload {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-lg);
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload:hover {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
        }

        .image-upload i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1>Website Customization</h1>
                <div class="header-actions">
                    <button class="button button-primary">
                        <i class="bi bi-eye"></i>
                        Preview Changes
                    </button>
                    <button class="button button-primary">
                        <i class="bi bi-save"></i>
                        Save All Changes
                    </button>
                </div>
            </div>

            <div class="customization-container">
                <!-- Template Preview -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Current Template Preview</h2>
                    </div>
                    <div class="template-preview">
                        <img src="../../../assets/templates/preview.jpg" alt="Template Preview">
                        <div class="preview-overlay">
                            <button class="button button-primary">View Full Preview</button>
                        </div>
                    </div>
                </div>

                <!-- Color Scheme -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Color Scheme</h2>
                        <button class="button">Reset to Default</button>
                    </div>
                    <div class="color-scheme">
                        <div class="color-picker">
                            <label>Primary Color</label>
                            <div class="color-preview" style="background: #2563eb"></div>
                            <input type="color" value="#2563eb">
                        </div>
                        <div class="color-picker">
                            <label>Secondary Color</label>
                            <div class="color-preview" style="background: #1e40af"></div>
                            <input type="color" value="#1e40af">
                        </div>
                        <div class="color-picker">
                            <label>Accent Color</label>
                            <div class="color-preview" style="background: #16a34a"></div>
                            <input type="color" value="#16a34a">
                        </div>
                        <div class="color-picker">
                            <label>Text Color</label>
                            <div class="color-preview" style="background: #1e293b"></div>
                            <input type="color" value="#1e293b">
                        </div>
                    </div>
                </div>

                <!-- Typography -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Typography</h2>
                    </div>
                    <div class="font-selector">
                        <div class="font-card active">
                            <div class="font-preview" style="font-family: 'Inter'">Aa Bb Cc</div>
                            <h3>Inter</h3>
                            <p>Modern, clean and highly legible</p>
                        </div>
                        <div class="font-card">
                            <div class="font-preview" style="font-family: 'Playfair Display'">Aa Bb Cc</div>
                            <h3>Playfair Display</h3>
                            <p>Elegant serif for headings</p>
                        </div>
                        <div class="font-card">
                            <div class="font-preview" style="font-family: 'Roboto'">Aa Bb Cc</div>
                            <h3>Roboto</h3>
                            <p>Versatile and readable</p>
                        </div>
                    </div>
                </div>

                <!-- Header Styles -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Header Customization</h2>
                    </div>
                    <div class="header-options">
                        <div class="option-grid">
                            <div class="option-card">
                                <img src="../../../assets/headers/header-1.jpg" alt="Header Style 1">
                                <div class="option-content">
                                    <h3>Classic Header</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                            <div class="option-card">
                                <img src="../../../assets/headers/header-2.jpg" alt="Header Style 2">
                                <div class="option-content">
                                    <h3>Modern Transparent</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                            <div class="option-card">
                                <img src="../../../assets/headers/header-3.jpg" alt="Header Style 3">
                                <div class="option-content">
                                    <h3>Centered Logo</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Styles -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Button Styles</h2>
                    </div>
                    <div class="button-customization">
                        <div class="style-options">
                            <h3>Shape</h3>
                            <div class="button-shapes">
                                <button class="style-button rounded">Rounded</button>
                                <button class="style-button pill">Pill</button>
                                <button class="style-button sharp">Sharp</button>
                            </div>
                            
                            <h3>Style</h3>
                            <div class="button-styles">
                                <button class="style-button filled">Filled</button>
                                <button class="style-button outlined">Outlined</button>
                                <button class="style-button ghost">Ghost</button>
                            </div>

                            <h3>Hover Effect</h3>
                            <div class="button-hovers">
                                <button class="style-button hover-scale">Scale</button>
                                <button class="style-button hover-slide">Slide</button>
                                <button class="style-button hover-glow">Glow</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Integration -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Social Media Integration</h2>
                    </div>
                    <div class="social-customization">
                        <div class="social-grid">
                            <div class="social-item">
                                <i class="bi bi-facebook"></i>
                                <div class="social-content">
                                    <input type="text" placeholder="Facebook URL">
                                    <select class="custom-select">
                                        <option>Header</option>
                                        <option>Footer</option>
                                        <option>Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="social-item">
                                <i class="bi bi-instagram"></i>
                                <div class="social-content">
                                    <input type="text" placeholder="Instagram URL">
                                    <select class="custom-select">
                                        <option>Header</option>
                                        <option>Footer</option>
                                        <option>Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="social-item">
                                <i class="bi bi-twitter"></i>
                                <div class="social-content">
                                    <input type="text" placeholder="Twitter URL">
                                    <select class="custom-select">
                                        <option>Header</option>
                                        <option>Footer</option>
                                        <option>Both</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Customization -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Footer Customization</h2>
                    </div>
                    <div class="footer-options">
                        <div class="option-grid">
                            <div class="option-card">
                                <img src="../../../assets/footers/footer-1.jpg" alt="Footer Style 1">
                                <div class="option-content">
                                    <h3>Simple Footer</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                            <div class="option-card">
                                <img src="../../../assets/footers/footer-2.jpg" alt="Footer Style 2">
                                <div class="option-content">
                                    <h3>Multi-Column</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                            <div class="option-card">
                                <img src="../../../assets/footers/footer-3.jpg" alt="Footer Style 3">
                                <div class="option-content">
                                    <h3>Modern Dark</h3>
                                    <button class="button button-primary">Select</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Custom CSS -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Advanced CSS Customization</h2>
                    </div>
                    <div class="css-editor">
                        <div class="editor-header">
                            <div class="editor-tabs">
                                <button class="editor-tab active">Custom CSS</button>
                                <button class="editor-tab">Media Queries</button>
                            </div>
                            <button class="button">
                                <i class="bi bi-code-slash"></i>
                                Format Code
                            </button>
                        </div>
                        <textarea class="code-editor" placeholder="/* Add your custom CSS here */"></textarea>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>SEO Settings</h2>
                    </div>
                    <div class="seo-settings">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" class="custom-input" placeholder="Enter page title">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="custom-textarea" placeholder="Enter page description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keywords</label>
                            <input type="text" class="custom-input" placeholder="Enter keywords, separated by commas">
                        </div>
                        <div class="form-group">
                            <label>Open Graph Image</label>
                            <div class="image-upload">
                                <i class="bi bi-cloud-upload"></i>
                                <span>Upload Image</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Manager -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Section Manager</h2>
                    </div>
                    <div class="section-manager">
                        <div class="section-item">
                            <span>Hero Section</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dbeafe">Edit</button>
                                <button class="control-button" style="background: #fee2e2">Hide</button>
                            </div>
                        </div>
                        <div class="section-item">
                            <span>Features</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dbeafe">Edit</button>
                                <button class="control-button" style="background: #fee2e2">Hide</button>
                            </div>
                        </div>
                        <div class="section-item">
                            <span>About Us</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dbeafe">Edit</button>
                                <button class="control-button" style="background: #fee2e2">Hide</button>
                            </div>
                        </div>
                        <div class="add-section">
                            <i class="bi bi-plus-circle" style="font-size: 2rem"></i>
                            <h3>Add New Section</h3>
                            <p>Choose from our pre-built sections or create your own</p>
                        </div>
                    </div>
                </div>

                <!-- Spacing & Layout -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Spacing & Layout</h2>
                    </div>
                    <div class="spacing-control">
                        <div class="spacing-input">
                            <label>Section Spacing</label>
                            <input type="range" min="1" max="100" value="50">
                            <span>50px</span>
                        </div>
                        <div class="spacing-input">
                            <label>Content Width</label>
                            <input type="range" min="800" max="1600" value="1200">
                            <span>1200px</span>
                        </div>
                    </div>
                </div>

                <!-- Animations -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Animations</h2>
                    </div>
                    <div class="animation-settings">
                        <div class="form-group">
                            <label>Page Load Animation</label>
                            <select class="custom-select">
                                <option>Fade In</option>
                                <option>Slide Up</option>
                                <option>Scale In</option>
                                <option>None</option>
                            </select>
                            <div class="animation-preview">
                                <div class="preview-text">Preview Text</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Pages -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Additional Pages</h2>
                    </div>
                    <div class="section-manager">
                        <div class="section-item">
                            <span>Blog Page</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dcfce7">Add</button>
                            </div>
                        </div>
                        <div class="section-item">
                            <span>Portfolio Page</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dcfce7">Add</button>
                            </div>
                        </div>
                        <div class="section-item">
                            <span>Contact Page</span>
                            <div class="section-controls">
                                <button class="control-button" style="background: #dcfce7">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Color picker functionality
        document.querySelectorAll('.color-picker input[type="color"]').forEach(input => {
            const preview = input.previousElementSibling;
            input.addEventListener('input', (e) => {
                preview.style.background = e.target.value;
            });
        });

        // Font selection
        document.querySelectorAll('.font-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.font-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
            });
        });

        // Range input updates
        document.querySelectorAll('input[type="range"]').forEach(input => {
            const valueDisplay = input.nextElementSibling;
            input.addEventListener('input', (e) => {
                valueDisplay.textContent = `${e.target.value}px`;
            });
        });

        // Animation preview
        const animationSelect = document.querySelector('.animation-settings select');
        const previewText = document.querySelector('.preview-text');

        animationSelect.addEventListener('change', (e) => {
            previewText.style.animation = 'none';
            setTimeout(() => {
                switch(e.target.value) {
                    case 'Fade In':
                        previewText.style.animation = 'fadeIn 1s ease';
                        break;
                    case 'Slide Up':
                        previewText.style.animation = 'slideUp 1s ease';
                        break;
                    case 'Scale In':
                        previewText.style.animation = 'scaleIn 1s ease';
                        break;
                    default:
                        previewText.style.animation = 'none';
                }
            }, 10);
        });

        // Button style preview
        document.querySelectorAll('.style-button').forEach(button => {
            button.addEventListener('click', function() {
                const type = this.className.split(' ')[1];
                const category = this.parentElement.className.split('-')[1];
                
                // Update preview button with selected style
                const previewButton = document.querySelector('.button-preview');
                if (previewButton) {
                    switch(category) {
                        case 'shapes':
                            previewButton.className = `button-preview ${type}`;
                            break;
                        case 'styles':
                            previewButton.className = `button-preview ${type}`;
                            break;
                        case 'hovers':
                            previewButton.className = `button-preview ${type}`;
                            break;
                    }
                }
            });
        });

        // Editor tabs
        document.querySelectorAll('.editor-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.editor-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html> 