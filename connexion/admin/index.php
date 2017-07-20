<?php require '../connexion/connexion.php' ?>
<?php
    session_start();//a mettre dans toute les pages admin ; SESSION et authentification
    if(isset($_SESSION['connexion']) && $_SESSION['connexion'] == 'connecté'){
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];

        echo $_SESSION['connexion'];
    }else{//l'utilisateur n'estb pas connecté
        header('location:authentification.php');
    }

    // Pour ce deconnecter
    if(isset($_GET['quitter'])){//on récupère le terme quitter dans l'url
        $_SESSION['connexion']='';//on vide les variables de SESSION
        $_SESSION['id_utilisateur']='';
        $_SESSION['prenom']='';
        $_SESSION['nom']='';

        unset($_SESSION['connexion']);
        session_destroy();

        header('location:index.php');
    }
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    <link rel="stylesheet" href="../css/style_amadou.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php

      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
      $ligne_utilisateur = $sql->fetch(); //va chercher
 ?>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Admin Amadou Niang</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="competences.php">Compétences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="loisirs.php">Loisirs</a>
                    </li>
                    <li>
						<a class="page-scroll" href="experiences.php">Experiences</a>
					</li>
					<li>
						<a class="page-scroll" href="realisations.php">Réalisations</a>
					</li>
					<li>
						<a class="page-scroll" href="formations.php">Formations</a>
					</li>
                    <li>
                        <a class="page-scroll" href="index.php?quitter=oui">Déconnexion</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1> Admin site CV <?php  echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']; ?></h1>
                    <?php
                          $sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id ='$id_utilisateur' ");
                          $ligne_utilisateur = $sql->fetch(); //va chercher
                     ?>
                    <p><?php  echo $ligne_utilisateur['titre_cv'].' '.$ligne_utilisateur['accroche']; ?></p>
                    <a class="btn btn-default page-scroll" href="#about">Click Me to Scroll Down!</a>
                    //<p>
                        <?php
                        date_default_timezone_set('Europe/Paris');
                        // --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
                        // strftime("jourEnLettres jour moisEnLettres annee") de la date courante
                        echo "Date du jour : ", strftime("%A %d %B %Y");
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <?php

                    $sql = $pdoCV->prepare("SELECT * FROM% t_compétences WHERE utilisateur_id = '1'");//prépare la requête
                    $sql->execute(); // exécute-la
                    $nbr_compétences = $sql->rowCount() // compte les lignes

                 ?>
            </div>
        </div>
    </section>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
