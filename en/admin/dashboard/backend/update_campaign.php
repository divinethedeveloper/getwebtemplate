<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';

header('Content-Type: application/json');

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['campaign_id']) || !isset($data['status'])) {
        throw new Exception('Missing required fields');
    }

    $conn = getDbConnection();
    
    $stmt = $conn->prepare("
        UPDATE newsletter_campaigns 
        SET status = ?,
            updated_at = NOW()
        WHERE id = ?
    ");
    
    $stmt->execute([$data['status'], $data['campaign_id']]);

    echo json_encode([
        'success' => true,
        'message' => 'Campaign status updated successfully'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 