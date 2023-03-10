<?php
require_once('../private/dbinfo.php');
$pdo = new PDO("pgsql:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpass);
