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
        require '../model/DAO/ChildDAO.php';
        require '../model/Child.php';
        
        use Aws\DynamoDb\Exception\DynamoDbException;
        ?>
</head>

<body>
    <?php
        try {
            $client = DynamoClient::get();
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $client->getItem(array(
                'TableName' => 'Users',
                'Key' => array(
                    'email' => array('S' => $email)
                )
            ));
            
            
            $array = array ( 
                '0' => array ( 
                    '0' => array ( 'S' => '0' ),
                    '1' => array ( 'S' => '2015-12-25' ) 
                ),
                '1' => array ( 
                    '0' => array ( 'S' => '1' ),
                    '1' => array ( 'S' => '2016-03-14' ) 
                )
            );
            $array2 = [
                [
                    "0",
                    "2015-12-25"
                ],
                [
                    "1",
                    "2016-03-14"
                ]
            ];
            
            
            // CREATE child
            /*
            $dao = new ChildDAO($client);
            $child = new Child();
            $child->setEmail('child1@gmail.com');
            $child->setPassword('nicolas');
            $child->setLastname("Pierre");
            $child->setFirstname('PaulJacques');
            $child->setType('child');
            print_r($array2);
            $child->setTeachingContent($array2);
            $dao->create($child);
            //*/
            
            
            
            // GET child
            /*
            $dao = new ChildDAO($client);
            $user = $dao->get($email);
            if ($user != null) {
                echo 'email = ' . $user->getEmail() . '</br>';
                echo 'lastname = ' . $user->getLastname() . '</br>';
                echo 'firstname = ' . $user->getFirstname() . '</br>';
                echo 'password = ' . $user->getPassword() . '</br>';
                echo 'type = ' . $user->getType() . '</br>';
                $list = $user->getTeachingContent();
                print_r($list);
                for ($i = 0; $i < 2; $i++) {
                    $tab = $list[$i];
                    echo $tab['L'][0]['S'] . ' > ' . $tab['L'][1]['S'] . '</br>';
                }
            } else {
                echo 'user null';
            }
            //*/
            
            if ($user['Item'] != null) {
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
            }
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>





