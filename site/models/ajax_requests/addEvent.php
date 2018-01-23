<?php

require "pdo_connection.php";

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


$chek_name = $pdo->prepare("SELECT `name` FROM `events` WHERE `name`=? AND start_date=?");
$chek_name->execute(array($eventName, $eventStart));

if ( !empty($allDayVal) AND !empty($invites)) {
    
    $insertEvt = $pdo->prepare('INSERT INTO `events` (`name`, location, start_date, start_time, end_date, end_time, all_day) VALUES(?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal
    ));
    $insertId = $pdo->lastInsertId();
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites(event_id, invites) VALUES(?,?)");
        $insert_invites->execute(array($insertId, $invite));
        
    }
    
    echo "Event succesful added";
    
} else if (empty($allDayVal) AND !empty($invites)) {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day) VALUES(?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal
    ));
    $insertId = $pdo->lastInsertId();
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites(event_id, invites) VALUES(?,?)");
        $insert_invites->execute(array($insertId, $invite));
        
    }
    
    echo "Event succesful added";
    
} else if ( !empty($allDayVal) AND empty($invites)) {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day) VALUES(?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        $allDayVal
    ));
    
    echo "Event succesful added";
    
} else {
    
    $insertEvt = $pdo->prepare('INSERT INTO events(name, location, start_date, start_time, end_date, end_time, all_day) VALUES(?,?,?,?,?,?,?)');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        "Not allday"
    ));
    
    
    $insert_invites = $pdo->prepare("INSERT INTO invites(event_name, invites) VALUES(?,?)");
    $insert_invites->execute(array($eventName, "No invite"));
    
    echo "Event succesful added";
    
}

