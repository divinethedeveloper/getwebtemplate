<?php
header('Content-Type: application/json');
require_once 'config/database.php';

class WaitlistHandler {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function addToWaitlist($data) {
        try {
            // Validate input
            if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Valid email is required");
            }
            
            if (!isset($data['name']) || empty(trim($data['name']))) {
                throw new Exception("Name is required");
            }
            
            // Check if email already exists
            $query = "SELECT id FROM waitlist WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $data['email']);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                throw new Exception("This email is already on our waitlist");
            }
            
            // Get UTM parameters and source
            $source = $this->getSource();
            $utm_params = $this->getUTMParams();
            
            // Insert into waitlist
            $query = "INSERT INTO waitlist 
                    (name, email, business_name, source, utm_source, utm_medium, utm_campaign) 
                    VALUES 
                    (:name, :email, :business_name, :source, :utm_source, :utm_medium, :utm_campaign)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":business_name", $data['business']);
            $stmt->bindParam(":source", $source);
            $stmt->bindParam(":utm_source", $utm_params['utm_source']);
            $stmt->bindParam(":utm_medium", $utm_params['utm_medium']);
            $stmt->bindParam(":utm_campaign", $utm_params['utm_campaign']);
            
            if($stmt->execute()) {
                // Update visitor tracking as converted
                if(isset($_SESSION['visitor_id'])) {
                    $this->markVisitorConverted($_SESSION['visitor_id']);
                }
                
                return ["success" => true, "message" => "Successfully joined the waitlist!"];
            }
            
            throw new Exception("Failed to join waitlist");
            
        } catch(Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
    
    private function getSource() {
        return isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : 'direct';
    }
    
    private function getUTMParams() {
        $params = [
            'utm_source' => isset($_SESSION['utm_source']) ? $_SESSION['utm_source'] : null,
            'utm_medium' => isset($_SESSION['utm_medium']) ? $_SESSION['utm_medium'] : null,
            'utm_campaign' => isset($_SESSION['utm_campaign']) ? $_SESSION['utm_campaign'] : null
        ];
        return $params;
    }
    
    private function markVisitorConverted($visitor_id) {
        try {
            $query = "UPDATE visitor_tracking 
                     SET converted = true 
                     WHERE visitor_id = :visitor_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":visitor_id", $visitor_id);
            $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error marking visitor converted: " . $e->getMessage());
        }
    }
}

// Handle the request
$data = json_decode(file_get_contents('php://input'), true);
$handler = new WaitlistHandler();
$result = $handler->addToWaitlist($data);

http_response_code($result['success'] ? 200 : 400);
echo json_encode($result);
?> 