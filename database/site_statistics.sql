-- Create table for daily visitors statistics
CREATE TABLE visitor_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    visit_date DATE NOT NULL,
    page_views INT DEFAULT 0,
    unique_visitors INT DEFAULT 0,
    total_visits INT DEFAULT 0,
    bounce_rate DECIMAL(5,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for basic revenue tracking
CREATE TABLE revenue_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    stat_date DATE NOT NULL,
    total_sales DECIMAL(10,2) DEFAULT 0.00,
    number_of_orders INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for newsletter statistics
CREATE TABLE newsletter_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    stat_date DATE NOT NULL,
    total_subscribers INT DEFAULT 0,
    active_subscribers INT DEFAULT 0,
    unsubscribed INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for product statistics
CREATE TABLE product_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    stat_date DATE NOT NULL,
    total_products INT DEFAULT 0,
    active_products INT DEFAULT 0,
    out_of_stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample data
INSERT INTO visitor_stats (visit_date, page_views, unique_visitors, total_visits, bounce_rate)
VALUES 
(CURDATE(), 150, 75, 200, 35.50),
(DATE_SUB(CURDATE(), INTERVAL 1 DAY), 120, 60, 180, 32.75);

INSERT INTO revenue_stats (stat_date, total_sales, number_of_orders)
VALUES 
(CURDATE(), 1250.00, 25),
(DATE_SUB(CURDATE(), INTERVAL 1 DAY), 980.50, 18);

INSERT INTO newsletter_stats (stat_date, total_subscribers, active_subscribers, unsubscribed)
VALUES 
(CURDATE(), 500, 480, 20),
(DATE_SUB(CURDATE(), INTERVAL 1 DAY), 495, 475, 20);

INSERT INTO product_stats (stat_date, total_products, active_products, out_of_stock)
VALUES 
(CURDATE(), 100, 85, 15),
(DATE_SUB(CURDATE(), INTERVAL 1 DAY), 98, 88, 10); 