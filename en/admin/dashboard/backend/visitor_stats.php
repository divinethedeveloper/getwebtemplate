<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';
require_once 'utilities.php';

/**
 * Get default stats array
 */
function getDefaultStats() {
    return [
        'total_visits' => 0,
        'unique_visitors' => 0,
        'page_views' => 0,
        'bounce_rate' => 0,
        'avg_session_duration' => 0,
        'mobile_users' => 0,
        'desktop_users' => 0,
        'tablet_users' => 0,
        'chrome_users' => 0,
        'safari_users' => 0,
        'firefox_users' => 0,
        'return_visitors' => 0,
        'new_visitors' => 0
    ];
}

/**
 * Get visitor statistics for a specific date
 */
function getVisitorStatsByDate($date) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT * FROM visitor_stats 
            WHERE visit_date = ?
        ");
        $stmt->execute([$date]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: getDefaultStats();
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return getDefaultStats();
    }
}

/**
 * Get visitor statistics for a date range
 */
function getVisitorStatsRange($start_date, $end_date) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                visit_date,
                total_visits,
                unique_visitors,
                page_views,
                bounce_rate,
                avg_session_duration,
                mobile_users,
                desktop_users,
                tablet_users,
                chrome_users,
                safari_users,
                firefox_users,
                return_visitors,
                new_visitors
            FROM visitor_stats 
            WHERE visit_date BETWEEN ? AND ?
            ORDER BY visit_date DESC
        ");
        $stmt->execute([$start_date, $end_date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

/**
 * Get recent visitor details
 */
function getRecentVisitors($limit = 10) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                id,
                visit_time,
                location,
                device,
                browser,
                time_on_site,
                pages_viewed
            FROM recent_visitors 
            ORDER BY visit_time DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

/**
 * Calculate device distribution
 */
function getDeviceDistribution($stats) {
    if (!is_array($stats)) {
        $stats = getDefaultStats();
    }
    
    $total = ($stats['mobile_users'] ?? 0) + ($stats['desktop_users'] ?? 0) + ($stats['tablet_users'] ?? 0);
    if ($total == 0) return ['mobile' => 0, 'desktop' => 0, 'tablet' => 0];
    
    return [
        'mobile' => round((($stats['mobile_users'] ?? 0) / $total) * 100),
        'desktop' => round((($stats['desktop_users'] ?? 0) / $total) * 100),
        'tablet' => round((($stats['tablet_users'] ?? 0) / $total) * 100)
    ];
}

/**
 * Calculate browser distribution
 */
function getBrowserDistribution($stats) {
    if (!is_array($stats)) {
        $stats = getDefaultStats();
    }
    
    $total = ($stats['chrome_users'] ?? 0) + ($stats['safari_users'] ?? 0) + ($stats['firefox_users'] ?? 0);
    if ($total == 0) return ['chrome' => 0, 'safari' => 0, 'firefox' => 0];
    
    return [
        'chrome' => round((($stats['chrome_users'] ?? 0) / $total) * 100),
        'safari' => round((($stats['safari_users'] ?? 0) / $total) * 100),
        'firefox' => round((($stats['firefox_users'] ?? 0) / $total) * 100)
    ];
}

/**
 * Format time duration in minutes to HH:MM format
 */
function formatDuration($minutes) {
    $hours = floor($minutes / 60);
    $mins = $minutes % 60;
    return sprintf("%d:%02d", $hours, $mins);
}

/**
 * Get current active visitors (last 5 minutes)
 */
function getCurrentVisitors() {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT COUNT(DISTINCT visitor_id) as current_visitors 
            FROM visitor_stats 
            WHERE visit_time >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['current_visitors'] ?? 0;
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return 0;
    }
}

/**
 * Get comprehensive visitor statistics
 */
function getVisitorStatistics($days = 30) {
    $today_stats = getTodayStats();
    $yesterday_stats = getYesterdayStats();
    $total_visits = getTotalVisits($days);
    $current_visitors = getCurrentVisitors();
    
    // Calculate percentage changes
    $visit_change = calculatePercentageChange($today_stats['total_visits'] ?? 0, $yesterday_stats['total_visits'] ?? 0);
    $unique_change = calculatePercentageChange($today_stats['unique_visitors'] ?? 0, $yesterday_stats['unique_visitors'] ?? 0);
    
    // Get device and browser distributions
    $device_stats = getDeviceDistribution($today_stats);
    $browser_stats = getBrowserDistribution($today_stats);
    
    // Get recent visitors
    $recent_visitors = getRecentVisitors();
    
    return [
        'current_visitors' => $current_visitors,
        'today_visits' => $today_stats['total_visits'] ?? 0,
        'today_unique' => $today_stats['unique_visitors'] ?? 0,
        'total_visits' => $total_visits,
        'visit_change' => $visit_change,
        'unique_change' => $unique_change,
        'page_views' => $today_stats['page_views'] ?? 0,
        'bounce_rate' => $today_stats['bounce_rate'] ?? 0,
        'avg_session_duration' => $today_stats['avg_session_duration'] ?? 0,
        'device_stats' => [
            'mobile' => $device_stats['mobile'] ?? 0,
            'desktop' => $device_stats['desktop'] ?? 0,
            'tablet' => $device_stats['tablet'] ?? 0
        ],
        'browser_stats' => [
            'chrome' => $browser_stats['chrome'] ?? 0,
            'safari' => $browser_stats['safari'] ?? 0,
            'firefox' => $browser_stats['firefox'] ?? 0
        ],
        'recent_visitors' => $recent_visitors ?: []
    ];
}

/**
 * Get today's visitor stats
 */
function getTodayStats() {
    return getVisitorStatsByDate(date('Y-m-d'));
}

/**
 * Get yesterday's visitor stats
 */
function getYesterdayStats() {
    return getVisitorStatsByDate(date('Y-m-d', strtotime('-1 day')));
}

/**
 * Get total visits for the last N days
 */
function getTotalVisits($days = 30) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT SUM(total_visits) as total 
            FROM visitor_stats 
            WHERE visit_date >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
        ");
        $stmt->execute([$days]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return 0;
    }
}

// If the file is called directly, return JSON data
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    header('Content-Type: application/json');
    echo json_encode(getVisitorStatistics());
}
?>
