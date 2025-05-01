<?php
ob_start();
?>
<div id="menu">
    <h2>Notre Menu</h2>
    <div id="cuisinieres-container">
        <!-- Les plats publiés seront affichés ici via JavaScript -->
    </div>
</div>
<script>
    

// Récupérer les plats publiés via l'API
(async function getPlatsData() {
    let response = await fetch("index.php?route=getallCuisinieres")
        .then(response => response.json())
        .catch(error => console.error("Erreur lors de la récupération des cuisinières :", error));

    cuisinieresData = response;
    afficherPlatsPublies(cuisinieresData);
    console.log(cuisinieresData);
})();


// Fonction pour afficher les plats publiés
function afficherPlatsPublies(data) {
    const platsContainer = document.getElementById("cuisinieres-container");
    platsContainer.innerHTML = ""; // Vider le conteneur avant d'ajouter les plats

    if (data.length === 0) {
        platsContainer.innerHTML = "<p>Aucun plat publié.</p>";
        return;
    }

    data.forEach(cuisinieres => {
        let card = document.createElement("div");
        card.setAttribute("class", "card col-md-4 mb-4");
        card.setAttribute("class", "width: 20rem; margin: 10px;");
        let image = document.createElement("img");
        image.setAttribute("class", "card-img-top");
        image.setAttribute("src", `${cuisinieres.image_de_cuisinieres}`);
        image.setAttribute("alt", cuisinieres.nom_cuisinieres    );
        image.setAttribute("style", "height: 10rem; object-fit: cover;");
        let cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");
        let title = document.createElement("h5");
        title.setAttribute("class", "card-title");
        title.textContent = cuisinieres.nom_cuisinieres;
        let description = document.createElement("p");
        description.setAttribute("class", "card-text");
        description.textContent = cuisinieres.description;
        let button = document.createElement("button");
        button.setAttribute("class", "btn btn-primary");
        button.textContent = "Voir le profile";
        button.addEventListener("click", () => {
            window.location.href = `index.php?route=voirProfilCuisiniere&id=${cuisinieres.Id_Cuisinieres}`;
        });
        console.log('ici');
        console.log(cuisinieres.Id_Cuisinieres);
        cardBody.appendChild(title);
        cardBody.appendChild(description);
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