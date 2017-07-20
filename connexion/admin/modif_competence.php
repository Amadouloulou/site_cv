<?php require '../connexion/connexion.php' ?>

<?php
// gestion des contenus, mise à jour d'une compétence
if(isset($_POST['competence'])){// par le nom du premier input


    $competence = addslashes($_POST['competence']);
    $id_competence = $_POST['id_competence'];
    $pdoCV->query("UPDATE t_competences SET competence='$competence' WHERE id_competence='$id_competence'");

    header('location: ../admin/competences.php');//le header pour revenir à la liste des compétences de l'utilisation
    exit();
}
//je récupère la compétence
$id_competence = $_GET['id_competence']; // par l'id et $_GET
$sql = $pdoCV->query("SELECT * FROM t_competences WHERE id_competence = '$id_competence'"); // la requête égale à l'id
$ligne_competence = $sql->fetch();//
 ?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Compétences</title>
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
    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <h1>Mise à jour d'une compétence</h1>
                <div class="col-lg"></div>
                    <?php
                        $competence = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '2' ");
                        $competence->execute();// execute la
                        $nbr_competences = $competence->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_competences; ?> compétences de la table pour <?php echo $ligne_utilisateur['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <form class="" action="modif_competence.php" method="post">
                            <label for="competence">Formulaire de mise à jour de la compétence</label>
                            <input type="text" name="competence" class="form-control" value="<?php echo $ligne_competence['competence']; ?>">
                            <input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                            <input type="submit" value="Mettre à jour" class="btn btn-primary btn-lg" style="margin-top: 10px;">
                        </form>
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
