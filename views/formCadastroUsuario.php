<?php
$tituloPagina = "WebForum - Cadastro";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <div class="card">
                <div class="card-body p-4">
                    <h1 class="card-title mb-3">Cadastro</h1>

                    <p class="text-muted">
                        Crie sua conta para trocar mensagens no WebForum.
                    </p>

                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] == 2) {
                        echo "<div class='alert alert-danger'>As senhas informadas não são iguais.</div>";
                    } elseif (isset($_GET['erro'])) {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar. Verifique se o e-mail já existe.</div>";
                    }
                    ?>

                    <form action="../controlers/controlerUsuario.php" method="post" novalidate>
                        <input type="hidden" name="pOpcao" value="1">

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input
                                    type="text"
                                    id="pNome"
                                    name="pNome"
                                    class="form-control"
                                    placeholder="Digite seu nome"
                                    required
                            >
                            <div class="invalid-feedback" id="erroNome"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input
                                    type="email"
                                    id="pEmail"
                                    name="pEmail"
                                    class="form-control"
                                    placeholder="Digite seu e-mail"
                                    required
                            >
                            <div class="invalid-feedback" id="erroEmail"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input
                                    type="password"
                                    id="pSenha"
                                    name="pSenha"
                                    class="form-control"
                                    placeholder="Digite sua senha"
                                    minlength="6"
                                    required
                            >
                            <div class="invalid-feedback" id="erroSenha"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirme a senha</label>
                            <input
                                    type="password"
                                    id="pConfirmaSenha"
                                    name="pConfirmaSenha"
                                    class="form-control"
                                    placeholder="Digite a senha novamente"
                                    minlength="6"
                                    required
                            >
                            <div class="invalid-feedback" id="erroConfirmaSenha"></div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Cadastrar
                        </button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Já tem conta?
                        <a href="formLogin.php">Fazer login</a>
                    </p>

                    <p class="text-center mb-0">
                        <a href="index.php">Voltar para início</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    (function () {
        const campoNome = document.getElementById('pNome');
        const campoEmail = document.getElementById('pEmail');
        const campoSenha = document.getElementById('pSenha');
        const campoConfirma = document.getElementById('pConfirmaSenha');
        const erroNome = document.getElementById('erroNome');
        const erroEmail = document.getElementById('erroEmail');
        const erroSenha = document.getElementById('erroSenha');
        const erroConfirma = document.getElementById('erroConfirmaSenha');

        function validarNome(forcarVazio) {
            const valido = campoNome.value.trim().length > 0;
            const mostrar = forcarVazio || campoNome.value.length > 0;

            campoNome.classList.toggle('is-invalid', mostrar && !valido);
            erroNome.textContent = (mostrar && !valido) ? 'O nome não pode ficar vazio.' : '';

            return valido;
        }

        function validarEmail(forcarVazio) {
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const valido = regexEmail.test(campoEmail.value.trim());
            const mostrar = forcarVazio || campoEmail.value.length > 0;

            campoEmail.classList.toggle('is-invalid', mostrar && !valido);
            erroEmail.textContent = (mostrar && !valido) ? 'Informe um e-mail válido.' : '';

            return valido;
        }

        function validarSenha(forcarVazio) {
            const valida = campoSenha.value.length >= 6;
            const mostrar = forcarVazio || campoSenha.value.length > 0;

            campoSenha.classList.toggle('is-invalid', mostrar && !valida);
            erroSenha.textContent = (mostrar && !valida) ? 'A senha deve ter no mínimo 6 caracteres.' : '';

            return valida;
        }

        function validarConfirmacao(forcarVazio) {
            const confere = campoConfirma.value === campoSenha.value && campoConfirma.value.length > 0;
            const mostrar = forcarVazio || campoConfirma.value.length > 0;

            campoConfirma.classList.toggle('is-invalid', mostrar && !confere);
            erroConfirma.textContent = (mostrar && !confere)
                ? (campoConfirma.value.length === 0 ? 'Confirme a senha digitada.' : 'As senhas não coincidem.')
                : '';

            return confere;
        }

        campoNome.addEventListener('input', function () {
            validarNome(false);
        });

        campoEmail.addEventListener('input', function () {
            validarEmail(false);
        });

        campoSenha.addEventListener('input', function () {
            validarSenha(false);
            validarConfirmacao(false);
        });

        campoConfirma.addEventListener('input', function () {
            validarConfirmacao(false);
        });

        document.querySelector('form').addEventListener('submit', function (evento) {
            const nomeOk = validarNome(true);
            const emailOk = validarEmail(true);
            const senhaOk = validarSenha(true);
            const confirmaOk = validarConfirmacao(true);

            if (!nomeOk || !emailOk || !senhaOk || !confirmaOk) {
                evento.preventDefault();
            }
        });
    })();
</script>

<?php require_once 'includes/rodape.inc.php'; ?>
