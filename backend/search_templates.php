<?php
require_once "conn.php";

header('Content-Type: application/json');

if (isset($_GET['term'])) {
    $searchTerm = $conn->real_escape_string($_GET['term']);
    
    $sql = "SELECT id, name FROM templates 
            WHERE name LIKE '%$searchTerm%' 
            LIMIT 5";
    
    $result = $conn->query($sql);
    $templates = [];
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $templates[] = $row;
        }
    }
    
    echo json_encode($templates);
} else {
    echo json_encode([]);
}

$conn->close();
?> 