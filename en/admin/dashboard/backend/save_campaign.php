<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';

header('Content-Type: application/json');

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        throw new Exception('No data received');
    }

    // Validate required fields
    $required_fields = ['subject', 'content', 'send_date', 'status', 'total_recipients'];
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            throw new Exception("Missing required field: {$field}");
        }
    }

    // Set default values for optional fields
    $data['opens'] = isset($data['opens']) ? (int)$data['opens'] : 0;
    $data['clicks'] = isset($data['clicks']) ? (int)$data['clicks'] : 0;
    $data['unsubscribes'] = isset($data['unsubscribes']) ? (int)$data['unsubscribes'] : 0;

    $conn = getDbConnection();

    // Check if campaign ID is provided (update existing campaign)
    if (isset($data['campaign_id'])) {
        $stmt = $conn->prepare("
            UPDATE newsletter_campaigns 
            SET subject = ?, 
                content = ?,
                send_date = ?,
                status = ?,
                total_recipients = ?,
                opens = ?,
                clicks = ?,
                unsubscribes = ?,
                updated_at = NOW()
            WHERE id = ?
        ");
        
        $stmt->execute([
            $data['subject'],
            $data['content'],
            $data['send_date'],
            $data['status'],
            $data['total_recipients'],
            $data['opens'],
            $data['clicks'],
            $data['unsubscribes'],
            $data['campaign_id']
        ]);
    } else {
        // Insert new campaign
        $stmt = $conn->prepare("
            INSERT INTO newsletter_campaigns 
            (subject, content, send_date, status, total_recipients, opens, clicks, unsubscribes, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $stmt->execute([
            $data['subject'],
            $data['content'],
            $data['send_date'],
            $data['status'],
            $data['total_recipients'],
            $data['opens'],
            $data['clicks'],
            $data['unsubscribes']
        ]);
    }

    echo json_encode([
        'success' => true,
        'message' => isset($data['campaign_id']) ? 'Campaign updated successfully' : 'Campaign created successfully'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 