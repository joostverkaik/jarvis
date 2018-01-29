<?php
require_once "../../../vendor/autoload.php";
require "pdo_connection.php";

$pdo = pdo();
try {
    $pb = new Pushbullet\Pushbullet('o.tSzshxX6RkL0wwac4F80PJ8hZAnXxfAQ');
} catch (Exception $e) {

}

$data       = filter_input(INPUT_POST, 'data', FILTER_UNSAFE_RAW);
$private    = filter_input(INPUT_POST, 'private', FILTER_UNSAFE_RAW);
$invitesArr = json_decode($_POST['invites']);

$users_q             = $pdo->query("SELECT user_id, pushbullet FROM users");
$pushbulletUsernames = [];
foreach ($users_q->fetchAll(PDO::FETCH_ASSOC) as $user) {
    $pushbulletUsernames[$user['user_id']] = $user['pushbullet'];
}


$insertEvt = $pdo->prepare('INSERT INTO `notes` (`created`, `data`, `user_id`, `private`) VALUES(NOW(),?,?,?)');
$insertEvt->execute(array(
    $data,
    1,
    $private
));
$insertId = $pdo->lastInsertId();

foreach ($invitesArr as $invite) {
    
    $insert_invites = $pdo->prepare("INSERT INTO notes_shares (note_id, user_id) VALUES(?,?)");
    $insert_invites->execute(array($insertId, $invite));
    
    try {
        $pb->device($pushbulletUsernames[$invite])->pushNote("New shared note",
            "From Jarvis: Test user shared a note with you");
    } catch (Exception $e) {
    
    }
    
}
