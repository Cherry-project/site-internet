<?php


class S3Access {
    private static $BUCKET = 'cherry-shared-content';
    private $client;
    
    public function __construct($s3Client) {
        $this->client = $s3Client;
    }
    
    public function createFile($name, $path) {
        try {
            echo 'name = '.$name.'</br>';
            echo 'path = '.$path.'</br>';
            $result = $this->client->putObject(array(
                'Bucket'     => S3Access::$BUCKET,
                'Key'        => $name,
                'SourceFile' => $path
            ));
            echo 'fin create file </br>';
            return $result['ObjectURL'];
        } catch (Exception $e) {
            echo '<p>Exception reçue : ',  $e->getMessage(), "\n</p>";
        }
    }
}
