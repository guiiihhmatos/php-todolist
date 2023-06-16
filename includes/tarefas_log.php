<?php

    session_start();

    require_once '../configuration/queries/tarefa_queries.php';
    require_once './components/header.php';

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

    if (isset($_GET['status_id'], $_GET['status'])) {
        $status_id = $_GET['status_id'];
        $status = $_GET['status'];
        alterStatus($status_id, $status);
        header("Location: tarefas_log.php");
        exit();
    }

    $tarefas = getAllTarefas($cd_usuario);

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
        <h1 style="margin-top: 20px; color: white;">Lista de Tarefas</h1>

        <table class="table-tarefas">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                    <th>Data de Conclusão</th>
                    <th colspan="2">Ação</th>
                    <th>Concluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($tarefas) > 0) : ?>
                    <?php foreach ($tarefas as $tarefa) : ?>
                        <tr>
                            <td><?= $tarefa['titulo'] ?></td>
                            <td><?= $tarefa['descricao'] ?></td>
                            <td><?= date('d/m/Y H:m:s', strtotime($tarefa['data_criacao'])) ?></td>
                            <td><?= $tarefa['data_conclusao']? date('d/m/Y H:m:s', strtotime($tarefa['data_conclusao'])) : 'Em aberto' ?></td>
                            <td><a title="Deletar" class='botao__deletar' href='tarefas_log.php?delete_id=<?= $tarefa['cd_tarefa'] ?>'><i class='bi bi-trash-fill' style='color: white;'></i></a></td>
                            <td><a title="Editar" class='botao__editar' href='criarTarefa_log.php?cd_tarefa=<?= $tarefa['cd_tarefa'] ?>'><i class='bi bi-pencil' style='color: black;'></i></a></td>
                            <td>
                                <?php if ($tarefa['fl_status']) : ?>
                                    <a title="Reabrir" class='botao__reabrir' href='tarefas_log.php?status_id=<?= $tarefa['cd_tarefa']?>&status=false'><i class='bi bi-x-circle' style='color: white;'></i></a>

                                <?php else : ?>
                                    <a title="Concluir" class='botao__concluir' href='tarefas_log.php?status_id=<?= $tarefa['cd_tarefa']?>&status=true'><i class='bi bi-check-circle' style='color: black;'></i></a>

                            </td>
                        <?php endif ?>
                        </td>
                        </tr>

                    <?php endforeach ?>
                <?php endif ?>

            </tbody>
        </table>
    </div>

</body>

</html>