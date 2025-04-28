
<?php 
ob_start();
?>
    <div class="content">
        <h1>🍽️ Bienvenue sur Tortiki – La Cuisine Fait Maison Près de Chez Vous ! 🍽️

</h1>
        <p>Vous rêvez de déguster de bons petits plats faits maison, préparés avec amour par des cuisinières passionnées près de chez vous ? Ne cherchez plus ! Sur TORTIKI, découvrez une sélection de plats authentiques concoctés par des talents locaux.
🔥 Fait maison avec amour
🥗 Ingrédients frais et de saison
Commandez facilement et régalez-vous sans passer des heures en cuisine. Nos cuisinières mettent tout leur savoir-faire pour vous offrir des saveurs uniques et gourmandes.
🍛 Explorez nos plats et passez commande dès maintenant ! </p>
    </div>

    
    <div class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image1.jpeg" alt="Image 1">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image2.jpg" alt="Image 2">
               
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image3.jpg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image4.jpg" alt="Image 3">
               
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image5.jpg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image6.jpeg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image7.jpg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image8.jpeg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image9.jpeg" alt="Image 3">
               
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image10.jpeg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image11.jpeg" alt="Image 3">
                
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image12.jpeg" alt="Image 3">
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image13.jpeg" alt="Image 3">
            </div>
            <div class="carousel-slide">
                <img src="/CODEPFE/src/images/image14.jpeg" alt="Image 3">
            </div>
        </div>
        <button class="nav-button prev">&#10094;</button>
        <button class="nav-button next">&#10095;</button>
        <div class="dots"></div>
    </div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?> 