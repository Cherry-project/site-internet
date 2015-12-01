<!doctype html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>Authentication</title>
    <?php
        $root = "../";
        require "../includes.php";
        use Aws\DynamoDb\Exception\DynamoDbException;
        ?>
</head>

<body>
    <?php
        function testUser ($email, $type) {
            $client = DynamoDbClientBuilder::get();
            $response = $client->getItem(array(
                'TableName' => 'Users',
                    'Key' => array(
                        'email' => array('S' => $email)
                    )
                ));
            if ($response['Item'] == null) {
                return false;
            }
            if ($response['Item']['type']['S'] == $type) {
                return true;
            } else {
                return false;
            }
        }
    
        try {
            $client = DynamoDbClientBuilder::get();
            
            $array = array();
            $error = false;
            
            $type = $_POST['type'];
            $emailFamily = $_POST['emailFamily'];
            $emailDoctor = $_POST['emailDoctor'];
            $emailTeacher = $_POST['emailTeacher'];
            
            if ($type == 'child') {
                $error = true;
                $testFamily = testUser($emailFamily, "family");
                $testDoctor = testUser($emailDoctor, "doctor");
                $testTeacher = testUser($emailTeacher, "teacher");

                if ($testFamily == false) {
                    echo "Problème avec email famille";
                } else if ($testDoctor == false) {
                    echo "Problème avec email médecin";
                } else if ($testTeacher == false) {
                    echo "Problème avec email enseignant";
                } else {
                    $error = false;
                    $array['familyId'] = array('S' => $emailFamily);
                    $array['teacherId'] = array('S' => $emailTeacher);
                    $array['doctorId'] = array('S' => $emailDoctor);
                }
            }
            
            if ($error == false) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];
                $lastname = $_POST['firstname'];
                $firstname = $_POST['lastname'];

                $array['email'] = array('S' => $email);
                $array['password'] = array('S' => $password);
                $array['lastname'] = array('S' => $lastname);
                $array['firstname'] = array('S' => $firstname);
                $array['type'] = array('S' => $type);

                $response = $client->getItem(array(
                'TableName' => 'Users',
                    'Key' => array(
                        'email' => array('S' => $email)
                    )
                ));

                if ($password != $confirmPassword) {
                    echo "Les deux mots de passe entrés sont différents.";
                } else if (($response['Item'] == null)) {
                    $client->putItem(array(
                        'TableName' => 'Users',
                        'Item' => $array
                    ));
                    echo "Vous existez!";
                } else {
                    echo "L'email saisie est déjà utilisée par un autre utilisateur.";
                } 
            }
        } catch (DynamoDbException $e) {
            echo '<p>Exception dynamoDB reçue : ',  $e->getMessage(), "\n</p>";
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
        ?>
</body>
</html>



