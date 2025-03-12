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
            const response = await fetch(`../../backend/search_templates.php?term=${encodeURIComponent(searchTerm)}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Search results:', data); // Debug log
            
            if (data.length > 0) {
                const resultsHtml = data.map(template => `
                    <div class="search-result-item" onclick="location.href='../checkout?id=${template.id}'">
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