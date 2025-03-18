document.addEventListener("DOMContentLoaded", function () {
    const preview = document.querySelector(".preview");
    const upButton = document.querySelector(".mov.up");
    const downButton = document.querySelector(".mov.down");
    let scrollInterval;
    let isScrolling = false;

    function startScrolling(direction) {
        if (isScrolling) return;
        isScrolling = true;
        scrollInterval = setInterval(() => {
            preview.scrollBy({ top: direction * 2, behavior: "auto" });
        }, 10);
    }

    function stopScrolling() {
        if (!isScrolling) return;
        isScrolling = false;
        clearInterval(scrollInterval);

        // Apply inertia effect
        let inertiaSpeed = 20; 
        let deceleration = 0.98;
        
        function applyInertia() {
            if (Math.abs(inertiaSpeed) < 0.5) return;
            preview.scrollBy({ top: inertiaSpeed, behavior: "auto" });
            inertiaSpeed *= deceleration;
            requestAnimationFrame(applyInertia);
        }
        setTimeout(applyInertia, 800);
    }

    upButton.addEventListener("mousedown", () => startScrolling(-1));
    downButton.addEventListener("mousedown", () => startScrolling(1));
    document.addEventListener("mouseup", stopScrolling);
});
