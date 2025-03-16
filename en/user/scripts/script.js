 // Mobile menu toggle
 document.querySelector('.mobile-menu').addEventListener('click', function() {
    document.querySelector('.side_panel').classList.toggle('active');
});

// Close mobile menu when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.side_panel') && !e.target.closest('.mobile-menu')) {
        document.querySelector('.side_panel').classList.remove('active');
    }
});