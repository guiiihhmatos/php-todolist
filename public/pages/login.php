<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/login.css">
  <title>Sistema de Login</title>
</head>

<body>

  <section class="section__login">
    <div class="login d-flex justify-content-center align-items-center">

      <div class="login__container-left d-flex flex-column align-items-center justify-content-around w-50 h-100">
        <div>
          <h4>Lista de tarefas</h4>
        </div>


        <div>
          <img src="../assets/image/tarefas-diarias.png" alt="foto" class="login__imagem">
        </div>
      </div><!-- FIM - login_container-left -->

      <div class="login__container-right d-flex flex-column align-items-center w-50 h-100">

        <form action="../../includes/login_log.php" method="POST" class="d-flex flex-column align-items-center justify-content-around h-100 w-100">
          <div>
            <h4>Login</h4>
          </div>

          <div class="login__container-inputs h-25 d-flex flex-column justify-content-around w-75">
            <div>
              <input type="text" name="username" placeholder="Nome de usuário" class="form-control">
            </div>
            <div>
              <input type="password" name="password" placeholder="Senha" class="form-control">
            </div>
          </div>

          <?php
          // Verifique se há uma mensagem de erro armazenada na sessão
            session_start(); // Inicie a sessão
            if (isset($_SESSION['erro_login'])) {
              echo '<p class="error-message text-danger">' . $_SESSION['erro_login'] . '</p>';
              unset($_SESSION['erro_login']); // Limpa a mensagem de erro da sessão
            }
          ?>

          <div>
            <button type="submit" class="button__login">Entrar</button>
          </div>

        </form>


      </div><!-- FIM - login_container-right -->

    </div>
  </section>



</body>

</html>