<?php require 'connexion/connexion.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../css/style_amadou.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

  </head>
  <body>
      <?php

            $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='2' ");
            $ligne = $sql->fetch(); //va chercher
       ?>
      <p>Coucou ! <?php  echo $ligne['prenom'].' '.$ligne['nom']; ?></p>
  </body>
</html>














<?php require '../connexion/connexion.php' ?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>
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

      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='2' ");
      $ligne = $sql->fetch(); //va chercher
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
                <a class="navbar-brand page-scroll" href="#page-top">Admin Amadou Niang</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="COMPETENCES.php">Compétences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
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
                    <h1> Admin site CV <?php  echo $ligne['prenom'].' '.$ligne['nom']; ?></h1>
                    <?php
                          $sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id='0' ");
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
                <div class="col-lg-12">
                    <h1>COMPETENCE</h1>
                    <?php
                        $competence = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '2' ");
                        $competence->execute();// execute la
                        $nbr_competences = $competence->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_competences; ?> compétences de la table pour <?php echo $ligne_utilisateur['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>Compétences</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                <tr>
                                    <?php while($ligne_competence = $competence->fetch()){ ?>
                                    <td><?php echo $ligne_competence['competence']; ?></td>
                                    <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="#"><span class="glyphicon glyphicon-trash"></span></a></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Services Section</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact Section</h1>
                </div>
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
