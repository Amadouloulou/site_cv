<?php require '../connexion/connexion.php' ?>

<?php
// gestion des contenus, mise à jour d'une compétence
if(isset($_POST['loisir'])){// par le nom du premier input


    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];
    $pdoCV->query("UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir'");

    header('location: ../admin/loisirs.php');//le header pour revenir à la liste des compétences de l'utilisation
    exit();
}
//je récupère la compétence
$id_loisir = $_GET['id_loisir']; // par l'id et $_GET
$sql = $pdoCV->query("SELECT * FROM t_loisirs WHERE id_loisir = '$id_loisir'"); // la requête égale à l'id
$ligne_loisir = $sql->fetch();//
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
                        <a class="page-scroll" href="loisirs.php">Compétences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="loisirs.php">Loisirs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="experiences.php">Expériences</a>
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
                        $loisir = $pdoCV->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id = '2' ");
                        $loisir->execute();// execute la
                        $nbr_loisirs = $loisir->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_loisirs; ?> compétences de la table pour <?php echo $ligne['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <form class="" action="modif_loisir.php" method="post">
                            <label for="loisir">Formulaire de mise à jour de la compétence</label>
                            <input type="text" name="loisir" class="form-control" value="<?php echo $ligne_loisir['loisir']; ?>">
                            <input hidden name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                            <input type="submit" value="Mettre à jour" class="btn btn-primary btn-lg" style="margin-top: 10px;">
                        </form>
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
