<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensagem = '';
$tipoAlerta = 'sucesso';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') {
    $mensagem = '✅ Projeto cadastrado com sucesso!';
} elseif (isset($_GET['msg']) && $_GET['msg'] === 'editado') {
    $mensagem = '✏️ Projeto atualizado com sucesso!';
} elseif (isset($_GET['msg']) && $_GET['msg'] === 'excluido') {
    $mensagem = '🗑️ Projeto removido com sucesso!';
    $tipoAlerta = 'erro';
}

$titulo_pagina = 'Meus Projetos';
$caminho_raiz  = '../';
$pagina_atual  = '';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<div class="container" style="margin-top: 20px;">

    <a href="../index.php" class="btn-voltar">
        ← Voltar ao Hub
    </a>

</div>

<header class="hub-header">

    <div class="container">

        <h1>Gerenciador de Projetos</h1>

        <p class="tagline">
            Módulo CRUD - Projetos
        </p>

    </div>

</header>

<main class="container">

    <!-- TOPO -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:15px;
        flex-wrap:wrap;
        margin-bottom:30px;
    ">

        <span class="badge-aula">

            <?= count($projetos) ?> projeto(s)

        </span>

        <!-- BOTÃO CORRIGIDO -->
        <a href="/02_projetoPHP-02_refatorado/05_crud/cadastrar.php"
           class="btn">

            ➕ Novo Projeto

        </a>

    </div>

    <!-- ALERTAS -->
    <?php if ($mensagem): ?>

        <div style="
            margin-bottom:30px;
            padding:15px;
            border-radius:12px;
            text-align:center;
            background:
            <?= $tipoAlerta === 'sucesso'
                ? 'rgba(34,197,94,0.1)'
                : 'rgba(239,68,68,0.1)' ?>;

            color:
            <?= $tipoAlerta === 'sucesso'
                ? '#16a34a'
                : '#ef4444' ?>;
        ">

            <?= htmlspecialchars($mensagem) ?>

        </div>

    <?php endif; ?>

    <!-- SEM PROJETOS -->
    <?php if (empty($projetos)): ?>

        <div class="card"
             style="
                text-align:center;
                padding:60px;
             ">

            <span style="
                font-size:3rem;
                display:block;
                margin-bottom:20px;
            ">
                📁
            </span>

            <h2>
                Nenhum projeto encontrado
            </h2>

            <p style="
                margin:15px 0 25px;
            ">
                Cadastre seu primeiro projeto.
            </p>

            <!-- BOTÃO CORRIGIDO -->
            <a href="/02_projetoPHP-02_refatorado/05_crud/cadastrar.php"
               class="btn">

                ➕ Cadastrar Agora

            </a>

        </div>

    <?php else: ?>

        <!-- GRID -->
        <div style="
            display:grid;
            grid-template-columns:
            repeat(auto-fill,minmax(300px,1fr));
            gap:20px;
        ">

            <?php foreach ($projetos as $projeto): ?>

                <article class="card"
                         style="
                            display:flex;
                            flex-direction:column;
                            gap:12px;
                         ">

                    <!-- TOPO CARD -->
                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                    ">

                        <span style="font-size:1.6rem;">
                            📝
                        </span>

                        <span class="badge-aula">

                            <?= htmlspecialchars($projeto['ano'] ?? '') ?>

                        </span>

                    </div>

                    <!-- NOME -->
                    <h3>

                        <?= htmlspecialchars($projeto['nome'] ?? '') ?>

                    </h3>

                    <!-- DESCRIÇÃO -->
                    <p style="line-height:1.6;">

                        <?= htmlspecialchars($projeto['descricao'] ?? '') ?>

                    </p>

                    <!-- TECNOLOGIAS -->
                    <div style="
                        display:flex;
                        flex-wrap:wrap;
                        gap:6px;
                    ">

                        <?php
                        $tecs = explode(
                            ',',
                            $projeto['tecnologias'] ?? ''
                        );

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

                    <!-- AÇÕES -->
                    <div style="
                        margin-top:auto;
                        display:flex;
                        flex-direction:column;
                        gap:10px;
                    ">

                        <?php if (!empty($projeto['link_github'])): ?>

                            <a href="<?= htmlspecialchars($projeto['link_github']) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn">

                                🔗 GitHub

                            </a>

                        <?php endif; ?>

                        <div style="
                            display:flex;
                            gap:10px;
                        ">

                            <a href="detalhe.php?id=<?= urlencode($projeto['id']) ?>"
                               class="btn"
                               style="flex:1;">

                                Ver Mais

                            </a>

                            <a href="editar.php?id=<?= urlencode($projeto['id']) ?>"
                               class="btn"
                               style="flex:1;">

                                Editar

                            </a>

                        </div>

                        <a href="excluir.php?id=<?= urlencode($projeto['id']) ?>"
                           onclick="return confirm('Excluir projeto?');"
                           class="btn"
                           style="
                                background:#ef4444;
                                text-align:center;
                           ">

                            Excluir

                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>