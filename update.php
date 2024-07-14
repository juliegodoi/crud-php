<?php
session_start();
require("./config.php");

// Verifica se os dados foram enviados via POST e obtém os dados do usuário
if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    // Verifica se o novo email já está em uso por outro usuário
    $sql_verifica_email = "SELECT id FROM usuarios WHERE email = '{$email}' AND id <> {$id}";
    $result = $conn->query($sql_verifica_email);

    // Se o email já existe, exibe um alerta e redireciona para o index
    if ($result->num_rows > 0) {
        $_SESSION['email_duplicado'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro!</strong> Um usuário com esse email já existe.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header("Location: ./index.php");
        exit();
    } else {
        // Se o email ainda não existeir, atualiza os dados do usuário no banco de dados
        $sql = "UPDATE usuarios SET nome = '{$nome}', email = '{$email}', telefone = '{$telefone}' WHERE id = {$id}";
        
        // Exibe alerta de sucesso e redireciona para o index
        if ($conn->query($sql) === TRUE) {
            $_SESSION['usuario_atualizado'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> Usuário atualizado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            header("Location: ./index.php");
            exit();
        }
    }
}
?>