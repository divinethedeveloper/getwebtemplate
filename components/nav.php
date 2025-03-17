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
</nav>

<!-- Google Sign-In Prompt -->
<div id="signin-prompt" class="signin-prompt">
    <div class="signin-content">
        <div class="signin-header">
            <span>Sign in to Get Business Website</span>
            <button onclick="closeSignInPrompt()" class="close-button" aria-label="Close sign-in prompt">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="signin-body">
            <div id="g_id_onload"
                 data-client_id="1234567890-abcdefghijklmnopqrstuvwxyz.apps.googleusercontent.com"
                 data-context="signin"
                 data-ux_mode="popup"
                 data-callback="handleCredentialResponse"
                 data-auto_prompt="false"
                 data-auto_select="true"
                 data-itp_support="true">
            </div>
            <div class="g_id_signin"
                 data-type="standard"
                 data-shape="rectangular"
                 data-theme="outline"
                 data-text="signin_with"
                 data-size="large"
                 data-logo_alignment="left"
                 data-width="250">
            </div>
        </div>
        <div id="signin-error" class="signin-error" style="display: none;">
            <p>Unable to sign in. Please try again.</p>
        </div>
    </div>
</div>

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

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
function toggleSignInPrompt() {
    const prompt = document.getElementById('signin-prompt');
    prompt.classList.toggle('active');
    document.getElementById('signin-error').style.display = 'none';
}

function closeSignInPrompt() {
    const prompt = document.getElementById('signin-prompt');
    prompt.classList.remove('active');
}

function handleCredentialResponse(response) {
    if (!response.credential) {
        showError('Sign-in failed. Please try again.');
        return;
    }

    // Send the token to your server
    fetch('/backend/auth/google-signin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            credential: response.credential
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            showError(data.message || 'Sign-in failed. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Unable to complete sign-in. Please try again.');
    });
}

function showError(message) {
    const errorDiv = document.getElementById('signin-error');
    errorDiv.innerHTML = `<p>${message}</p>`;
    errorDiv.style.display = 'block';
}

// Show sign-in prompt after 3 seconds if user is not logged in
document.addEventListener('DOMContentLoaded', function() {
    // Only show prompt if not on mobile
    if (window.innerWidth > 768) {
        setTimeout(function() {
            if (!isUserLoggedIn()) {
                toggleSignInPrompt();
            }
        }, 3000);
    }
});

function isUserLoggedIn() {
    // Check if user is logged in by looking for session cookie
    return document.cookie.includes('user_logged_in=true');
}
</script>

<script src="../../scripts/nav_script.js"></script>
