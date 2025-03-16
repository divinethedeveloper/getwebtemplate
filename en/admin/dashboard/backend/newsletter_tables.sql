-- Create newsletter_subscribers table
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255),
    subscription_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('subscribed', 'unsubscribed', 'bounced') DEFAULT 'subscribed',
    source VARCHAR(50) DEFAULT 'website',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_date (subscription_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create newsletter_campaigns table
CREATE TABLE IF NOT EXISTS newsletter_campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    content TEXT,
    send_date DATETIME,
    status ENUM('draft', 'scheduled', 'sent', 'failed') DEFAULT 'draft',
    total_recipients INT DEFAULT 0,
    opens INT DEFAULT 0,
    clicks INT DEFAULT 0,
    unsubscribes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_date (send_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create campaign_tracking table
CREATE TABLE IF NOT EXISTS campaign_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campaign_id INT,
    subscriber_id INT,
    opened BOOLEAN DEFAULT FALSE,
    clicked BOOLEAN DEFAULT FALSE,
    open_date DATETIME,
    click_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (campaign_id) REFERENCES newsletter_campaigns(id),
    FOREIGN KEY (subscriber_id) REFERENCES newsletter_subscribers(id),
    INDEX idx_campaign (campaign_id),
    INDEX idx_subscriber (subscriber_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create subscriber_preferences table
CREATE TABLE IF NOT EXISTS subscriber_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subscriber_id INT,
    frequency ENUM('daily', 'weekly', 'monthly') DEFAULT 'weekly',
    categories JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (subscriber_id) REFERENCES newsletter_subscribers(id),
    INDEX idx_subscriber (subscriber_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 