<?php


class ContentDAO {
    private static $TABLE_NAME = 'Contents';
    private $client;
    
    public function __construct ($dynamoClient) {
        $this->client = $dynamoClient;
    }
    
    // children = array of [email, date]
    public function create ($content, $children) {
        $this->client->putItem(array(
            'TableName' => ContentDAO::$TABLE_NAME,
            'Item' => array(
                'name'    => array('S' => $content->getName()),
                'owner'   => array('S' => $content->getEmailOwner()),
                'url'     => array('S' => $content->getUrl()),
                'type'    => array('S' => $content->getType())
                )
        ));
        echo 'apres putItem de content</br>';
        $length = count($children);
        $childDAO = new ChildDAO(DynamoDbClientBuilder::get());
        for ($i = 0; $i < $length; $i++) {
            $email = $children[$i]['email'];
            $child = $childDAO->get($email);
            echo 'on recupere enfant dont email vaut : '. $email .'</br>';
            if ($child != null) {
                echo 'enfant récupéré</br>';
                $child->addContent(
                        $content,
                        $children[$i]['date']); // date
                echo 'contenu ajouté</br>';
                $childDAO->update($child);
                echo 'enfant mis a jour</br>';
            }
        }
    }
}
