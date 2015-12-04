<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
	<?php 

    include_once('../../include/functions/functions.php');
	include_once('../../include/config.php');
	//include('includes/information.php');
	include_once("../../include/head.php");
	?>


  <body class="container">
  
	<!-- Entete -->

	<?php require_once("../../include/header.php") ?>
	<!-- Fin Entete -->
	<!-- Centre -->
		<div class="container" id="center_inscription">
		
				<?php

			
					if( empty($_GET['inscript']) )
					{
					?>
					<div class="row">

							<div class="col-sm-6">

								<h1> Formulaire d'inscription </h1>
								<form method="POST" action="trait-inscription.php" id="form_inscription">
									<!-- speudo -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"> </span> </span>
									<input type="text" name="pseudo"  id="pseudo"  class="form-control" placeholder="Pseudo (*)" value="<?php if($_SESSION['pseudo_info'] == '') echo htmlspecialchars($_SESSION['form_pseudo'], ENT_QUOTES) ; ?>"/>
									</div>

									<?php if( isset($_SESSION['pseudo_info']) && $_SESSION['pseudo_info'] != '') echo $_SESSION['pseudo_info']; ?>
									
									<!-- nom -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-user"> </span> </span>
										<input type="text" name="nom"  id="nom"  placeholder="Nom (*)" class="form-control" value="<?php if($_SESSION['nom_info'] == '') echo htmlspecialchars($_SESSION['form_nom'], ENT_QUOTES) ; ?>"/>
									</div>
									<?php if(isset($_SESSION['nom_info']) && $_SESSION['nom_info'] != '') echo $_SESSION['nom_info']; ?>
									
									<!-- prénom -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-user"> </span> </span>
									<input type="text" name="prenom" id="prenom" placeholder="Prénom (*)"  class="form-control" value="<?php if($_SESSION['prenom_info'] == '') echo htmlspecialchars($_SESSION['form_prenom'], ENT_QUOTES) ; ?>" />
									</div>
									<?php if(isset($_SESSION['prenom_info']) && $_SESSION['prenom_info'] != '') echo $_SESSION['prenom_info']; ?>
									
									<!-- date de naissance -->
									<label for="date_naissance"> Date de naissance(*):  </label>
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-calendar"> </span> </span>
									<input type="date" name="date_naissance" id="date_naissance"     class="form-control " value="<?php if($_SESSION['date_naissance_info'] == '') echo htmlspecialchars($_SESSION['form_date_naissance'], ENT_QUOTES) ; ?>"/>
									</div>

									<?php if( isset($_SESSION['date_naissance_info']) && $_SESSION['date_naissance_info'] != '') echo $_SESSION['date_naissance_info']; ?>
								
									<!-- mail -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-envelope"> </span> </span>
									<input type="email" name="mail" class="email form-control" id="email" placeholder="adresse email (*)" value="<?php if($_SESSION['mail_info'] == '') echo htmlspecialchars($_SESSION['form_mail'], ENT_QUOTES) ; ?>" />
									</div>
									<?php if(isset($_SESSION['mail_info']) && $_SESSION['mail_info'] != '') echo $_SESSION['mail_info']; ?>
									
									<!-- mail confirmation -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-envelope"> </span> </span>
									<input type="email" name="confirm_email" class="email form-control" id="c_email" placeholder="confirmez votre email (*)" value="<?php if($_SESSION['mail_verif_info'] == '') echo htmlspecialchars($_SESSION['form_mail_verif'], ENT_QUOTES) ; ?>" />
									</div>

									<?php if( isset($_SESSION['mail_verif_info']) && $_SESSION['mail_verif_info'] != '') echo $_SESSION['mail_verif_info']; ?>
									
									<!-- mot de passe -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-lock"> </span> </span>
									<input type="password" name="mdp" id="password" placeholder="mot de passe (*)" class="form-control"  value="<?php if($_SESSION['mdp_info'] == '') echo htmlspecialchars($_SESSION['form_mdp'], ENT_QUOTES) ; ?>" />
									</div>

									<?php if(isset($_SESSION['mdp_verif_info']) && $_SESSION['mdp_info'] != '') echo $_SESSION['mdp_info']; ?>
									
									<!-- mot de passe confirmation -->
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-lock"> </span> </span>
									<input type="password" name="mdp_verif" id="c_password" placeholder="Confirmez votre mot de passe (*)" class="form-control" value="<?php if($_SESSION['mdp_verif_info'] == '') echo htmlspecialchars($_SESSION['form_mdp_verif'], ENT_QUOTES) ; ?>"  />
									</div>

									<?php if(isset($_SESSION['mdp_verif_info']) && $_SESSION['mdp_verif_info'] != '') echo $_SESSION['mdp_verif_info']; ?><br/>
									

									
									<!-- image capchat -->
									<img src="includes/capchat.php" alt="image captcha" id="capchat" >
									<div class="input-group input-group-lg">
									  <span class="input-group-addon" id="sizing-addon1"> <span class="glyphicon glyphicon-lock"> </span> </span>
									<input type="tel" name="captcha" id="captchatIN"    placeholder="Entrez les caractères ci-dessus"  class="form-control "/>
									</div>

									<?php if( isset($_SESSION['captcha_info']) &&  $_SESSION['captcha_info'] != '') echo $_SESSION['captcha_info']; ?><br/>
									
									<!-- condition -->
									<span class="checkbox"></span>

									
									
									   <div class="input-group">
										  <span class="input-group-addon">
									<input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree" value="ok" <?php if(isset($_SESSION['agree_info']) && $_SESSION['agree_info'] == '') echo 'checked' ; ?> /> <a href="/Text/CGU.txt" /> J'accepte les conditions du site </a>
										  </span>
										 
										</div><!-- /input-group -->									
									
									<?php if( isset($_SESSION['agree_info']) && $_SESSION['agree_info'] != '') echo $_SESSION['agree_info']; ?><br/>
										
									<!-- submit button -->
									<input type="submit" name="inscription" id="submit_inscription" value="Inscrivez vous"/>
									<p style=" color:red; font-weight:bold"> (*) Champs obligatoire </p>
								</form>
								

							</div>
				<?php
 					}
					else
					{
 						$mail_result = checkmail($_SESSION['form_mail']);
						$pseudo_result = checkpseudo($_SESSION['form_pseudo']);
						if($mail_result=="exists" or $pseudo_result=="exists" )
						{
							
							echo '
								<div class="col-sm-6">
									<h1> Message d\'erreur !!! </h1>
									<img src="http://i.giphy.com/xjOXJ5HGLQkP6.gif" />
								</div>';
						}
						else
						{

							set_newUsers($_SESSION['form_nom'],$_SESSION['form_prenom'],$_SESSION['form_mdp'],$_SESSION['form_pseudo'],$_SESSION['form_date_naissance'],$_SESSION['form_mail']);
							
							echo '
								<div class="col-sm-6">
									<h1> Inscription réussie Youpi !!! </h1>
									<img src="http://i.giphy.com/xjOXJ5HGLQkP6.gif" />
								</div>';
							unset ($_SESSION['form_mail'],$_SESSION['form_pseudo'],$_SESSION['form_nom'],$_SESSION['form_prenom'],$_SESSION['form_date_naissance'],$_SESSION['form_mdp_verif'],$_SESSION['form_mdp'],$_SESSION['form_mail'],$_SESSION['form_mail_verif']);
						} 
					
					}
				?>

							<div class="col-sm-6" id="descSite" >
							<h1>Bienvenue sur Safelife!</h1>
							
							SafeLife est le site où il faut etre et etre vue en ce moment!
							Votre inscription vous permettra d'acceder completement au contenu de samoco.fr!
							Publiez des articles, des photos, des vidéos !
							Faites partager tous vos contenus multimédia avec vos amis!
							Ajouter des commentaires aux articles de vos amis!
							Votre flox vous appartient, vous pouvez supprimer ou modifier vos articles a tout moment.
							Décidez vous même des commentaires qui apparaissent sur vos articles!
							</div>
						
						</div>
		
		</div>
	<!-- fin Centre -->
	
	<!-- Pieds -->
	<div class="container containerIndex">
		<?php //require_once("footer.php")?>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="module.js"></script>
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="./bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>