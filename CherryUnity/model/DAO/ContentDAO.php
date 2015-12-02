<?php


class ContentDAO {
    private static $TABLE_NAME = 'Contents';
    private $client;
    
    public function __construct ($dynamoClient) {
        $this->client = $dynamoClient;
    }
    
    // children = array of [email, date]
    public function create ($content, $children) {
        try {
            $this->client->putItem(array(
                'TableName' => ContentDAO::$TABLE_NAME,
                'Item' => array(
                    'name'    => array('S' => $content->getName()),
                    'owner'   => array('S' => $content->getEmailOwner()),
                    'url'     => array('S' => $content->getUrl()),
                    'type'    => array('S' => $content->getType())
                    )
            ));
        } catch (Exception $e) {
            print $e->getMessage();
        }
        $length = count($children);
        print 'DEBUG : $length vaut '.$length;
        $childDAO = new ChildDAO(DynamoDbClientBuilder::get());
        for ($i = 0; $i < $length; $i++) {
            $email = $children[$i]['email'];
            print 'DEBUG : $email vaut '.$email;
            $child = $childDAO->get($email);
            if ($child != null) {
                $date = $children[$i]['date'];
                print 'DEBUG : $date vaut '.$date;
                $child->addContent(
                        $content,
                        $date);
                print 'DEBUG : $child->getTeachingContent() vaut '.$child->getTeachingContent();
                $childDAO->update($child);
            }
        }
        print 'DEBUG : fin create';
    }
    
    //méthode à tester
    public function get($name, $owner) {
        $dto = $this->client->getItem(array(
            'ConsistentRead' => true,
            'TableName' => ContentDAO::$TABLE_NAME,
            'Key' => array(
                'name' => array('S' => $name),
                'owner' => array('S' => $owner)
            )
        ));
        $content = new Content();
        $content->setName($dto['Item']['name']['S']);
        $content->setType($dto['Item']['type']['S']);
        $content->setEmailOwner($dto['Item']['owner']['S']);
        $content->setUrl($dto['Item']['url']['S']);
        return $content;
    }
}
