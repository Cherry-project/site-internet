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
        
        $length = count($children);
        $childDAO = new ChildDAO(DynamoDbClientBuilder::get());
        
        for ($i = 0; $i < $length; $i++) {
            $child = $childDAO->get($children[$i][0]);//email
            $child->addContent(
                    $content,
                    $children[$i][1]//date 
                    );
            $childDAO->update($child);
        }
    }
}
