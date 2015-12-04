<?php
	//session_start();


	$bdd=connexionBDD();
						$_SESSION['erreurs'] = 0;
 
  						//Pseudo
 						if(isset($_POST['pseudo']))
						{
							//header('Location: index.php', false);
							//echo "oui";
							$pseudo = trim($_POST['pseudo']);
							$pseudo_result = checkpseudo($pseudo);
							//echo "speudo: ".$pseudo_result;
							if($pseudo_result == 'tooshort')
							{
								
								$_SESSION['pseudo_info'] = '<div class="alert alert-danger" role="alert"> '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</div>';
								$_SESSION['form_pseudo'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($pseudo_result == 'toolong')
							{
								$_SESSION['pseudo_info'] = '<div class="alert alert-danger" role="alert">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</div>';
								$_SESSION['form_pseudo'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($pseudo_result == 'exists')
							{
								$_SESSION['pseudo_info'] = '<div class="alert alert-danger" role="alert">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</div>';
								$_SESSION['form_pseudo'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($pseudo_result == 'ok')
							{
								$_SESSION['pseudo_info'] = '';
								$_SESSION['form_pseudo'] = $pseudo;
							}
							
							else if($pseudo_result == 'empty')
							{
								$_SESSION['pseudo_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de pseudo.</div>';
								$_SESSION['form_pseudo'] = '';
								$_SESSION['erreurs']++;
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						}
						
						//nom
 						if(isset($_POST['nom']))
						{
							$nom=trim($_POST['nom']);
							$nom_result=checknom($nom);
							if($nom_result == "empty")
							{
								$_SESSION['nom_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de nom.</div>';
								$_SESSION['form_nom'] = '';
								$_SESSION['erreurs']++;
							}
							else if ($nom_result== "toolong")
							{
								$_SESSION['nom_info'] = '<div class="alert alert-danger" role="alert">Le nom entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</div>';
								$_SESSION['form_nom'] = '';
								$_SESSION['erreurs']++;	
							}
							 else if ($nom_result== "nomatch")
							 {
								 $_SESSION['nom_info'] = '<div class="alert alert-danger" role="alert">Le nom entré contient des chiffres,Veuillez corriger cette erreur. </div>';
								 $_SESSION['form_nom'] = '';
								 $_SESSION['erreurs']++;	
								
							 }
							else
							{
								$_SESSION['nom_info'] = '';
								$_SESSION['form_nom'] = $nom;	
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						}
						
						//prenom
						if(isset($_POST['prenom']))
						{
							$prenom=trim($_POST['prenom']);
							$prenom_result=checknom($prenom);
							if($prenom_result == "empty")
							{
								$_SESSION['prenom_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de prenom.</div>';
								$_SESSION['form_prenom'] = '';
								$_SESSION['erreurs']++;
							}
							else if ($prenom_result== "toolong")
							{
								$_SESSION['nom_info'] = '<div class="alert alert-danger" role="alert">Le prenom entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</div>';
								$_SESSION['form_prenom'] = '';
								$_SESSION['erreurs']++;	
							}
							 else if ($prenom_result== "nomatch")
							 {
								 $_SESSION['prenom_info'] = '<span class="erreur">Le nom entré contient des chiffres,Veuillez corriger cette erreur. </span><br/>';
								 $_SESSION['form_prenom'] = '';
								 $_SESSION['erreurs']++;	
								
							 }
							else
							{
								$_SESSION['prenom_info'] = '';
								$_SESSION['form_prenom'] = $prenom;	
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						}

						//date de naissance
						if(isset($_POST['date_naissance']))
						{
							//echo $_POST['date_naissance'].'</br>';
							$date_naissance = trim($_POST['date_naissance']);
							$date_naissance_result = birthdate($date_naissance);
							//echo $date_naissance_result;
							if($date_naissance_result == 'format')
							{
								$_SESSION['date_naissance_info'] = '<div class="alert alert-danger" role="alert">Date de naissance au mauvais format ou invalide.</div>';
								$_SESSION['form_date_naissance'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($date_naissance_result == 'tooyoung')
							{
								$_SESSION['date_naissance_info'] = '<div class="alert alert-danger" role="alert">Agagagougougou areuh ? (Vous êtes trop jeune pour vous inscrire ici.)</div>';
								$_SESSION['form_date_naissance'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($date_naissance_result == 'tooold')
							{
								$_SESSION['date_naissance_info'] = '<div class="alert alert-danger" role="alert">Plus de 100 ans ? Mouais...</div>';
								$_SESSION['form_date_naissance'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($date_naissance_result == 'invalid')
							{
								$_SESSION['date_naissance_info'] = '<div class="alert alert-danger" role="alert">Le '.htmlspecialchars($date_naissance, ENT_QUOTES).' n\'existe pas.</div>';
								$_SESSION['form_date_naissance'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($date_naissance_result == 'ok')
							{
								$_SESSION['date_naissance_info'] = '';
								$_SESSION['form_date_naissance'] = $date_naissance;
							}
							
							else if($date_naissance_result == 'empty')
							{
								$_SESSION['date_naissance_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de date de naissance.</div>';
								$_SESSION['form_date_naissance'] = '';
								$_SESSION['erreurs']++;
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						} 						


  						//Mot de passe
  						if(isset($_POST['mdp']))
						{
							$mdp = trim($_POST['mdp']);
							$mdp_result = checkmdp($mdp, '');
							if($mdp_result == 'tooshort')
							{
								$_SESSION['mdp_info'] = '<div class="alert alert-danger" role="alert">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</div>';
								$_SESSION['form_mdp'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($mdp_result == 'toolong')
							{
								$_SESSION['mdp_info'] = '<div class="alert alert-danger" role="alert">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</div>';
								$_SESSION['form_mdp'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($mdp_result == 'nofigure')
							{
								$_SESSION['mdp_info'] = '<div class="alert alert-danger" role="alert">Votre mot de passe doit contenir au moins un chiffre.</div>';
								$_SESSION['form_mdp'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($mdp_result == 'noupcap')
							{
								$_SESSION['mdp_info'] = '<div class="alert alert-danger" role="alert">Votre mot de passe doit contenir au moins une majuscule.</div>';
								$_SESSION['form_mdp'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($mdp_result == 'ok')
							{
								$_SESSION['mdp_info'] = '';
								$_SESSION['form_mdp'] = $mdp;
							}
							
							else if($mdp_result == 'empty')
							{
								$_SESSION['mdp_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de mot de passe.</div>';
								$_SESSION['form_mdp'] = '';
								$_SESSION['erreurs']++;

							}
						}

						else
						{
							header('Location: inscription.php');
							exit();
						} 

						//Mot de passe suite
					if(isset($_POST['mdp_verif']))
						{
							$mdp_verif = trim($_POST['mdp_verif']);
							$mdp_verif_result = checkmdpS($mdp_verif, $mdp);
							//echo $mdp_verif_result;
							if($mdp_verif_result == 'different')
							{
								$_SESSION['mdp_verif_info'] = '<div class="alert alert-danger" role="alert">Le mot de passe de vérification diffère du mot de passe.</div>';
								$_SESSION['form_mdp_verif'] = '';
								$_SESSION['erreurs']++;
								if(isset($_SESSION['form_mdp'])) unset($_SESSION['form_mdp']);
							}
							
							else
							{
								if($mdp_verif_result == 'ok')
								{
									$_SESSION['form_mdp_verif'] = $mdp_verif;
									$_SESSION['mdp_verif_info'] = '';
								}
								
								else
								{
									$_SESSION['mdp_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['mdp_info']);
									$_SESSION['form_mdp_verif'] = '';
									$_SESSION['erreurs']++;
								}
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						}
 
 						//mail
						if(isset($_POST['mail']))
						{
							$mail = trim($_POST['mail']);
							$mail_result = checkmail($mail);
							if($mail_result == 'isnt')
							{
								$_SESSION['mail_info'] = '<div class="alert alert-danger" role="alert">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</div>';
								$_SESSION['form_mail'] = '';
								$_SESSION['erreurs']++;
							}
							
							else if($mail_result == 'exists')
							{
								$_SESSION['mail_info'] = '<div class="alert alert-danger" role="alert">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</div>';
								$_SESSION['form_mail'] = '';
								$_SESSION['erreurs']++;
							}
								
							else if($mail_result == 'ok')
							{
								$_SESSION['mail_info'] = '';
								$_SESSION['form_mail'] = $mail;
							}
							
							else if($mail_result == 'empty')
							{
								$_SESSION['mail_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas entré de mail.</div>';
								$_SESSION['form_mail'] = '';
								$_SESSION['erreurs']++;	
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						} 

						//mail suite
 						if(isset($_POST['confirm_email']))
						{
							$mail_verif = trim($_POST['confirm_email']);
							$mail_verif_result = checkmailS($mail_verif, $mail);
							if($mail_verif_result == 'different')
							{
								$_SESSION['mail_verif_info'] = '<div class="alert alert-danger" role="alert">Le mail de vérification diffère du mail.</div>';
								$_SESSION['form_mail_verif'] = '';
								$_SESSION['erreurs']++;
							}
							
							else
							{
								if($mail_result == 'ok')
								{
									$_SESSION['mail_verif_info'] = '';
									$_SESSION['form_mail_verif'] = $mail_verif;
								}
								
								else
								{
									$_SESSION['mail_verif_info'] = str_replace(' mail', ' mail de confirmation', $_SESSION['mail_info']);
									$_SESSION['form_mail_verif'] = '';
									$_SESSION['erreurs']++;
								}
							}
						}
						else
						{
							header('Location: inscription.php');
							exit();
						}  




 						//captcha
						//print_r($_SESSION['captcha']);
 						if($_POST['captcha'] == $_SESSION['captcha'] && isset($_POST['captcha']) && isset($_SESSION['captcha']))
						{
							$_SESSION['captcha_info'] = '';
						}
						else
						{	
							$_SESSION['captcha_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas recopié correctement le contenu de l\'image.</div>';
							$_SESSION['erreurs']++;
						}  
						
						//checkboxe
 						if( isset($_POST['agree']) && $_POST['agree']=="ok")
						{
							$_SESSION['agree_info'] = '';
						}
						else
						{
							$_SESSION['agree_info'] = '<div class="alert alert-danger" role="alert">Vous n\'avez pas accepté les conditions d\'utilisation.</div>';
							$_SESSION['erreurs']++;
						} 
						
						unset($_SESSION['captcha']); 
						
						if( $_SESSION['erreurs']==0)
						{
							header('Location: inscription.php?inscript=succes', false);
							exit();
						}
						else
						{
							header('Location: inscription.php', false);
							exit();
						} 
						
						 

						

?>