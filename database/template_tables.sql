-- Create templates table
CREATE TABLE templates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    mobile_image_url VARCHAR(255),
    preview_url VARCHAR(255),
    rating DECIMAL(3,1) DEFAULT 0.0,
    is_trending BOOLEAN DEFAULT FALSE,
    is_new BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create template statistics table
CREATE TABLE template_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    template_id INT NOT NULL,
    stat_date DATE NOT NULL,
    page_views INT DEFAULT 0,
    unique_views INT DEFAULT 0,
    add_to_cart INT DEFAULT 0,
    purchases INT DEFAULT 0,
    revenue DECIMAL(10,2) DEFAULT 0.00,
    conversion_rate DECIMAL(5,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (template_id) REFERENCES templates(id)
);

-- Insert sample templates
INSERT INTO templates (name, category, price, description, is_trending, is_new) VALUES
('Business Pro', 'Corporate', 499.99, 'Professional business template with modern design', TRUE, FALSE),
('E-commerce Plus', 'E-commerce', 599.99, 'Complete e-commerce solution with advanced features', FALSE, TRUE),
('Portfolio Premium', 'Portfolio', 399.99, 'Showcase your work with this premium portfolio template', FALSE, FALSE);

-- Insert sample statistics
INSERT INTO template_stats (template_id, stat_date, page_views, unique_views, add_to_cart, purchases, revenue, conversion_rate) VALUES
(1, CURDATE(), 2847, 2000, 350, 124, 61876.76, 4.4),
(2, CURDATE(), 2123, 1500, 280, 98, 58799.02, 4.6),
(3, CURDATE(), 1908, 1200, 220, 86, 34399.14, 4.5);

-- Insert historical data for trends
INSERT INTO template_stats (template_id, stat_date, page_views, unique_views, add_to_cart, purchases, revenue, conversion_rate) VALUES
(1, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 2750, 1900, 320, 115, 57423.85, 4.2),
(2, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 2000, 1400, 260, 90, 53999.10, 4.5),
(3, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 1800, 1100, 200, 80, 31999.20, 4.4); 