const panier =document.getElementById("cart-count");
const fermer = document.getElementById("close");


function toggleCart() {
    const cartContainer = document.getElementById('cart-container');
    cartContainer.classList.toggle('active');
}
panier.addEventListener('click', toggleCart);
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

const notremain = document.getElementById("notre-main");
const cuisinemarocaine = document.getElementById("cuisinemarocaine");
const cuisineukrainienne = document.getElementById("cuisineukrainienne");

function CuisineMarocaine(params) {
    notremain.innerHTML= "";
    const div1 = document.createElement('div');
    const div2 = document.createElement('div');
    const img = document.createElement('img');
    const h2 = document.createElement('h2');

    const button = document.createElement('button');
    div1.className = "card";
    div1.style.width = "18rem";
    div2.className = "card-body";
    img.src = "/codestage/src/images/cuisiniere1.jpeg";
    img.style.width = "100%";
    img.style.height = "200px";
    img.className = "card-img-top";
    img.alt = "couscous";
    h2.textContent = "sarah";
    button.textContent = "Voir le profil";

    
    div1.appendChild(img);
    div2.appendChild(h2);
  
    div2.appendChild(button);
    div1.appendChild(div2);
    notremain.appendChild(div1);

}
cuisinemarocaine.addEventListener('click',CuisineMarocaine);

function CuisineUkrainienne(params) {
    notremain.innerHTML= "";
}
cuisineukrainienne.addEventListener('click',CuisineUkrainienne);