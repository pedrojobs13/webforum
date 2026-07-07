<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagens = $_SESSION['mensagensEnviadas'] ?? [];

$tituloPagina = "WebForum - Mensagens Enviadas";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <h1 class="mb-2">Mensagens Enviadas</h1>
    <p class="text-muted mb-4">
        Veja as mensagens que você enviou para outros usuários
        e acompanhe se elas já foram lidas.
    </p>

    <div class="mb-4 d-flex gap-2">
        <a href="../controlers/controlerMensagem.php?opcao=1" class="btn btn-primary">
            Nova mensagem
        </a>

        <a href="../controlers/controlerMensagem.php?opcao=3" class="btn btn-outline-secondary">
            Mensagens recebidas
        </a>

        <a href="../controlers/controlerDashboard.php" class="btn btn-outline-secondary">
            Voltar para área restrita
        </a>
    </div>

    <?php if (count($mensagens) == 0) { ?>

        <div class="alert alert-secondary">
            Nenhuma mensagem enviada. Quando você enviar uma mensagem, ela aparecerá nesta página.
        </div>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Assunto</th>
                    <th>Destinatário</th>
                    <th>E-mail</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($mensagens as $mensagem) { ?>

                    <?php $lida = isset($mensagem->lida) ? (int) $mensagem->lida : 0; ?>

                    <tr>
                        <td>
                            <?php if ($lida == 1) { ?>
                                <span class="badge bg-secondary">Lida</span>
                            <?php } else { ?>
                                <span class="badge bg-primary">Não lida</span>
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($mensagem->assunto); ?></td>
                        <td><?php echo htmlspecialchars($mensagem->destinatario_nome); ?></td>
                        <td><?php echo htmlspecialchars($mensagem->destinatario_email); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?></td>
                        <td>
                            <a href="../controlers/controlerMensagem.php?opcao=7&id=<?php echo $mensagem->id_mensagem; ?>"
                               class="btn btn-sm btn-primary">
                                Visualizar
                            </a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>

    <?php } ?>

</main>

<?php require_once 'includes/rodape.inc.php'; ?>
