<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagem = $_SESSION['mensagemEnviada'] ?? null;

$tituloPagina = "WebForum - Mensagem Enviada";
$paginaCSS = "mensagens.css";
require_once 'includes/cabecalho.inc.php';

?>

    <main class="container">

        <a href="../controlers/controlerMensagem.php?opcao=6" class="voltar">
            ← Voltar para mensagens enviadas
        </a>

        <?php if ($mensagem == null) { ?>

            <section class="mensagem-vazia">
                <div class="icone">⚠️</div>

                <h2>Mensagem não encontrada</h2>

                <p>
                    A mensagem solicitada não existe ou você não tem permissão para visualizá-la.
                </p>
            </section>

        <?php } else { ?>

            <section class="mensagem-completa">

                <div class="mensagem-topo">
                    <span>Mensagem enviada</span>

                    <h1>
                        <?php echo htmlspecialchars($mensagem->assunto); ?>
                    </h1>

                    <div class="remetente-box">
                        <p>
                            <strong>Destinatário:</strong>
                            <?php echo htmlspecialchars($mensagem->destinatario_nome); ?>
                        </p>

                        <p>
                            <strong>E-mail:</strong>
                            <?php echo htmlspecialchars($mensagem->destinatario_email); ?>
                        </p>

                        <p>
                            <strong>Enviada em:</strong>
                            <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <?php echo ((int) $mensagem->lida == 1) ? 'Lida pelo destinatário' : 'Ainda não lida'; ?>
                        </p>
                    </div>
                </div>

                <div class="corpo-mensagem">
                    <?php echo nl2br(htmlspecialchars($mensagem->corpo)); ?>
                </div>

            </section>

        <?php } ?>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>