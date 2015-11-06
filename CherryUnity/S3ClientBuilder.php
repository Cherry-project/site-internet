<?php

use Aws\DynamoDb\S3Client;

class S3ClientBuilder {
    private static $client = null;
    
    private function __construct () {}
    
    public static function get () {
        if (S3ClientBuilder::$client == null) {
            S3ClientBuilder::$client = S3Client::factory(array(
                'region' => 'eu-west-1'
            ));
        }
        return $client;
    }
}
