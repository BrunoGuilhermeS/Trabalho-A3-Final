<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
  $suporte = $_SESSION['username'];
} else {
  $response = array("error" => "Usuário não está logado");
  echo json_encode($response);
  exit();
}

include("conecta.php");

$cliente = $_POST["cliente"];
$origem = $_POST["origem"];
$motivo = $_POST["motivo"];
$descricao = $_POST["descricao"];

if (isset($_POST["criarOp"])) {
    // Verifica se os campos estão preenchidos
    if (empty($cliente) || empty($origem) || empty($motivo) || empty($descricao)) {
        $error_message = 'Todos os campos devem ser preenchidos.';
        header('Location: criar_chamado.php?error_message=' . urlencode($error_message));
    } else {
        $comando = "INSERT INTO chamados (idPrimaria, suporte, cliente, origem, motivo, descricao, data, hora) VALUES (Null, :suporte, :cliente, :origem, :motivo, :descricao, CURDATE(), CURTIME())";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(':suporte', $suporte);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':origem', $origem);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            $succes_message = 'Chamado criado com sucesso.';
            header('Location: criar_chamado.php?error_message=' . urlencode($succes_message));
        } else {
            $error_message = 'Erro ao inserir dados.';
            header('Location: criar_chamado.php?error_message=' . urlencode($error_message));
        }
    }
}
?>
