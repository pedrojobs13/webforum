<?php
$tituloPagina = "WebForum - Login";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <div class="card">
                <div class="card-body p-4">
                    <h1 class="card-title mb-3">Login</h1>

                    <p class="text-muted">
                        Acesse sua conta para usar o WebForum.
                    </p>

                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                        echo "<div class='alert alert-danger'>Login incorreto.</div>";
                    }

                    if (isset($_GET['erro']) && $_GET['erro'] == 2) {
                        echo "<div class='alert alert-warning'>Você precisa estar logado para acessar essa página.</div>";
                    }

                    if (isset($_GET['erro']) && $_GET['erro'] == 3) {
                        echo "<div class='alert alert-danger'>Sua conta foi banida por má conduta. Entre em contato com o administrador.</div>";
                    }

                    if (isset($_GET['cadastro'])) {
                        echo "<div class='alert alert-success'>Usuário cadastrado com sucesso. Faça login.</div>";
                    }
                    ?>

                    <form action="../controlers/controlerUsuario.php" method="post">
                        <input type="hidden" name="pOpcao" value="2">

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input
                                    type="email"
                                    name="pEmail"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>"
                                    required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="pSenha" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Entrar
                        </button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Ainda não tem conta?
                        <a href="formCadastroUsuario.php">Cadastre-se</a>
                    </p>

                    <p class="text-center mb-0">
                        <a href="index.php">Voltar para início</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</main>

<?php require_once 'includes/rodape.inc.php'; ?>
