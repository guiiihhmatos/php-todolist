<?php

    require '../configuration/database/conexao.php';

    //Função para logar no sistema
    function createTarefa($titulo, $cd_usuario, $descricao){

        global $conexão;

        // Consulta SQL para inserir a nova tarefa
        $sql = "INSERT INTO tb_tarefa (titulo, descricao, data_criacao, id_usuario) VALUES (:titulo, :descricao, NOW() ,:id_usuario)";
        $stmt = $conexão->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id_usuario', $cd_usuario);
        $stmt->execute();

    }

    // Função para excluir uma tarefa
    function deleteTarefa($id_tarefa)
    {
        global $conexão;

        // Consulta SQL para excluir a tarefa
        $sql = "DELETE FROM tb_tarefa WHERE id = :id";
        $stmt = $conexão->prepare($sql);
        $stmt->bindParam(':id', $id_tarefa);
        $stmt->execute();
    }

    // Função para obter todas as tarefas de um usuário
    function getAllTarefas($cd_usuario)
    {
        global $conexão;

        // Consulta SQL para obter todas as tarefas do usuário
        $sql = "SELECT * FROM tb_tarefa WHERE id_usuario = :id_usuario";
        $stmt = $conexão->prepare($sql);
        $stmt->bindParam(':id_usuario', $cd_usuario);
        $stmt->execute();

        $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tarefas;
    }

    // Verificar se o parâmetro delete_id foi passado
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        deleteTarefa($delete_id);
    }

    // Função para editar a tarefa
    function editTarefa(){}

?>
