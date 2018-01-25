<?php

require "pdo_connection.php";

$pdo = pdo();

$eventId = htmlentities(htmlspecialchars($_GET['curEvtId']));

$deleteEvent = $pdo->prepare("DELETE FROM events WHERE id = ?");
$deleteEvent->execute(array($eventId));

$deleteInvtes = $pdo->prepare("DELETE FROM invites WHERE event_id = ?");
$deleteInvtes->execute(array($eventId));

echo "Event deleted";



