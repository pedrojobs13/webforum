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
            if (isset($_GET['erro']) && $_GET['erro'] == 2) {
                echo "<div class='alerta alerta-erro'>As senhas informadas não são iguais.</div>";
            } elseif (isset($_GET['erro'])) {
                echo "<div class='alerta alerta-erro'>Erro ao cadastrar. Verifique se o e-mail já existe.</div>";
            }
            ?>

            <form action="../controlers/controlerUsuario.php" method="post" novalidate>
                <input type="hidden" name="pOpcao" value="1">

                <div class="form-group">
                    <label>Nome</label>
                    <input
                            type="text"
                            id="pNome"
                            name="pNome"
                            class="form-control"
                            placeholder="Digite seu nome"
                            required
                    >
                    <p class="campo-erro" id="erroNome"></p>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input
                            type="email"
                            id="pEmail"
                            name="pEmail"
                            class="form-control"
                            placeholder="Digite seu e-mail"
                            required
                    >
                    <p class="campo-erro" id="erroEmail"></p>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input
                            type="password"
                            id="pSenha"
                            name="pSenha"
                            class="form-control"
                            placeholder="Digite sua senha"
                            minlength="6"
                            required
                    >
                    <p class="campo-erro" id="erroSenha"></p>
                </div>

                <div class="form-group">
                    <label>Confirme a senha</label>
                    <input
                            type="password"
                            id="pConfirmaSenha"
                            name="pConfirmaSenha"
                            class="form-control"
                            placeholder="Digite a senha novamente"
                            minlength="6"
                            required
                    >
                    <p class="campo-erro" id="erroConfirmaSenha"></p>
                </div>

                <button type="submit" class="btn btn-azul" id="btnCadastrar" style="width: 100%;">
                    Cadastrar
                </button>
            </form>

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

                        campoNome.classList.toggle('campo-invalido', mostrar && !valido);
                        erroNome.textContent = (mostrar && !valido)
                            ? 'O nome não pode ficar vazio.'
                            : '';

                        return valido;
                    }

                    function validarEmail(forcarVazio) {
                        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        const valido = regexEmail.test(campoEmail.value.trim());
                        const mostrar = forcarVazio || campoEmail.value.length > 0;

                        campoEmail.classList.toggle('campo-invalido', mostrar && !valido);
                        erroEmail.textContent = (mostrar && !valido)
                            ? 'Informe um e-mail válido.'
                            : '';

                        return valido;
                    }

                    function validarSenha(forcarVazio) {
                        const valida = campoSenha.value.length >= 6;
                        const mostrar = forcarVazio || campoSenha.value.length > 0;

                        campoSenha.classList.toggle('campo-invalido', mostrar && !valida);
                        erroSenha.textContent = (mostrar && !valida)
                            ? 'A senha deve ter no mínimo 6 caracteres.'
                            : '';

                        return valida;
                    }

                    function validarConfirmacao(forcarVazio) {
                        const confere = campoConfirma.value === campoSenha.value && campoConfirma.value.length > 0;
                        const mostrar = forcarVazio || campoConfirma.value.length > 0;

                        campoConfirma.classList.toggle('campo-invalido', mostrar && !confere);
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