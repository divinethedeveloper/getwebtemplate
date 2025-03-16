<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';
require_once 'utilities.php';

// Get most viewed templates for overview page
function getMostViewedTemplates($limit = 3) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                name,
                category,
                main_image,
                views,
                clicks,
                rating,
                times_purchased,
                price
            FROM templates 
            ORDER BY views DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Get template sales statistics
function getTemplateSalesStats() {
    try {
        $conn = getDbConnection();
        
        // Get category distribution
        $stmt = $conn->prepare("
            SELECT 
                category,
                COUNT(*) as count,
                SUM(times_purchased) as total_sales,
                SUM(times_purchased * price) as revenue
            FROM templates
            GROUP BY category
        ");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate total revenue and sales
        $stmt = $conn->prepare("
            SELECT 
                COUNT(*) as total_templates,
                SUM(times_purchased) as total_purchases,
                SUM(times_purchased * price) as total_revenue,
                AVG(rating) as avg_rating
            FROM templates
        ");
        $stmt->execute();
        $totals = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'categories' => $categories,
            'totals' => $totals
        ];
    } catch(PDOException $e) {
        return [
            'categories' => [],
            'totals' => [
                'total_templates' => 0,
                'total_purchases' => 0,
                'total_revenue' => 0,
                'avg_rating' => 0
            ]
        ];
    }
}

// Get template performance metrics
function getTemplatePerformance() {
    try {
        $conn = getDbConnection();
        
        // Get current stats
        $stmt = $conn->prepare("
            SELECT 
                COUNT(*) as total_templates,
                SUM(times_purchased * price) as total_revenue,
                AVG(CASE WHEN views > 0 THEN (times_purchased / views) * 100 ELSE 0 END) as conversion_rate,
                AVG(price) as avg_price,
                SUM(views) as total_views,
                SUM(clicks) as total_clicks
            FROM templates
        ");
        $stmt->execute();
        $metrics = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get top performing templates
        $stmt = $conn->prepare("
            SELECT name, views, times_purchased, price
            FROM templates
            ORDER BY times_purchased DESC
            LIMIT 5
        ");
        $stmt->execute();
        $top_performers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'metrics' => $metrics ?: [
                'total_templates' => 0,
                'total_revenue' => 0,
                'conversion_rate' => 0,
                'avg_price' => 0,
                'total_views' => 0,
                'total_clicks' => 0
            ],
            'top_performers' => $top_performers
        ];
    } catch(PDOException $e) {
        return [
            'metrics' => [
                'total_templates' => 0,
                'total_revenue' => 0,
                'conversion_rate' => 0,
                'avg_price' => 0,
                'total_views' => 0,
                'total_clicks' => 0
            ],
            'top_performers' => []
        ];
    }
}

// Get category breakdown
function getCategoryBreakdown() {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                category,
                COUNT(*) as template_count,
                SUM(times_purchased) as total_sales,
                AVG(rating) as avg_rating,
                SUM(views) as total_views
            FROM templates
            GROUP BY category
            ORDER BY total_sales DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Get all statistics for products page
function getAllTemplateStats() {
    return [
        'performance' => getTemplatePerformance(),
        'top_templates' => getTopTemplates(),
        'categories' => getCategoryBreakdown(),
        'sales_stats' => getTemplateSalesStats()
    ];
}

// Get overview statistics for index page
function getOverviewStats() {
    return [
        'most_viewed' => getMostViewedTemplates(3),
        'performance' => getTemplatePerformance(),
        'recent_sales' => getTemplateSalesStats()
    ];
}

// Get top performing templates
function getTopTemplates($limit = 10) {
    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("
            SELECT 
                name,
                category,
                main_image,
                views,
                clicks,
                times_purchased,
                price,
                rating,
                (times_purchased * price) as revenue,
                CASE WHEN views > 0 THEN (times_purchased / views) * 100 ELSE 0 END as conversion_rate,
                preview_url,
                created_at
            FROM templates
            ORDER BY (times_purchased * price) DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// If the file is called directly, return JSON data
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    header('Content-Type: application/json');
    $type = $_GET['type'] ?? 'all';
    
    switch($type) {
        case 'overview':
            echo json_encode(getOverviewStats());
            break;
        case 'performance':
            echo json_encode(getTemplatePerformance());
            break;
        case 'top':
            echo json_encode(getTopTemplates());
            break;
        case 'categories':
            echo json_encode(getCategoryBreakdown());
            break;
        default:
            echo json_encode(getAllTemplateStats());
    }
}
?> 