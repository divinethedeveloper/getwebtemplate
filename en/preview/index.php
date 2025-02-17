<?php 
require '../../backend/conn.php';

$template_id = $_GET['id'];

// Get both images from the templates table
$query = "SELECT main_image, mobile_image FROM templates WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $template_id);
$stmt->execute();
$result = $stmt->get_result();
$template = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($template['name']); ?></title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/preview.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

    <div class="navigation">
        <div class="mov up cen">
            <div class="held"></div>
            <i class="bi bi-arrow-up"></i></div>
        <div class="mov down cen">
            <div class="held"></div>
        <i class="bi bi-arrow-down"></i></div>
    </div>
    <div class="container">

       <div class="preview">
        <!-- Desktop Image -->
        <img src="../../backend/<?php echo htmlspecialchars($template['main_image']); ?>" 
             alt="Template Preview" 
             class="desktop-view">
        
        <!-- Mobile Image -->
        <img src="../../backend/<?php echo htmlspecialchars($template['mobile_image']); ?>" 
             alt="Template Preview" 
             class="mobile-view">
       </div>

    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const preview = document.querySelector(".preview");
    const upButton = document.querySelector(".mov.up");
    const downButton = document.querySelector(".mov.down");
    let scrollInterval;
    let isScrolling = false;
    let startTime;

    function setButtonActive(direction) {
        if (direction === 'up') {
            upButton.classList.add('active');
            downButton.classList.remove('active');
        } else if (direction === 'down') {
            downButton.classList.add('active');
            upButton.classList.remove('active');
        } else {
            // Remove active from both when scrolling stops
            upButton.classList.remove('active');
            downButton.classList.remove('active');
        }
    }

    function startScrolling(direction) {
        if (isScrolling) return;
        isScrolling = true;
        startTime = Date.now();
        
        // Add this line to set active state
        setButtonActive(direction === -1 ? 'up' : 'down');
        
        // Configure acceleration
        const minSpeed = 1;
        const maxSpeed = 10;
        const accelerationDuration = 2000; // 2 seconds to reach max speed
        
        scrollInterval = setInterval(() => {
            const elapsedTime = Date.now() - startTime;
            const progress = Math.min(elapsedTime / accelerationDuration, 1);
            
            // Smooth acceleration using easeInQuad
            const speed = minSpeed + (maxSpeed - minSpeed) * (progress * progress);
            
            preview.scrollBy({ 
                top: direction * speed, 
                behavior: "auto" 
            });
        }, 16); // ~60fps
    }

    function stopScrolling() {
        if (!isScrolling) return;
        isScrolling = false;
        clearInterval(scrollInterval);

        // Add this line to remove active states
        setButtonActive('none');

        // Get the current speed at time of release
        const elapsedTime = Date.now() - startTime;
        const progress = Math.min(elapsedTime / 2000, 1);
        let currentSpeed = 1 + 9 * (progress * progress);
        
        // Store the direction that was being used
        const lastDirection = downButton.matches(':active') ? 1 : -1;

        function decelerate() {
            if (currentSpeed <= 0.01) return;  // Lower threshold to continue longer
            currentSpeed *= 0.98;  // Changed from 0.95 to 0.98 for slower deceleration
            preview.scrollBy({ 
                top: currentSpeed * lastDirection, 
                behavior: "auto" 
            });
            requestAnimationFrame(decelerate);
        }
        
        decelerate();
    }

    // Mouse events
    upButton.addEventListener("mousedown", () => startScrolling(-1));
    downButton.addEventListener("mousedown", () => startScrolling(1));
    document.addEventListener("mouseup", stopScrolling);
    
    // Touch events
    upButton.addEventListener("touchstart", (e) => {
        e.preventDefault();
        startScrolling(-1);
    });
    downButton.addEventListener("touchstart", (e) => {
        e.preventDefault();
        startScrolling(1);
    });
    document.addEventListener("touchend", stopScrolling);
});
    </script>



    

    <script src="../../scripts/script.js"></script>

    
</body>
</html>