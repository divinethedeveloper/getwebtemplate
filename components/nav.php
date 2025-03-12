<nav class="nav" aria-label="Main navigation">
    <div class="search cen">
        <div class="search-container">
             <input id="search-input" type="text" placeholder="Search templates..." aria-label="Search templates">
            <button class="button cen" aria-label="Submit search"><i class="bi bi-search"></i></button>
            
            <div class="search-dropdown" id="search-results">
                <!-- Results will be populated here -->
            </div>
        </div>
    </div>
    <div class="logo cen" onclick="location.href='../../'">
        <a href="" title="Get Business Website - Professional Business Websites">
            <img src="../../assets/logo/getbusinesswebsite-logo.png" alt="Get Business Website Logo - Professional Website Solutions" width="auto" height="auto">
        </a>
    </div>
    <div class="cart cen">
                <a href="javascript:void(0)" title="View Shopping Cart" aria-label="Shopping Cart" onclick="toggleCartDropdown()">
                    <i class="bi bi-bag"></i>
                </a>
                <div id="cart-dropdown" class="cart-dropdown">
                    <div class="cart-content">
                        <p class="empty-cart-message">There are no items in your cart</p>
                    </div>
                </div>
            </div>
</nav>

<script src="../../scripts/nav_script.js"></script>
