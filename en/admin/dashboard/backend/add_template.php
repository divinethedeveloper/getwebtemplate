<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './db_connection.php';
$pdo = getDbConnection();

// Set proper headers for JSON response
header('Content-Type: application/json');

try {
    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Validate required fields
    $required_fields = ['name', 'category', 'price', 'short_description'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            throw new Exception("Missing required field: {$field}");
        }
    }

    // Validate file uploads
    if (!isset($_FILES['main_image']) || $_FILES['main_image']['error'] !== 0) {
        throw new Exception('Main image is required');
    }

    if (!isset($_FILES['mobile_image']) || $_FILES['mobile_image']['error'] !== 0) {
        throw new Exception('Mobile image is required');
    }

    // Create upload directory if it doesn't exist
    $upload_dir = '../../../backend/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Handle main image upload
    $main_image = '';
    if(isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
        $main_image = './backend/uploads/' . time() . '_main_' . $_FILES['main_image']['name'];
        if (!move_uploaded_file($_FILES['main_image']['tmp_name'], '../../../' . $main_image)) {
            throw new Exception('Failed to upload main image');
        }
    }

    // Handle mobile image upload
    $mobile_image = '';
    if(isset($_FILES['mobile_image']) && $_FILES['mobile_image']['error'] == 0) {
        $mobile_image = './backend/uploads/' . time() . '_mobile_' . $_FILES['mobile_image']['name'];
        if (!move_uploaded_file($_FILES['mobile_image']['tmp_name'], '../../../' . $mobile_image)) {
            throw new Exception('Failed to upload mobile image');
        }
    }

    // Handle template shots
    $shots = array();
    for($i = 1; $i <= 10; $i++) {
        $shot_key = "shot_$i";
        $shots[$shot_key] = '';
        
        if(isset($_FILES[$shot_key]) && $_FILES[$shot_key]['error'] == 0) {
            $shots[$shot_key] = './backend/uploads/' . time() . "_shot{$i}_" . $_FILES[$shot_key]['name'];
            if (!move_uploaded_file($_FILES[$shot_key]['tmp_name'], '../../../' . $shots[$shot_key])) {
                throw new Exception("Error uploading shot $i");
            }
        }
    }

    // Prepare data for database
    $template_data = [
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => floatval($_POST['price']),
        'short_description' => $_POST['short_description'],
        'main_image' => $main_image,
        'mobile_image' => $mobile_image,
        'shot_1' => $shots['shot_1'],
        'shot_2' => $shots['shot_2'],
        'shot_3' => $shots['shot_3'],
        'shot_4' => $shots['shot_4'],
        'shot_5' => $shots['shot_5'],
        'shot_6' => $shots['shot_6'],
        'shot_7' => $shots['shot_7'],
        'shot_8' => $shots['shot_8'],
        'shot_9' => $shots['shot_9'],
        'shot_10' => $shots['shot_10'],
        'rating' => isset($_POST['rating']) ? floatval($_POST['rating']) : 0.0,
        'preview_url' => $_POST['preview_url'] ?? null,
        'clicks' => 0,
        'views' => 0,
        'times_purchased' => 0
    ];

    // Create SQL query
    $sql = "INSERT INTO templates (
        name, category, price, short_description, 
        main_image, mobile_image,
        shot_1, shot_2, shot_3, shot_4, shot_5, 
        shot_6, shot_7, shot_8, shot_9, shot_10, 
        rating, preview_url, clicks, views, times_purchased
    ) VALUES (
        :name, :category, :price, :short_description,
        :main_image, :mobile_image,
        :shot_1, :shot_2, :shot_3, :shot_4, :shot_5,
        :shot_6, :shot_7, :shot_8, :shot_9, :shot_10,
        :rating, :preview_url, :clicks, :views, :times_purchased
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($template_data);
    $template_id = $pdo->lastInsertId();

    // Send success response
    echo json_encode([
        'success' => true,
        'message' => 'Template added successfully',
        'template_id' => $template_id
    ]);

} catch (Exception $e) {
    // Log the error
    error_log("Template Upload Error: " . $e->getMessage());
    
    // Send error response
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 