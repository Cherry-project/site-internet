<?php


class UserDAO {
    private $client;
    
    public function __construct ($client) {
        $this->client = $client;
    }
    
    public function get ($email) {
        $user = $this->getUser();
        $userDTO = $this->getUserDTO($email);
        $this->fillUserAttributes($userDTO, $user);
        return $user;
    }
    
    private function getUserDTO ($email) {
        $result = $this->client->getItem(array(
            'ConsistentRead' => true,
            'TableName' => 'Users',
            'Key' => array(
                'email' => array('N' => $email)
            )
        ));
        return $result;
    }
    
    protected function getUser () {
        return new User();
    }


    protected function fillUserAttributes ($userDTO, $user) {
        $user->setEmail($userDTO['email']['S']);
        $user->setPassword($userDTO['password']['S']);
        $user->setLastname($userDTO['lastname']['S']);
        $user->setFirstname($userDTO['firstname']['S']);
        $user->setType($userDTO['type']['S']);
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
    
    protected function getArrayWithUserData ($user) {
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
