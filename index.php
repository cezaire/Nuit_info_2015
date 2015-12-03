/**
 * Created by PhpStorm.
 * User: leamsiollaid
 * Date: 03/12/2015
 * Time: 21:47
 */

<?php
    include_once("include/head.php");
?>

<body >
<!--Header menu haut -->
<div class="row" >
    <div class="col-lg-12">
        <header role="banner" class="navbar navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="navbar-inverse side-collapse in">
                    <nav role="navigation" class="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#users">Enfants</a></li>
                            <li><a href="#">Places</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    </div>
</div>

<div class="row" >
    <div class="col-lg-10">
        <div class="row">
            <!--Formulaire alert -->
            <div class="col-lg-2">
                <?php
                include_once("./include/formAlert.php");
                ?>

            </div>
            <!--Centre de la page -->
            <div class="col-lg-10">
                <h1>NUIT DE l'INFO</h1>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    TEST: BOOTSTRAP
                </div>
                <audio src="audio/Generique.mp3" autoplay controls></audio>
            </div>

        </div>

    </div>
    <!-- Ajout API Twitter-->
    <div class="col-lg-2">
        <?php
        include_once("./include/tweet.php");
        ?>
    </div>
    <div/>
</div>
<?php
    include_once("./include/footer.php");
?>
</body>
</html>
