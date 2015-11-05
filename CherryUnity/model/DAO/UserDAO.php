<?php


class UserDAO {
    private $client;
    
    public function __construct ($client) {
        $this->client = $client;
    }
    
    public function get ($email) {
        $result = $this->client->getItem(array(
            'ConsistentRead' => true,
            'TableName' => 'Users',
            'Key' => array(
                'email' => array('N' => $email)
            )
        ));
        // switch result.type
    }
    
    public function create ($user) {
        $this->client->putItem(array(
            'TableName' => 'Users',
            'Item' => $this->getArrayWithUserData($user)
        ));
    }
    
    public function update ($user) {
        $this->create($user);
    }
    
    public function delete ($email) {
        $this->client->deleteItem(array(
            'TableName' => 'Users',
            'Key' => array(
                'email' => array('S' => $email)
            )
        ));
    }
    
    public function getArrayWithUserData ($user) {
        $array = array(
            'email'     => array('S' => $user.getEmail()),
            'password'  => array('S' => $user.getPassword()),
            'lastname'  => array('S' => $user.getLastname()),
            'firstname' => array('S' => $user.getFirstname()),
            'type'      => array('S' => $user.getType())
        );
        return $array;
    } 
}
