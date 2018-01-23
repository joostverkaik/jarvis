<?php
require 'pdo_connection.php';

$pdo = pdo();

$eventName      = htmlentities(htmlspecialchars($_GET['eventName']));
$eventLocation  = htmlentities(htmlspecialchars($_GET['eventLocation']));
$eventStart     = htmlentities(htmlspecialchars($_GET['eventStart']));
$eventEnd       = htmlentities(htmlspecialchars($_GET['eventEnd']));
$eventTimeStart = htmlentities(htmlspecialchars($_GET['eventTimeStart']));
$eventTimeEnd   = htmlentities(htmlspecialchars($_GET['eventTimeEnd']));
$allDayVal      = htmlentities(htmlspecialchars($_GET['allDayVal']));
$invites        = htmlentities(htmlspecialchars($_GET['invites']));

$invitesArr = array();
array_push($invitesArr, $invites);


if ( !empty($allDayVal) AND !empty($invites)) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name=?, location=?, start_date=?, start_time=?, end_date=?, end_time=?, all_day=? ');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal
    ));
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("UPDATE invites SET event_name=?, invites=?");
        $insert_invites->execute(array($eventName, $invite));
        
    }
    
    echo "Event succesful updated";
    
} else if (empty($allDayVal) AND !empty($invites)) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name=?, location=?, start_date=?, start_time=?, end_date=?, end_time=?, all_day=? ');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        "Not allday"
    ));
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("UPDATE invites SET event_name=?, invites=?");
        $insert_invites->execute(array($eventName, $invite));
        
    }
    
    echo "Event succesful updated";
    
} else if ( !empty($allDayVal) AND empty($invites)) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name=?, location=?, start_date=?, start_time=?, end_date=?, end_time=?, all_day=? ');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal
    ));
    
    
    $insert_invites = $pdo->prepare("UPDATE invites SET event_name=?, invites=?");
    $insert_invites->execute(array($eventName, "No invite"));
    
    echo "Event succesful updated";
    
} else {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name=?, location=?, start_date=?, start_time=?, end_date=?, end_time=?, all_day=? ');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        "Not allday"
    ));
    
    
    $insert_invites = $pdo->prepare("UPDATE invites SET event_name=?, invites=?");
    $insert_invites->execute(array($eventName, "No invite"));
    
    echo "Event succesful updated";
    
}

    
