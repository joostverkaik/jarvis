<?php
require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/models/phpUtils.php";

function pdo()
{
    
    global $dsn, $username, $password;
    
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
    
}
