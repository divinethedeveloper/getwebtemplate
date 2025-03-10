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
    <div class="logo cen">
        <a href="/" title="Get Business Website - Professional Business Websites">
            <img src="./assets/logo/getbusinesswebsite-logo.png" alt="Get Business Website Logo - Professional Website Solutions" width="auto" height="auto">
        </a>
    </div>
    <div class="cart cen">
        <a href="/cart" title="View Shopping Cart" aria-label="Shopping Cart">
            <i class="bi bi-bag"></i>
        </a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let typingTimer;
    const doneTypingInterval = 300;

    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        if (searchInput.value) {
            typingTimer = setTimeout(fetchResults, doneTypingInterval);
        } else {
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }
    });

    async function fetchResults() {
        const searchTerm = searchInput.value;
        try {
            const response = await fetch(`backend/search_templates.php?term=${encodeURIComponent(searchTerm)}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Search results:', data); // Debug log
            
            if (data.length > 0) {
                const resultsHtml = data.map(template => `
                    <div class="search-result-item" onclick="location.href='templates/?id=${template.id}'">
                        <div class="result-name">${template.name}</div>
                    </div>
                `).join('');
                
                searchResults.innerHTML = resultsHtml;
                searchResults.style.display = 'block';
            } else {
                searchResults.innerHTML = '<div class="no-results">No templates found</div>';
                searchResults.style.display = 'block';
            }
        } catch (error) {
            console.error('Search error:', error); // Debug log
            searchResults.innerHTML = '<div class="no-results">Error fetching results. Please try again.</div>';
            searchResults.style.display = 'block';
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-container')) {
            searchResults.style.display = 'none';
        }
    });
});
</script>