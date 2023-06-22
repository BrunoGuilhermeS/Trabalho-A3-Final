<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include("conecta.php");
    
    if (isset($_POST["criarUsuario"])) {
        if (empty($_POST["novousuario"]) || empty($_POST["email"]) || empty($_POST["senha"]) || empty($_POST["acesso"])) {
            $error_message = 'Todos os campos devem ser preenchidos.';
            header('Location: criar_usuario.php?error_message=' . urlencode($error_message));
        } else {
            $novousuario = $_POST["novousuario"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $acesso = $_POST["acesso"];

            $consulta = $pdo->prepare("SELECT COUNT(*) FROM login WHERE usuario = ? OR email = ?");
            $consulta->execute([$novousuario, $email]);
            $registroExistente = $consulta->fetchColumn();
    
            if ($registroExistente > 0) {
                $error_message = 'Usuário já existe.';
                header('Location: criar_usuario.php?error_message=' . urlencode($error_message));
            } else {
                $comando = $pdo->prepare("INSERT INTO login (idPrimaria, usuario, email, senha, acesso) VALUES (Null, ?, ?, ?, ?)");
                $resultado = $comando->execute([$novousuario, $email, $senha, $acesso]);

                if ($resultado) {
                    $succes_message = 'Novo usuário criado com sucesso.';
                    header('Location: criar_usuario.php?error_message=' . urlencode($succes_message));
                } else {
                    $error_message = 'Erro ao inserir usuário no banco de dados.';
                    header('Location: criar_usuario.php?error_message=' . urlencode($error_message));
                }
            }
        }
    }

    if (isset($_POST["deletarUsuario"])) {
        $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    
        if ($usuario == $suporte) {
            $_SESSION["mensagemErro"] = "Erro ao excluir usuário.";
            header("Location: deletar_usuario.php");
            exit;
        }
    
        $comando = $pdo->prepare("DELETE FROM login WHERE usuario = ?");
        $resultado = $comando->execute([$usuario]);
    
        if ($resultado) {
            $succes_message = 'Usuário excluído do sistema.';
            header('Location: deletar_usuario.php?error_message=' . urlencode($succes_message));
        } else {
            $error_message = 'Erro ao excluir usuário.';
            header('Location: deletar_usuario.php?error_message=' . urlencode($error_message));
        }
    }

    if (isset($_POST["alterarUsuario"])) {
        $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
        $acesso = isset($_POST["acesso"]) ? $_POST["acesso"] : "";
    
        $consulta = $pdo->prepare("SELECT COUNT(*) FROM login WHERE email = ?");
        $consulta->execute([$email]);
        $registroExistente = $consulta->fetchColumn();
    
        if ($registroExistente > 0) {
            $error_message = 'Email já cadastrado.';
            header('Location: alterar_usuario.php?error_message=' . urlencode($error_message));
        } else {
    
            $comando = $pdo->prepare("UPDATE login SET EMAIL = ?, SENHA = ?, ACESSO = ? WHERE USUARIO = ?");
            $resultado = $comando->execute([$email, $senha, $acesso, $usuario]);
    
            if ($resultado) {
                $succes_message = 'Dados atualizados com sucesso.';
                header('Location: alterar_usuario.php?error_message=' . urlencode($succes_message));
            } else {
                $errorInfo = $comando->errorInfo();
                $_SESSION["mensagemErro"] = "Erro ao inserir atualização no banco de dados. Detalhes: Código: " . $errorInfo[1] . ", Mensagem: " . $errorInfo[2];
                header("Location: alterar_usuario.php");
                exit;
            }
        }
    }
    
    
?>