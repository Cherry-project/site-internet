<?php session_start()
 // Désactiver le rapport d'erreurs
    error_reporting(0); ?>
<!doctype html>
<html>

<head>
    <?php include 'head.php' ?>
    <title>Connection </title>
</head>

<body>
    <?php include 'nav.php' ?>


    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <form role="form" id="userForm" method="post" action="handlers/connectionHandler.php" >
                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input id="email" name="email" class="form-control" placeholder="Entrez un email" type="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Mot de passe</label>
                        <input id="password" name="password" class="form-control" placeholder="Entrez un mot de passe" type="password">
                    </div>
                    <button type="submit" class="btn btn-default">Se connecter</button>
					<!--deplacement du bouton "S"inscrire"-->
					<a href="authentication.php"><button  class="btn btn-primary">S'inscrire</button></a>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <a href="forgotPassword.php">Mot de passe oublié? </a>
                <!--ancienne place du bouton "S'inscrire"-->
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>
</html>
