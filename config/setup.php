<?php

require_once("../model/model_database.php");

try {
    $db = new model_database();
    $db->create('camagru');
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}