<?php

function connexionBDD()
{

	define('HOTS_NAME','db573247645.db.1and1.com');
	define('DATA_BASE','db573247645');
	define('USER_NAME','dbo573247645');
	define('PASSWORD','711990_Projet');

	try {
		$bdd = new PDO('mysql:host='.HOTS_NAME.';dbname='.DATA_BASE, USER_NAME,PASSWORD);
		//echo "connexion réussie";

	} catch (PDOException $e) {
	   // print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}
	return $bdd;
}

/*
Neoterranos & LkY
Page fonctions.php

Contient quelques fonctions globales.

Quelques indications : (utiliser l'outil de recherche et rechercher les mentions donnÃ©es)

Liste des fonctions :
--------------------------
sqlquery($requete,$number)
connexionbdd()
actualiser_session()
vider_cookie()
--------------------------


Liste des informations/erreurs :
--------------------------
Mot de passe de session incorrect
Mot de passe de cookie incorrect
L'id de cookie est incorrect
--------------------------
*/

/* function sqlquery($requete, $number)
{
	$query = mysql_query($requete) or exit('Erreur SQL : '.mysql_error().' Ligne : '. __LINE__ .'.'); //requête
	queries();
	
	
	// Deux cas possibles ici :
	// Soit on sait qu'on a qu'une seule entrée qui sera
	// retournée par SQL, donc on met $number à 1
	// Soit on ne sait pas combien seront retournées,
	// on met alors $number à 2.
	
	
	if($number == 1)
	{
		$query1 = mysql_fetch_assoc($query);
		mysql_free_result($query);
		//mysql_free_result($query) libère le contenu de $query, je
		//le fais par principe, mais c'est pas indispensable.
		return $query1;
	}
	
	else if($number == 2)
	{
		while($query1 = mysql_fetch_assoc($query))
		{
			$query2[] = $query1;
			//On met $query1 qui est un array dans $query2 qui
			//est un array. Ca fait un array d'arrays :o
		}
		mysql_free_result($query);
		return $query2;
	}
	
	else //Erreur
	{
		exit('Argument de sqlquery non renseigné ou incorrect.');
	}
}

function queries($num = 1)
{
	global $queries;
	$queries = $queries + intval($num);
}
 */

/* 
function actualiser_session()
{
	if(isset($_SESSION['membre_id']) && intval($_SESSION['membre_id']) != 0) //Vérification id
	{
	
		$bdd=connexionBDD();
		$bdd->exec("SET CHARACTER SET utf8");
													
		$stmt=$bdd->prepare('SELECT id_users FROM exposition WHERE titre=:titre');
		$stmt->bindParam(':titre',$_POST['nomExpo']);
													//$stmt->execute();
													//$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	
		//utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
		$retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_SESSION['membre_id']), 1);
		//$stmt=$bdd->query('SELECT * FROM exposition WHERE titre=:titre');
		//Si la requête a un résultat (id est : si l'id existe dans la table membres)
		if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
		{
			if($_SESSION['membre_mdp'] != $retour['membre_mdp'])
			{
				//Dehors vilain pas beau !
				$informations = Array(//Mot de passe de session incorrect
									true,
									'Session invalide',
									'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
			
			else
			{
				//Validation de la session.
					$_SESSION['membre_id'] = $retour['membre_id'];
					$_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
					$_SESSION['membre_mdp'] = $retour['membre_mdp'];
			}
		}
	}
	
	else //On vérifie les cookies et sinon pas de session
	{
		if(isset($_COOKIE['membre_id']) && isset($_COOKIE['membre_mdp'])) //S'il en manque un, pas de session.
		{
			if(intval($_COOKIE['membre_id']) != 0)
			{
				//idem qu'avec les $_SESSION
				$retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_COOKIE['membre_id']), 1);
				
				if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
				{
					if($_COOKIE['membre_mdp'] != $retour['membre_mdp'])
					{
						//Dehors vilain tout moche !
						$informations = Array(//Mot de passe de cookie incorrect
											true,
											'Mot de passe cookie erroné',
											'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
											'',
											'membres/connexion.php',
											3
											);
						require_once('../information.php');
						vider_cookie();
						session_destroy();
						exit();
					}
					
					else
					{
						//Bienvenue :D
						$_SESSION['membre_id'] = $retour['membre_id'];
						$_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
						$_SESSION['membre_mdp'] = $retour['membre_mdp'];
					}
				}
			}
			
			else //cookie invalide, erreur plus suppression des cookies.
			{
				$informations = Array(//L'id de cookie est incorrect
									true,
									'Cookie invalide',
									'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
		}
		
		else
		{
			//Fonction de suppression de toutes les variables de cookie.
			if(isset($_SESSION['membre_id'])) unset($_SESSION['membre_id']);
			vider_cookie();
		}
	}
}
*/

function vider_cookie()
{
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-3600);
	}
} 

function checkpseudo($pseudo)
{
	$bdd=connexionBDD();
	if($pseudo == '') return 'empty';
	else if(strlen($pseudo) < 3) return 'tooshort';
	else if(strlen($pseudo) > 32) return 'toolong';
	
 	else
	{
		//$result = sqlquery("SELECT COUNT(*) AS nbr FROM users WHERE pseudo = '".mysql_real_escape_string($pseudo)."'", 1);
		
		$stmt=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE pseudo=:pseudo');
		$stmt->bindParam(':pseudo',$pseudo);
		$stmt->execute();
		$donnee=$stmt->fetch(PDO::FETCH_ASSOC);
		//print_r($donnee);
		global $queries;
		$queries++;
		
 		if($donnee['nbr'] > 0) return 'exists';
		else return 'ok'; 
	}
	$bdd=NULL;
}

function checknom($nom)
{
	if($nom == '') return 'empty';
	else if(strlen($nom) > 50) return 'toolong';
	
	else
	{
		if(preg_match('#[0-9]{1,}#', $nom)) return 'nomatch';
		else if(!preg_match('#[A-Z]{1,}#', $nom)) return 'noupcap';
		else return 'ok';
	}
	
}

 function checkmdp($mdp)
{
	if($mdp == '') return 'empty';
	else if(strlen($mdp) < 4) return 'tooshort';
	else if(strlen($mdp) > 50) return 'toolong';
	
	else
	{
		if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
		else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
		else return 'ok';
	}
}


function checkmdpS($mdp, $mdp2)
{
	if($mdp != $mdp2 && $mdp != '' && $mdp2 != '') return 'different';
	else return checkmdp($mdp);
}

function checkmail($email)
{
	
	trim($email);
	//echo $email."<br/>";
	$bdd=connexionBDD();
	if($email == '') return 'empty';
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';
	
	else
	{
		//$result = sqlquery("SELECT COUNT(*) AS nbr FROM membres WHERE membre_mail = '".mysql_real_escape_string($email)."'", 1);
		$stmt=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE mail=:mail');
		$stmt->bindParam(':mail',$email);
		$stmt->execute();
		$donnee=$stmt->fetch(PDO::FETCH_ASSOC);
		//print_r($donnee);
		global $queries;
		$queries++;
		if($donnee['nbr'] > 0) return 'exists';
		else return 'ok';
	}
	$bdd=NULL;
	
}

function checkmailS($email, $email2)
{
	if($email != $email2 && $email != '' && $email2 != '') return 'different';
	else return 'ok';
}


function birthdate($date)
{
	if($date == '') return 'empty';

	else if(substr_count($date, '-') != 2) return 'format';
	else
	{
		$DATE = explode('-', $date);
		if(date('Y') - $DATE[0] <= 18) return 'tooyoung';
		else if(date('Y') - $DATE[0] >= 100) return 'tooold';
		
		else if($DATE[0]%4 == 0)
		{
			$maxdays = Array('31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
			if($DATE[2] > $maxdays[$DATE[1]-1]) return 'invalid';
			else return 'ok';
		}
		
		else
		{
			$maxdays = Array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
			if($DATE[2] > $maxdays[$DATE[1]-1]) return 'invalid';
			else return 'ok';
		}
	}
}


function vidersession()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}

/*
=======================
||      Users        ||
=======================
*/

function set_newUsers($nom,$prenom,$mdp,$pseudo,$dateNaiss,$mail)
{
	$photo="/images/photosUsers/init.png";
	$bann="/images/photosUsers/init.png";
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO users (nom,prenom,dateN,mdp,pseudo,mail,photo_profil,banniere_user) VALUES (:nom,:prenom,:dateN,:mdp,:pseudo,:mail,:photo,:bann)");								
	$stmt->bindValue(':nom',$nom);
	$stmt->bindValue(':prenom',$prenom);
	$stmt->bindValue(':dateN',$dateNaiss);
	$stmt->bindValue(':mdp',$mdp);
	$stmt->bindValue(':pseudo',$pseudo);
	$stmt->bindValue(':mail',$mail);
	$stmt->bindValue(':photo',$photo);
	$stmt->bindValue(':bann',$bann);
	$stmt->execute();
	$bdd=NULL;
}

function update_user_mail($id_user,$mail){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET mail=:mail WHERE id_user=:id_user");
	$stmt->bindValue(':mail',$mail);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
}

 function update_user_desc($id_user,$desc){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET description=:desc WHERE id_user=:id_user");
	$stmt->bindValue(':desc',$desc);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
} 

 function update_user_Img_profil($id_user,$photo){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET photo_profil=:photo WHERE id_user=:id_user");
	$stmt->bindValue(':photo',$photo);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
} 

 function update_user_banniere($id_user,$bann){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET banniere_user=:bann WHERE id_user=:id_user");
	$stmt->bindValue(':bann',$bann);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
} 

 function update_user_mdp($id_user,$mdp){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET mdp=:mdp WHERE id_user=:id_user");
	$stmt->bindValue(':mdp',$mdp);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
} 

function config_user($id_user, $mail, $mdp, $photo, $banniere){
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE users SET mail=:mail, mdp=:mdp, photo_profil=:photo, banniere_user=:banniere WHERE id_user=:id_user");
	$stmt->bindValue(':mail',$mail);
	$stmt->bindValue(':mdp',$mdp);
	$stmt->bindValue(':photo',$photo);
	$stmt->bindValue(':banniere',$banniere);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$bdd=NULL;
}

function get_user($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM users WHERE id_user=:id_user');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_pseudo($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT pseudo FROM users WHERE id_user=:id_user');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}


function get_nbr_users()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM users');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function get_all_users()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM users');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function supp_user_cascade($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT id_article FROM users, articles WHERE id_user=:id_user AND id_user=users_id_users');
	$stmt->bindValue(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	if(!$donnee){
		echo 'PAS ARTICLE SUPPRESION USER';
		//supp_user($id_user);
	}
	else{
		echo 'ARTICLE';
		foreach($donnee as $article){
			supp_article_cascade($article['id_article']);
		}
		supp_user($id_user);
	}
	$bdd=NULL;
}

function supp_user($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('DELETE FROM users WHERE id_user=:id_user');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
}


/*
==========================
||      Cartegorie      ||
==========================
*/

function add_cat($nom_cat,$lien_cat)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO categories (nom,photo) VALUES (:nom,:photo)");								
	$stmt->bindValue(':nom',$nom_cat);
	$stmt->bindValue(':photo',$lien_cat);
	$stmt->execute();
	$bdd=NULL;
}

function get_all_cat()  
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM categories');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_cat($id_cat)  
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM categories WHERE id_cat=:id_cat');
	$stmt->bindParam(':id_cat',$id_cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_cat_nom($cat_nom)  
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM categories WHERE nom=:cat_nom');
	$stmt->bindParam(':cat_nom',$cat_nom);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_cat_photo($lien_cat)  
{	
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM categories WHERE photo=:lien_cat');
	$stmt->bindParam(':lien_cat',$lien_cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}



/*
==========================
||      Articles        ||
==========================
*/
function set_articles($id_user,$id_cat,$titre,$text)
{
	date_default_timezone_set('UTC+1');
	$datePubli=date("Y-m-j H:i:s");
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO articles (users_id_users, categories_id_cat, titre, text, dateHeure) VALUES (:id_user, :id_cat, :titre, :text, :dateHeure)");
	$stmt->bindValue(':id_user',$id_user,PDO::PARAM_INT);
	$stmt->bindValue(':id_cat',$id_cat,PDO::PARAM_INT);
	$stmt->bindValue(':titre',$titre);
	$stmt->bindValue(':text',$text);
	$stmt->bindValue(':dateHeure',$datePubli);
	$stmt->execute();
	
	return $bdd->lastInsertId();
	$bdd=NULL;
}

function update_articles($id_article,$id_cat,$titre,$text)
{
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE articles SET categories_id_cat=:modif_cat, titre=:modif_titre, text=:modif_text WHERE id_article=:id_article");
	$stmt->bindValue(':modif_cat',$id_cat,PDO::PARAM_INT);
	$stmt->bindValue(':modif_titre',$titre);
	$stmt->bindValue(':modif_text',$text);
	$stmt->bindValue(':id_article',$id_article);
	$stmt->execute();
	$bdd=NULL;
}

function get_all_article()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM articles ORDER BY dateHeure DESC');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_all_articles_limit($debut,$fin)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("SELECT * FROM articles ORDER BY dateHeure DESC LIMIT $fin OFFSET $debut ");
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}


function get_all_articles_cat_limit($debut,$fin,$id_cat)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("SELECT * FROM articles WHERE categories_id_cat=:id_cat ORDER BY dateHeure DESC LIMIT $fin OFFSET $debut");
	$stmt->bindParam(':id_cat',$id_cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_article($id_article)
{
	$bdd=connexionBDD($id_article);
	$bdd->exec("set names utf8");
	update_vue($id_article);
	$stmt=$bdd->prepare('SELECT * FROM articles WHERE id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	update_visite_profil($donnee[0]["users_id_users"]);
	return $donnee;
}

function update_vue($id_article)
{
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE articles SET vue= vue+1 WHERE id_article=:id_article ");
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$bdd=NULL;
}

function update_visite_profil($id_user)
{

	if($_SESSION['id_user']!=$id_user)
	{
		$bdd=connexionBDD();
		$stmt=$bdd->prepare("UPDATE users SET nbr_visiteurT= nbr_visiteurT+1 WHERE id_user=:id_user ");
		$stmt->bindParam(':id_user',$id_user);
		$stmt->execute();
		$bdd=NULL;
	}
}

function supp_article_cascade($id_article){
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT id_commentaire FROM articles,commentaires WHERE id_article=:id_article AND id_article=articles_id_article');
	$stmt->bindValue(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	if(!$donnee){
		echo 'article sans commentaire';
		supp_article($id_article);
	}
	else{
		echo 'article AVEC commentaire';
		foreach($donnee as $comment){
			supp_comment_article($comment['id_commentaire']);
		}
		supp_article($id_article);
	}
}

function supp_article($id_article)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('DELETE FROM articles WHERE id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
}

function get_nbr_articles_Publie($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT count(*) FROM articles WHERE users_id_users=:id_user');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function get_nbr_articles_cat_Publie($id_user,$cat)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT count(*) FROM articles WHERE users_id_users=:id_user AND categories_id_cat=:id_cat');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->bindParam(':id_cat',$cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}



function get_nbr_articles()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM articles');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function get_nbr_articles_cat($id_cat)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM articles WHERE categories_id_cat=:id_cat');
	$stmt->bindParam(':id_cat',$id_cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}


function get_user_article ($id_user)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM articles WHERE users_id_users=:id_user ORDER BY dateHeure DESC');
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}



function get_user_article_limit($id_user,$debut,$fin)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("SELECT * FROM articles WHERE users_id_users=:id_user ORDER BY dateHeure DESC LIMIT $fin OFFSET $debut");
	$stmt->bindParam(':id_user',$id_user);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_user_cat_article_limit($id_user,$debut,$fin,$cat)
{	
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("SELECT * FROM articles WHERE users_id_users=:id_user AND categories_id_cat=:id_cat ORDER BY dateHeure DESC LIMIT $fin OFFSET $debut");
	$stmt->bindParam(':id_user',$id_user);
	$stmt->bindParam(':id_cat',$cat);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}



/*
function get_all_articles()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM articles');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
} */

/*
==========================
||      Photos       ||
==========================
*/

function set_photo_article($lien,$pricipale,$id_article)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO photosArticle ( cheminPhoto, principale, articles_id_article) VALUES (:lien, :princip, :id_article)");
	$stmt->bindValue(':lien',$lien);
	$stmt->bindValue(':princip',$pricipale);
	$stmt->bindValue(':id_article',$id_article,PDO::PARAM_INT);
	$stmt->execute();
	$bdd=NULL;
}

function get_photo_article($id_article)
{
	$bdd=connexionBDD();
	$stmt=$bdd->prepare('SELECT * FROM photosArticle WHERE articles_id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

/*
==========================
||      MESSAGES       ||
==========================
*/

function set_message($pseudo, $mail, $sujet, $message, $lu)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO messages (pseudo, mail, sujet, message, lu) VALUES ( :pseudo, :mail, :sujet, :message, :lu)");
	$stmt->bindValue(':pseudo',$pseudo);
	$stmt->bindValue(':mail',$mail);
	$stmt->bindValue(':sujet',$sujet);
	$stmt->bindValue(':message',$message);
	$stmt->bindValue(':lu',$lu);
	$stmt->execute();
	$bdd=NULL;
}

function get_nbr_message()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM messages');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function get_nbr_message_non_lu($lu)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM messages WHERE lu=:lu');
	$stmt->bindParam(':lu', $lu);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function set_messages_lu($lu)
{
	$bdd=connexionBDD();
	$stmt=$bdd->prepare("UPDATE messages SET lu=:lu");
	$stmt->bindValue(':lu',$lu);
	$stmt->execute();
	$bdd=NULL;
}

function get_all_message()
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM messages');
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function supp_message($id_msg)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('DELETE FROM messages WHERE id_message=:id_msg');
	$stmt->bindValue(':id_msg',$id_msg);
	$stmt->execute();
	$bdd=NULL;
}

function get_nbr_vue_profil($id_user)
{

}

function get_nbr_aime_article($id_article)
{
	$bdd=connexionBDD();
	$stmt=$bdd->prepare('SELECT like FROM articles WHERE id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function get_nbr_comment_article($id_article)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT COUNT(*) FROM commentaires WHERE articles_id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_NUM);
	return $donnee;
}

function get_comments_article( $id_article)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('SELECT * FROM commentaires WHERE articles_id_article=:id_article');
	$stmt->bindParam(':id_article',$id_article);
	$stmt->execute();
	$donnee=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $donnee;
}

function supp_comment_article($id_comm)
{
	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare('DELETE FROM commentaires WHERE id_commentaire=:id_com');
	$stmt->bindParam(':id_com',$id_comm);
	$stmt->execute();
}



function set_commentaire($text, $id_article, $id_user, $valide)
{
	date_default_timezone_set('UTC+1');
	$date=date("Y-m-j");
	$heure=date("H:i:s");
 	$bdd=connexionBDD();
	$bdd->exec("set names utf8");
	$stmt=$bdd->prepare("INSERT INTO commentaires (text, articles_id_article, users_id_users, dateCom, heureCom, valide) VALUES ( :text, :id_article, :id_user, :date, :heure, :valide)");
	$stmt->bindValue(':text',$text);
	$stmt->bindValue(':id_article',$id_article);
	$stmt->bindValue(':id_user',$id_user);
	$stmt->bindValue(':date',$date);
	$stmt->bindValue(':heure',$heure);
	$stmt->bindValue(':valide',$valide);
	$stmt->execute();
	$bdd=NULL; 
}

function raccourci0($chaine,$len) 
{
	//$chaine="Cette chaine est une longue phrase qui devra être raccourcie"; 
	// Le nombre le lettres avant les ...
	//$len = 15;
	if (strlen($chaine) >= $len) {$chaine = substr($chaine,0,$len) . "  ..." ;}
	// On écrit la chaine modifiée
	//echo $chaine; 
	return $chaine;
}

/*Fonction: couper un texte par un nombre de caracteres défini par ligne
Paramètre: $chaine => chaine de caractères 
			$nb_car_li => nombre de caractères par ligne
*/

 function raccourci($chaine,$nb_car_max, $nb_li=1){
  $nb_car_li = intval(abs($nb_car_max/$nb_li));
  if(strlen($chaine)>=$nb_car_li)
  {
  // Met la portion de chaine dans $chaine
  //$chaine=strip_tags($chaine);
  $chaine=strip_tags($chaine);
  $chaine=substr($chaine,0,$nb_car_max); 

  // position du dernier espace
  $espace=strrpos($chaine," "); 
  // test si il ya un espace
  if($espace)
  // si ya 1 espace, coupe de nouveau la chaine
  $chaine=substr($chaine,0,$espace);
  // Ajoute saut de ligne à la chaine
  $chaine= wordwrap($chaine, $nb_car_li, "<br />"). "  ...";
  }
   return $chaine;
 }

 function printr($cont){print_r('<pre>');print_r($cont);print_r('</pre>');}
 
 function mepd($date)
{
        if(intval($date) == 0) return $date;
//====================
	date_default_timezone_set('UTC+1');
	//$datePubli=date("Y-m-j H:i:s");
//====================
        $tampon = time();
        $diff = $tampon - $date;
        
        $dateDay = date('d', $date);
        $tamponDay = date('d', $tampon);
        $diffDay = $tamponDay - $dateDay;
        
        if($diff < 60 && $diffDay == 0)
        {
                return 'Il y a '.$diff.'s';
        }
        
        else if($diff < 600 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/60).'m et '.floor($diff%60).'s';
        }
        
        else if($diff < 3600 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/60).'m';
        }
        
        else if($diff < 7200 && $diffDay == 0)
        {
                return 'Il y a '.floor($diff/3600).'h et '.floor(($diff%3600)/60).'m';
        }
        
        else if($diff < 24*3600 && $diffDay == 0)
        {
                return 'Aujourd\'hui Ã  '.date('H\hi', $date);
        }
        
        else if($diff < 48*3600 && $diffDay == 1)
        {
                return 'Hier Ã  '.date('H\hi', $date);
        }
        
        else
        {
                return 'Le '.date('d/m/Y', $date).' Ã  '.date('h\hi', $date).'.';
        }
}

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadÃ©
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //DÃ©placement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}


?>