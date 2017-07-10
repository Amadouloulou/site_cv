<?php require '../connexion/connexion.php' ?>
<?php
if(isset($_POST['experience'])){//si on récupere une nouvelle compétence
    if($_POST['experience']!=''){// si experience est pas vide
            $experience = addslashes($_POST['experience']);
            $pdoCV->exec("INSERT INTO t_experiences VALUES (NULL, '$experience', '2')"); //mettre $id_utilisateur quand on l'aura en variable de session
            header("location: ../admin/experiences.php");
            exit();
    }//ferme le if
}//ferme le if isset

// suppression d'une compétence
if(isset($_GET['id_experience'])){
    $efface = $_GET['id_experience'];
    $sql = "DELETE FROM t_experiences WHERE id_experience = '$efface'";
    $pdoCV->query($sql);//ou avec exec
    header("location: ../admin/experiences.php");

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

    <title>Expérience</title>
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
                        <a class="page-scroll" href="experiences.php">Compétences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="loisirs.php">Loisirs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="experiences.php">Expérience</a>
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
                <h1>experiences</h1>
                <div class="col-lg"></h1>
                    <?php
                        $experience = $pdoCV->prepare("SELECT * FROM t_experiences WHERE utilisateur_id = '2' ");
                        $experience->execute();// execute la
                        $nbr_experiences = $experience->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_experiences; ?> compétences de la table pour <?php echo $ligne['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>Compétences</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                <tr>
                                    <?php while($ligne_experience = $experience->fetch()){ ?>
                                    <td><?php echo $ligne_experience['experience']; ?></td>
                                    <td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <form class="" action="experiences.php" method="post">
                            <label for="titre_e">Titre</label><br />
                            <input type="text" name="titre_e"><br /><br />

                            <label for="sous_titre_e">Sous_titre</label><br />
                            <input type="text" name="sous_titre_e"><br /><br />

                            <label for="date_e">Date</label><br />
                            <input type="text" name="date_e" ><br /><br />

                            <label for="description_e">Description</label><br />
                            <input type="text" name="description_e" ><br /><br />

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
