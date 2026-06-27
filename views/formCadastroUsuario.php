<?php
$tituloPagina = "WebForum - Cadastro";
$paginaCSS = "auth.css";
require_once 'includes/cabecalho.inc.php';
?>

    <main class="auth-container">

        <section class="auth-card">
            <h1>Cadastro</h1>

            <p class="subtitulo">
                Crie sua conta para trocar mensagens no WebForum.
            </p>

            <?php
            if (isset($_GET['erro'])) {
                echo "<div class='alerta alerta-erro'>Erro ao cadastrar. Verifique se o e-mail já existe.</div>";
            }
            ?>

            <form action="../controlers/controlerUsuario.php" method="post">
                <input type="hidden" name="pOpcao" value="1">

                <div class="form-group">
                    <label>Nome</label>
                    <input
                            type="text"
                            name="pNome"
                            class="form-control"
                            placeholder="Digite seu nome"
                            required
                    >
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input
                            type="email"
                            name="pEmail"
                            class="form-control"
                            placeholder="Digite seu e-mail"
                            required
                    >
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input
                            type="password"
                            name="pSenha"
                            class="form-control"
                            placeholder="Digite sua senha"
                            required
                    >
                </div>

                <button type="submit" class="btn btn-azul" style="width: 100%;">
                    Cadastrar
                </button>
            </form>

            <p class="link-centro">
                Já tem conta?
                <a href="formLogin.php">Fazer login</a>
            </p>

            <p class="link-centro">
                <a href="index.php">Voltar para início</a>
            </p>
        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>