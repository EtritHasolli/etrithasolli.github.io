document.addEventListener('DOMContentLoaded', () => {
  // Target the .images_down with orientation_horizontal class
  const container = document.querySelector('.images_down.orientation_horizontal');
  const isMobile = window.innerWidth <= 768;

  if (isMobile && container) {
    let scrollAmount = 0;
    const scrollSpeed = 1; // Pixels per frame
    const scrollInterval = 20; // Milliseconds
    let scrollTimer;

    const autoScroll = () => {
      scrollAmount += scrollSpeed;
      container.scrollLeft = scrollAmount;

      // Reset to start when reaching the end
      if (scrollAmount >= container.scrollWidth - container.clientWidth) {
        scrollAmount = 0;
      }
    };

    // Start auto-scrolling
    scrollTimer = setInterval(autoScroll, scrollInterval);

    // Pause on user interaction (touch)
    container.addEventListener('touchstart', () => clearInterval(scrollTimer));
    container.addEventListener('touchend', () => {
      scrollTimer = setInterval(autoScroll, scrollInterval); // Restart the interval
    });
  }
});