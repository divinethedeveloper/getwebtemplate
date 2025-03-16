<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';
require_once 'utilities.php';

/**
 * Get total subscriber count
 */
function getTotalSubscribers() {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM newsletter_subscribers WHERE status = 'subscribed'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return 0;
    }
}

/**
 * Get recent subscribers
 */
function getRecentSubscribers($limit = null) {
    try {
        $conn = getDbConnection();
        $query = "SELECT * FROM newsletter_subscribers ORDER BY subscription_date DESC";
        if ($limit) {
            $query .= " LIMIT ?";
        }
        
        $stmt = $conn->prepare($query);
        if ($limit) {
            $stmt->execute([$limit]);
        } else {
            $stmt->execute();
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

/**
 * Get subscriber growth stats
 */
function getSubscriberGrowth($days = 30) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                DATE(subscription_date) as date,
                COUNT(*) as new_subscribers
            FROM newsletter_subscribers
            WHERE subscription_date >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
            GROUP BY DATE(subscription_date)
            ORDER BY date
        ");
        $stmt->execute([$days]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

/**
 * Get campaign statistics
 */
function getCampaignStats() {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                id,
                subject,
                send_date,
                total_recipients,
                opens,
                clicks,
                unsubscribes
            FROM newsletter_campaigns
            WHERE status = 'sent'  -- Only get sent campaigns
            ORDER BY send_date DESC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

/**
 * Get comprehensive newsletter statistics
 */
function getNewsletterStatistics() {
    try {
        $conn = getDbConnection();
        
        // Get total subscribers
        $stmt = $conn->query("SELECT COUNT(*) as total FROM newsletter_subscribers WHERE status = 'subscribed'");
        $total_subscribers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Get this month's new subscribers
        $stmt = $conn->query("SELECT COUNT(*) as monthly_new FROM newsletter_subscribers 
                            WHERE MONTH(subscription_date) = MONTH(CURRENT_DATE()) 
                            AND YEAR(subscription_date) = YEAR(CURRENT_DATE())");
        $monthly_new = $stmt->fetch(PDO::FETCH_ASSOC)['monthly_new'];
        
        // Calculate growth rate
        $stmt = $conn->query("SELECT COUNT(*) as last_month FROM newsletter_subscribers 
                            WHERE MONTH(subscription_date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) 
                            AND YEAR(subscription_date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))");
        $last_month = $stmt->fetch(PDO::FETCH_ASSOC)['last_month'];
        $growth_rate = $last_month > 0 ? (($monthly_new - $last_month) / $last_month) * 100 : 0;
        
        // Get recent subscribers
        $recent_subscribers = getRecentSubscribers();
        
        // Get growth data for the chart (last 30 days)
        $stmt = $conn->query("SELECT DATE(subscription_date) as date, 
                                   COUNT(*) as new_subscribers 
                            FROM newsletter_subscribers 
                            WHERE subscription_date >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY) 
                            GROUP BY DATE(subscription_date) 
                            ORDER BY date");
        $growth_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get campaign data using getCampaignStats function
        $recent_campaigns = getCampaignStats();
        
        return [
            'total_subscribers' => $total_subscribers,
            'growth_rate' => round($growth_rate, 1),
            'avg_open_rate' => 25.5, // Example static value - replace with actual calculation
            'avg_click_rate' => 3.2,  // Example static value - replace with actual calculation
            'recent_subscribers' => $recent_subscribers,
            'growth_data' => $growth_data,
            'recent_campaigns' => $recent_campaigns // Using actual campaign data from database
        ];
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [
            'total_subscribers' => 0,
            'growth_rate' => 0,
            'avg_open_rate' => 0,
            'avg_click_rate' => 0,
            'recent_subscribers' => [],
            'growth_data' => [],
            'recent_campaigns' => []
        ];
    }
}

/**
 * Get total subscribers at a specific date
 */
function getTotalSubscribersAtDate($date) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT COUNT(*) as total 
            FROM newsletter_subscribers 
            WHERE subscription_date <= ? AND status = 'subscribed'
        ");
        $stmt->execute([$date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return 0;
    }
}

/**
 * Add new subscriber
 */
function addSubscriber($email, $name = '', $source = 'website') {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            INSERT INTO newsletter_subscribers 
            (email, name, source, status, subscription_date) 
            VALUES (?, ?, ?, 'subscribed', NOW())
        ");
        return $stmt->execute([$email, $name, $source]);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

/**
 * Update subscriber status
 */
function updateSubscriberStatus($email, $status) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            UPDATE newsletter_subscribers 
            SET status = ? 
            WHERE email = ?
        ");
        return $stmt->execute([$status, $email]);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

// If the file is called directly, return JSON data
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    header('Content-Type: application/json');
    echo json_encode(getNewsletterStatistics());
}
?> 