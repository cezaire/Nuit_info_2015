<?php

/**
 * Created by PhpStorm.
 * User: leamsiollaid
 * Date: 03/12/2015
 * Time: 21:47
 */
?>

<?php
    include_once("include/head.php");
?>

<body >
<div class="container"
<!--Header menu haut -->
<div class="row" >
    <div class="col-lg-12">
        <?php
        include_once("include/header.php");
        ?>

    </div>
</div>



<div class="row" >
    <div class="col-lg-10">
        <div class="row">
            <!--Formulaire alert -->
            <div class="col-lg-2">
                <?php
                include_once("src/formAlert.php");
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
        include_once("src/tweet.php");
        ?>
    </div>
    <div/>
</div>
<?php
    include_once("include/footer.php");
?>
<div
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="module.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="./bootstrap/dist/js/bootstrap.min.js"></script>



</body>
</html>
