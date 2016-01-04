<?php

class Date {
    private $year;
    private $month;
    private $day;

    public function __construct($date, $format) {
        switch ($format) {
            case "en":
                $this->year = intval(substr($date, 6));
                $this->month = intval(substr($date, 0, 2));
                $this->day = intval(substr($date), 3, 2);
                break;
            case "fr":
                $this->year = intval(substr($date, 6));
                $this->month = intval(substr($date, 3, 2));
                $this->day = intval(substr($date), 0, 2);
                break;
            case "in":
                $this->year = intval(substr($date, 0, 4));
                $this->month = intval(substr($date, 5, 2));
                $this->day = intval(substr($date), 8, 2);
                break;
        }
    }
    
    public function toString($format) {
        if ($this->month < 10) {
            $str_month = '0' . $this->month;
        }
        if ($this->day < 10) {
            $str_day = '0' . $this->day;
        }
        switch ($format) {
            case "en":
                return $str_month.'/'.$str_day.'/'.$this->year;
            case "fr":
                return $str_day.'/'.$str_month.'/'.$this->year;
            case "in":
                return $this->year.'-'.$str_month.'-'.$str_day;
        }
    }
}