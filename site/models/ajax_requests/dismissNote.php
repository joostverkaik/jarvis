<?php

require "pdo_connection.php";

$pdo = pdo();

$noteId = filter_input(INPUT_GET, 'note_id', FILTER_VALIDATE_INT);

$notes = $pdo->prepare("UPDATE notes SET dismissed = 1 WHERE note_id = ?");
$notes->execute(array($noteId));

