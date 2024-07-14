<?php
// Inicia a sessão e carrega as configurações do banco
session_start();
require("./config.php");

// Verifica se os dados foram enviados via POST e obtém os dados do usuário
if (isset($_POST["acao"]) && $_POST["acao"] == 'adicionar') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    // Verifica se o email já está em uso
    $sql_verifica_email = "SELECT id FROM usuarios WHERE email = '{$email}'";
    $result = $conn->query($sql_verifica_email);

    // Se o email já existe, exibe um alerta de erro
    if ($result->num_rows > 0) {
        $_SESSION['email_duplicado'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro!</strong> Um usuário com esse email já existe.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header("Location: ./index.php");
        exit();
    } else {
        // Se o email for único, adiciona o usuário, exibe alerta de sucesso e redireciona para o index
        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES ('{$nome}', '{$email}', '{$telefone}')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['usuario_criado'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> Usuário criado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            header("Location: ./index.php");
            exit();
        }
    }
}
?>