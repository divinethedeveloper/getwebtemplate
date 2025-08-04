<?php
require_once "../../backend/conn.php";

// Get unique categories from database
$categoryQuery = "SELECT DISTINCT category FROM templates ORDER BY category";
$categoryResult = $conn->query($categoryQuery);
$categories = [];
while($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Get templates based on selected category
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($selectedCategory && $selectedCategory !== 'all') {
    $templateQuery = "SELECT * FROM templates WHERE category = ?";
    $stmt = $conn->prepare($templateQuery);
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $templatesResult = $stmt->get_result();
} else {
    // If no category selected or 'all' is selected, show all templates
    $templateQuery = "SELECT * FROM templates";
    $templatesResult = $conn->query($templateQuery);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dynamic Title -->
    <title>Templates - <?php echo $selectedCategory === 'all' ? 'All Categories' : ucfirst($selectedCategory); ?> | Get Business Website</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Browse professionally designed website templates<?php echo $selectedCategory !== 'all' ? ' in the ' . ucfirst($selectedCategory) . ' category' : ''; ?>. Mobile-friendly, fast, and SEO-ready. Launch your business website today.">
    <meta name="keywords" content="website templates, business templates, prebuilt websites, <?php echo $selectedCategory; ?> templates, responsive web design, SEO-ready templates">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://getbusinesswebsite.online/en/pages/templates<?php echo $selectedCategory !== 'all' ? '?category=' . urlencode($selectedCategory) : ''; ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://getbusinesswebsite.online/en/pages/templates<?php echo $selectedCategory !== 'all' ? '?category=' . urlencode($selectedCategory) : ''; ?>">
    <meta property="og:title" content="Templates - <?php echo $selectedCategory === 'all' ? 'All Categories' : ucfirst($selectedCategory); ?> | Get Business Website">
    <meta property="og:description" content="Explore prebuilt website templates<?php echo $selectedCategory !== 'all' ? ' for ' . ucfirst($selectedCategory) : ''; ?>. Ready in days. No coding needed.">
    <meta property="og:image" content="https://getbusinesswebsite.online/assets/divinethedeveloper_hero_2.png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Templates - <?php echo $selectedCategory === 'all' ? 'All Categories' : ucfirst($selectedCategory); ?> | Get Business Website">
    <meta name="twitter:description" content="Choose from ready-made, responsive templates<?php echo $selectedCategory !== 'all' ? ' in ' . ucfirst($selectedCategory) : ''; ?>. Fast launch, SEO-ready.">
    <meta name="twitter:image" content="https://getbusinesswebsite.online/assets/divinethedeveloper_hero_2.png">

    <!-- Favicons & Manifest -->
    <link rel="apple-touch-icon" sizes="180x180" href="../../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <link rel="icon" type="image/png" sizes="192x192" href="../../android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../../android-chrome-512x512.png">
    <link rel="manifest" href="../../site.webmanifest">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/nav.css">
</head>

<body>
    <div class="container">
        <?php require_once "../../components/nav.php"; ?>

        <div class="planebg">
            <div class="main_bg"></div>
            <div class="hero cen">
                <h1>Make It Possible</h1>
                <h2>Hundreds of Templates to choose from</h2>
            </div>
        </div>

        <div class="categories cen">
            <div class="wrap">
                <!-- Add "All" as first category -->
                <div class="cart_item cen <?php echo ($selectedCategory == 'all' || !$selectedCategory) ? 'active' : ''; ?>" 
                     onclick="window.location.href='?category=all'">
                    <div class="icon cen">
                        <i class="bi bi-grid-fill"></i>
                    </div>
                    <h4>All</h4>
                </div>
                
                <?php foreach($categories as $category): ?>
                    <div class="cart_item cen <?php echo ($selectedCategory == $category) ? 'active' : ''; ?>" 
                         onclick="window.location.href='?category=<?php echo urlencode($category); ?>'">
                        <div class="icon cen">
                            <i class="bi bi-person-raised-hand"></i>
                        </div>
                        <h4><?php echo ucfirst(str_replace('_', ' ', $category)); ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="selected_category cen">
            <?php echo $selectedCategory == 'all' ? 'All Templates' : ucfirst(str_replace('_', ' ', $selectedCategory)); ?>
        </div>

        <div class="templates">
            <?php while($template = $templatesResult->fetch_assoc()): ?>
                <div class="template" onclick="location.href='../checkout/?id=<?php echo $template['id']; ?>'">
                    <div class="gif">
                        <img src="../../backend/<?php echo htmlspecialchars($template['main_image']); ?>" alt="<?php echo htmlspecialchars($template['name']); ?>">
                    </div>
                    <div class="t_scroll">
                        <img src="../../backend/<?php echo htmlspecialchars($template['main_image']); ?>" alt="<?php echo htmlspecialchars($template['name']); ?>">
                    </div>
                    <h4><?php echo htmlspecialchars($template['name']); ?></h4>
                    <div class="template-price">$<?php echo number_format($template['price'], 2); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        // Add active class to selected category
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const category = urlParams.get('category');
            if (category) {
                const activeCategory = document.querySelector(`.cart_item[data-category="${category}"]`);
                if (activeCategory) {
                    activeCategory.classList.add('active');
                }
            }
        });
    </script>

    <script src="../../scripts/script.js"></script>
</body>
</html>