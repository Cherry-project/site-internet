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
        
        use Aws\DynamoDb\DynamoDbClient;
        use Aws\DynamoDb\Exception\DynamoDbException;
        ?>
</head>

<body>
    <?php
        try {
            $client = DynamoDbClient::factory(array(
                    'credentials' => array(
                            'key'    => 'AK2KQ',
                            'secret' => 'y4WjJH+kee5K2uqRR5fux2f',
                    ),
                    'region' => 'eu-west-1'
            ));
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $response = $client->getItem(array(
                    'TableName' => 'Users',
                    'Key' => array(
                            'email' => array('S' => $email)
                    )
            ));
            
            if ($response['Item'] != null) {
                if ($response['Item']['password']['S'] == $password) {
                    $_SESSION['email'] = $_POST['email'];
                    header('Location: ../room.php');
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





