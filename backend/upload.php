<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    $required_fields = ['name', 'category', 'price', 'short_description'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[] = ucfirst($field) . " is required";
        }
    }

    // If there are validation errors, stop and show them
    if (!empty($errors)) {
        echo "Errors:<br>" . implode("<br>", $errors);
        exit();
    }

    // Get form data with proper validation
    echo "Form data received";
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $short_description = isset($_POST['short_description']) ? trim($_POST['short_description']) : '';
    $rating = isset($_POST['rating']) ? floatval($_POST['rating']) : 0;
    $preview_url = isset($_POST['preview_url']) ? trim($_POST['preview_url']) : '';

    // Validate file uploads
    if (!isset($_FILES['main_image']) || $_FILES['main_image']['error'] !== 0) {
        echo "Main image is required";
        exit();
    }

    if (!isset($_FILES['mobile_image']) || $_FILES['mobile_image']['error'] !== 0) {
        echo "Mobile image is required";
        exit();
    }

    // Handle main image upload
    $main_image = '';
    if(isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
        $main_image = 'uploads/' . time() . '_main_' . $_FILES['main_image']['name'];
        if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $main_image)) {
            echo "Error uploading main image";
            exit();
        }
    }

    // Handle mobile image upload
    $mobile_image = '';
    if(isset($_FILES['mobile_image']) && $_FILES['mobile_image']['error'] == 0) {
        $mobile_image = 'uploads/' . time() . '_mobile_' . $_FILES['mobile_image']['name'];
        if (!move_uploaded_file($_FILES['mobile_image']['tmp_name'], $mobile_image)) {
            echo "Error uploading mobile image";
            exit();
        }
    }

    // Handle template shots with validation
    $shots = array();
    for($i = 1; $i <= 10; $i++) {
        $shot_key = "shot_$i";
        $shots[$shot_key] = '';
        
        if(isset($_FILES[$shot_key]) && $_FILES[$shot_key]['error'] == 0) {
            $shots[$shot_key] = 'uploads/' . time() . "_shot{$i}_" . $_FILES[$shot_key]['name'];
            if (!move_uploaded_file($_FILES[$shot_key]['tmp_name'], $shots[$shot_key])) {
                echo "Error uploading shot $i";
                exit();
            }
        }
    }

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO templates (
            name, category, price, short_description, 
            main_image, mobile_image,
            shot_1, shot_2, shot_3, shot_4, shot_5, 
            shot_6, shot_7, shot_8, shot_9, shot_10, 
            rating, preview_url
        ) VALUES (
            ?, ?, ?, ?, 
            ?, ?,
            ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, 
            ?, ?
        )";

        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssdsssssssssssssds",
            $name, $category, $price, $short_description,
            $main_image, $mobile_image,
            $shots['shot_1'], $shots['shot_2'], $shots['shot_3'], 
            $shots['shot_4'], $shots['shot_5'], $shots['shot_6'], 
            $shots['shot_7'], $shots['shot_8'], $shots['shot_9'], 
            $shots['shot_10'], $rating, $preview_url
        );

        if ($stmt->execute()) {
            echo "Template added successfully!";
            header("Location: ../en/admin/upload/success.html");
            exit();
        } else {
            throw new Exception("Execute failed: " . $stmt->error);
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    echo "Invalid request method.";
}
?>
