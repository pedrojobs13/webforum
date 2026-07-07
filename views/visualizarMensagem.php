<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagem = $_SESSION['mensagem'] ?? null;

$tituloPagina = "WebForum - Visualizar Mensagem";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <a href="../controlers/controlerMensagem.php?opcao=3" class="d-inline-flex align-items-center gap-1 mb-4">
        <i class="bi bi-arrow-left"></i> Voltar para mensagens
    </a>

    <?php if ($mensagem == null) { ?>

        <div class="alert alert-warning">
            <h2 class="h5">Mensagem não encontrada</h2>
            <p class="mb-0">
                A mensagem pode ter sido removida ou não pertence ao seu usuário.
            </p>
        </div>

    <?php } else { ?>

        <div class="card">
            <div class="card-body p-4">

                <span class="text-uppercase small text-primary">Mensagem recebida</span>

                <h1 class="h3 mt-2">
                    <?php echo htmlspecialchars($mensagem->assunto); ?>
                </h1>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <p class="mb-1">
                        <strong>Remetente:</strong>
                        <?php echo htmlspecialchars($mensagem->remetente_nome); ?>
                        -
                        <?php echo htmlspecialchars($mensagem->remetente_email); ?>
                    </p>

                    <p class="mb-0">
                        <strong>Data:</strong>
                        <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                    </p>
                </div>

                <p style="white-space: pre-line;">
                    <?php echo nl2br(htmlspecialchars($mensagem->corpo)); ?>
                </p>

                <div class="d-flex gap-2 mt-4">
                    <a href="../controlers/controlerMensagem.php?opcao=3" class="btn btn-primary">
                        Voltar
                    </a>

                    <a href="../controlers/controlerMensagem.php?opcao=1&destinatario=<?php echo $mensagem->id_remetente; ?>&nome=<?php echo urlencode($mensagem->remetente_nome . ' - ' . $mensagem->remetente_email); ?>&assunto=<?php echo urlencode('Re: ' . $mensagem->assunto); ?>"
                       class="btn btn-outline-secondary">
                        Responder
                    </a>

                    <a href="../controlers/controlerMensagem.php?opcao=5&id=<?php echo $mensagem->id_mensagem; ?>"
                       onclick="return confirm('Deseja remover essa mensagem?')"
                       class="btn btn-danger">
                        Remover mensagem
                    </a>
                </div>

            </div>
        </div>

    <?php } ?>

</main>

<?php require_once 'includes/rodape.inc.php'; ?>
