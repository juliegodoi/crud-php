<?php
// Define dados de acesso ao banco de dados
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASS')) {
    define('PASS', '');
}
if (!defined('BASE')) {
    define('BASE', 'crud');
}

// Cria a conexão utilizando os dados
$conn = new mysqli(HOST, USER, PASS, BASE);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    // Se a conexão falhar, exibe uma mensagem de erro e encerra o script
    die("Conexão falhou: " . $conn->connect_error);
}
?>