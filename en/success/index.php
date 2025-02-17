<?php
require '../../backend/conn.php';

// Get the reference from URL
$reference = isset($_GET['reference']) ? htmlspecialchars($_GET['reference']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Successful!</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            text-align: center;
        }

        .success-container {
            padding: 2rem;
            max-width: 600px;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: #333;
            animation: fadeInUp 1s ease;
        }

        .subtext {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
            animation: fadeInUp 1s ease 0.3s;
            animation-fill-mode: both;
        }

        .reference {
            background: #f0f0f0;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: monospace;
            color: #555;
        }

        .home-link {
            margin-top: 2rem;
            color: #333;
            text-decoration: none;
            padding: 1rem 2rem;
            border: 2px solid #333;
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.6s;
            animation-fill-mode: both;
        }

        .home-link:hover {
            background: #333;
            color: #fff;
            transform: translateY(-2px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Congratulations! 🎉</h1>
        <p class="subtext">
            Your purchase was successful! You'll receive an email shortly with your access details.<br>
            Reference: <span class="reference"><?php echo $reference; ?></span>
        </p>
        <a href="../../" class="home-link">Back to Homepage</a>
    </div>

    <script>
        // Trigger confetti animation
        function triggerConfetti() {
            const duration = 3000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function() {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50 * (timeLeft / duration);
                
                // Since they fall down, start a bit higher than random
                confetti({
                    ...defaults,
                    particleCount,
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                });
                confetti({
                    ...defaults,
                    particleCount,
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                });
            }, 250);
        }

        // Start confetti when page loads
        window.onload = function() {
            triggerConfetti();
        };
    </script>
</body>
</html> 