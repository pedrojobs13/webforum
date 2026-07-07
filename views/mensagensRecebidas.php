<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagens = $_SESSION['mensagens'] ?? [];

$tituloPagina = "WebForum - Mensagens Recebidas";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <h1 class="mb-2">Mensagens Recebidas</h1>
    <p class="text-muted mb-4">
        Veja suas mensagens recebidas, visualize o conteúdo completo
        ou remova mensagens antigas.
    </p>

    <div class="mb-4 d-flex gap-2">
        <a href="../controlers/controlerMensagem.php?opcao=1" class="btn btn-primary">
            Nova mensagem
        </a>

        <a href="../controlers/controlerDashboard.php" class="btn btn-outline-secondary">
            Voltar para área restrita
        </a>
    </div>

    <?php if (count($mensagens) == 0) { ?>

        <div class="alert alert-secondary">
            Nenhuma mensagem recebida. Quando alguém enviar uma mensagem para você,
            ela aparecerá nesta página.
        </div>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Assunto</th>
                    <th>Remetente</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($mensagens as $mensagem) { ?>

                    <?php $lida = isset($mensagem->lida) ? (int) $mensagem->lida : 0; ?>

                    <tr>
                        <td>
                            <?php if ($lida == 0) { ?>
                                <span class="badge bg-primary">Nova</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Lida</span>
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($mensagem->assunto); ?></td>
                        <td><?php echo htmlspecialchars($mensagem->remetente_nome); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?></td>
                        <td>
                            <a href="../controlers/controlerMensagem.php?opcao=4&id=<?php echo $mensagem->id_mensagem; ?>"
                               class="btn btn-sm btn-primary">
                                Visualizar
                            </a>

                            <a href="../controlers/controlerMensagem.php?opcao=5&id=<?php echo $mensagem->id_mensagem; ?>"
                               onclick="return confirm('Deseja remover essa mensagem?')"
                               class="btn btn-sm btn-danger">
                                Remover
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
