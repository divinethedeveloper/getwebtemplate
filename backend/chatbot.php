<?php
class Chatbot {
    private $responses;
    
    public function __construct() {
        $json = file_get_contents(__DIR__ . '/../data/chatbot-responses.json');
        $this->responses = json_decode($json, true);
    }
    
    public function getResponse($input) {
        $input = strtolower(trim($input));
        $bestMatch = null;
        $highestScore = 0;
        
        // Search through categories and their items
        foreach ($this->responses['categories'] as $category => $items) {
            foreach ($items as $item => $data) {
                if (isset($data['keywords'])) {
                    // First try exact matches
                    foreach ($data['keywords'] as $keyword) {
                        if (strpos($input, strtolower($keyword)) !== false) {
                            return $this->getRandomResponse($data['responses']);
                        }
                    }
                    
                    // If no exact match, calculate similarity
                    foreach ($data['keywords'] as $keyword) {
                        $score = $this->calculateSimilarity($input, $keyword);
                        if ($score > $highestScore) {
                            $highestScore = $score;
                            $bestMatch = $data['responses'];
                        }
                    }
                }
            }
        }
        
        // If we found a good match (similarity > 0.6)
        if ($highestScore > 0.6 && $bestMatch) {
            return $this->getRandomResponse($bestMatch);
        }
        
        // Return default response if no match found
        return $this->getRandomResponse($this->responses['default']['responses']);
    }
    
    private function calculateSimilarity($str1, $str2) {
        // Convert strings to arrays of words
        $words1 = explode(' ', strtolower($str1));
        $words2 = explode(' ', strtolower($str2));
        
        // Count matching words
        $matches = array_intersect($words1, $words2);
        
        // Calculate similarity score
        $totalWords = count($words1) + count($words2);
        if ($totalWords === 0) return 0;
        
        return (2 * count($matches)) / $totalWords;
    }
    
    private function getRandomResponse($responses) {
        return $responses[array_rand($responses)];
    }
    
    public function processMessage($message) {
        // Clean and prepare the input
        $input = strip_tags(trim($message));
        
        // Get the response
        $response = $this->getResponse($input);
        
        // Format the response for output
        return [
            'status' => 'success',
            'message' => $response,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    try {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        if (!isset($data['message'])) {
            throw new Exception('No message provided');
        }
        
        $chatbot = new Chatbot();
        $response = $chatbot->processMessage($data['message']);
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}
?> 