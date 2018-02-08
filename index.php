<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "site/core/web_routing.php";
require "site/models/ajax_requests/pdo_connection.php";

$route = new mediaServerRoute();
