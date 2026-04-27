<?php
$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual = "catalogo";
$caminho_raiz = "../";

include_once __DIR__ . '/../includes/cabecalho.php';

/**
 * SIMULAÇÃO DE DADOS (substituir por PDO depois)
 */
$tecnologias = [
    ['id' => 1, 'nome' => 'PHP 8.2', 'categoria' => 'Backend'],
    ['id' => 2, 'nome' => 'JavaScript', 'categoria' => 'Frontend'],
];

function e($valor) {
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!-- CSS embutido -->
<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --dark: #0f172a;
        --border: #e2e8f0;
        --text-muted: #64748b;
        --bg: #f8fafc;
        --error: #ef4444;
    }

    body { font-family: 'Inter', sans-serif; background: var(--bg); padding-top: 70px; margin:0; }
    .section-card { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
    .section-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; }
    .section-header h1 { margin:0; color: var(--dark); font-size: 1.8rem; display:flex; align-items:center; gap:10px; }
    .text-primary { color: var(--primary); }
    .text-muted { color: var(--text-muted); font-size: 0.95rem; }
    .btn { background: var(--primary); color: #fff; text-decoration: none; padding: 10px 20px; border-radius:6px; font-weight:600; transition: all 0.2s; }
    .btn:hover { background: var(--primary-dark); }
    .table-responsive { overflow-x:auto; }
    .table { width:100%; border-collapse: collapse; margin-top:10px; font-size:0.95rem; }
    .table th, .table td { padding: 12px 15px; border-bottom: 1px solid var(--border); }
    .table th { text-align:left; background:#f3f4f6; color: var(--dark); font-weight:600; }
    .fw-bold { font-weight: 600; }
    .badge { display:inline-block; padding: 4px 10px; border-radius: 12px; background: var(--primary); color:#fff; font-size:0.8rem; }
    .text-center { text-align:center; }
    .action { color: var(--text-muted); margin: 0 5px; text-decoration:none; font-size:1.1rem; }
    .action.edit:hover { color: var(--primary); }
    .action.delete:hover { color: var(--error); }
    .empty-state { text-align:center; padding:40px; color: var(--text-muted); font-size:1rem; }
    .empty-state i { font-size:3rem; opacity:0.3; margin-bottom:15px; display:block; }
</style>

<div class="section-card">

    <!-- HEADER -->
    <div class="section-header">
        <div>
            <h1><i class="fa-solid fa-database text-primary"></i> Catálogo de Dados</h1>
            <p class="text-muted">Gerenciamento de registros via PDO (CRUD).</p>
        </div>

        <a href="novo.php" class="btn"><i class="fa-solid fa-plus"></i> Novo Item</a>
    </div>

    <!-- TABELA -->
    <?php if (!empty($tecnologias)): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tecnologia</th>
                        <th>Categoria</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tecnologias as $tec): ?>
                        <tr>
                            <td><?= str_pad($tec['id'], 2, '0', STR_PAD_LEFT) ?></td>
                            <td class="fw-bold"><?= e($tec['nome']) ?></td>
                            <td><span class="badge"><?= e($tec['categoria']) ?></span></td>
                            <td class="text-center">
                                <a href="editar.php?id=<?= $tec['id'] ?>" class="action edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="excluir.php?id=<?= $tec['id'] ?>" class="action delete" onclick="return confirm('Deseja excluir este item?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-folder-open"></i>
            <p>Nenhum registro encontrado no banco de dados.</p>
        </div>
    <?php endif; ?>

</div>

<?php include_once __DIR__ . '/../includes/rodape.php'; ?>