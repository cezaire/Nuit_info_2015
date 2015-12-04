<header class="row" >
   <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top col-lg-12" role="navigation">

       

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
					<span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" id="logo" >
					SafeLife
				</a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Photos</a>
                    </li>
                    <li>
                        <a href="#">Vidéos</a>
                    </li>
				<?php

					if(isset($_SESSION['id_user']) and isset($_SESSION['pseudo']) )
					{
						echo '<li>
							<a href="contact.php">Nous contacter</a>
						</li>';
					}

				?>

                    <li>
                        <a href="apropos.php">A propos</a>
                    </li>

                </ul>
				<?php



				if(isset($_SESSION['id_user']) and isset($_SESSION['pseudo']) )
				{ ?>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">

					  <a href="#" id="deconnexion-btn" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"> </span> <?php echo $_SESSION['pseudo']  ?></a>

						  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation" > <a href="../index.php?action=deco"> <span class="glyphicon glyphicon-off" > </span> Se deconnecter </a>  </li>
							<li role="presentation" > <a href=<?php echo '"/profile.php"' ?> > <span class="glyphicon glyphicon-user" > </span> Profil </a>  </li>
							<li role="presentation" > <a href="http://projetphp.ismaeldiallo.fr/configurer_profil.php" > <span class="glyphicon glyphicon-cog" > </span> Configurer </a>  </li>

						  </ul>
					</li>
				  </ul>

				<?php }
				else
				{
					echo ' <ul class="nav navbar-nav navbar-right">
						<li class="dropdown">

						  <a href="#" id="connexion-btn" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-off"> </span> Se connecter</a>

							  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation" >
								  <div id="user_connexion" >
										<form method="POST" action="index.php">
												<input type="text" id="speudo" name="pseudo" placeholder="Pseudo"/>
												<input type="password" id="mdp" name="mdp" placeholder="Mot de passe"/><br/>
												<input type="checkbox" id="remember" name="remember" checked="true"/>Sauvegarder<br/>
												<input type="submit" id="connexion-bt" class="send-form-bt" name="connexion" value="Se connecter"/>
										</form>
										<a href="src/utilisateur/inscription.php" ><button id="inscription-bt" class="send-form-bt">S\'inscrire</button></a>
								  </div>
								</li>
							  </ul>
						</li>
					  </ul>';
				}
				?>
            </div>

            <!-- /.navbar-collapse -->

 

       <!-- /.container -->
    </nav>
</header>