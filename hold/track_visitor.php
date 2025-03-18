<?php
session_start();
require_once 'config/database.php';

class VisitorTracker {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function trackVisit() {
        if (!isset($_SESSION['visitor_id'])) {
            $_SESSION['visitor_id'] = uniqid('v_', true);
        }

        $visitor_id = $_SESSION['visitor_id'];
        $session_id = session_id();
        
        // Get visitor information
        $ip_address = $this->getIpAddress();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $device_type = $this->getDeviceType();
        $browser = $this->getBrowser();
        $os = $this->getOS();
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $landing_page = $_SERVER['REQUEST_URI'];
        
        // Check if this is a unique visit
        $is_unique = $this->isUniqueVisit($visitor_id);
        
        try {
            $query = "INSERT INTO visitor_tracking 
                    (visitor_id, session_id, ip_address, user_agent, device_type, 
                     browser, os, referrer_url, landing_page, is_unique) 
                    VALUES 
                    (:visitor_id, :session_id, :ip_address, :user_agent, :device_type,
                     :browser, :os, :referrer_url, :landing_page, :is_unique)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":visitor_id", $visitor_id);
            $stmt->bindParam(":session_id", $session_id);
            $stmt->bindParam(":ip_address", $ip_address);
            $stmt->bindParam(":user_agent", $user_agent);
            $stmt->bindParam(":device_type", $device_type);
            $stmt->bindParam(":browser", $browser);
            $stmt->bindParam(":os", $os);
            $stmt->bindParam(":referrer_url", $referrer);
            $stmt->bindParam(":landing_page", $landing_page);
            $stmt->bindParam(":is_unique", $is_unique, PDO::PARAM_BOOL);
            
            $stmt->execute();

            
            
            // Update daily stats
            $this->updateDailyStats($is_unique);
            
            return true;
        } catch(PDOException $e) {
            error_log("Tracking Error: " . $e->getMessage());
            return false;
        }
    }

    private function getIpAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    private function getDeviceType() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($user_agent))) {
            return 'tablet';
        }
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($user_agent))) {
            return 'mobile';
        }
        return 'desktop';
    }

    private function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'Chrome')) return 'Chrome';
        if (strpos($user_agent, 'Firefox')) return 'Firefox';
        if (strpos($user_agent, 'Safari')) return 'Safari';
        if (strpos($user_agent, 'Edge')) return 'Edge';
        if (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }

    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'Windows')) return 'Windows';
        if (strpos($user_agent, 'Mac')) return 'MacOS';
        if (strpos($user_agent, 'Linux')) return 'Linux';
        if (strpos($user_agent, 'Android')) return 'Android';
        if (strpos($user_agent, 'iOS')) return 'iOS';
        return 'Other';
    }

    private function isUniqueVisit($visitor_id) {
        try {
            $query = "SELECT id FROM visitor_tracking 
                     WHERE visitor_id = :visitor_id 
                     AND DATE(visit_date) = CURDATE()";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":visitor_id", $visitor_id);
            $stmt->execute();
            
            return $stmt->rowCount() === 0;
        } catch(PDOException $e) {
            error_log("Unique Visit Check Error: " . $e->getMessage());
            return true;
        }
    }

    private function updateDailyStats($is_unique) {
        try {
            $date = date('Y-m-d');
            
            // First, try to update existing record
            $query = "INSERT INTO visitor_stats_daily (date, total_visitors, unique_visitors, total_page_views) 
                     VALUES (:date, 1, :is_unique, 1) 
                     ON DUPLICATE KEY UPDATE 
                     total_visitors = total_visitors + 1,
                     unique_visitors = unique_visitors + :is_unique,
                     total_page_views = total_page_views + 1";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":is_unique", $is_unique, PDO::PARAM_INT);
            $stmt->execute();
            
        } catch(PDOException $e) {
            error_log("Daily Stats Update Error: " . $e->getMessage());
        }
    }
}

// Track the visit
$tracker = new VisitorTracker();
$tracker->trackVisit();
?> 