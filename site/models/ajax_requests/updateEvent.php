<?php
require_once "../../../vendor/autoload.php";
require 'pdo_connection.php';

$pdo = pdo();
try {
    $pb = new Pushbullet\Pushbullet('o.tSzshxX6RkL0wwac4F80PJ8hZAnXxfAQ');
}
catch (Exception $e) {

}

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

$users_q = $pdo->query("SELECT user_id, pushbullet FROM users");
$pushbulletUsernames = [];
foreach ($users_q->fetchAll(PDO::FETCH_ASSOC) as $user) {
    $pushbulletUsernames[$user['user_id']] = $user['pushbullet'];
}

if ( !empty($allDayVal) AND count($invitesArr) > 0) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        date('Y-m-d', strtotime($eventStart)),
        $eventTimeStart,
        date('Y-m-d', strtotime($eventEnd)),
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
        
        try {
            $pb->device($pushbulletUsernames[$invite])->pushNote("Event updated", "From Jarvis: Test user has updated the event " . $eventName . " for which you are invited");
        }
        catch (Exception $e) {
        
        }
        
    }
    
    echo "Event updated";
    
} else if (empty($allDayVal) AND count($invitesArr) > 0) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        date('Y-m-d', strtotime($eventStart)),
        $eventTimeStart,
        date('Y-m-d', strtotime($eventEnd)),
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
        
        try {
            $pb->device($pushbulletUsernames[$invite])->pushNote("Event updated", "From Jarvis: Test user has updated the event " . $eventName . " for which you are invited");
        }
        catch (Exception $e) {
        
        }
        
    }
    
    echo "Event updated";
    
} else if ( !empty($allDayVal) AND count($invitesArr) === 0) {
    
    $insertEvt = $pdo->prepare('UPDATE events SET name = ?, location = ?, start_date = ?, start_time = ?, end_date = ?, end_time = ?, all_day = ?, private = ? WHERE id = ?');
    $insertEvt->execute(array(
        $eventName,
        $eventLocation,
        date('Y-m-d', strtotime($eventStart)),
        $eventTimeStart,
        date('Y-m-d', strtotime($eventEnd)),
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
        date('Y-m-d', strtotime($eventStart)),
        $eventTimeStart,
        date('Y-m-d', strtotime($eventEnd)),
        $eventTimeEnd,
        '0',
        $eventPrivate,
        $eventId
    ));
    
    $delete_invites = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
    $delete_invites->execute([$eventId]);
    
    echo "Event updated";
    
}

    
