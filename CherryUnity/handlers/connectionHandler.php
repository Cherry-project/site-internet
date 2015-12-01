<?php 
session_start();
?>
<!doctype html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>Connection</title>
    <?php
        $root = "../";
        require "../includes.php";
        use Aws\DynamoDb\Exception\DynamoDbException;
        ?>
</head>

<body>
    <!-- <a href="../temp.php">temp.php</a> -->
    <?php
        try {
            $client = DynamoDbClientBuilder::get();
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $dao = new UserDAO($client);
            $user = $dao->get($email);
            if ($user != null) {
                if ($user->getPassword() == $password) {
                    $_SESSION['email'] = $email;
                    $type = $user->getType();
                    $_SESSION['type']  = $type; 
                    if ($type == "child") {
                        header('Location: ../room.php');
                    } else if ($type == "teacher") {
                        header('Location: ../drop.php');
                    } else if ($type == "doctor") {
                        header('Location: ../drop.php');
                    } else if ($type == "family") {
                        header('Location: ../drop.php');
                    }
                } else {
                    session_destroy();
                    echo "Mot de passe incorrect.";
                }
            } else {
                session_destroy();
                echo "L'utilisateur n'existe pas.";
            }
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>





