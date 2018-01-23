<?php

require "pdo_connection.php";

$pdo = pdo();

$eventName = htmlentities(htmlspecialchars($_GET['curEvtName']));

$deleteEvent = $pdo->prepare("DELETE FROM events WHERE name=?");
$deleteEvent->execute(array($eventName));

$deleteInvtes = $pdo->prepare("DELETE FROM invites WHERE event_name=?");
$deleteInvtes->execute(array($eventName));

echo $eventName . " event is succesful deleted..!";



