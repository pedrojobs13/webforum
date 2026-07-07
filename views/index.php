<?php
$tituloPagina = "WebForum - Início";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <div class="p-5 mb-4 bg-light rounded-3">
        <h1 class="display-5 fw-bold">WebForum</h1>

        <p class="col-md-8 fs-4">
            Sistema de troca de mensagens entre usuários cadastrados,
            desenvolvido para a disciplina de Desenvolvimento de Sistemas Web.
        </p>

        <a href="formLogin.php" class="btn btn-primary btn-lg me-2">Entrar</a>
        <a href="formCadastroUsuario.php" class="btn btn-outline-secondary btn-lg">Cadastrar usuário</a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Envio de mensagens</h5>
                    <p class="card-text">
                        Envie mensagens para outros usuários cadastrados no sistema.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Caixa de entrada</h5>
                    <p class="card-text">
                        Veja as mensagens recebidas, com remetente e assunto.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Área restrita</h5>
                    <p class="card-text">
                        Só é possível acessar essas funcionalidades estando logado.
                    </p>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require_once 'includes/rodape.inc.php'; ?>
