<?php
ob_start();
?>
        <h1> Pour les Clients</h1>
<section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Connexion</h2>
								</div>
							</div>
							<div class="col-xs-12">
									<form id="login-form"  method="post" action="index.php?route=loginClient">
                                    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Votre Email*" style="width:100%" required>
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<br>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Votre Password*" style="width:100%" required>
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									<br>
									<div class="contact-btn">
										<button type="submit" class="fv-btn" >Connexion</button>
									</div>
								</form>
								<div class="form-output login_msg ">
									<p class="form-messege field_error "></p>
								</div>
							</div>
						</div> 
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Créer un compte</h2>
								</div>
							</div>
							<div class="col-xs-12">
							<form id="register-form" method="post" action="index.php?route=registerClient">
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="nom" name="nom" placeholder="Votre nom*" style="width:100%" required>
        </div>
        <span class="field_error" id="nom_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom*" style="width:100%" required>
        </div>
        <span class="field_error" id="prenom_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="email" id="email" name="email" placeholder="Votre Email*" style="width:100%" required>
        </div>
        <span class="field_error" id="email_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="telephone" name="telephone" placeholder="Votre Téléphone*" style="width:100%" required>
        </div>
        <span class="field_error" id="telephone_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="adresse" name="adresse" placeholder="Votre Adresse*" style="width:100%"required>
        </div>
        <span class="field_error" id="adresse_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="ville" name="ville" placeholder=" votre ville*" style="width:100%" required>
        </div>
        <span class="field_error" id="confirm_ville_error"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="text" id="num_departement" name="num_departement" placeholder="Votre num_departement*" style="width:100%" required>
        </div>
        <span class="field_error" id="num_departement"></span>
    </div>
    <br>
    <div class="single-contact-form">
        <div class="contact-box name">
            <input type="password" id="password" name="password" placeholder="Votre Password*" style="width:100%" required>
        </div>
        <span class="field_error" id="password_error"></span>
    </div>
    <br>
    <div class="contact-btn">
        <button type="submit" class="fv-btn">Créer un Compte</button>
    </div>
</form>
								<div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
		
<?php
$content = ob_get_clean();
require_once('layout.php');
?>
