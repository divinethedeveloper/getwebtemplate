 document.addEventListener('DOMContentLoaded', function() {
    const chatbotInput = document.getElementById('chatbot-input-field');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotSend = document.getElementById('chatbot-send');
    const chatbotTrigger = document.getElementById('chatbot-trigger');
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotClose = document.getElementById('chatbot-close');

    // Replace with your Together API key
    const TOGETHER_API_KEY = '65773bdc3e593b7aa1463d6284127f0d447e0bf13fe5bf6cd10429c5dd24986d';

    // Category-to-link mapping
    const CATEGORY_LINKS = {
        'portfolio website': 'https://getbusinesswebsite.online/portfolio',
        'ecommerce website': 'https://getbusinesswebsite.online/ecommerce',
        'blog website': 'https://getbusinesswebsite.online/blog',
        'support': 'https://getbusinesswebsite.online/support'
    };

    // Keywords for each category
    const KEYWORDS = {
        'portfolio': ['portfolio', 'showcase', 'gallery', 'creative'],
        'ecommerce': ['ecommerce', 'store', 'shop', 'online business'],
        'blog': ['blog', 'articles', 'content', 'writing']
    };

    // Dynamically construct part of the system prompt with CATEGORY_LINKS
    const categoryLinksText = Object.entries(CATEGORY_LINKS)
        .map(([key, url]) => `[${key.charAt(0).toUpperCase() + key.slice(1)}](${url})`)
        .join(', ');

    // System prompt for the chatbot
    const SYSTEM_PROMPT = `You are a friendly, conversational chatbot for getbusinesswebsite.online, offering instant prebuilt websites with hosting in under 24 hours. Provide engaging, concise answers in a casual tone, like chatting with a friend. Always use these markdown links when relevant: ${categoryLinksText}. Never use placeholders like [YOUR_PORTFOLIO_LINK]. 

    For questions about website types, list our offerings: [Portfolio Website](https://getbusinesswebsite.online/portfolio), [Ecommerce Website](https://getbusinesswebsite.online/ecommerce), [Blog Website](https://getbusinesswebsite.online/blog). 

    Maintain conversation context using previous messages. Answer FAQs (e.g., setup time: 'under 24 hours', payment methods: 'cash or mobile money', customization: 'basic tweaks available') and provide [Contact Support](https://getbusinesswebsite.online/support) for complex queries. 

    Avoid vague responses like 'I'm not quite sure' and always aim to be helpful. If the user asks about something unrelated, gently guide them back to our services.`;

    // Load chat history from localStorage or initialize empty array
    let chatHistory = JSON.parse(localStorage.getItem('chatHistory')) || [];

    // Simple markdown-to-HTML converter for links
    function markdownToHtml(text) {
        return text.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>');
    }

    // Basic HTML sanitization (allows only <a> tags with href, target, rel)
    function sanitizeHtml(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        const allowedTags = ['A'];
        const allowedAttributes = ['href', 'target', 'rel'];
        const elements = div.getElementsByTagName('*');
        for (let i = elements.length - 1; i >= 0; i--) {
            const element = elements[i];
            if (!allowedTags.includes(element.tagName)) {
                element.parentNode.removeChild(element);
                continue;
            }
            for (let attr of element.attributes) {
                if (!allowedAttributes.includes(attr.name)) {
                    element.removeAttribute(attr.name);
                }
            }
        }
        return div.innerHTML;
    }

    // Function to add user messages and save to history
    function addUserMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'user-message';
        messageDiv.textContent = message;
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        chatHistory.push({ role: 'user', content: message });
        localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
    }

    // Function to add bot messages with a typing effect
    function addTypingEffect(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'bot-message';
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        let i = 0;
        const typingSpeed = 25; // Adjust this value to change the typing speed

        function type() {
            if (i < message.length) {
                const currentText = message.substring(0, i + 1);
                const htmlMessage = markdownToHtml(currentText);
                messageDiv.innerHTML = sanitizeHtml(htmlMessage);
                i++;
                setTimeout(type, typingSpeed);
            } else {
                // Once typing is complete, save the full message to history
                chatHistory.push({ role: 'assistant', content: message });
                localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
            }
        }
        type();
    }

    async function sendMessage(message) {
        const userMessage = message.toLowerCase().trim();
        let botMessage = '';

        // Check for specific queries and provide a custom, pre-defined response
        if (userMessage.includes('portfolio')) {
            botMessage = 'Our [Portfolio Website](https://getbusinesswebsite.online/portfolio) is perfect for showcasing your work—sleek, professional, and ready in under 24 hours!';
        } else if (userMessage.includes('ecommerce') || userMessage.includes('store') || userMessage.includes('shop')) {
            botMessage = 'Our [Ecommerce Website](https://getbusinesswebsite.online/ecommerce) is designed for online stores, making it easy for you to sell your products. Get yours up and running today!';
        } else if (userMessage.includes('blog')) {
            botMessage = 'Ready to share your thoughts? Our [Blog Website](https://getbusinesswebsite.online/blog) is user-friendly and great for publishing your content.';
        } else if (userMessage.includes('types of websites') || userMessage.includes('what kind of websites')) {
            botMessage = `We offer three main types of websites: [Portfolio Website](https://getbusinesswebsite.online/portfolio), [Ecommerce Website](https://getbusinesswebsite.online/ecommerce), and [Blog Website](https://getbusinesswebsite.online/blog). Which one are you interested in?`;
        }

        if (botMessage) {
            // If a specific query was found, use the custom message with typing effect
            addTypingEffect(botMessage);
        } else {
            // Otherwise, proceed with the API call to the AI model
            try {
                // Include last 4 messages for context
                const messages = [
                    { role: 'system', content: SYSTEM_PROMPT },
                    ...chatHistory.slice(-4),
                    { role: 'user', content: message }
                ];

                const response = await fetch('https://api.together.xyz/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${TOGETHER_API_KEY}`
                    },
                    body: JSON.stringify({
                        model: 'meta-llama/Llama-3.3-70B-Instruct-Turbo-Free',
                        messages,
                        max_tokens: 500,
                        temperature: 0.7
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                let apiBotMessage = data.choices[0]?.message?.content || 'Sorry, I encountered an error. Please try again or [Contact Support](https://getbusinesswebsite.online/support).';

                // Fallback for irrelevant responses
                if (!apiBotMessage.trim() || apiBotMessage.includes('I don’t have enough information') || apiBotMessage.includes('I’m not quite sure')) {
                    apiBotMessage = `I can help with our instant website services! Try asking about [Portfolio Website](https://getbusinesswebsite.online/portfolio), [Ecommerce Website](https://getbusinesswebsite.online/ecommerce), or [Blog Website](https://getbusinesswebsite.online/blog), or [Contact Support](https://getbusinesswebsite.online/support) for more help.`;
                }

                addTypingEffect(apiBotMessage);
            } catch (error) {
                console.error('Error:', error);
                addTypingEffect('Sorry, I encountered an error. Please try again or [Contact Support](https://getbusinesswebsite.online/support).');
            }
        }
    }

    // Handle input when user presses Enter
    chatbotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            const message = this.value.trim();
            addUserMessage(message);
            sendMessage(message);
            this.value = '';
        }
    });

    // Handle send button click
    chatbotSend.addEventListener('click', function() {
        if (chatbotInput.value.trim()) {
            const message = chatbotInput.value.trim();
            addUserMessage(message);
            sendMessage(message);
            chatbotInput.value = '';
        }
    });

    // Toggle chatbot visibility
    chatbotTrigger.addEventListener('click', function() {
        chatbotContainer.style.display = chatbotContainer.style.display === 'none' ? 'block' : 'none';
    });

    chatbotClose.addEventListener('click', function() {
        chatbotContainer.style.display = 'none';
    });

    // Initial greeting message with typing effect
    setTimeout(() => {
        const initialGreeting = 'Welcome to GetBusinessWebsite.online! Ready to get your website live in under 24 hours? Ask about [Portfolio Website](https://getbusinesswebsite.online/portfolio), [Ecommerce Website](https://getbusinesswebsite.online/ecommerce), or how to buy!';
        addTypingEffect(initialGreeting);
    }, 500);

    // Load previous messages from localStorage without typing effect
    chatHistory.forEach(msg => {
        if (msg.role === 'user') {
            addUserMessage(msg.content);
        } else {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'bot-message';
            const htmlMessage = markdownToHtml(msg.content);
            messageDiv.innerHTML = sanitizeHtml(htmlMessage);
            chatbotMessages.appendChild(messageDiv);
        }
    });
});
 