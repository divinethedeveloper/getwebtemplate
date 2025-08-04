<?php
// ... existing code ...
?>

<nav class="nav" aria-label="Main navigation">
<div class="search cen">
        <div class="search-container">
            <input id="search-input" type="text" placeholder="Search templates..." aria-label="Search templates">
            <button id="search-toggle" class="button cen" aria-label="Toggle search"><i class="bi bi-search"></i></button>
            
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

<!-- 
<nav class="nav" aria-label="Main navigation">
    <div class="search cen">
        <div class="search-container">
            <input id="search-input" type="text" placeholder="Search templates..." aria-label="Search templates">
            <button id="search-toggle" class="button cen" aria-label="Toggle search"><i class="bi bi-search"></i></button>
            
            <div class="search-dropdown" id="search-results">
             </div>
        </div>
    </div>
    <div class="logo cen" onclick="window.location.reload()">
        <a href="" title="Get Business Website - Professional Business Websites">
            <img src="../../assets/logo/getbusinesswebsite-logo.png" alt="Get Business Website Logo - Professional Website Solutions" width="auto" height="auto">
        </a>
    </div>
    <div class="account cen">
        <a href="javascript:void(0)" title="Account" aria-label="Account" onclick="toggleSignInPrompt()">
            <i class="bi bi-person"></i>
        </a>
    </div>
</nav>  -->

<style>
.signin-prompt {
    position: fixed;
    top: 60px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 1000;
    display: none;
    width: 300px;
    border: 1px solid #e0e0e0;
}

.signin-prompt.active {
    display: block;
    animation: slideIn 0.3s ease-out;
}

.signin-content {
    padding: 16px;
}

.signin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.signin-header span {
    font-weight: 500;
    color: #333;
}

.close-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    color: #666;
}

.close-button:hover {
    color: #333;
}

.signin-body {
    display: flex;
    justify-content: center;
    padding: 8px 0;
}

.signin-error {
    margin-top: 12px;
    padding: 8px;
    background-color: #fee;
    border-radius: 4px;
    color: #c00;
    font-size: 14px;
    text-align: center;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
 

<script src="../../scripts/nav_script.js"></script>
