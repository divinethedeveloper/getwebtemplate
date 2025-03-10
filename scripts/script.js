setTimeout(() => {

    toggle_items(".bg1_c");
    toggle_items(".bg1");



    
}, 2000);

function toggle_items(item_name){
    element = document.querySelector(item_name);
    element.classList.toggle("active");
}
function add_items(item_name){
    element = document.querySelector(item_name);
    element.classList.add("active");
}
function remove_items(item_name){
    element = document.querySelector(item_name);
    element.classList.remove("active");
}



function remove_gif() {
  console.log("remove_gif");
const gifs = Array.from(document.querySelectorAll('.gif')); // Select all .gif elements
const usedIndexes = new Set(); // Track used indexes to avoid duplicates

function addActiveClass() {
    if (usedIndexes.size === gifs.length) {
        // Stop once all gifs have been activated
        return;
    }

    let randomIndex;
    do {
        randomIndex = Math.floor(Math.random() * gifs.length); // Get a random index
    } while (usedIndexes.has(randomIndex)); // Ensure the index hasn't been used

    usedIndexes.add(randomIndex); // Mark the index as used
    gifs[randomIndex].classList.add('active'); // Add the 'active' class

    // Schedule the next activation
    setTimeout(addActiveClass, 500); // Delay of 0.5 seconds
}

addActiveClass(); // Start the activation process
}
remove_gif();



document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');

    container.addEventListener('scroll', () => {
        const scrollTop = container.scrollTop; // Current scroll position from the top
        const scrollHeight = container.scrollHeight - container.clientHeight; // Total scrollable height
        const scrollPercentage = (scrollTop / scrollHeight) * 100;

        if (scrollPercentage > 1) {
            // Perform the desired action
            add_items(".nav");
         }
        else{
            remove_items(".nav");


        }
    });
});







const wrap = document.querySelector('.wrap');
const shots = document.querySelectorAll('.shot');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const nextBtn2 = document.getElementById('next2');
const content = document.querySelector('.content'); // Select the content div

let currentIndex = 0;
const colors = [
  '#FFB3A6', // Very light Vibrant Orange
  '#B3FFB3', // Very light Fresh Green
  '#A6B3FF', // Very light Bold Blue
  '#FFF5A6', // Very light Sun Yellow
  '#D0A8E5', // Very light Deep Purple
  '#FFB3B3', // Very light Bright Red
  '#B3F2F2', // Very light Soft Teal
  '#B0C4D4', // Very light Cool Grey
  '#B3FFB3', // Very light Spring Green
  '#FFE6A6', // Very light Warm Amber
];

// Add smooth transition for transform property
wrap.style.transition = "transform 2s cubic-bezier(0.25, 0.1, 0.25, 1)"; // 1s transition with custom easing

function updateActiveShot(index) {
  // Remove active class from all shots
  shots.forEach(shot => shot.classList.remove('active'));

  // Add active class to the current shot
  shots[index].classList.add('active');

  // Scroll the wrap container by 70vh (translated to rem for consistency with your styles)
  const scrollAmount = 15 * index;
  wrap.style.transform = `translateX(-${scrollAmount}rem)`;

  // Change the background with a smooth transition
  const selectedColor = colors[index % colors.length];
  content.style.background = selectedColor; // Smoothly transition the color
}

nextBtn.addEventListener('click', () => {
  if (currentIndex < shots.length - 1) {
    currentIndex++;
    updateActiveShot(currentIndex);
  } else {
    // Reset to the first shot for infinite scrolling
    currentIndex = 0;
    updateActiveShot(currentIndex);
  }
});

nextBtn2.addEventListener('click', () => {
  if (currentIndex < shots.length - 1) {
    currentIndex++;
    updateActiveShot(currentIndex);
  }
});
prevBtn.addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateActiveShot(currentIndex);
  } else {
    // Reset to the last shot for infinite scrolling
    currentIndex = shots.length - 1;
    updateActiveShot(currentIndex);
  }
});

// Initial setup
updateActiveShot(currentIndex);