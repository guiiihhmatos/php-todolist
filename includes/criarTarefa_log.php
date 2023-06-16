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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar se o formulário foi submetido
        if (isset($_POST['cd_tarefa'])) {
            $id = $_POST['cd_tarefa'];
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $fl_status = $_POST['fl_status'];

            editTarefa($id, $titulo, $descricao, $fl_status);

            // Redirecionar para evitar o envio duplicado do formulário
            header("Location: tarefas_log.php");
        }
        else if (isset($_POST['titulo'], $_POST['descricao'], $_POST['fl_status'])) {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $fl_status = $_POST['fl_status'];

            // Chamar a função createTarefa passando os dados do formulário
            createTarefa($titulo, $cd_usuario, $descricao, $fl_status);
            // Redirecionar para evitar o envio duplicado do formulário
            header("Location: tarefas_log.php");
            exit();
        }
    }

    if(isset($_GET['cd_tarefa'])){

        $return = getById($_GET['cd_tarefa']);

        $titulo = $return['titulo'];
        $descricao = $return['descricao'];
        $fl_status = $return['fl_status'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Tarefas</title>
    <link rel="stylesheet" href="../public/assets/css/tarefa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="section__tarefa">
        <div class="tarefas">
            
            <div class="tarefas__title">
                <h3>Criar tarefa</h3>
            </div>

            <form method="POST" class="w-75 d-flex flex-column justify-content-center align-items-center">
                
                <?php if(isset($_GET['cd_tarefa'])): ?>
                    <input type="hidden" name="cd_tarefa" value="<?= $_GET['cd_tarefa'] ?>">
                <?php endif ?>

                <div class="w-100">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" name="titulo" value="<?php if(isset($titulo)){echo $titulo;} ?>" required>
                </div>

                <div class="my-3 w-100">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao" class="form-control" required><?php if(isset($descricao)){echo $descricao;} ?></textarea>
                </div>

                <div class="mb-3 w-100">
                    <label class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="fl_status">
                        <option <?php if(isset($fl_status) && !$fl_status){echo 'selected';} ?> value="false">Em aberto</option>
                        <option <?php if(isset($fl_status) && $fl_status){echo 'selected';} ?> value="true">Finalizada</option>
                    </select>
                </div>

                <?php if(isset($_GET['cd_tarefa'])): ?>

                    <button type="submit" class="botao mt-2">Editar Tarefa</button>

                    <?php else : ?>

                    <button type="submit" class="botao mt-2">Adicionar Tarefa</button>

                <?php endif ?>

            </form>

        </div>
    </div>
</body>
</html>
