<?php require '../connexion/connexion.php' ?>
<?php
if(isset($_POST['loisir'])){//si on récupere un nouveau loisir
    if($_POST['loisir']!=''){// si loisir est pas vide
            $loisir = addslashes($_POST['loisir']);
            $pdoCV->exec("INSERT INTO t_loisirs VALUES (NULL, '$loisir', '2')"); //mettre $id_utilisateur quand on l'aura en variable de session
            header("location: ../admin/loisirs.php");
            exit();
    }//ferme le if
}//ferme le if isset

// suppression d'un loisir
if(isset($_GET['id_loisir'])){
    $efface = $_GET['id_loisir'];
    $sql = "DELETE FROM t_loisirs WHERE id_loisir = '$efface'";
    $pdoCV->query($sql);//ou avec exec
    header("location: ../admin/loisirs.php");

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

    <title>Loisirs</title>
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
                        <a class="page-scroll" href="competences.php">Compétences</a>
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
                <h1>Loisirs</h1>
                <div class="col-lg"></h1>
                    <?php
                        $loisir = $pdoCV->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id = '2' ");
                        $loisir->execute();// execute la
                        $nbr_loisirs = $loisir->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_loisirs; ?> loisir(s) de la table pour <?php echo $ligne['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>Loisir</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                <tr>
                                    <?php while($ligne_loisir = $loisir->fetch()){ ?>
                                    <td><?php echo $ligne_loisir['loisir']; ?></td>
                                    <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir'] ?>"><span class="glyphicon glyphicon-trash"></span></a></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <form class="" action="loisirs.php" method="post">
                            <label for="loisir">Loisir</label>
                            <input type="text" name="loisir" placeholder="Inserez une loisir" required>
                            <input type="submit" name="" value="Ajouter">
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
