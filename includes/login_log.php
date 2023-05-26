<?php

    require '../configuration/database/conexao.php';

    // Obtém os dados enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Crie a consulta SQL para verificar o login do usuário
    $sql = "SELECT * FROM tb_usuario WHERE username = :username AND password = :password";
    $stmt = $conexão->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Verifique se o usuário existe no banco de dados
    if ($stmt->rowCount() > 0) 
    {
        // O login é válido, redirecione para a página de sucesso
        header("Location: tarefas.php");
        exit();

    } else {

        // O login é inválido, armazene a mensagem de erro na sessão
        session_start();
        $_SESSION['erro_login'] = "Nome de usuário ou senha inválidos.";
    
        // Redirecione de volta para a página de login
        header("Location: ../public/pages/login.php");
        exit();
    }
  
  // ...
  
?>


