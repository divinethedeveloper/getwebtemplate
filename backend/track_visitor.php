<?php
session_start();
require_once 'config/database.php';

class VisitorTracker {
    private $conn;
    private $tracking_enabled = true;
    
    public function __construct() {
        try {
            $database = new Database();
            $this->conn = $database->getConnection();
            if (!$this->conn) {
                $this->tracking_enabled = false;
                error_log("Visitor tracking disabled due to database connection failure");
            }
        } catch (Exception $e) {
            $this->tracking_enabled = false;
            error_log("Visitor tracking initialization error: " . $e->getMessage());
        }
    }

    private function getIpAddress() {
        // Check for proxy addresses first
        $proxy_headers = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );

        foreach ($proxy_headers as $header) {
            if (isset($_SERVER[$header])) {
                $addresses = explode(',', $_SERVER[$header]);
                $ip = trim($addresses[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
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
        
        $browser_array = array(
            'Edge' => '/Edge/i',
            'Chrome' => '/Chrome/i',
            'Firefox' => '/Firefox/i',
            'Safari' => '/Safari/i',
            'Opera' => '/Opera|OPR/i',
            'IE' => '/MSIE|Trident/i'
        );

        foreach ($browser_array as $browser => $pattern) {
            if (preg_match($pattern, $user_agent)) {
                return $browser;
            }
        }

        return 'Other';
    }

    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        $os_array = array(
            'Windows' => '/Windows/i',
            'MacOS' => '/Mac OS X|macOS/i',
            'Linux' => '/Linux/i',
            'Ubuntu' => '/Ubuntu/i',
            'iPhone' => '/iPhone/i',
            'iPad' => '/iPad/i',
            'Android' => '/Android/i'
        );

        foreach ($os_array as $os => $pattern) {
            if (preg_match($pattern, $user_agent)) {
                return $os;
            }
        }

        return 'Unknown';
    }

    private function updateDailyStats($is_unique) {
        if (!$this->conn) return false;

        try {
            $date = date('Y-m-d');
            
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
            
            return true;
        } catch(Exception $e) {
            error_log("Daily Stats Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function trackVisit() {
        if (!$this->tracking_enabled) {
            return false;
        }

        if (!isset($_SESSION['visitor_id'])) {
            $_SESSION['visitor_id'] = uniqid('v_', true);
        }

        try {
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
            
            if ($this->conn === null) {
                throw new Exception("Database connection not available");
            }

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
        } catch(Exception $e) {
            error_log("Visitor Tracking Error: " . $e->getMessage());
            return false;
        }
    }

    private function isUniqueVisit($visitor_id) {
        try {
            if ($this->conn === null) {
                throw new Exception("Database connection not available");
            }

            $query = "SELECT id FROM visitor_tracking 
                     WHERE visitor_id = :visitor_id 
                     AND DATE(visit_date) = CURDATE()";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":visitor_id", $visitor_id);
            $stmt->execute();
            
            return $stmt->rowCount() === 0;
        } catch(Exception $e) {
            error_log("Unique Visit Check Error: " . $e->getMessage());
            return true; // Assume unique visit in case of error
        }
    }
}

// Track the visit with error handling
try {
    $tracker = new VisitorTracker();
    $tracker->trackVisit();
} catch (Exception $e) {
    error_log("Fatal tracking error: " . $e->getMessage());
    // Continue with the page load even if tracking fails
}
?> 