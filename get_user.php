<?php
  require("./config.php");

  // Verifica se o ID do usuário foi passado via GET e obtém o ID
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Consulta o usuário pelo ID
    $sql = "SELECT * FROM usuarios WHERE id = '{$id}'";
    $result = $conn->query($sql);
    
    // Verifica se tem resultados e retorna os dados do usuário em JSON
    if ($result->num_rows > 0) {
      echo json_encode($result->fetch_assoc());
    } else {
      // Retorna um array vazio se nenhum usuário foi encontrado
      echo json_encode([]);
    }
  }
?>