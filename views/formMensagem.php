<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$destinatarioPreSelecionado = (int) ($_GET['destinatario'] ?? 0);
$nomeDestinatarioPreSelecionado = $_GET['nome'] ?? '';
$assuntoPreSelecionado = $_GET['assunto'] ?? '';

$tituloPagina = "WebForum - Enviar Mensagem";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <a href="../controlers/controlerDashboard.php" class="btn btn-outline-secondary mb-4">
        Voltar para área restrita
    </a>

    <h1 class="mb-2">Enviar Mensagem</h1>
    <p class="text-muted mb-4">
        Escolha um ou mais usuários cadastrados como destinatários e escreva sua mensagem.
    </p>

    <div class="card">
        <div class="card-body p-4">

            <?php if (isset($_GET['erro']) && $_GET['erro'] == 1) { ?>
                <div class="alert alert-danger">
                    Preencha todos os campos e escolha ao menos um destinatário válido.
                </div>
            <?php } ?>

            <?php if (isset($_GET['erro']) && $_GET['erro'] == 2) { ?>
                <div class="alert alert-danger">
                    Não foi possível enviar a mensagem. Tente novamente.
                </div>
            <?php } ?>

            <form action="../controlers/controlerMensagem.php" method="post" novalidate>
                <input type="hidden" name="opcao" value="2">

                <div class="mb-3 position-relative">
                    <label class="form-label">Destinatários</label>

                    <input
                            type="text"
                            id="buscaDestinatario"
                            class="form-control"
                            placeholder="Digite o nome ou e-mail do destinatário"
                            autocomplete="off"
                    >

                    <div id="listaSugestoes" class="list-group position-absolute w-100 shadow" style="z-index: 10; display: none;"></div>

                    <div id="chipsDestinatarios" class="d-flex flex-wrap gap-2 mt-2"></div>

                    <div class="invalid-feedback" id="erroDestinatario"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Assunto</label>

                    <input
                            type="text"
                            id="pAssunto"
                            name="pAssunto"
                            class="form-control"
                            placeholder="Digite o assunto da mensagem"
                            value="<?php echo htmlspecialchars($assuntoPreSelecionado); ?>"
                            required
                    >
                    <div class="invalid-feedback" id="erroAssunto"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mensagem</label>

                    <textarea
                            id="pCorpo"
                            name="pCorpo"
                            class="form-control"
                            rows="6"
                            placeholder="Escreva sua mensagem aqui..."
                            required
                    ></textarea>
                    <div class="invalid-feedback" id="erroCorpo"></div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="areaRestrita.php" class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Enviar mensagem
                    </button>
                </div>
            </form>

        </div>
    </div>

</main>

<script>
    (function () {
        const campoBusca = document.getElementById('buscaDestinatario');
        const listaSugestoes = document.getElementById('listaSugestoes');
        const chipsContainer = document.getElementById('chipsDestinatarios');
        const erroDestinatario = document.getElementById('erroDestinatario');

        const campoAssunto = document.getElementById('pAssunto');
        const erroAssunto = document.getElementById('erroAssunto');

        const campoCorpo = document.getElementById('pCorpo');
        const erroCorpo = document.getElementById('erroCorpo');

        const destinatariosSelecionados = new Map();
        let temporizador = null;

        <?php if ($destinatarioPreSelecionado > 0) { ?>
        destinatariosSelecionados.set(<?php echo $destinatarioPreSelecionado; ?>, <?php echo json_encode($nomeDestinatarioPreSelecionado); ?>);
        <?php } ?>

        function renderizarChips() {
            chipsContainer.innerHTML = '';

            destinatariosSelecionados.forEach(function (nome, id) {
                const chip = document.createElement('span');
                chip.className = 'badge text-bg-primary d-flex align-items-center gap-2 p-2';
                chip.textContent = nome;

                const botaoRemover = document.createElement('button');
                botaoRemover.type = 'button';
                botaoRemover.className = 'btn-close btn-close-white';
                botaoRemover.style.fontSize = '10px';
                botaoRemover.setAttribute('aria-label', 'Remover');
                botaoRemover.addEventListener('click', function () {
                    destinatariosSelecionados.delete(id);
                    renderizarChips();
                    validarDestinatario(false);
                });

                chip.appendChild(botaoRemover);

                const campoOculto = document.createElement('input');
                campoOculto.type = 'hidden';
                campoOculto.name = 'pDestinatario[]';
                campoOculto.value = id;
                chip.appendChild(campoOculto);

                chipsContainer.appendChild(chip);
            });
        }

        function validarDestinatario(forcarVazio) {
            const valido = destinatariosSelecionados.size > 0;
            const mostrar = forcarVazio || chipsContainer.childElementCount > 0 || campoBusca.value.length > 0;

            campoBusca.classList.toggle('is-invalid', mostrar && !valido);
            erroDestinatario.textContent = (mostrar && !valido)
                ? 'Selecione ao menos um destinatário na lista de sugestões.'
                : '';

            return valido;
        }

        function validarAssunto(forcarVazio) {
            const valido = campoAssunto.value.trim().length > 0;
            const mostrar = forcarVazio || campoAssunto.value.length > 0;

            campoAssunto.classList.toggle('is-invalid', mostrar && !valido);
            erroAssunto.textContent = (mostrar && !valido) ? 'Informe o assunto da mensagem.' : '';

            return valido;
        }

        function validarCorpo(forcarVazio) {
            const valido = campoCorpo.value.trim().length > 0;
            const mostrar = forcarVazio || campoCorpo.value.length > 0;

            campoCorpo.classList.toggle('is-invalid', mostrar && !valido);
            erroCorpo.textContent = (mostrar && !valido) ? 'Escreva o conteúdo da mensagem.' : '';

            return valido;
        }

        campoAssunto.addEventListener('input', function () {
            validarAssunto(false);
        });

        campoCorpo.addEventListener('input', function () {
            validarCorpo(false);
        });

        function esconderLista() {
            listaSugestoes.style.display = 'none';
            listaSugestoes.innerHTML = '';
        }

        function adicionarDestinatario(usuario) {
            destinatariosSelecionados.set(usuario.id_usuario, usuario.nome + ' - ' + usuario.email);
            renderizarChips();
            validarDestinatario(false);

            campoBusca.value = '';
            esconderLista();
        }

        function mostrarResultados(usuarios) {
            listaSugestoes.innerHTML = '';

            const disponiveis = usuarios.filter(function (usuario) {
                return !destinatariosSelecionados.has(usuario.id_usuario);
            });

            if (disponiveis.length === 0) {
                listaSugestoes.style.display = 'none';
                return;
            }

            disponiveis.forEach(function (usuario) {
                const item = document.createElement('button');
                item.type = 'button';
                item.className = 'list-group-item list-group-item-action';
                item.textContent = usuario.nome + ' - ' + usuario.email;
                item.addEventListener('click', function () {
                    adicionarDestinatario(usuario);
                });

                listaSugestoes.appendChild(item);
            });

            listaSugestoes.style.display = 'block';
        }

        campoBusca.addEventListener('input', function () {
            const termo = campoBusca.value.trim();

            clearTimeout(temporizador);

            if (termo.length < 2) {
                esconderLista();
                return;
            }

            temporizador = setTimeout(function () {
                fetch('../controlers/controlerMensagem.php?opcao=8&termo=' + encodeURIComponent(termo))
                    .then(function (resposta) {
                        return resposta.json();
                    })
                    .then(mostrarResultados)
                    .catch(esconderLista);
            }, 300);
        });

        document.addEventListener('click', function (evento) {
            if (evento.target !== campoBusca) {
                esconderLista();
            }
        });

        document.querySelector('form').addEventListener('submit', function (evento) {
            const destinatarioOk = validarDestinatario(true);
            const assuntoOk = validarAssunto(true);
            const corpoOk = validarCorpo(true);

            if (!destinatarioOk || !assuntoOk || !corpoOk) {
                evento.preventDefault();
            }
        });

        renderizarChips();
    })();
</script>

<?php require_once 'includes/rodape.inc.php'; ?>
