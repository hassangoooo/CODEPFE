<?php
ob_start();
?>
<div id="menu">
    <h2>Notre Menu</h2>
    <div id="plats-container">
        <!-- Les plats publiés seront affichés ici via JavaScript -->
    </div>
</div>
<script>
 let panier = [];
let montantTotal = 0;

// Afficher le nombre d'articles dans le panier
const compteurPanier = document.getElementById("cart-count");

// Fonction pour ajouter un plat au panier
function ajouterAuPanier(plat) {
    panier.push(plat);
    montantTotal += parseFloat(plat.prix_plat);
    compteurPanier.textContent = panier.length;
    console.log("Plat ajouté au panier :", plat);
}

// Fonction pour afficher le panier
function afficherPanier() {
    const platsContainer = document.getElementById("plats-container");
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

        const total = document.createElement("h3");
        total.textContent = `Total: ${montantTotal.toFixed(2)} €`;
        divPanier.appendChild(total);

        const btnCommander = document.createElement("button");
        btnCommander.setAttribute("class", "btn btn-success");
        btnCommander.textContent = "Passer commande";
        btnCommander.addEventListener("click", passerCommande);
        divPanier.appendChild(btnCommander);
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
}

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

// Fonction pour afficher les plats publiés
function afficherPlatsPublies(data) {
    const platsContainer = document.getElementById("plats-container");
    platsContainer.innerHTML = ""; // Vider le conteneur avant d'ajouter les plats

    if (data.length === 0) {
        platsContainer.innerHTML = "<p>Aucun plat publié.</p>";
        return;
    }

    data.forEach(plat => {
        let card = document.createElement("div");
        card.setAttribute("class", "card");
        card.setAttribute("style", "width: 20rem; margin: 10px;");

        let image = document.createElement("img");
        image.setAttribute("class", "card-img-top");
        image.setAttribute("src", `${plat.image_de_cuisinieres}`);
        image.setAttribute("alt", plat.nom_cuisinieres    );
        image.setAttribute("style", "height: 10rem; object-fit: cover;");

        let cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        let title = document.createElement("h5");
        title.setAttribute("class", "card-title");
        title.textContent = plat.nom_cuisinieres;

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
        button.addEventListener("click", () => ajouterAuPanier(plat));

        cardBody.appendChild(title);
        cardBody.appendChild(description);
        cardBody.appendChild(price);
        cardBody.appendChild(typePlat);
        card.appendChild(button);
        card.appendChild(image);
        card.appendChild(cardBody);

        platsContainer.appendChild(card);
    });
}

// Récupérer les plats publiés via l'API
(async function getPlatsData() {
    let response = await fetch("index.php?route=getallCuisinieres")
        .then(response => response.json())
        .catch(error => console.error("Erreur lors de la récupération des cuisinières :", error));

    platsData = response;
    afficherPlatsPublies(platsData);
    console.log(platsData);
})();
</script>
<?php
$content = ob_get_clean();
require_once(__DIR__ . '/layout.php');
?>