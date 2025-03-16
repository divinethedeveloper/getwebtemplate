<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="side_panel">
            <div class="logo">
                <i class="bi bi-grid-1x2"></i>
                <h4>My Dashboard</h4>
            </div>

            <div class="credit-info">
                <div class="credit-type">
                    <i class="bi bi-lightning-charge"></i>
                    <span>Instant Credits:</span>
                    <span class="credit-count">2</span>
                </div>
                <div class="credit-type">
                    <i class="bi bi-clock"></i>
                    <span>Regular Credits:</span>
                    <span class="credit-count">5</span>
                </div>
                <div class="credit-type">
                    <i class="bi bi-calendar"></i>
                    <span>Standard Credits:</span>
                    <span class="credit-count">8</span>
                </div>
            </div>

            <div class="items">
                <a href="index.php" class="item <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
                    <i class="bi bi-grid"></i>
                    <h3>My Templates</h3>
                </a>
                <a href="customization.php" class="item <?php echo $current_page === 'customization.php' ? 'active' : ''; ?>">
                    <i class="bi bi-palette"></i>
                    <h3>Customization</h3>
                </a>
                <a href="updates.php" class="item <?php echo $current_page === 'updates.php' ? 'active' : ''; ?>">
                    <i class="bi bi-arrow-clockwise"></i>
                    <h3>Updates</h3>
                </a>
                <a href="domains.php" class="item <?php echo $current_page === 'domains.php' ? 'active' : ''; ?>">
                    <i class="bi bi-arrow-clockwise"></i>
                    <h3>Domains</h3>
                </a>
                <a href="credits.php" class="item <?php echo $current_page === 'credits.php' ? 'active' : ''; ?>">
                    <i class="bi bi-credit-card"></i>
                    <h3>Credits</h3>
                </a>
                <a href="settings.php" class="item <?php echo $current_page === 'settings.php' ? 'active' : ''; ?>">
                    <i class="bi bi-gear"></i>
                    <h3>Settings</h3>
                </a>
            </div>
        </div>

        <div class="mobile-menu">
            <i class="bi bi-list"></i>
        </div>