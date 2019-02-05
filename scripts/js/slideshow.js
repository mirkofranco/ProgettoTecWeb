var currentSlide;
showSlideshowContainer();

function showSlideshowContainer() {
    var container = document.getElementsByClassName("slideshow-container")[0];

    container.classList.remove("hidden");
    container.removeAttribute("hidden");

    currentSlide = 0;
    showSlides(currentSlide);
}

function plusSlides(n) {
    showSlides(currentSlide += n);
}

function showSlides(n) {
    var slides = document.getElementsByClassName("slideshow-element");
    var dots = document.getElementsByClassName("dot");

    if (dots.length !== slides.length) {
        console.error("non ci sono tanti dot quante immagini");
    }

    if (n >= slides.length) {
        currentSlide = 0;
    }
    if (n < 0) {
        currentSlide = slides.length - 1;
    }
    for (var i = 0; i < slides.length; i++) {
        hide(slides[i]);

        dots[i].classList.remove("dotactive");
    }

    show(slides[currentSlide]);

    dots[currentSlide].classList.add("dotactive");
}

function hide(element) {
    element.classList.add("hidden");
    element.setAttribute("hidden", "hidden");
}

function show(element) {
    element.classList.remove("hidden");
    element.removeAttribute("hidden");
}
