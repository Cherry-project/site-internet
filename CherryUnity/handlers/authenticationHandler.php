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
                    'key'    => 'AKIAILCHDD2KQ',
                    'secret' => 'y4WEd4c/OVJ1OBQe5RR5fux2f',
                ),
                'region' => 'eu-west-1'
            ));
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $lastname = $_POST['firstname'];
            $firstname = $_POST['lastname'];
            
            $response = $client->getItem(array(
            'TableName' => 'Users',
                'Key' => array(
                    'email' => array('S' => $email)
                )
            ));
            
            if ($response['Item'] == null) {
                $client->putItem(array(
                    'TableName' => 'Users',
                    'Item' => array(
                        'email' => array('S' => $email),
                        'password' => array('S' => $password),
                        'lastname' => array('S' => $lastname),
                        'firstname' => array('S' => $firstname)
                    )
                ));
                echo "Vous existez!";
            } else {
                echo "L'email saisie est déjà utilisée par un autre utilisateur.";
            }           
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>



