document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slides img");
    const playButton = document.getElementById("playButton");
    const replayCheckbox = document.getElementById("replayCheckbox");
    const timeSelect = document.getElementById("timeSelect");

    let currentSlide = 0;
    let intervalId;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add("active");
            } else {
                slide.classList.remove("active");
            }
        });
    }

    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            if (replayCheckbox.checked) {
                currentSlide = 0;
            } else {
                clearInterval(intervalId);
                playButton.textContent = "Play!";
                return;
            }
        }
        showSlide(currentSlide);
    }

    playButton.addEventListener("click", function() {
        if (playButton.textContent === "Play!") {
            intervalId = setInterval(nextSlide, parseInt(timeSelect.value)); 
            playButton.textContent = "Pause"; 
        } else {
            clearInterval(intervalId);
            playButton.textContent = "Play!"; 
        }
    });

});
