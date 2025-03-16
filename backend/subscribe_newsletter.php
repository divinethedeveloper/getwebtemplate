<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

// Include database connection
require_once __DIR__ . '/conn.php';

// Set headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Clear any previous output
ob_clean();

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['email'])) {
        throw new Exception('Email is required');
    }

    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    // Get database connection
    $conn = getConnection();
    
    // Check if email already exists
    $email = $conn->real_escape_string($data['email']);
    $query = "SELECT id FROM newsletter_subscribers WHERE email = '$email'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        throw new Exception('This email is already subscribed');
    }
    
    // Insert new subscriber
    $query = "INSERT INTO newsletter_subscribers (email, subscription_date, status) 
              VALUES ('$email', NOW(), 'subscribed')";
              
    if (!$conn->query($query)) {
        throw new Exception('Error saving subscription: ' . $conn->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Thank you for subscribing to our newsletter!'
    ]);

} catch (Exception $e) {
    error_log("Newsletter subscription error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// End output buffering
ob_end_flush(); 