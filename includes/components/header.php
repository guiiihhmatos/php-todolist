<?php
  require '../configuration/queries/login_queries.php';

  // Verificar se o botão de logout foi clicado
  if (isset($_POST['logout'])) {
    logout();
  }
?>

<head>
  <link rel="stylesheet" href="../public/assets/css/header.css">
</head>

<div class="header__list">

    <ul>
      <li><a href="./CriarTarefa_log.php">Criar Tarefa</a></li>
      <li style="margin-left: 20px;"><a href="./Tarefas_log.php">Minhas Tarefas</a></li>
    </ul>

    <form method="POST">
      <button class="botao-logout" type="submit" name="logout">Logout</button>
    </form>
</div>
