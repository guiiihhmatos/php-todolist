<?php
    session_start();
    require '../configuration/database/conexao.php';
    require './components/header.php';

    $cd_usuario = $_SESSION['cd_usuario'];
    $username = $_SESSION['username'];

    $date = new DateTime();
    $timestamp = $date->getTimestamp();

    $titulo = "Tarefa 18";
    $descricao = "Essa é a primeira tarefa do projeto";

    // Consulta SQL para inserir a nova tarefa
    $sql = "INSERT INTO tb_tarefa (titulo, descricao, data_criacao, id_usuario) VALUES (:titulo, :descricao, NOW() ,:id_usuario)";
    $stmt = $conexão->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_usuario', $cd_usuario);
    $stmt->execute();

    echo "Tarefa criada com sucesso.";

?>
