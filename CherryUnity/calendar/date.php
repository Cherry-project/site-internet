<?php


class date {
    
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    
    public $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    
    function getAll($year) {
        $r = array();
        
        // what we want : $r[YEAR][MONTH][DAY] = name of the day
        
        
        // procedural
        //*
        
        $date = strtotime($year.'-01-01');
        
        // we are computing the calendar of $year
        while (($y = date('Y', $date)) == $year) {
            $m = date('n', $date); 
            $d = date('j', $date); 
            $w = str_replace('0', '7', date('w', $date)); 

            $r[$y][$m][$d] = $w;
            
            $date = strtotime(date('y-m-d', $date). '+1 DAY');
        }
        //*/
        
        /*
        use DateTime;
        use DateInterval;
        $date = new DateTime($year.'-01-01');
        $oneDay = new DateInterval('P1D');
        
        while (($y = $date->format('Y')) == $year) {
            $m = $date->format('n');
            $d = $date->format('j'); 
            $w = str_replace('0', '7', $date->format('w')); 

            $r[$y][$m][$d] = $w;
            
            $date->add($oneDay);
        }
        */
        
        return $r;
    }
    
}
