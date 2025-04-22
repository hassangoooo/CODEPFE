<?php
ob_start();
?>
<style>
  
div #imgprofile{
  
  width: 100px;
  height: 100px;
  background-size: cover;
  background-image: url('<?= htmlspecialchars($info['image_de_cuisinieres']); ?>');
  border-radius: 100px;
  display: flex;
  justify-content: center;
  align-items: center;


}
div #imgprofile::before{
width: 100px;
height: 100px;
content: '';
position: absolute;
border-radius: 430px;
padding: 10px;
}
#deconnexion{
    display: flex;
    justify-content: center;
    color: black;
    text-align: center;
    margin: auto;
}

</style>
<div id="profile-container">
    <h2>Bienvenue <?= htmlspecialchars($info['prenom_cuisinieres'] . ' ' . $info['nom_cuisinieres']); ?></h2>
    <div id="imgprofile"></div>
    <button id="deconnexion"><a href="index.php?route=logoutCuisiniere">Déconnexion</a></button>
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
        <div class="contact-btn">
            <button type="submit" class="fv-btn">Publier</button>
        </div>
    </form>
</div>
<div class="published-plats">
    <h3>Vos plats publiés</h3>
    <?php foreach ($plats as $plat): ?>
        <div class="plat">
            <h4><?= htmlspecialchars($plat['nom_plat']); ?> (<?= htmlspecialchars($plat['type_plat']); ?>)</h4>
            <p><?= htmlspecialchars($plat['description']); ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($plat['prix']); ?> €</p>
            <img src="<?= htmlspecialchars($plat['image']); ?>" alt="Image du plat" style="width: 200px;">
        </div>
    <?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require_once 'layout.php';
?> 