<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/index.php
 * Disciplina: Desenvolvimento Web II
 * Aula: 07 - CRUD: Listagem Geral
 * Autor: Nicolas Henrique
 * Descrição: Tela principal que lista todos os projetos.
 * =========================================================
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. Proteção e conexão
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

// 2. Busca projetos
try {
    $stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
    $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Erro ao listar projetos: ' . $e->getMessage());
    $projetos = [];
}

// 3. Mensagens
$mensagem = '';
$tipo_alerta = 'info';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') {
    $mensagem = '✅ Projeto cadastrado com sucesso!';
    $tipo_alerta = 'success';
} elseif (isset($_GET['editado']) && $_GET['editado'] === 'ok') {
    $mensagem = '✏️ Alterações salvas com sucesso!';
    $tipo_alerta = 'info';
} elseif (isset($_GET['excluido']) && $_GET['excluido'] === 'ok') {
    $mensagem = '🗑️ Projeto removido com sucesso!';
    $tipo_alerta = 'warning';
}

// 4. Template
$titulo_pagina = 'Meus Projetos | Gerenciador';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
    .crud-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 2rem;
    }

    .crud-header h1 {
        margin: 0;
        font-size: 2.2rem;
        color: #0f172a;
    }

    .crud-header p {
        color: #64748b;
        margin-top: .5rem;
    }

    .btn-novo {
        background: #2563eb;
        color: white;
        padding: 14px 22px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 800;
        transition: .2s;
    }

    .btn-novo:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
    }

    .alerta {
        margin-bottom: 2rem;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        text-align: center;
    }

    .alerta.success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #22c55e;
    }

    .alerta.info {
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #60a5fa;
    }

    .alerta.warning {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
    }

    .badge-total {
        display: inline-block;
        background: #dbeafe;
        color: #2563eb;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 800;
        margin-bottom: 2rem;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 22px;
    }

    .projeto-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 16px 35px rgba(15, 23, 42, 0.08);
        display: flex;
        flex-direction: column;
        transition: .25s;
    }

    .projeto-card:hover {
        transform: translateY(-5px);
    }

    .card-topo {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .ano-badge {
        background: #dbeafe;
        color: #2563eb;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 800;
    }

    .acoes-icons {
        display: flex;
        gap: .55rem;
    }

    .acoes-icons a {
        text-decoration: none;
        font-size: 1.2rem;
        opacity: .65;
        transition: .2s;
    }

    .acoes-icons a:hover {
        opacity: 1;
        transform: translateY(-2px);
    }

    .projeto-card h3 {
        color: #0f172a;
        margin-bottom: .75rem;
        font-size: 1.25rem;
    }

    .projeto-card p {
        color: #64748b;
        line-height: 1.55;
        font-size: .95rem;
        margin-bottom: 1.2rem;
    }

    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: auto;
    }

    .tag {
        font-size: .75rem;
        background: #f1f5f9;
        color: #334155;
        padding: .35rem .75rem;
        border-radius: 999px;
        border: 1px solid #e2e8f0;
        font-weight: 700;
    }

    .vazio {
        text-align: center;
        padding: 5rem 2rem;
        background: #ffffff;
        border-radius: 22px;
        border: 2px dashed #cbd5e1;
    }

    .vazio h2 {
        color: #0f172a;
    }

    .vazio p {
        color: #64748b;
        max-width: 420px;
        margin: 1rem auto 2rem;
    }
</style>

<main>

    <header class="crud-header">
        <div>
            <h1>Gerenciador de Projetos</h1>
            <p>Controle total do seu portfólio acadêmico.</p>
        </div>

        <a href="/02_projetoPHP-02_refatorado/05_crud/cadastrar.php" class="btn-novo">
            ➕ Novo Projeto
        </a>
    </header>

    <?php if ($mensagem): ?>
        <div class="alerta <?= $tipo_alerta ?>">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <span class="badge-total">
        📊 Total: <?= count($projetos) ?> projeto(s)
    </span>

    <?php if (empty($projetos)): ?>

        <section class="vazio">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📂</div>

            <h2>Nenhum projeto encontrado</h2>

            <p>
                Sua base de dados ainda está vazia. Comece adicionando seu primeiro projeto.
            </p>

            <a href="/02_projetoPHP-02_refatorado/05_crud/cadastrar.php" class="btn-novo">
                🚀 Criar Primeiro Projeto
            </a>
        </section>

    <?php else: ?>

        <section class="cards-grid">

            <?php foreach ($projetos as $projeto): ?>

                <article class="projeto-card">

                    <header class="card-topo">

                        <span class="ano-badge">
                            📅 <?= htmlspecialchars((string)($projeto['ano'] ?? '')) ?>
                        </span>

                        <div class="acoes-icons">

                            <a href="/02_projetoPHP-02_refatorado/05_crud/detalhe.php?id=<?= urlencode($projeto['id']) ?>" title="Ver detalhes">
                                👁️
                            </a>

                            <?php if (!empty($projeto['link_github'])): ?>
                                <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" rel="noopener noreferrer" title="GitHub">
                                    🔗
                                </a>
                            <?php endif; ?>

                            <a href="/02_projetoPHP-02_refatorado/05_crud/editar.php?id=<?= urlencode($projeto['id']) ?>" title="Editar">
                                ✏️
                            </a>

                            <a href="/02_projetoPHP-02_refatorado/05_crud/excluir.php?id=<?= urlencode($projeto['id']) ?>"
                               onclick="return confirm('Tem certeza que deseja excluir este projeto?');"
                               title="Excluir">
                                🗑️
                            </a>

                        </div>

                    </header>

                    <h3>
                        <?= htmlspecialchars($projeto['nome'] ?? '') ?>
                    </h3>

                    <p>
                        <?= mb_strimwidth(htmlspecialchars($projeto['descricao'] ?? ''), 0, 100, '...') ?>
                    </p>

                    <div class="tags">
                        <?php
                        $tecs = explode(',', $projeto['tecnologias'] ?? '');

                        foreach ($tecs as $tec):
                            if (trim($tec) === '') {
                                continue;
                            }
                        ?>
                            <span class="tag">
                                <?= htmlspecialchars(trim($tec)) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                </article>

            <?php endforeach; ?>

        </section>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>