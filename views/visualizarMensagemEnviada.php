<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagem = $_SESSION['mensagemEnviada'] ?? null;

$tituloPagina = "WebForum - Mensagem Enviada";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <a href="../controlers/controlerMensagem.php?opcao=6" class="d-inline-flex align-items-center gap-1 mb-4">
        <i class="bi bi-arrow-left"></i> Voltar para mensagens enviadas
    </a>

    <?php if ($mensagem == null) { ?>

        <div class="alert alert-warning">
            <h2 class="h5">Mensagem não encontrada</h2>
            <p class="mb-0">
                A mensagem solicitada não existe ou você não tem permissão para visualizá-la.
            </p>
        </div>

    <?php } else { ?>

        <div class="card">
            <div class="card-body p-4">

                <span class="text-uppercase small text-primary">Mensagem enviada</span>

                <h1 class="h3 mt-2">
                    <?php echo htmlspecialchars($mensagem->assunto); ?>
                </h1>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <p class="mb-1">
                        <strong>Destinatário:</strong>
                        <?php echo htmlspecialchars($mensagem->destinatario_nome); ?>
                    </p>

                    <p class="mb-1">
                        <strong>E-mail:</strong>
                        <?php echo htmlspecialchars($mensagem->destinatario_email); ?>
                    </p>

                    <p class="mb-1">
                        <strong>Enviada em:</strong>
                        <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                    </p>

                    <p class="mb-0">
                        <strong>Status:</strong>
                        <?php echo ((int) $mensagem->lida == 1) ? 'Lida pelo destinatário' : 'Ainda não lida'; ?>
                    </p>
                </div>

                <p style="white-space: pre-line;">
                    <?php echo nl2br(htmlspecialchars($mensagem->corpo)); ?>
                </p>

            </div>
        </div>

    <?php } ?>

</main>

<?php require_once 'includes/rodape.inc.php'; ?>
