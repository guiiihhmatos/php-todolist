<?php
  require '../configuration/queries/login_queries.php';

  // Verificar se o botão de logout foi clicado
  if (isset($_POST['logout'])) {
    logout();
  }

  $username = $_SESSION['username'];
?>

<head>
  <link rel="stylesheet" href="../public/assets/css/header.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<div class="header__list">

    <ul>
      <li><a href="./CriarTarefa_log.php">Criar Tarefa</a></li>
      <li style="margin-left: 20px;"><a href="./Tarefas_log.php">Minhas Tarefas</a></li>
    </ul>

    <form method="POST" class="usuario__Pai">
      <div class="usuario">
        <i class="bi bi-person-fill" style="color: white;"></i>
        <p style="color: white; margin: 0 10px; font-size: 18px;"><?= $username ?></p>
      </div>
      <button class="botao-logout" type="submit" name="logout">Logout</button>
    </form>
</div>
