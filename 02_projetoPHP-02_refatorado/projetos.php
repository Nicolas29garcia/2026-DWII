<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal
 * Arquivo    : projetos.php
 * Autor      : Nicolas Henrique
 * Descrição  : Página pública de projetos publicados.
 * ============================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo_pagina = "Projetos — Nicolas Henrique";
$pagina_atual  = "projetos";
$caminho_raiz  = "./";
$nome_dev      = "NICOLAS";

// Conexão com o banco
require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

// Busca apenas projetos publicados
$stmt = $pdo->query("
    SELECT *
    FROM projetos
    WHERE status = 'publicado'
    ORDER BY criado_em DESC
");

$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cabeçalho
require_once __DIR__ . '/includes/cabecalho.php';
?>

<style>
.projetos-page {
    padding: 40px 0 70px;
}

.projetos-hero {
    background: #0f172a;
    color: #ffffff;
    border-radius: 28px;
    padding: 42px;
    margin-bottom: 34px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
}

.projetos-hero span {
    display: inline-block;
    background: rgba(255,255,255,0.12);
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 900;
    margin-bottom: 18px;
}

.projetos-hero h1 {
    font-size: 2.7rem;
    margin-bottom: 12px;
}

.projetos-hero p {
    color: #cbd5e1;
    line-height: 1.7;
    max-width: 700px;
}

.projetos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 22px;
}

.projeto-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
    transition: 0.25s;
}

.projeto-card:hover {
    transform: translateY(-5px);
    border-color: #93c5fd;
}

.card-topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.status {
    background: #dcfce7;
    color: #166534;
    padding: 6px 11px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 900;
}

.ano {
    color: #64748b;
    font-size: 0.85rem;
    font-weight: 800;
}

.projeto-card h2 {
    color: #0f172a;
    font-size: 1.25rem;
    margin-bottom: 12px;
}

.projeto-card p {
    color: #475569;
    line-height: 1.7;
    margin-bottom: 18px;
}

.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 18px;
}

.tag {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 800;
}

.acoes {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-projeto {
    text-decoration: none;
    border-radius: 12px;
    padding: 11px 14px;
    font-size: 0.88rem;
    font-weight: 900;
}

.btn-detalhe {
    background: #2563eb;
    color: #ffffff;
}

.btn-github {
    background: #0f172a;
    color: #ffffff;
}

.vazio {
    background: #ffffff;
    border: 2px dashed #cbd5e1;
    border-radius: 24px;
    padding: 50px 25px;
    text-align: center;
    color: #64748b;
}

.voltar {
    display: inline-block;
    margin-top: 34px;
    text-decoration: none;
    color: #2563eb;
    font-weight: 900;
}
</style>

<main class="projetos-page">

    <section class="projetos-hero">
        <span>🚀 Portfólio publicado</span>

        <h1>Meus Projetos</h1>

        <p>
            Nesta página aparecem somente os projetos marcados como
            <strong>publicado</strong> no painel administrativo.
        </p>
    </section>

    <?php if (empty($projetos)): ?>

        <section class="vazio">
            <h2>Nenhum projeto publicado</h2>
            <p>Publique um projeto pelo painel administrativo para ele aparecer aqui.</p>
        </section>

    <?php else: ?>

        <section class="projetos-grid">

            <?php foreach ($projetos as $projeto): ?>

                <article class="projeto-card">

                    <div class="card-topo">
                        <span class="status">PUBLICADO</span>
                        <span class="ano">📅 <?= htmlspecialchars((string) $projeto['ano']) ?></span>
                    </div>

                    <h2>
                        <?= htmlspecialchars($projeto['nome']) ?>
                    </h2>

                    <p>
                        <?= htmlspecialchars($projeto['descricao']) ?>
                    </p>

                    <div class="tags">

                        <?php
                        $tecs = explode(',', $projeto['tecnologias']);

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

                    <div class="acoes">

                        <a href="detalhe.php?id=<?= urlencode($projeto['id']) ?>"
                           class="btn-projeto btn-detalhe">
                            Ver detalhes
                        </a>

                        <?php if (!empty($projeto['link_github'])): ?>
                            <a href="<?= htmlspecialchars($projeto['link_github']) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn-projeto btn-github">
                                GitHub
                            </a>
                        <?php endif; ?>

                    </div>

                </article>

            <?php endforeach; ?>

        </section>

    <?php endif; ?>

    <a href="index.php" class="voltar">
        ← Voltar ao início
    </a>

</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>