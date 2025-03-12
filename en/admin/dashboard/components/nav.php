<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$current_page = str_replace('.php', '', $current_page); // Handle HTML files too
?>

<div class="side_panel">
    <div class="logo">
        <i class="bi bi-graph-up-arrow"></i>
        <h4>Analytics Dashboard</h4>
    </div>

    <div class="items">
        <a href="../index.php" class="item <?php echo $current_page === 'index' ? 'active' : ''; ?>">
            <i class="bi bi-house"></i>
            <h3>Overview</h3>
        </a>
        <a href="../visitors.php" class="item <?php echo $current_page === 'visitors' ? 'active' : ''; ?>">
            <i class="bi bi-people"></i>
            <h3>Visitors</h3>
        </a>
        <a href="../products.php" class="item <?php echo $current_page === 'products' ? 'active' : ''; ?>">
            <i class="bi bi-cart"></i>
            <h3>Products</h3>
        </a>
        <a href="../newsletter.php" class="item <?php echo $current_page === 'newsletter' ? 'active' : ''; ?>">
            <i class="bi bi-envelope"></i>
            <h3>Newsletter</h3>
        </a>
        <a href="../settings.php" class="item <?php echo $current_page === 'settings' ? 'active' : ''; ?>">
            <i class="bi bi-gear"></i>
            <h3>Settings</h3>
        </a>
    </div>
</div>

<style>
.side_panel {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background: var(--card-background);
    border-right: 1px solid var(--border-color);
    z-index: 100;
    overflow-y: auto;
    padding: 1.5rem 0;
}

.logo {
    padding: 0 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.logo i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.logo h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.items {
    padding: 0 0.75rem;
}

.item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    border-radius: 0.5rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s ease;
    margin-bottom: 0.5rem;
}

.item:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
}

.item.active {
    background: var(--primary-color);
    color: white;
}

.item i {
    font-size: 1.25rem;
}

.item h3 {
    font-size: 0.9375rem;
    font-weight: 500;
    margin: 0;
}

@media (max-width: 768px) {
    .side_panel {
        position: relative;
        width: 100%;
        height: auto;
        border-right: none;
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 0;
    }

    .items {
        display: flex;
        overflow-x: auto;
        padding: 0.5rem;
    }

    .item {
        flex: 0 0 auto;
    }
}
</style> 