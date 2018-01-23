<?php

function pdo()
{
    
    //$pdo = new PDO("mysql:host=localhost;dbname=media_server",'root','');//localhost
    $pdo = new PDO("mysql:host=localhost;dbname=jarvis", 'jarvis', 'JarvisUvA2018');//shaif host
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
    
}


