<?php
$tituloPagina = "WebForum - Início";
$paginaCSS = "home.css";
require_once 'includes/cabecalho.inc.php';
?>

    <main class="container">

        <section class="hero">

            <h1>WebForum</h1>

            <p>
                Bem-vindo ao WebForum. Este sistema permite que usuários cadastrados
                troquem mensagens internas de forma simples.
            </p>

            <div class="botoes">
                <a href="formLogin.php" class="btn btn-azul">Entrar</a>
                <a href="formCadastroUsuario.php" class="btn btn-outline">Cadastrar usuário</a>
            </div>
        </section>

        <section class="cards">
            <div class="card">
                <h3>Envio de mensagens</h3>
                <p>
                    Envie mensagens para outros usuários já cadastrados no sistema.
                </p>
            </div>

            <div class="card">
                <h3>Caixa de entrada</h3>
                <p>
                    Visualize suas mensagens recebidas, mostrando remetente e assunto.
                </p>
            </div>

            <div class="card">
                <h3>Área restrita</h3>
                <p>
                    Apenas usuários autenticados podem acessar as funcionalidades internas.
                </p>
            </div>
        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>