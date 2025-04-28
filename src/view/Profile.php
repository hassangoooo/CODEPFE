<?php
ob_start();
?>       
<div id="profile-container">
    <h2>Bienvenue <?=htmlspecialchars($info['prenom_cuisinieres'].' '. $info['nom_cuisinieres']);?></h2>
    <div id="imgprofile" style="background-image: url('<?= htmlspecialchars($info['image_de_cuisinieres']); ?>');"></div>
    <button id="btnlogout" class="btn btn-danger" style="margin-top: 20px;"><a href="index.php?route=logoutCuisiniere">Déconnexion</a></button>
</div>

<div class="right">
    <h3>Publier un plat préparé</h3>
    <form id="publish-form" method="post" action="index.php?route=ajouterPlat" enctype="multipart/form-data">
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" name="nom_plat" placeholder="Nom du plat*" style="width:100%" required>
        </div>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <textarea name="description" placeholder="Description du plat*" style="width:100%" required></textarea>
        </div>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <select name="type_plat" style="width:100%" required>
                <option value="" disabled selected>Type de plat*</option>
                <option value="entrée">Entrée</option>
                <option value="plat principal">Plat principal</option>
                <option value="dessert">Dessert</option>
            </select>
        </div>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="number" name="prix" placeholder="Prix (€)*" style="width:100%" required>
        </div>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="file" name="image" accept="image/*" required>
        </div>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <textarea name="description_image" placeholder="Description de l'image*" style="width:100%" required></textarea>
        </div>
    </div>
    <br>
    <div class="contact-btn">
        <button type="submit" class="fv-btn">Publier</button>
    </div>
</form>
</div>
<!-- filepath: c:\xampp\htdocs\CODEPFE\src\view\Profile.php -->
<div class="left">
    <h3>Mes plats publiés</h3>
    <div id="plats-container">
        <!-- Les plats publiés seront affichés ici via JavaScript -->
    </div>
</div>
<script>
    let platsData = [];


// Récupérer les plats publiés via l'API
(async function getPlatsData() {
    let response = await fetch("index.php?route=getPublishedPlats")
        .then(response => response.json())
        .catch(error => console.error("Erreur lors de la récupération des plats :", error));

    platsData = response;
    afficherPlatsPublies(platsData);
    console.log(platsData);
})();

// Fonction pour afficher les plats publiés
function afficherPlatsPublies(data) {
    const platsContainer = document.getElementById("plats-container");
    platsContainer.innerHTML = ""; // Vider le conteneur avant d'ajouter les plats

    if (data.length === 0) {
        platsContainer.innerHTML = "<p>Aucun plat publié.</p>";
        return;
    }
console.log(data);
    data.forEach(plat => {
        console.log(plat);
        let card = document.createElement("div");
        card.setAttribute("class", "card");
        card.setAttribute("style", "width: 20rem; margin: 10px;");

        let image = document.createElement("img");
        image.setAttribute("class", "card-img-top");
        image.setAttribute("src", `images/plats/${plat.image}`);
        image.setAttribute("alt", plat.nom_plat);
        image.setAttribute("style", "height: 10rem; object-fit: cover;");

        let cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        let title = document.createElement("h5");
        title.setAttribute("class", "card-title");
        title.textContent = plat.nom_plat;

        let description = document.createElement("p");
        description.setAttribute("class", "card-text");
        description.textContent = plat.description_image;

        let price = document.createElement("p");
        price.setAttribute("class", "card-text");
        price.textContent = `Prix : ${plat.prix_plat} €`;
        let typePlat = document.createElement("p");
        typePlat.setAttribute("class", "card-text");
        typePlat.textContent = `Type : ${plat.type_plat}`;
        let button = document.createElement("button");
        button.setAttribute("class", "btn btn-primary");
        button.textContent = "Ajouter au panier";


        cardBody.appendChild(title);
        cardBody.appendChild(description);
        cardBody.appendChild(typePlat);
        cardBody.appendChild(price);
        card.appendChild(image);
        
        card.appendChild(cardBody);
        card.appendChild(button);

        platsContainer.appendChild(card);
    });
}
</script>
<?php
$content = ob_get_clean();
require_once(__DIR__ . '/layout.php');
?>

