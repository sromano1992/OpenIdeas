<?php
    function getTimestamp() {
        $date = date_create();
        return date_timestamp_get($date);
    };
    
    function getTimeAndDate() {
        date_default_timezone_set('Europe/Rome');
        $date = date("Y-m-d H:i:s");                   
        return $date;
    }
    
    function fromTimestampToDate() {
        $timestamp = getTimestamp();
        return date('m/d/Y H:i:s', $timestamp);
    }    
    
?>