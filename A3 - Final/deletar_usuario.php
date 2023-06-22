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

$sql = "SELECT usuario FROM login WHERE acesso <> 1 AND usuario <> :usuario_atual";
$consulta = $pdo->prepare($sql);
$consulta->bindValue(':usuario_atual', $suporte);
$consulta->execute();
$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include("conecta.php");
// Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
    $suporte = $_SESSION['username'];
} else {
    header("Location: index.php");
    exit;
}

$sql = "SELECT usuario FROM login WHERE acesso <> 1 AND usuario <> :usuario_atual";
$consulta = $pdo->prepare($sql);
$consulta->bindValue(':usuario_atual', $suporte);
$consulta->execute();
$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="./jquery-3.6.0.min.js"></script>
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
            <div class="deletarUsuarioScreen" id="deletarUsuarioScreen">
                <form class="form-op" action="gerenciar_usuarios_crud.php" id="deletarUsuarioForm" method="POST">
                    <label for="usuario" class="form-label">Selecione o Usuário:
                        <select class="form-control" id="usuario" name="usuario">
                            <?php foreach ($result as $row1): ?>
                                <option value="<?php echo $row1['usuario']; ?>"><?php echo $row1['usuario']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <button type="submit" name="deletarUsuario" class="submit-button">Deletar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"> </script>
    </div>
</body>

</html>