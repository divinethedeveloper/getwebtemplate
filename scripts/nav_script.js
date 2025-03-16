
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.getElementById('search-toggle');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let typingTimer;
    const doneTypingInterval = 300;

    // Toggle search input on mobile
    searchToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent event bubbling
        if (window.innerWidth <= 769) {
            searchInput.classList.toggle('active');
            if (searchInput.classList.contains('active')) {
                setTimeout(() => {
                    searchInput.focus();
                }, 100);
            } else {
                searchResults.style.display = 'none';
            }
        }
    });

    // Search functionality
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
            const response = await fetch(`../../backend/search_templates.php?term=${encodeURIComponent(searchTerm)}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.length > 0) {
                const resultsHtml = data.map(template => `
                    <div class="search-result-item" onclick="location.href='../../en/checkout/?id=${template.id}'">
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
            console.error('Search error:', error);
            searchResults.innerHTML = '<div class="no-results">Error fetching results. Please try again.</div>';
            searchResults.style.display = 'block';
        }
    }

    // Close search input and results when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 769 && 
            !e.target.closest('.search-container')) {
            searchInput.classList.remove('active');
            searchResults.style.display = 'none';
        }
    });

    // Prevent search container clicks from closing
    searchInput.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Close search input on resize if window becomes larger than mobile breakpoint
    window.addEventListener('resize', function() {
        if (window.innerWidth > 769) {
            searchInput.classList.remove('active');
            if (!searchInput.value) {
                searchResults.style.display = 'none';
            }
        }
    });
});