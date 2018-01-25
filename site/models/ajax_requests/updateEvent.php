<?php
require 'pdo_connection.php';

$pdo = pdo();

$eventId        = htmlentities(htmlspecialchars($_GET['eventId']));
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
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '1',
        $eventPrivate,
        $eventId
    ));
    
    $delete_invites = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
    $delete_invites->execute([$eventId]);
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites (event_id, user_id) VALUES (?, ?)");
        $insert_invites->execute(array($eventId, $invite));
        
    }
    
    echo "Event updated";
    
} else if (empty($allDayVal) AND count($invitesArr) > 0) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '0',
        $eventPrivate,
        $eventId
    ));
    
    $delete_invites = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
    $delete_invites->execute([$eventId]);
    
    foreach ($invitesArr as $invite) {
        
        $insert_invites = $pdo->prepare("INSERT INTO invites (event_id, user_id) VALUES (?, ?)");
        $insert_invites->execute(array($eventId, $invite));
        
    }
    
    echo "Event updated";
    
} else if ( !empty($allDayVal) AND count($invitesArr) === 0) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '1',
        $eventPrivate,
        $eventId
    ));
    
    $delete_invites = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
    $delete_invites->execute([$eventId]);
    
    echo "Event updated";
    
} else {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        $eventStart,
        $eventTimeStart,
        $eventEnd,
        $eventTimeEnd,
        '0',
        $eventPrivate,
        $eventId
    ));
    
    $delete_invites = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
    $delete_invites->execute([$eventId]);
    
    echo "Event updated";
    
}

    
