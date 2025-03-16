-- Table for storing visitor statistics
CREATE TABLE IF NOT EXISTS visitor_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id VARCHAR(50) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    browser VARCHAR(50) NOT NULL,
    device VARCHAR(20) NOT NULL,
    page_url VARCHAR(255) NOT NULL,
    referrer VARCHAR(255),
    visit_time DATETIME NOT NULL,
    pages_viewed INT NOT NULL DEFAULT 1,
    INDEX idx_visitor_id (visitor_id),
    INDEX idx_visit_time (visit_time)
);

-- Table for tracking current visitors
CREATE TABLE IF NOT EXISTS current_visitors (
    visitor_id VARCHAR(50) PRIMARY KEY,
    last_activity DATETIME NOT NULL,
    pages_viewed INT NOT NULL DEFAULT 1,
    time_on_site INT NOT NULL DEFAULT 0,
    INDEX idx_last_activity (last_activity)
); 