<?php
    session_start();
    require '../configuration/queries/tarefa_queries.php';
    require './components/header.php';

    $cd_usuario = $_SESSION['cd_usuario'];
    $username = $_SESSION['username'];

    // Verificar se o usuário está logado
    if (!isset($_SESSION['cd_usuario'])) {
        // Usuário não está logado, redirecionar para a página de login
        header("Location: ../public/pages/login.php");
        exit();
    }

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        deleteTarefa($delete_id);
        header("Location: tarefas_log.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/assets/css/tarefa.css">
</head>
<body>
    <div class="table-container">
        <h1 style="margin: 30px 0;">Lista de Tarefas</h1>

        <table class="table-tarefas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                    <th colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Obter todas as tarefas do usuário
                $cd_usuario = $_SESSION['cd_usuario'];
                $tarefas = getAllTarefas($cd_usuario);

                // Verificar se existem tarefas
                if (count($tarefas) > 0) {
                    foreach ($tarefas as $tarefa) {
                        echo "<tr>";
                        echo "<td>" . $tarefa['id'] . "</td>";
                        echo "<td>" . $tarefa['titulo'] . "</td>";
                        echo "<td>" . $tarefa['descricao'] . "</td>";
                        echo "<td>" . strftime('%d/%m/%Y %H:%M:%S', strtotime($tarefa['data_criacao'])) . "</td>";
                        echo "<td><button class='botao__deletar'><a href='tarefas_log.php?delete_id=" . $tarefa['id'] . "' ><i class='bi bi-trash-fill' style='color: white;'></i></a></button></td>";
                        echo "<td><button class='botao__editar' onclick='editTarefa(" . $tarefa['id'] . ")'><i class='bi bi-pencil'></i></button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='5'>Nenhuma tarefa encontrada.</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
  
</body>
</html>
