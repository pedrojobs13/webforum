<?php
$tituloPagina = "WebForum - Login";
$paginaCSS = "auth.css";
require_once 'includes/cabecalho.inc.php';
?>

    <main class="auth-container">

        <section class="auth-card">
            <h1>Login</h1>

            <p class="subtitulo">
                Acesse sua conta para usar o WebForum.
            </p>

            <?php
            if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                echo "<div class='alerta alerta-erro'>Login incorreto.</div>";
            }

            if (isset($_GET['erro']) && $_GET['erro'] == 2) {
                echo "<div class='alerta alerta-aviso'>Você precisa estar logado para acessar essa página.</div>";
            }

            if (isset($_GET['cadastro'])) {
                echo "<div class='alerta alerta-sucesso'>Usuário cadastrado com sucesso. Faça login.</div>";
            }
            ?>

            <form action="../controlers/controlerUsuario.php" method="post">
                <input type="hidden" name="pOpcao" value="2">

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="pEmail" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="pSenha" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-azul" style="width: 100%;">
                    Entrar
                </button>
            </form>

            <p class="link-centro">
                Ainda não tem conta?
                <a href="formCadastroUsuario.php">Cadastre-se</a>
            </p>

            <p class="link-centro">
                <a href="index.php">Voltar para início</a>
            </p>
        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>