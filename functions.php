<?php
    /** 
    * @author Amedeo Leo
    */
    function getTimestamp() {
        $date = date_create();
        return date_timestamp_get($date);
    };
    
    function getTimeAndDate() {
        date_default_timezone_set('Europe/Rome');
        $date = date("Y-m-d H:i:s");                   
        return $date;
    };
    
    function getToday() {
        date_default_timezone_set('Europe/Rome');
        $date = date("Y-m-d");                   
        return $date;
    }
    
    function fromTimestampToDate($timestamp) {
        return date('d-m-Y', $timestamp);
    }    
    
?>