const Panier =document.getElementById("cart-count");
const fermer = document.getElementById("close");


function toggleCart() {
    const cartContainer = document.getElementById('cart-container');
    cartContainer.classList.toggle('active');
}
Panier.addEventListener('click', toggleCart);
fermer.addEventListener('click',toggleCart);



 
const container = document.querySelector('.carousel-container');
const slides = document.querySelectorAll('.carousel-slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const dotsContainer = document.querySelector('.dots');
let index = 0;

slides.forEach((_, i) => {
    const dot = document.createElement('span');
    dot.classList.add('dot');
    if (i === 0) dot.classList.add('active');
    dot.addEventListener('click', () => moveToSlide(i));
    dotsContainer.appendChild(dot);
});

function updateCarousel() {
    container.style.transform = `translateX(${-index * 600}px)`;
    document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
    document.querySelectorAll('.dot')[index].classList.add('active');
}

function moveToSlide(newIndex) {
    index = newIndex;
    updateCarousel();
}

nextButton.addEventListener('click', () => {
    index = (index + 1) % slides.length;
    updateCarousel();
});

prevButton.addEventListener('click', () => {
    index = (index - 1 + slides.length) % slides.length;
    updateCarousel();
});
