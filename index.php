<?php

/**
 * Created by PhpStorm.
 * User: leamsiollaid
 * Date: 03/12/2015
 * Time: 21:47
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Nuit de l'info</title>
    <link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="module.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>

    <link href="./module.css" rel="stylesheet">


</head>

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
                            <li><a href="#Home">Home</a></li>
                            <li><a href="#users">Users</a></li>
                            <li><a href="http://placesforlove.com">Places</a></li>
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
                <form class="form-horizontal">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>NEW ALERT</legend>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectbasic">TYPES</label>
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1" selected>Attentat</option>
                                    <option value="2">Épidémie</option>
                                </select>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                                <button id="singlebutton" name="singlebutton" class="btn btn-default">Alerter</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <!--Centre de la page -->
            <div class="col-lg-10">
                <h1>NUIT DE l'INFO</h1>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    TEST: BOOTSTRAP
                </div>
            </div>

        </div>

    </div>
    <!-- Ajout API Twitter-->
    <div class="col-lg-2">


        <a class="twitter-timeline" href="https://twitter.com/search?q=%23Urgences%20%23MGSU%20%23gestiondecrise%20%23mediassociaux%20Crowdhelp%20%23Resilience"
           data-widget-id="672458314190573568">Tweets sur #Urgences #MGSU #gestiondecrise #mediassociaux Crowdhelp #Resilience
        </a>
        <script>
            !function(d,s,id)
            {var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
                if(!d.getElementById(id)){js=d.createElement(s);
                    js.id=id;
                    js.src=p+"://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js,fjs);}
            }(document,"script","twitter-wjs");
        </script>
    </div>


    <div/>
</div>
</body>
</html>
