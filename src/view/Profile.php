<?php
ob_start();
?>       
<div id="profile-container">
    <h2>Bienvenue <?= htmlspecialchars($info['prenom_cuisinieres'] . ' ' . $info['nom_cuisinieres']); ?></h2>
    <img src="<?= htmlspecialchars($info['image_de_cuisinieres']); ?>" alt="Photo de profil" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
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
    let panier = [];
    let montantTotal = 0;
    
    const isClient = <?= isset($_SESSION['client_id']) ? 'true' : 'false'; ?>;


    // Afficher le nombre d'articles dans le panier
    const compteurPanier = document.getElementById("cart-count");

    // Récupérer les plats publiés via l'API
    (async function getPlatsData() {
        try {
            let response = await fetch("index.php?route=getPublishedPlats");
            platsData = await response.json();
            afficherPlatsPublies(platsData);
            console.log("Plats récupérés :", platsData);
        } catch (error) {
            console.error("Erreur lors de la récupération des plats :", error);
        }
    })();

    // Fonction pour afficher les plats publiés
    function afficherPlatsPublies(data) {
        const platsContainer = document.getElementById("plats-container");
        platsContainer.innerHTML = ""; // Vider le conteneur avant d'ajouter les plats

        if (!Array.isArray(data) || data.length === 0) {
            platsContainer.innerHTML = "<p>Aucun plat publié.</p>";
            return;
        }

        data.forEach(plat => {
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

            let button = document.createElement("button");
            button.setAttribute("class", "btn btn-primary");
            button.textContent = "Ajouter au panier";
            button.addEventListener("click", () => ajouterAuPanier(plat));

            cardBody.appendChild(title);
            cardBody.appendChild(description);
            cardBody.appendChild(price);
            cardBody.appendChild(button);
            card.appendChild(image);
            card.appendChild(cardBody);

            platsContainer.appendChild(card);
        });
    }

    // Fonction pour ajouter un plat au panier
    function ajouterAuPanier(plat) {
        panier.push(plat);
        montantTotal += parseFloat(plat.prix_plat);
        compteurPanier.textContent = panier.length;
        console.log("Plat ajouté au panier :", plat);
        console.log("Contenu du panier :", panier);
    }

    // Fonction pour afficher le panier
    function afficherPanier() {
        const platsContainer = document.getElementById("cart");
        platsContainer.innerHTML = ""; // Vider le conteneur avant d'afficher le panier

        const divPanier = document.createElement("div");
        divPanier.setAttribute("class", "panier-container");

        const titre = document.createElement("h2");
        titre.textContent = "Votre Panier";
        divPanier.appendChild(titre);

        if (panier.length === 0) {
            const msgVide = document.createElement("p");
            msgVide.textContent = "Votre panier est vide";
            divPanier.appendChild(msgVide);
        } else {
            panier.forEach((plat, index) => {
                const Panier1 = document.createElement("div");
                Panier1.setAttribute("class", "panier");

                const img = document.createElement("img");
                img.setAttribute("src", `images/plats/${plat.image}`);
                img.setAttribute("style", "width: 100px;");

                const nom = document.createElement("h3");
                nom.textContent = plat.nom_plat;

                const prix = document.createElement("p");
                prix.textContent = `${parseFloat(plat.prix_plat).toFixed(2)} €`;

                const btnSupprimer = document.createElement("button");
                btnSupprimer.setAttribute("class", "btn btn-danger");
                btnSupprimer.textContent = "Supprimer";
                btnSupprimer.addEventListener("click", () => supprimerDuPanier(index));

                Panier1.appendChild(img);
                Panier1.appendChild(nom);
                Panier1.appendChild(prix);
                Panier1.appendChild(btnSupprimer);
                divPanier.appendChild(Panier1);
            });

            const total = document.getElementById("total");
            total.textContent = `${montantTotal.toFixed(2)} `;
            

           // Désactiver le bouton si l'utilisateur n'est pas un client
        if (!isClient) {
            btnCommander.disabled = true;
            btnCommander.textContent = "Connectez-vous pour commander";
        } else {
            btnCommander.addEventListener("click", passerCommande);
        }

        divPanier.appendChild(btnCommander);
    }

        }

        const btnRetour = document.createElement("button");
        btnRetour.setAttribute("class", "btn btn-primary");
        btnRetour.textContent = "Retour au menu";
        btnRetour.addEventListener("click", () => {
            platsContainer.innerHTML = "";
            afficherPlatsPublies(platsData);
        });
        divPanier.appendChild(btnRetour);

        platsContainer.appendChild(divPanier);
    

    // Fonction pour supprimer un plat du panier
    function supprimerDuPanier(index) {
        montantTotal -= parseFloat(panier[index].prix_plat);
        panier.splice(index, 1);
        compteurPanier.textContent = panier.length;
        afficherPanier();
    }

    // Fonction pour passer une commande
    function passerCommande() {
        if (panier.length > 0) {
            alert("Commande passée avec succès !");
            panier = [];
            montantTotal = 0;
            compteurPanier.textContent = "0";
            afficherPanier();
        } else {
            alert("Votre panier est vide !");
        }
    }

    // Ajouter un événement pour afficher le panier
    const btnPanier = document.getElementById("cart-count");
    btnPanier.addEventListener("click", afficherPanier);
</script>
<?php
$content = ob_get_clean();
require_once(__DIR__ . '/layout.php');
?>

