<?php
/**
 * ========================================================
 * Arquivo    : 05_crud/detalhe.php
 * Projeto    : Central de Projetos Web
 * Autor      : Nicolas Henrique
 * Descrição  : Mostra as informações completas de um projeto.
 * ========================================================
 */

// Bloqueia acesso sem login
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Conexão do módulo CRUD
require_once __DIR__ . '/includes/conexao.php';

// Recebe o ID pela URL
$id = (int) ($_GET['id'] ?? 0);

$projeto = null;
$erro = '';

if ($id <= 0) {

    $erro = 'ID inválido ou não informado.';

} else {

    try {
        $pdo = conectar();

        $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id LIMIT 1');

        $stmt->execute([
            ':id' => $id
        ]);

        $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$projeto) {
            $erro = 'Projeto não encontrado.';
        }

    } catch (PDOException $e) {
        error_log('Erro ao buscar detalhe do projeto: ' . $e->getMessage());
        $erro = 'Não foi possível carregar os detalhes do projeto.';
    }

}

$titulo_pagina = $projeto
    ? $projeto['nome'] . ' | Detalhes'
    : 'Detalhes do Projeto';

$caminho_raiz = '../';
$pagina_atual = 'crud';
$nome_dev = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
.detalhe-area {
    max-width: 900px;
    margin: 0 auto;
    padding: 35px 0 65px;
}

.voltar-detalhe {
    display: inline-block;
    margin-bottom: 24px;
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.voltar-detalhe:hover {
    text-decoration: underline;
}

.detalhe-erro {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 55px 30px;
    text-align: center;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
}

.detalhe-erro h2 {
    color: #0f172a;
    margin-bottom: 12px;
}

.detalhe-erro p {
    color: #64748b;
    margin-bottom: 24px;
}

.detalhe-topo {
    margin-bottom: 26px;
}

.detalhe-badge {
    display: inline-block;
    background: #2563eb;
    color: #ffffff;
    padding: 7px 14px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 0.82rem;
    margin-bottom: 14px;
}

.detalhe-topo h1 {
    font-size: 2.4rem;
    color: #0f172a;
}

.detalhe-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
}

.detalhe-barra {
    height: 8px;
    background: linear-gradient(90deg, #2563eb, #0ea5e9);
}

.detalhe-conteudo {
    padding: 34px;
}

.bloco-info {
    margin-bottom: 30px;
}

.bloco-info h3 {
    color: #64748b;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 12px;
}

.descricao-box {
    background: #f8fafc;
    border-left: 4px solid #2563eb;
    border-radius: 16px;
    padding: 18px;
    color: #475569;
    line-height: 1.8;
}

.detalhe-grid {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 25px;
    align-items: start;
}

.tags-detalhe {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tag-detalhe {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 800;
}

.btn-github-detalhe,
.btn-editar-detalhe,
.btn-voltar-lista {
    display: inline-block;
    text-decoration: none;
    border-radius: 14px;
    padding: 12px 16px;
    font-weight: 800;
    transition: 0.25s;
}

.btn-github-detalhe {
    background: #0f172a;
    color: #ffffff;
}

.btn-editar-detalhe {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-voltar-lista {
    background: #2563eb;
    color: #ffffff;
}

.btn-github-detalhe:hover,
.btn-editar-detalhe:hover,
.btn-voltar-lista:hover {
    transform: translateY(-2px);
}

.detalhe-rodape {
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    padding: 20px 34px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.detalhe-rodape span {
    color: #64748b;
    font-size: 0.9rem;
}

@media (max-width: 700px) {
    .detalhe-grid {
        grid-template-columns: 1fr;
    }

    .detalhe-topo h1 {
        font-size: 1.8rem;
    }
}
</style>

<main class="detalhe-area">

    <a href="index.php" class="voltar-detalhe">
        ← Voltar para projetos
    </a>

    <?php if ($erro): ?>

        <article class="detalhe-erro">

            <div style="font-size: 3rem; margin-bottom: 15px;">🔍</div>

            <h2>Não foi possível exibir o projeto</h2>

            <p>
                <?= htmlspecialchars($erro) ?>
            </p>

            <a href="index.php" class="btn-voltar-lista">
                Ver todos os projetos
            </a>

        </article>

    <?php else: ?>

        <section class="detalhe-topo">

            <span class="detalhe-badge">
                Ano: <?= htmlspecialchars((string) $projeto['ano']) ?>
            </span>

            <h1>
                <?= htmlspecialchars($projeto['nome']) ?>
            </h1>

        </section>

        <article class="detalhe-card">

            <div class="detalhe-barra"></div>

            <div class="detalhe-conteudo">

                <section class="bloco-info">

                    <h3>📝 Descrição do Projeto</h3>

                    <div class="descricao-box">
                        <?= nl2br(htmlspecialchars($projeto['descricao'])) ?>
                    </div>

                </section>

                <section class="detalhe-grid">

                    <div class="bloco-info">

                        <h3>🚀 Tecnologias</h3>

                        <div class="tags-detalhe">

                            <?php
                            $techs = explode(',', $projeto['tecnologias']);

                            foreach ($techs as $tech):

                                if (trim($tech) === '') {
                                    continue;
                                }
                            ?>

                                <span class="tag-detalhe">
                                    <?= htmlspecialchars(trim($tech)) ?>
                                </span>

                            <?php endforeach; ?>

                        </div>

                    </div>

                    <?php if (!empty($projeto['link_github'])): ?>

                        <div class="bloco-info">

                            <h3>Repositório</h3>

                            <a href="<?= htmlspecialchars($projeto['link_github']) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn-github-detalhe">
                                🔗 Ver GitHub
                            </a>

                        </div>

                    <?php endif; ?>

                </section>

            </div>

            <footer class="detalhe-rodape">

                <span>
                    ID do projeto: #<?= htmlspecialchars((string) $projeto['id']) ?>
                </span>

                <a href="editar.php?id=<?= urlencode($projeto['id']) ?>"
                   class="btn-editar-detalhe">
                    ✏️ Editar Projeto
                </a>

            </footer>

        </article>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>