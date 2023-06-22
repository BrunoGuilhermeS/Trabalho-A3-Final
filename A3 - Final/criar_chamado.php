<?php
session_start();

if (isset($_SESSION['username'])) {
    $suporte = $_SESSION['username'];
} else {
    header('Location: index.php');
    exit();
}
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
        <div class="criarChamadoScreen">
            <form class="form-op" action="criar_chamado_crud.php" method="post">
                <label for="suporte" class="form-label">Suporte:
                    <input type="text" class="form-control" id="suporte" name="suporte" value="<?php echo $suporte; ?>"
                        readonly>
                </label>
                <label for="cliente" class="form-label">Cliente:
                    <input type="text" class="form-control" id="cliente" name="cliente"
                        placeholder="Inserir buscar cliente cadastrados">
                </label>
                <label for="origem" class="form-label">Origem do Atendimento:
                    <input type="text" class="form-control" id="origem" name="origem" placeholder="Origem do chamado">
                </label>
                <label for="motivo" class="form-label">Motivo:
                    <input type="text" class="form-control" id="motivo" name="motivo"
                        placeholder="Coloque aqui o motivo do atendimento">
                </label>
                <label for="descricao" class="form-label">Descrição:
                    <input type="text" class="form-control" id="descricao" name="descricao"
                        placeholder="Coloque aqui a descricão">
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
                    <button type="button" class="cancel-button" id="cancelarCriarOp">Limpar</button>
                    <button type="submit" class="submit-button" name="criarOp">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>