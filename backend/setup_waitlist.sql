CREATE TABLE IF NOT EXISTS waitlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    business_name VARCHAR(255),
    signup_date DATETIME NOT NULL,
    status ENUM('pending', 'contacted', 'converted') DEFAULT 'pending',
    notes TEXT,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_signup_date (signup_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 