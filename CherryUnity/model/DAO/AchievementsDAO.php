<?php


class AchievementsDAO {
    public static $TABLE_NAME = 'Achievements';
    protected $client;
        
    public function __construct ($client) {
        $this->client = $client;
    }
    
    // TODO
}
