<?php require '../connexion/connexion.php' ?>
<?php

session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION

$msg_authentification_erreur='';

if(isset($_POST)) {
    echo 'test';
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql = $pdoCV->prepare("SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");
    $sql->execute();
    $nbr_utilisateur = $sql->rowCount();

    if($nbr_utilisateur == 0){
        $msg_authentification_erreur="Erreur d'authentification !";
    }else{
        $ligne_utilisateur = $sql->fetch();

        $_SESSION['connexion']='connecté';
        $_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
        $_SESSION['prenom']=$ligne_utilisateur['prenom'];
        $_SESSION['nom']=$ligne_utilisateur['nom'];

        header('location:index.php');
    }
}
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../admin/css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="main">

  <div class="login-screen"></div>
      <div class="login-center">
          <div class="container min-height" style="margin-top: 20px;">
          	<div class="row">
                  <div class="col-xs-4 col-md-offset-8">
                      <div class="login" id="card">
                      	<div class="front signin_form">
                          <p>Login Your Account</p>
                            <form class="login-form" action="" name="connexion" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="Type your email">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="mdp" placeholder="Type your password">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="checkbox">
                                <label><input type="checkbox">Remember me next time.</label>
                                </div>

                                <div class="form-group sign-btn">
                                    <input type="submit" class="btn" value="Se connecter">
                                    <p><a href="#" class="forgot">Can't access your account?</a></p>
                                    <p><strong>New to TimeInfo?</strong><br><a href="#" id="flip-btn" class="signup signup_link">Sign up for a new account</a></p>
                                </div>
                            </form>
                          </div>
                          <!-- <div class="back signup_form" style="opacity: 0;">
                            <p>Sign Up for Your New Account</p>
                            <form class="login-form">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Username">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn"><button type="button" class="btn btn-cyan"><span class="fa fa-refresh"></span></button></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Email">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </span>
                                    </div>
                                </div>

                            </form>
                          </div> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>

    <script src="login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Flip/1.0.18/jquery.flip.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
