<div class="section4">
            <div class="partners">
            <img src="./assets/associates/bot.png" alt="">
            <img src="./assets/associates/lion.png" alt="">
            <img src="./assets/associates/m.png" alt="">
            <img src="./assets/associates/polaris.png" alt="">

            </div>

            <div class="contact">
                <span>
                    <h4>Have an idea or project? let's talk</h4>
                    <aside>Contact Us</aside>
                </span>
                <span>
                    <h5>Subscribe to Newsletters / Request a call</h5>
                    <div class="input cen">
                        <input type="email" id="newsletterEmail" placeholder="Your Email" required>
                        <button onclick="subscribeNewsletter()">Subscribe</button>
                    </div>
                    <div id="subscriptionMessage" style="margin-top: 10px; text-align: center;"></div>
                </span>
            </div>
            <div class="contact_details">
            <span>+1(888)123 45 67</span>
            <span>Phlox-Theme@Averta.Com</span>
            <span>Patricia C. Amedee 4401 Waldeck Street Grapevine Nashville, Tx 76051</span>
        </div>

<script>
async function subscribeNewsletter() {
    const email = document.getElementById('newsletterEmail').value;
    const messageDiv = document.getElementById('subscriptionMessage');
    const subscribeButton = messageDiv.previousElementSibling.querySelector('button');
    
    // Basic email validation
    if (!email || !email.includes('@')) {
        messageDiv.innerHTML = '<span style="color: #dc2626;">Please enter a valid email address</span>';
        return;
    }

    // Disable button and show loading state
    subscribeButton.disabled = true;
    subscribeButton.innerHTML = 'Subscribing...';
    messageDiv.innerHTML = '';

    try {
        const response = await fetch('/divinethedeveloper/backend/subscribe_newsletter.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email: email })
        });

        let data;
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            data = await response.json();
        } else {
            throw new Error('Invalid response format');
        }

        if (data.success) {
            messageDiv.innerHTML = '<span style="color: #16a34a;">' + data.message + '</span>';
            document.getElementById('newsletterEmail').value = '';
        } else {
            messageDiv.innerHTML = '<span style="color: #dc2626;">' + (data.message || 'Subscription failed. Please try again.') + '</span>';
        }
    } catch (error) {
        console.error('Error:', error);
        messageDiv.innerHTML = '<span style="color: #dc2626;">Unable to process your request. Please try again later.</span>';
    } finally {
        // Re-enable button and restore original text
        subscribeButton.disabled = false;
        subscribeButton.innerHTML = 'Subscribe';
    }
}

// Add event listener for Enter key
document.getElementById('newsletterEmail').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        subscribeNewsletter();
    }
});
</script>