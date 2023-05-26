<?php
    try {

        $conexão = new PDO("mysql:host=localhost; dbname=listatarefa;chasert=utf-8", 'root', '');

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        echo 'deu merda mano';
    }
?>