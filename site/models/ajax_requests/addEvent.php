<?php

require "pdo_connection.php";

$pdo = pdo();


$eventName      = htmlentities(htmlspecialchars($_GET['eventName']));
$eventLocation  = htmlentities(htmlspecialchars($_GET['eventLocation']));
$eventStart     = htmlentities(htmlspecialchars($_GET['eventStart']));
$eventEnd       = htmlentities(htmlspecialchars($_GET['eventEnd']));
$eventTimeStart = htmlentities(htmlspecialchars($_GET['eventTimeStart']));
$eventTimeEnd   = htmlentities(htmlspecialchars($_GET['eventTimeEnd']));
$eventPrivate   = htmlentities(htmlspecialchars($_GET['private']));
$allDayVal      = htmlentities(htmlspecialchars($_GET['allDayVal']));
$invitesArr     = json_decode($_GET['invites']);

if ( !empty($allDayVal) AND count($invitesArr) > 0) {
    
    $insertEvt = $pdo->prepare('INSERT INTO `events` (`name`, location, start_date, start_time, end_date, end_time, all_day, private) VALUES(?,?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal,
        $eventPrivate
    ));
    $insertId = $pdo->lastInsertId();
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites(event_id, user_id) VALUES(?,?)");
        $insert_invites->execute(array($insertId, $invite));
        
    }
    
    echo "Event succesful added";
    
} else if (empty($allDayVal) AND count($invitesArr) > 0) {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day, private) VALUES(?,?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '0',
        $eventPrivate
    ));
    $insertId = $pdo->lastInsertId();
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites(event_id, user_id) VALUES(?,?)");
        $insert_invites->execute(array($insertId, $invite));
        
    }
    
    echo "Event succesful added";
    
} else if ( !empty($allDayVal) AND count($invitesArr) === 0) {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day, private) VALUES(?,?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal,
        $eventPrivate
    ));
    
    echo "Event succesful added";
    
} else {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day, private) VALUES(?,?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '0',
        $eventPrivate
    ));
    
    echo "Event succesful added";
    
}

