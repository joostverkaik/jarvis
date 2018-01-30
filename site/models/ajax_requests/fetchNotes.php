<?php

require "pdo_connection.php";

$pdo = pdo();

$current_mode = $_COOKIE['current_mode'];

$userId = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);

$notes_array = [];

$private = '';
if ($current_mode == 'collective') {
    $private = 'AND n.private = 0';
}

$notes = $pdo->prepare("SELECT n.*, u.firstname, u.color
                        FROM notes n
                        LEFT JOIN users u
                        ON u.user_id = n.user_id
                        WHERE n.user_id = ?
                          " . $private . "
                          AND n.dismissed = 0");
$notes->execute(array($userId));

foreach ($notes->fetchAll(PDO::FETCH_ASSOC) as $note) {
    $shares = $pdo->prepare("SELECT u.firstname, u.color
                              FROM notes_shares ns
                              LEFT JOIN notes n
                              ON n.note_id = ns.note_id
                              LEFT JOIN users u
                              ON u.user_id = ns.user_id
                              WHERE ns.note_id = ?
                                " . $private . "
                                AND n.dismissed = 0");
    $shares->execute(array($note['note_id']));
    
    if ($shares->rowCount() === 0) {
        $shared_with = '';
    }
    else {
        $shared_with = 'Shared with: ';
        foreach ($shares->fetchAll(PDO::FETCH_ASSOC) as $share) {
            $shared_with .= '<span style="color: ' . $share['color'] . '">' . $share['firstname'] . '</span>, ';
        }
        $shared_with = substr($shared_with, 0, -2);
    }
    $notes_array[$note['note_id']] = ['note' => $note, 'shares' => $shared_with];
}

$notesShared = $pdo->prepare("SELECT n.*
                              FROM notes_shares ns
                              INNER JOIN notes n
                              ON n.note_id = ns.note_id
                              WHERE ns.user_id = ?
                                " . $private . "
                                AND n.dismissed = 0");
$notesShared->execute(array($userId));

foreach ($notesShared->fetchAll(PDO::FETCH_ASSOC) as $note) {
    $shares = $pdo->prepare("SELECT u.firstname, u.color
                              FROM notes_shares ns
                              LEFT JOIN notes n
                              ON n.note_id = ns.note_id
                              LEFT JOIN users u
                              ON u.user_id = ns.user_id
                              WHERE ns.note_id = ?
                                " . $private . "
                                AND n.dismissed = 0");
    $shares->execute(array($note['note_id']));
    
    if ($shares->rowCount() === 0) {
        $shared_with = '';
    }
    else {
        $shared_with = 'Shared with: ';
        foreach ($shares->fetchAll(PDO::FETCH_ASSOC) as $share) {
            $shared_with .= '<span style="color: ' . $share['color'] . '">' . $share['firstname'] . '</span>, ';
        }
        $shared_with = substr($shared_with, 0, -2);
    }
    $notes_array[$note['note_id']] = ['note' => $note, 'shares' => $shared_with];
}

echo json_encode(array_merge($notes_array, $notesShared->fetchAll(PDO::FETCH_ASSOC)));
