-- Create waitlist table
CREATE TABLE IF NOT EXISTS waitlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    business_name VARCHAR(255),
    signup_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'contacted', 'converted') DEFAULT 'pending',
    source VARCHAR(100),
    utm_source VARCHAR(100),
    utm_medium VARCHAR(100),
    utm_campaign VARCHAR(100),
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_signup_date (signup_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create visitor tracking table
CREATE TABLE IF NOT EXISTS visitor_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id VARCHAR(50) NOT NULL,
    session_id VARCHAR(100) NOT NULL,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    device_type ENUM('desktop', 'tablet', 'mobile', 'other'),
    browser VARCHAR(50),
    os VARCHAR(50),
    country VARCHAR(100),
    city VARCHAR(100),
    referrer_url TEXT,
    landing_page TEXT,
    visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    page_views INT DEFAULT 1,
    time_spent INT DEFAULT 0, -- in seconds
    is_unique BOOLEAN DEFAULT TRUE,
    converted BOOLEAN DEFAULT FALSE,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_visitor_id (visitor_id),
    INDEX idx_session_id (session_id),
    INDEX idx_visit_date (visit_date),
    INDEX idx_converted (converted)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create daily visitor stats table for aggregated analytics
CREATE TABLE IF NOT EXISTS visitor_stats_daily (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    total_visitors INT DEFAULT 0,
    unique_visitors INT DEFAULT 0,
    total_page_views INT DEFAULT 0,
    avg_time_spent DECIMAL(10,2) DEFAULT 0.00,
    conversion_rate DECIMAL(5,2) DEFAULT 0.00,
    bounce_rate DECIMAL(5,2) DEFAULT 0.00,
    UNIQUE INDEX idx_date (date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 