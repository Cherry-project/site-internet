<?php


class S3Access {
    private static $BUCKET = 'cherry-shared-content';
    private $client;
    
    public function __construct($s3Client) {
        $this->client = $s3Client;
    }
    
    public function createFile($name, $path) {
        $result = $s3->putObject(array(
            'Bucket'       => S3Access::$BUCKET,
            'Key'          => $name,
            'SourceFile'   => $path
        ));

        return $result['ObjectURL'];
    }
}
