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

    <div class="content-area" style="position: relative">
        <div>
            <div class="atendimentos">
                <div class="atendimentos-titulo">Listagem de Atendimentos Passados</div>
                <form action="" method="GET">
                    <div class="search-container">
                        <label class="search-container-label">
                            <span>ID do Chamado:</span>
                            <input type="text" class="search-container-input" value="" name="idPrimaria" placeholder="">
                        </label>
                        <label class="search-container-label">
                            <span>Suporte:</span>
                            <input type="text" class="search-container-input" value="" name="suporte" placeholder="">
                        </label>
                        <label class="search-container-label">
                            <span>Cliente:</span>
                            <input type="text" class="search-container-input" value="" name="cliente" placeholder="">
                        </label>
                        <label class="search-container-label">
                            <span>Origem:</span>
                            <input type="text" class="search-container-input" value="" name="origem" placeholder="">
                        </label>
                        <label class="search-container-label">
                            <span>Motivo:</span>
                            <input type="text" class="search-container-input" value="" name="motivo" placeholder="">
                        </label>
                        <button type="submit" name="pesquisarTabela" class="btn">Pesquisar</button>
                    </div>
                </form>

                <table id="tabela-atendimentos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Suporte</th>
                            <th>Origem</th>
                            <th>Cliente</th>
                            <th>Motivo</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("conecta.php");

                        if (isset($_GET['pesquisarTabela'])) {
                            $query = "SELECT * FROM chamados WHERE ";

                            $conditions = array();

                            if (!empty($_GET['idPrimaria'])) {
                                $idPrimaria = trim($_GET['idPrimaria']);
                                $conditions[] = "idPrimaria = $idPrimaria";
                            }

                            // Verifica se o campo 'suporte' foi preenchido
                            if (!empty($_GET['suporte'])) {
                                $suporte = trim($_GET['suporte']);
                                $conditions[] = "suporte LIKE '%$suporte%'";
                            }

                            // Verifica se o campo 'cliente' foi preenchido
                            if (!empty($_GET['cliente'])) {
                                $cliente = trim($_GET['cliente']);
                                $conditions[] = "cliente LIKE '%$cliente%'";
                            }

                            // Verifica se o campo 'origem' foi preenchido
                            if (!empty($_GET['origem'])) {
                                $origem = trim($_GET['origem']);
                                $conditions[] = "origem LIKE '%$origem%'";
                            }

                            // Verifica se o campo 'motivo' foi preenchido
                            if (!empty($_GET['motivo'])) {
                                $motivo = trim($_GET['motivo']);
                                $conditions[] = "motivo LIKE '%$motivo%'";
                            }

                            // Constrói a cláusula WHERE da consulta
                            if (!empty($conditions)) {
                                $query .= implode(" AND ", $conditions);
                            } else {
                                $query .= "1"; // Caso nenhum campo tenha sido preenchido, retorna todos os registros
                            }

                            $stmt = $pdo->query($query);

                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr class="linha-atendimento">
                                        <td>
                                            <?= $row['idPrimaria']; ?>
                                        </td>
                                        <td>
                                            <?= trim($row['suporte']); ?>
                                        </td>
                                        <td>
                                            <?= $row['origem']; ?>
                                        </td>
                                        <td>
                                            <?= trim($row['cliente']); ?>
                                        </td>
                                        <td>
                                            <?= trim($row['motivo']); ?>
                                        </td>
                                        <td>
                                            <?= $row['data']; ?>
                                        </td>
                                        <td class="hidden">
                                            <?= $row['descricao']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="6">No Record Found</td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="detalhes">
            <div class="details-op">
                <header>
                    <div>
                        <span>Detalhes do Chamado</span>
                        <i class="close-details" onclick="fecharDetalhes()">X</i>
                    </div>
                </header>
                <form class="form-op" action="" method="">
                    <div class="form-row">
                        <div class="form-column">
                            <label for="idPrimaria" class="form-label" style="width: 300px;">ID do Atendimento:
                                <input type="text" class="form-control" style="width: 290px;" id="idPrimaria"
                                    name="idPrimaria" placeholder="" readonly>
                            </label>
                        </div>
                        <div class="form-column">
                            <label for="data" class="form-label" style="width: 300px;">Data:
                                <input type="text" class="form-control" style="width: 290px;" id="data" name="data"
                                    placeholder="" readonly>
                            </label>
                        </div>
                    </div>
                    <label for="suporteForm" class="form-label" style="width: 620px;">Suporte:
                        <input type="text" class="form-control" style="width: 610px;" id="suporte" name="suporte"
                            placeholder="" readonly>
                    </label>
                    <label for="cliente" class="form-label" style="width: 620px;">Cliente:
                        <input type="text" class="form-control" style="width: 610px;" id="cliente" name="cliente"
                            placeholder="" readonly>
                    </label>
                    <label for="motivo" class="form-label" style="width: 620px;">Motivo:
                        <input type="text" class="form-control" style="width: 610px;" id="motivo" name="motivo"
                            placeholder="" readonly>
                    </label>
                    <label for="descricao" class="form-label-description" style="width: 620px;">Descrição:
                        <textarea class="form-control-description" style="width: 610px; resize: none;" id="descricao"
                            name="descricao" readonly oninput="ajustarAlturaDescricao()"></textarea>
                    </label>
                </form>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>