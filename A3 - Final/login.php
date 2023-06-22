<?php
include("conecta.php");

// Verifica se o formulário de login foi enviado
if (isset($_POST['login-button'])) {
  // Obtém os valores enviados pelo formulário
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Realiza a consulta no banco de dados para verificar o usuário e senha
  $stmt = $pdo->prepare("SELECT * FROM login WHERE usuario = :username AND senha = :password");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  // Verifica se o login foi bem-sucedido
  if ($stmt->rowCount() > 0) {
    // Login bem-sucedido
    // Inicie a sessão e defina as informações de autenticação
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['acesso'] = $stmt->fetch()['acesso'];

    // Redirecione o usuário para a página inicial ou outra página desejada
    header('Location: criar_chamado.php');
    exit();
  } else {
    // Login falhou
    $error_message = 'Usuário ou senha inválidos. Por favor, tente novamente.';
    header('Location: index.php?error_message=' . urlencode($error_message));
    exit();
  }
}
$pdo = null;
?>
