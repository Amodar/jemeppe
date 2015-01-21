<?php

function returnDateRange($fromdate, $todate) {
    $begin = new DateTime( $fromdate );
    $end = new DateTime( $todate );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');

    $daterange = new DatePeriod($begin, $interval ,$end);
    
    return $daterange;
    /*
    foreach($daterange as $date){
        echo $date->format("Y-m-d") . "<br>";
    }*/
}