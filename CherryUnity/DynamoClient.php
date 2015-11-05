<?php

use Aws\DynamoDb\DynamoDbClient;

class DynamoClient {
    private static $client = null;
    
    private function __construct () {}
    
    public static function get () {
        if ($client == null) {
            $client = DynamoDbClient::factory(array(
                'region' => 'eu-west-1'
            ));
        }
        return $client;
    }
}
