<?php

require_once '../utils/seguranca.inc.php';
protegerAdmin();

$usuarios = $_SESSION['usuariosAdmin'] ?? [];

$tituloPagina = "WebForum - Gerenciar Usuários";
require_once 'includes/cabecalho.inc.php';
?>

<main class="container my-5 flex-grow-1">

    <h1 class="mb-2">Gerenciar Usuários</h1>
    <p class="text-muted mb-4">
        Área exclusiva para administradores. Bana usuários que violarem as regras do WebForum.
    </p>

    <a href="../controlers/controlerDashboard.php" class="btn btn-outline-secondary mb-4">
        Voltar para área restrita
    </a>

    <?php if (count($usuarios) == 0) { ?>

        <div class="alert alert-secondary">
            Nenhum outro usuário cadastrado.
        </div>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Papel</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($usuarios as $usuario) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($usuario->nome); ?></td>
                        <td><?php echo htmlspecialchars($usuario->email); ?></td>
                        <td>
                            <?php if ($usuario->role === 'admin') { ?>
                                <span class="badge bg-dark">Admin</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Usuário</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ((int) $usuario->banido === 1) { ?>
                                <span class="badge bg-danger" title="<?php echo htmlspecialchars($usuario->motivo_banimento ?? ''); ?>">
                                    Banido
                                </span>
                            <?php } else { ?>
                                <span class="badge bg-success">Ativo</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($usuario->role === 'admin') { ?>
                                <span class="text-muted small">Administradores não podem ser banidos</span>
                            <?php } elseif ((int) $usuario->banido === 1) { ?>
                                <form action="../controlers/controlerAdmin.php" method="post" class="d-inline">
                                    <input type="hidden" name="opcao" value="3">
                                    <input type="hidden" name="pIdUsuario" value="<?php echo $usuario->id_usuario; ?>">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Desbanir
                                    </button>
                                </form>
                            <?php } else { ?>
                                <button
                                        type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalBanir"
                                        data-id="<?php echo $usuario->id_usuario; ?>"
                                        data-nome="<?php echo htmlspecialchars($usuario->nome); ?>"
                                >
                                    Banir
                                </button>
                            <?php } ?>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>

    <?php } ?>

</main>

<div class="modal fade" id="modalBanir" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controlers/controlerAdmin.php" method="post">
                <input type="hidden" name="opcao" value="2">
                <input type="hidden" name="pIdUsuario" id="modalIdUsuario">

                <div class="modal-header">
                    <h5 class="modal-title">Banir usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Você está prestes a banir <strong id="modalNomeUsuario"></strong>.</p>

                    <label class="form-label">Motivo do banimento</label>
                    <textarea name="pMotivo" class="form-control" rows="3" placeholder="Descreva o motivo (má conduta, violação das regras, etc.)"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar banimento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('modalBanir').addEventListener('show.bs.modal', function (evento) {
        const botao = evento.relatedTarget;

        document.getElementById('modalIdUsuario').value = botao.getAttribute('data-id');
        document.getElementById('modalNomeUsuario').textContent = botao.getAttribute('data-nome');
    });
</script>

<?php require_once 'includes/rodape.inc.php'; ?>
