<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagens = $_SESSION['mensagens'] ?? [];

$tituloPagina = "WebForum - Mensagens Recebidas";
$paginaCSS = "mensagens.css";
require_once 'includes/cabecalho.inc.php';

?>

    <main class="container">

        <section class="titulo-pagina">
            <span>Caixa de entrada</span>

            <h1>Mensagens Recebidas</h1>

            <p>
                Veja suas mensagens recebidas, visualize o conteúdo completo
                ou remova mensagens antigas.
            </p>
        </section>

        <div class="mensagem-acoes" style="margin-bottom: 24px;">
            <a href="../controlers/controlerMensagem.php?opcao=1" class="btn btn-azul">
                Nova mensagem
            </a>

            <a href="areaRestrita.php" class="btn btn-outline">
                Voltar para área restrita
            </a>
        </div>

        <?php if (count($mensagens) == 0) { ?>

            <section class="mensagem-vazia">
                <div class="icone">📭</div>

                <h2>Nenhuma mensagem recebida</h2>

                <p>
                    Quando alguém enviar uma mensagem para você,
                    ela aparecerá nesta página.
                </p>
            </section>

        <?php } else { ?>

            <?php foreach ($mensagens as $mensagem) { ?>

                <section class="mensagem-card">

                    <h2>
                        <?php echo htmlspecialchars($mensagem->assunto); ?>
                    </h2>

                    <p class="mensagem-info">
                        <strong>Remetente:</strong>
                        <?php echo htmlspecialchars($mensagem->remetente_nome); ?>
                    </p>

                    <p class="mensagem-info">
                        <strong>Data:</strong>
                        <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                    </p>

                    <div class="mensagem-acoes">
                        <a href="../controlers/controlerMensagem.php?opcao=4&id=<?php echo $mensagem->id_mensagem; ?>"
                           class="btn btn-azul">
                            Visualizar
                        </a>

                        <a href="../controlers/controlerMensagem.php?opcao=5&id=<?php echo $mensagem->id_mensagem; ?>"
                           onclick="return confirm('Deseja remover essa mensagem?')"
                           class="btn btn-vermelho">
                            Remover
                        </a>
                    </div>

                </section>

            <?php } ?>

        <?php } ?>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>