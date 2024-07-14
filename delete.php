<?php
session_start();
require("./config.php");

// Verifica se o ID do usuário foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o ID é um número válido
    if (is_numeric($id)) {
        // Monta a consulta para deletar usuário do banco
        $sql = "DELETE FROM usuarios WHERE id = $id";
        
        // Executa a consulta exibindo mensagem de sucesso
        if ($conn->query($sql) === TRUE) {
            $_SESSION['usuario_excluido'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> Usuário excluído.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
}
?>
