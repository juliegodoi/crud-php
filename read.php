<?php
require("./config.php"); 

// Consulta todos os usuários ordenados por ID decrescente
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$res = $conn->query($sql);

// Verifica se tem rsultados e exibe os dados dos usuários na tabela
if ($res->num_rows > 0) {
    while($row = $res->fetch_object()){
        echo "<tr>";
        echo "<td>".$row->nome."</td>";
        echo "<td>".$row->email."</td>";
        echo "<td>".$row->telefone."</td>";
        echo "<td> 
        <button class='btn btn-secondary focus-ring focus-ring-secondary btn-sm btn-editar' title='Editar' data-bs-toggle='modal' data-bs-target='#alterarUsuarioModal' data-id='".$row->id."'> <i class='bi bi-pencil-fill'></i> </button>
        <button class='btn btn-danger focus-ring focus-ring-danger btn-sm btn-excluir' title='Excluir' data-bs-toggle='modal' data-bs-target='#excluirUsuarioModal' data-id='".$row->id."'> <i class='bi bi-trash-fill'></i> </button>
        </td>"; // Botões de editar e excluir usuário
        echo "</tr>";
    }
}
?>
