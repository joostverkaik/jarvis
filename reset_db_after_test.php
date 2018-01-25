<?php
require "config.php";

function pdo()
{
    
    global $dsn, $username, $password;
    
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
    
}

$pdo = pdo();

$sql = "TRUNCATE TABLE `events`;";
$pdo->query($sql);

$sql = "
INSERT INTO `events` (`id`, `name`, `location`, `start_date`, `start_time`, `end_date`, `end_time`, `all_day`, `added_by`, `private`) VALUES
(2, 'Lunch', 'City centre', '27-01-2018', '12:00', '27-01-2018', '14:00', 0, 4, 1),
(4, 'Meeting', 'Office', '26-01-2018', '15:00', '26-01-2018', '17:00', 0, 1, 0),
(5, 'Visit museum', 'Rijksmuseum', '25-01-2018', '14:00', '25-01-2018', '18:00', 0, 2, 0),
(6, 'Parents', '', '28-01-2018', '14:00', '28-01-2018', '16:00', 0, 1, 1),
(7, 'Brunch', '', '25-01-2018', '11:00', '25-01-2018', '13:00', 0, 3, 0);";
$pdo->query($sql);

$sql = "TRUNCATE TABLE `invites`;";
$pdo->query($sql);

$sql = "TRUNCATE TABLE `users`;";
$pdo->query($sql);

$sql = "INSERT INTO `users` (`user_id`, `email`, `firstname`, `lastname`, `color`, `background`, `pushbullet`) VALUES
(1, 'test@user.nl', 'Test', 'User', '#87CEEB', '', ''),
(2, 'sanne@kop.nl', 'Sanne', 'Kop', '#FE5F55', '', ''),
(3, 'alberto@steeg.nl', 'Alberto', 'Steeg', '#2B59C3', '', ''),
(4, 'jeroen@bos.nl', 'Jeroen', 'Bos', '#BFB5AF', '', '');";
$pdo->query($sql);

echo 'Database reset done';