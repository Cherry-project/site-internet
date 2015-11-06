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
        
        require '../DynamoDbClientBuilder.php';
        require '../S3ClientBuilder.php';
        
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
            $client = DynamoDbClientBuilder::get();
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // S3 upload file
            /*
            $s3Client = S3ClientBuilder::get();
            $result = $s3Client->putObject(array(
                'Bucket' => 'cherry-shared-content',
                'Key'    => 'data.txt',
                'Body'   => 'Hello!'
            ));
            // Get the URL the object can be downloaded from
            echo $result['ObjectURL'] . "</br>";
            //*/
            
            
            /*
            $array = array (
                array ('L' => array ( 
                    array ('S' => '0'),
                    array ('S' => '2015-12-25') 
                )),
                array ('L' => array ( 
                    array ('S' => '1'),
                    array ('S' => '2016-03-14') 
                ))
            );
            //*/
            
            // DELETE child
            /*
            $dao = new ChildDAO($client);
            echo $email;
            $dao->delete($email);
            //*/
            
            
            // CREATE child
            /*
            $dao = new ChildDAO($client);
            $child = new Child();
            $child->setEmail('child1@gmail.com');
            $child->setPassword('nicolas');
            $child->setLastname("Pierre");
            $child->setFirstname('PaulJacques');
            $child->setType('child');
            print_r($array);
            $child->setTeachingContent($array);
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
            
            
            
            //CONNECTION
            //*
            $dao = new UserDAO($client);
            $user = $dao->get($email);
            if ($user != null) {
                if ($user->getPassword() == $password) {
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
            //*/
            
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>





