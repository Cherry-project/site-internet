<!doctype html>
<html>
<head>
    <?php include 'head.php' ?>
    <title>Deconnection </title>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container">
        Vous vous êtes déconnecté. Redirection vers la <a href="index.php"> page d'accueil </a> ...
        <?php header('Refresh:5; url=index.php');  ?>
    </div>

    <?php include 'footer.php' ?>

</body>
</html>







