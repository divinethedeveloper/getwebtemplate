// Function to remove gif loading animation
function remove_gif(element) {
    const gif = element.querySelector('.gif');
    if (gif) {
        gif.classList.add('active');
    }
}

// Add intersection observer to handle gif removal automatically
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                remove_gif(entry.target);
            }, 1000);
        }
    });
});

// Observe all template elements
document.addEventListener('DOMContentLoaded', () => {
    const templates = document.querySelectorAll('.template');
    templates.forEach(template => {
        observer.observe(template);
    });
}); 