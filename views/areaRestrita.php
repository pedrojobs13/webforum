<?php
require_once '../utils/seguranca.inc.php';
require_once __DIR__ . '/../dao/MensagemDAO.inc.php';
protegerPagina();

$usuario = getUsuarioLogado();

$totalNaoLidas = $_SESSION['totalNaoLidas'] ?? 0;

$tituloPagina = "WebForum - Área Restrita";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <div class="p-5 mb-4 bg-dark text-white rounded-3">
        <span class="text-uppercase small">Área restrita</span>

        <h1 class="display-6 fw-bold">
            Bem-vindo, <?php echo htmlspecialchars($usuario->nome); ?>!
        </h1>

        <div class="bg-white bg-opacity-10 rounded-3 p-3 my-3" style="width: fit-content;">
            <p class="mb-0 small">Mensagens não lidas</p>
            <p class="display-5 fw-bold mb-0"><?php echo $totalNaoLidas; ?></p>
        </div>

        <p class="mb-0">
            Nesta área você pode enviar mensagens para usuários cadastrados,
            visualizar suas mensagens recebidas e remover mensagens antigas.
        </p>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <a href="../controlers/controlerMensagem.php?opcao=1" class="card h-100 text-decoration-none text-reset">
                <div class="card-body">
                    <h5 class="card-title">Enviar mensagem</h5>
                    <p class="card-text">
                        Escreva uma nova mensagem e escolha um destinatário previamente
                        cadastrado no WebForum.
                    </p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="../controlers/controlerMensagem.php?opcao=3" class="card h-100 text-decoration-none text-reset">
                <div class="card-body">
                    <h5 class="card-title">Mensagens recebidas</h5>
                    <p class="card-text">
                        Acesse sua caixa de entrada, visualize mensagens completas
                        e remova mensagens quando necessário.
                    </p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="../controlers/controlerMensagem.php?opcao=6" class="card h-100 text-decoration-none text-reset">
                <div class="card-body">
                    <h5 class="card-title">Mensagens enviadas</h5>
                    <p class="card-text">
                        Veja as mensagens que você enviou e acompanhe se o destinatário já leu.
                    </p>
                </div>
            </a>
        </div>
    </div>

</main>

<?php require_once 'includes/rodape.inc.php'; ?>
