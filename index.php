<?php
// Inicia a sessão pra utilizar variáveis de sessão
session_start();
// Inclui o arquivo de configuração que contém a conexão com o banco
require("./config.php"); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <!-- Bootstrap via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand text-white fs-3 fw-bold" href="#">CRUD</a>
    </div>
  </nav>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Usuários</h4>
            <p class="mb-0">Listagem de Usuários</p>
          </div>
          <div class="card-body p-5 pt-4">
            <?php 
              // Alertas de sucesso e erro das ações
              if (isset($_SESSION['usuario_criado'])) {
                echo $_SESSION['usuario_criado'];
                unset($_SESSION['usuario_criado']);
              }
              if (isset($_SESSION['usuario_atualizado'])) {
                echo $_SESSION['usuario_atualizado'];
                unset($_SESSION['usuario_atualizado']);
              }
              if (isset($_SESSION['email_duplicado'])) {
                echo $_SESSION['email_duplicado'];
                unset($_SESSION['email_duplicado']);
              }
              if (isset($_SESSION['usuario_excluido'])) {
                echo $_SESSION['usuario_excluido'];
                unset($_SESSION['usuario_excluido']);
              }
            ?>
            <div class="d-flex justify-content-start mb-3">
              <button class="btn btn-success focus-ring focus-ring-success text-uppercase" data-bs-toggle="modal" data-bs-target="#adicionarUsuarioModal" title="Cadastrar"><i class="bi bi-plus-lg"></i> Novo usuário</button>
            </div>
            <!-- Tabela de Usuários -->
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  // Lê os usuários do banco e exibe na tabela
                  include("./read.php"); 
                ?>
                <tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Adicionar Usuário -->
  <div class="modal fade" id="adicionarUsuarioModal" tabindex="-1" aria-labelledby="adicionarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title mx-auto text-capitalize" id="adicionarUsuarioModalLabel">adicionar usuário</h5>
        </div>
        <div class="modal-body">
          <!-- Envia os dados para create.php -->
          <form action="./create.php" method="POST">
            <input type="hidden" name="acao" value="adicionar">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Telefone</label>
              <input type="text" name="telefone" pattern="[0-9]{8,11}" class="form-control">
              <small class="text-secondary">(Somente números de 8 a 11 digitos)</small>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="button" class="btn btn-secondary focus-ring focus-ring-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary focus-ring focus-ring-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Alterar Usuário -->
  <div class="modal fade" id="alterarUsuarioModal" tabindex="-1" aria-labelledby="alterarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title mx-auto text-capitalize" id="alterarUsuarioModalLabel">alterar usuário</h5>
        </div>
        <div class="modal-body">
          <!-- Envia os dados para update.php -->
          <form action="./update.php" method="POST">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Telefone</label>
              <input type="text" pattern="[0-9]{8,11}" name="telefone" class="form-control">
              <small class="text-secondary">(Somente números de 8 a 11 digitos)</small>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="button" class="btn btn-secondary focus-ring focus-ring-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary focus-ring focus-ring-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Excluir Usuário -->
  <div class="modal fade" id="excluirUsuarioModal" tabindex="-1" aria-labelledby="excluirUsuarioModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0 flex-column">
          <span><i class="bi bi-exclamation-circle text-danger text-opacity-50 display-1"></i></span>
          <h5 class="modal-title mx-auto text-capitalize fs-2" id="excluirUsuarioModalLabel">excluir usuário</h5>
        </div>
        <div class="modal-body text-center">
          <p class="fs-5 lh-1">Estas informações não poderão ser recuperadas, deseja excluir mesmo assim?</p>
          <div class="d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-primary focus-ring focus-ring-primary" id="confirmaExcluirBtn">Sim</button>
            <button type="button" class="btn btn-danger focus-ring focus-ring-danger" data-bs-dismiss="modal">Não</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts do Bootstrap via CDN e script JS personalizado -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="./script.js"></script>
</body>
</html>