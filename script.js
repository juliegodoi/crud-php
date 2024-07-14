document.addEventListener("DOMContentLoaded", function() {
  // Lida com o clique no botão de editar usuário
  document.querySelectorAll('.btn-editar').forEach(button => {
    button.addEventListener('click', function() {
      // Obtém o ID do usuário
      const idUsuario = this.getAttribute('data-id');

      // Requisição pra obter os dados do usuário pelo ID
      fetch(`./get_user.php?id=${idUsuario}`)
        .then(response => response.json())
        .then(data => {
          // Preenche os campos do modal de edição com os dados do usuário
          document.querySelector('#alterarUsuarioModal input[name="id"]').value = data.id;
          document.querySelector('#alterarUsuarioModal input[name="nome"]').value = data.nome;
          document.querySelector('#alterarUsuarioModal input[name="email"]').value = data.email;
          document.querySelector('#alterarUsuarioModal input[name="telefone"]').value = data.telefone;
        })
        .catch(error => console.error('Error:', error));
    });
  });

  // Lida com o clique no botão de excluir usuário
  let idUsuarioDeletar = null;

  document.querySelectorAll('.btn-excluir').forEach(button => {
    button.addEventListener('click', function() {
      // Obtém o ID do usuário
      idUsuarioDeletar = this.getAttribute('data-id');
    });
  });

  // Confirma a exclusão do usuário
  document.getElementById('confirmaExcluirBtn').addEventListener('click', function() {
    if (idUsuarioDeletar) {
      // Requisição pra deletar o usuário pelo ID
      fetch(`./delete.php?id=${idUsuarioDeletar}`, {
          method: 'GET',
      })
      .then(response => {
          if (response.ok) {
            // Redireciona para o index se a exclusão for confirmada e o usuário excluído
            window.location.href = './index.php';
          }
      })
      .catch(error => console.error('Error:', error));
    }
  });
});
