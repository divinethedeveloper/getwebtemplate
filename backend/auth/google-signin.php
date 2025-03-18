<?php
require_once '../config/database.php';

// Google API Client Library
require_once '../../vendor/autoload.php';

// Get the POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['credential'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No credential provided']);
    exit;
}

try {
    // Configure Google Client
    $client = new Google_Client([
        'client_id' => '1234567890-abcdefghijklmnopqrstuvwxyz.apps.googleusercontent.com', // Replace with your client ID
        'client_secret' => 'YOUR_CLIENT_SECRET' // Replace with your client secret
    ]);

    // Verify the ID token
    $payload = $client->verifyIdToken($data['credential']);

    if ($payload) {
        $userid = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'];
        $picture = $payload['picture'];

        // Check if user exists in database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
        $stmt->execute([$userid]);
        $user = $stmt->fetch();

        if (!$user) {
            // Create new user
            $stmt = $pdo->prepare("INSERT INTO users (google_id, email, name, profile_picture) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userid, $email, $name, $picture]);
            $userId = $pdo->lastInsertId();
        } else {
            $userId = $user['id'];
            // Update user information
            $stmt = $pdo->prepare("UPDATE users SET email = ?, name = ?, profile_picture = ? WHERE id = ?");
            $stmt->execute([$email, $name, $picture, $userId]);
        }

        // Start session and store user data
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_picture'] = $picture;

        // Set login cookie (30 days expiration)
        setcookie('user_logged_in', 'true', time() + (30 * 24 * 60 * 60), '/', '', true, true);

        echo json_encode([
            'success' => true,
            'message' => 'Successfully signed in',
            'user' => [
                'name' => $name,
                'email' => $email,
                'picture' => $picture
            ]
        ]);
    } else {
        throw new Exception('Invalid ID token');
    }
} catch (Exception $e) {
    // Log the error
    error_log('Google Sign-In Error: ' . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Authentication failed. Please try again.'
    ]);
}
?> 