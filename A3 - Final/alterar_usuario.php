<?php
include("conecta.php");

session_start();
// Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
    $suporte = $_SESSION['username'];
} else {
    header("Location: index.php");
    exit;
}

$sql = "SELECT usuario FROM login WHERE acesso <> 1";
$result = $pdo->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="./jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="sidebar">
        <header>
            <div>
                <i class='toggle'> <img src="./images/arrow.svg" alt=""></i>
            </div>
        </header>
        <div class="menu-sidebar">
            <div class="menu">
                <ul class="menu-links">
                    <li>
                        <a class="nav-link" href="criar_chamado.php">
                            <img src="./images/criar-op.svg" class="normal-img">
                            <img src="./images/criar-op-darkmode.svg" class="hover-img">
                            <span> Criar Chamado </span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="historico_chamados.php">
                            <img src="./images/historico.svg" class="normal-img">
                            <img src="./images/historico-darkmode.svg" class="hover-img">
                            <span> Histórico </span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="criar_usuario.php">
                            <img src="./images/dashboard.svg" class="normal-img">
                            <img src="./images/dashboard-darkmode.svg" class="hover-img">
                            <span> Gerenciar Usuários </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-sidebar">
            <ul class="menu-links">
                <li>
                    <a class="nav-link" href="log_out.php">
                        <img src="./images/log-out.svg" class="normal-img">
                        <img src="./images/log-out-darkmode.svg" class="hover-img">
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-area">
        <div class="users-menu">
            <div class="users-select">
                <header>
                    <div>
                        <a href="criar_usuario.php" class="criarUsuario">Novo Usuário</a>
                    </div>
                </header>
                <header>
                    <div>
                        <a href="alterar_usuario.php" class="alterarUsuario">Alterar Usuário</a>
                    </div>
                </header>
                <header>
                    <div>
                        <a href="deletar_usuario.php" class="deletarUsuario">Deletar Usuário</a>
                    </div>
                </header>
            </div>
            <div class="alterarUsuarioScreen" id="alterarUsuarioScreen">
                <form class="form-op" action="gerenciar_usuarios_crud.php" method="post">
                    <label for="usuario" class="form-label">Selecione o Usuário:
                        <select class="form-control" id="usuario" name="usuario">
                            <?php foreach ($result as $row1): ?>
                                <option value="<?php echo $row1['usuario']; ?>"><?php echo $row1['usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label for="acesso" class="form-label">Acesso:
                        <select class="form-control" id="acesso" name="acesso">
                            <option value="2">Admin</option>
                            <option value="3">Usuário</option>
                        </select>
                    </label>
                    <label for="email" class="form-label">Novo Email:
                        <input type="text" class="form-control" id="email" name="email" placeholder="">
                    </label>
                    <label for="senha" class="form-label">Nova Senha:
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="">
                    </label>
                    <div class="error-message">
                        <?php if (isset($_GET['error_message'])): ?>
                            <span>
                                <?php echo $_GET['error_message']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="success-message">
                        <?php if (isset($_GET['succes_message'])): ?>
                            <span>
                                <?php echo $_GET['succes_message']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" name="alterarUsuario" class="submit-button">Alterar Dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./script.js"> </script>
</body>

</html>
