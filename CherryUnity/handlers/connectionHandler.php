<?php 
session_start();
?>
<!doctype html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>formHandler </title>
    <?php
        require '../vendor/autoload.php';
        require '../DynamoClient.php';
        require '../model/DAO/UserDAO.php';
        require '../model/User.php';
        
        use Aws\DynamoDb\Exception\DynamoDbException;
        ?>
</head>

<body>
    <?php
        try {
            $client = DynamoClient::get();
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            /*$user = $client->getItem(array(
                'TableName' => 'Users',
                'Key' => array(
                    'email' => array('S' => $email)
                )
            ));*/
            
            
            $dao = new UserDAO($client);
            $user = $dao->get($email);
            if ($user != null) {
                echo 'firstname = ' . $user->getFirstname();
            } else {
                echo 'user null';
            }
            
            /*if ($user['Item'] != null) {
                if ($user['Item']['password']['S'] == $password) {
                    $_SESSION['email'] = $_POST['email'];
                    header('Location: ../room.php');
                } else {
                    session_destroy();
                    echo "Mot de passe incorrect.";
                }
            } else {
                session_destroy();
                echo "L'utilisateur n'existe pas.";
            }*/
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>





