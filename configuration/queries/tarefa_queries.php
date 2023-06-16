<?php

    require_once '../configuration/database/conexao.php';

    //Função para logar no sistema
    function createTarefa($titulo, $cd_usuario, $descricao, $status){

        global $conexao;

        $fl_status = ($status == 'true') ? 1 : 0;

        if($status == 'true')
        {
            $sql = "INSERT INTO tb_tarefa (titulo, descricao, data_criacao, data_conclusao, fl_status, id_usuario) VALUES (:titulo, :descricao, NOW(), NOW(), :fl_status ,:id_usuario)";
        }
        else
        {
            $sql = "INSERT INTO tb_tarefa (titulo, descricao, data_criacao, data_conclusao, fl_status, id_usuario) VALUES (:titulo, :descricao, NOW(), null, :fl_status ,:id_usuario)";
        }

        // Consulta SQL para inserir a nova tarefa
        
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':fl_status', $fl_status);
        $stmt->bindParam(':id_usuario', $cd_usuario);
        $stmt->execute();

    }

    // Função para excluir uma tarefa
    function deleteTarefa($cd_tarefa)
    {
        global $conexao;

        // Consulta SQL para excluir a tarefa
        $sql = "DELETE FROM tb_tarefa WHERE cd_tarefa = :cd_tarefa";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':cd_tarefa', $cd_tarefa);
        $stmt->execute();
    }

    // Função para obter todas as tarefas de um usuário
    function getAllTarefas($cd_usuario)
    {
        global $conexao;

        // Consulta SQL para obter todas as tarefas do usuário
        $sql = "SELECT * FROM tb_tarefa WHERE id_usuario = :id_usuario";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_usuario', $cd_usuario);
        $stmt->execute();

        $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tarefas;
    }

    function alterStatus($cd_tarefa, $status)
    {
        global $conexao;

        $fl_status = ($status == 'true') ? 1 : 0;

        if($status == 'true')
        {
            $sql = "UPDATE tb_tarefa SET fl_status = :fl_status, data_conclusao = NOW() WHERE cd_tarefa = :cd_tarefa";
        }
        else
        {
            $sql = "UPDATE tb_tarefa SET fl_status = :fl_status, data_conclusao = null WHERE cd_tarefa = :cd_tarefa";
        }

        
        $stmt = $conexao->prepare($sql);
        
        $stmt->bindParam(':fl_status', $fl_status);
        $stmt->bindParam(':cd_tarefa', $cd_tarefa);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    function getById($cd_tarefa)
    {
        global $conexao;

        $sql = "SELECT * from tb_tarefa WHERE cd_tarefa = :cd_tarefa";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':cd_tarefa', $cd_tarefa);

        $stmt->execute();
        $tarefas = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tarefas;
    }


    // Função para editar a tarefa
    function editTarefa(){}

?>
