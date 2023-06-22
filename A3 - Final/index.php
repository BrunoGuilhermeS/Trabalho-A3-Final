<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="login-page">
        <form action="login.php" method="POST" class="login-form">
            <div class="login-label">
              <span>Usuário:</span>
              <input type="text" id="username" name="username">
            </div>
          
            <div class="login-label">
              <span>Senha:</span>
              <input type="password" id="password" name="password">
            </div>
            <div class="error-message">
            <?php if (isset($_GET['error_message'])): ?>
                <span><?php echo $_GET['error_message']; ?></span>
              <?php endif; ?>
            </div>         
            <button class="login-button" type="submit" name="login-button">Entrar</button>
          </form>
        </div>
</body>
</html>
