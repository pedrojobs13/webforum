<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagens = $_SESSION['mensagensEnviadas'] ?? [];

$tituloPagina = "WebForum - Mensagens Enviadas";
$paginaCSS = "mensagens.css";
require_once 'includes/cabecalho.inc.php';

?>

    <main class="container">

        <section class="titulo-pagina">
            <span>Caixa de saída</span>

            <h1>Mensagens Enviadas</h1>

            <p>
                Veja as mensagens que você enviou para outros usuários
                e acompanhe se elas já foram lidas.
            </p>
        </section>

        <div class="mensagem-acoes" style="margin-bottom: 24px;">
            <a href="../controlers/controlerMensagem.php?opcao=1" class="btn btn-azul">
                Nova mensagem
            </a>

            <a href="../controlers/controlerMensagem.php?opcao=3" class="btn btn-outline">
                Mensagens recebidas
            </a>

            <a href="../controlers/controlerDashboard.php" class="btn btn-outline">
                Voltar para área restrita
            </a>
        </div>

        <?php if (count($mensagens) == 0) { ?>

            <section class="mensagem-vazia">
                <div class="icone">📤</div>

                <h2>Nenhuma mensagem enviada</h2>

                <p>
                    Quando você enviar uma mensagem, ela aparecerá nesta página.
                </p>
            </section>

        <?php } else { ?>

            <?php foreach ($mensagens as $mensagem) { ?>

                <?php
                $lida = isset($mensagem->lida) ? (int) $mensagem->lida : 0;
                ?>

                <section class="mensagem-card">

                    <?php if ($lida == 1) { ?>
                        <span class="badge-lida">Lida pelo destinatário</span>
                    <?php } else { ?>
                        <span class="badge-nova">Ainda não lida</span>
                    <?php } ?>

                    <h2>
                        <?php echo htmlspecialchars($mensagem->assunto); ?>
                    </h2>

                    <p class="mensagem-info">
                        <strong>Destinatário:</strong>
                        <?php echo htmlspecialchars($mensagem->destinatario_nome); ?>
                    </p>

                    <p class="mensagem-info">
                        <strong>E-mail:</strong>
                        <?php echo htmlspecialchars($mensagem->destinatario_email); ?>
                    </p>

                    <p class="mensagem-info">
                        <strong>Data:</strong>
                        <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                    </p>

                    <div class="mensagem-acoes">
                        <a href="../controlers/controlerMensagem.php?opcao=7&id=<?php echo $mensagem->id_mensagem; ?>"
                           class="btn btn-azul">
                            Visualizar
                        </a>
                    </div>

                </section>

            <?php } ?>

        <?php } ?>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>