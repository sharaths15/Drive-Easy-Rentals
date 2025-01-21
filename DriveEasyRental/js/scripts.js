document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll(".slider img");
    let currentIndex = 0;

    function showNextImage() {
        images[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add("active");
    }

    images[0].classList.add("active"); // Show the first image initially
    setInterval(showNextImage, 3000); // Change image every 3 seconds
});
