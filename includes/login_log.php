<?php
    session_start();
    require_once '../configuration/queries/login_queries.php';

    // Obtém os dados enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    logar($username, $password)

  
?>


