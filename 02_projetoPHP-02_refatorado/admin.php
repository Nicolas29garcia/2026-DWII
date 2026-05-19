<?php
/**
 * ============================================================
 * Arquivo    : admin.php
 * Autor      : Nicolas Henrique
 * Descrição  : Painel administrativo com cadastro, edição,
 *              filtro por status e arquivamento de projetos.
 * ============================================================
 */

require_once __DIR__ . '/04_sessoes/includes/auth.php';
require_once __DIR__ . '/includes/conexao.php';

requer_login();

$pdo = conectar();
$erro = '';
$editando = null;

function registrar_log(PDO $pdo, string $acao, int $registro_id, string $detalhes): void
{
    $stmt = $pdo->prepare("
        INSERT INTO logs (
            tabela_afetada,
            registro_id,
            acao,
            usuario_login,
            detalhes
        )
        VALUES (
            'projetos',
            :id,
            :acao,
            :usuario_login,
            :detalhes
        )
    ");

    $stmt->execute([
        ':id'            => $registro_id,
        ':acao'          => $acao,
        ':usuario_login' => $_SESSION['usuario'] ?? null,
        ':detalhes'      => $detalhes
    ]);
}

$status_validos = ['rascunho', 'publicado', 'arquivado'];

/* PROCESSAMENTO */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? 'salvar';

    if ($acao === 'arquivar') {

        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {
            $stmt = $pdo->prepare("
                UPDATE projetos
                SET status = 'arquivado'
                WHERE id = :id
            ");

            $stmt->execute([':id' => $id]);

            registrar_log($pdo, 'STATUS', $id, 'Projeto arquivado');
        }

        header('Location: admin.php?arquivado=ok');
        exit;
    }

    if ($acao === 'salvar') {

        $id          = (int) ($_POST['id'] ?? 0);
        $nome        = trim($_POST['nome'] ?? '');
        $descricao   = trim($_POST['descricao'] ?? '');
        $tecnologias = trim($_POST['tecnologias'] ?? '');
        $link_github = trim($_POST['link_github'] ?? '');
        $ano         = (int) ($_POST['ano'] ?? date('Y'));
        $status      = $_POST['status'] ?? 'rascunho';

        if (!in_array($status, $status_validos, true)) {
            $status = 'rascunho';
        }

        if ($nome === '') {
            $erro = 'Informe o nome do projeto.';
        } elseif ($descricao === '') {
            $erro = 'Informe a descrição do projeto.';
        } elseif ($tecnologias === '') {
            $erro = 'Informe as tecnologias utilizadas.';
        } elseif ($ano < 2000 || $ano > (int) date('Y')) {
            $erro = 'Informe um ano válido.';
        }

        if ($erro === '') {

            if ($id > 0) {

                $stmt = $pdo->prepare("
                    UPDATE projetos
                    SET
                        nome = :nome,
                        descricao = :descricao,
                        tecnologias = :tecnologias,
                        link_github = :link_github,
                        ano = :ano,
                        status = :status
                    WHERE id = :id
                ");

                $stmt->execute([
                    ':nome'        => $nome,
                    ':descricao'   => $descricao,
                    ':tecnologias' => $tecnologias,
                    ':link_github' => $link_github !== '' ? $link_github : null,
                    ':ano'         => $ano,
                    ':status'      => $status,
                    ':id'          => $id
                ]);

                registrar_log($pdo, 'UPDATE', $id, "Projeto atualizado: {$nome}");

                header('Location: admin.php?editado=ok');
                exit;

            } else {

                $stmt = $pdo->prepare("
                    INSERT INTO projetos
                    (nome, descricao, tecnologias, link_github, ano, status)
                    VALUES
                    (:nome, :descricao, :tecnologias, :link_github, :ano, :status)
                ");

                $stmt->execute([
                    ':nome'        => $nome,
                    ':descricao'   => $descricao,
                    ':tecnologias' => $tecnologias,
                    ':link_github' => $link_github !== '' ? $link_github : null,
                    ':ano'         => $ano,
                    ':status'      => $status
                ]);

                $novo_id = (int) $pdo->lastInsertId();

                registrar_log($pdo, 'INSERT', $novo_id, "Projeto cadastrado: {$nome}");

                header('Location: admin.php?cadastro=ok');
                exit;
            }
        }

        $editando = [
            'id'          => $id,
            'nome'        => $nome,
            'descricao'   => $descricao,
            'tecnologias' => $tecnologias,
            'link_github' => $link_github,
            'ano'         => $ano,
            'status'      => $status
        ];
    }
}

/* BUSCA PARA EDIÇÃO */
if ($editando === null && isset($_GET['editar'])) {
    $id_editar = (int) $_GET['editar'];

    $stmt = $pdo->prepare("SELECT * FROM projetos WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id_editar]);

    $editando = $stmt->fetch(PDO::FETCH_ASSOC);
}

/* FILTRO */
$filtros_validos = ['todos', 'rascunho', 'publicado', 'arquivado'];
$filtro = $_GET['filtro'] ?? 'todos';

if (!in_array($filtro, $filtros_validos, true)) {
    $filtro = 'todos';
}

if ($filtro === 'todos') {
    $stmt = $pdo->query("SELECT * FROM projetos ORDER BY criado_em DESC");
    $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("
        SELECT *
        FROM projetos
        WHERE status = :status
        ORDER BY criado_em DESC
    ");

    $stmt->execute([':status' => $filtro]);
    $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$form = $editando ?? [
    'id'          => 0,
    'nome'        => '',
    'descricao'   => '',
    'tecnologias' => '',
    'link_github' => '',
    'ano'         => date('Y'),
    'status'      => 'rascunho'
];

$titulo_pagina = 'Administração de Projetos';
$pagina_atual  = 'painel';
$caminho_raiz  = './';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<style>
.admin-topo {
    margin-bottom: 30px;
}

.admin-topo h1 {
    font-size: 2.3rem;
    color: #0f172a;
    margin-bottom: 8px;
}

.admin-topo p {
    color: #64748b;
}

.admin-grid {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 28px;
    align-items: start;
}

.admin-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
}

.admin-card h2 {
    margin-bottom: 18px;
    color: #0f172a;
}

.admin-alerta {
    padding: 14px;
    border-radius: 14px;
    margin-bottom: 18px;
    font-weight: 700;
}

.sucesso {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #22c55e;
}

.erro {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #ef4444;
}

.form-admin {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.campo label {
    display: block;
    margin-bottom: 7px;
    font-weight: 800;
    color: #334155;
}

.campo input,
.campo textarea,
.campo select {
    width: 100%;
    padding: 13px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 14px;
    background: #f8fafc;
    outline: none;
    font-size: 0.95rem;
}

.campo input:focus,
.campo textarea:focus,
.campo select:focus {
    background: #fff;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
}

.btn-admin {
    border: none;
    border-radius: 14px;
    padding: 14px 18px;
    font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    display: inline-block;
}

.btn-salvar {
    background: #2563eb;
    color: #fff;
}

.btn-limpar {
    background: #f1f5f9;
    color: #334155;
}

.filtro-box {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
}

.filtro-box select {
    padding: 11px 14px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
}

.lista-projetos {
    display: grid;
    gap: 18px;
}

.projeto-item {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
}

.projeto-topo {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 12px;
}

.badge-status {
    padding: 6px 11px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 900;
}

.rascunho {
    background: #fef3c7;
    color: #92400e;
}

.publicado {
    background: #dcfce7;
    color: #166534;
}

.arquivado {
    background: #fee2e2;
    color: #991b1b;
}

.projeto-item h3 {
    color: #0f172a;
    margin-bottom: 8px;
}

.projeto-item p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 12px;
}

.acoes-projeto {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.btn-editar {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-arquivar {
    background: #fee2e2;
    color: #dc2626;
}

.btn-github {
    background: #0f172a;
    color: #fff;
}

@media (max-width: 900px) {
    .admin-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="admin-topo">
    <h1>Painel Administrativo</h1>
    <p>Gerencie projetos, edite informações, filtre por status e arquive registros.</p>
</section>

<?php if (isset($_GET['cadastro'])): ?>
    <div class="admin-alerta sucesso">✅ Projeto cadastrado com sucesso.</div>
<?php elseif (isset($_GET['editado'])): ?>
    <div class="admin-alerta sucesso">✏️ Projeto atualizado com sucesso.</div>
<?php elseif (isset($_GET['arquivado'])): ?>
    <div class="admin-alerta sucesso">🗂️ Projeto arquivado com sucesso.</div>
<?php endif; ?>

<?php if ($erro !== ''): ?>
    <div class="admin-alerta erro">
        <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

<section class="admin-grid">

    <article class="admin-card">

        <h2>
            <?= ((int) $form['id'] > 0) ? '✏️ Editar projeto' : '➕ Novo projeto' ?>
        </h2>

        <form action="admin.php" method="POST" class="form-admin">

            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $form['id']) ?>">

            <div class="campo">
                <label for="nome">Nome *</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($form['nome'] ?? '') ?>"
                    required
                >
            </div>

            <div class="campo">
                <label for="descricao">Descrição *</label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="4"
                    required
                ><?= htmlspecialchars($form['descricao'] ?? '') ?></textarea>
            </div>

            <div class="campo">
                <label for="tecnologias">Tecnologias *</label>
                <input
                    type="text"
                    id="tecnologias"
                    name="tecnologias"
                    value="<?= htmlspecialchars($form['tecnologias'] ?? '') ?>"
                    placeholder="PHP, MySQL, CSS..."
                    required
                >
            </div>

            <div class="campo">
                <label for="link_github">GitHub</label>
                <input
                    type="url"
                    id="link_github"
                    name="link_github"
                    value="<?= htmlspecialchars($form['link_github'] ?? '') ?>"
                    placeholder="https://github.com/..."
                >
            </div>

            <div class="campo">
                <label for="ano">Ano *</label>
                <input
                    type="number"
                    id="ano"
                    name="ano"
                    min="2000"
                    max="<?= date('Y') ?>"
                    value="<?= htmlspecialchars((string) ($form['ano'] ?? date('Y'))) ?>"
                    required
                >
            </div>

            <div class="campo">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="rascunho" <?= ($form['status'] ?? '') === 'rascunho' ? 'selected' : '' ?>>
                        Rascunho
                    </option>
                    <option value="publicado" <?= ($form['status'] ?? '') === 'publicado' ? 'selected' : '' ?>>
                        Publicado
                    </option>
                    <option value="arquivado" <?= ($form['status'] ?? '') === 'arquivado' ? 'selected' : '' ?>>
                        Arquivado
                    </option>
                </select>
            </div>

            <button type="submit" class="btn-admin btn-salvar">
                💾 Salvar projeto
            </button>

            <?php if ((int) $form['id'] > 0): ?>
                <a href="admin.php" class="btn-admin btn-limpar">
                    Cancelar edição
                </a>
            <?php endif; ?>

        </form>

    </article>

    <article class="admin-card">

        <div class="filtro-box">

            <h2>📋 Projetos</h2>

            <form method="GET" action="admin.php">
                <select name="filtro" onchange="this.form.submit()">
                    <option value="todos" <?= $filtro === 'todos' ? 'selected' : '' ?>>Todos</option>
                    <option value="rascunho" <?= $filtro === 'rascunho' ? 'selected' : '' ?>>Rascunho</option>
                    <option value="publicado" <?= $filtro === 'publicado' ? 'selected' : '' ?>>Publicado</option>
                    <option value="arquivado" <?= $filtro === 'arquivado' ? 'selected' : '' ?>>Arquivado</option>
                </select>
            </form>

        </div>

        <?php if (empty($projetos)): ?>

            <p>Nenhum projeto encontrado neste filtro.</p>

        <?php else: ?>

            <div class="lista-projetos">

                <?php foreach ($projetos as $projeto): ?>

                    <div class="projeto-item">

                        <div class="projeto-topo">

                            <span class="badge-status <?= htmlspecialchars($projeto['status']) ?>">
                                <?= strtoupper(htmlspecialchars($projeto['status'])) ?>
                            </span>

                            <strong>
                                <?= htmlspecialchars((string) $projeto['ano']) ?>
                            </strong>

                        </div>

                        <h3>
                            <?= htmlspecialchars($projeto['nome']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($projeto['descricao']) ?>
                        </p>

                        <small>
                            🛠️ <?= htmlspecialchars($projeto['tecnologias']) ?>
                        </small>

                        <div class="acoes-projeto">

                            <a href="admin.php?editar=<?= urlencode($projeto['id']) ?>"
                               class="btn-admin btn-editar">
                                ✏️ Editar
                            </a>

                            <?php if (!empty($projeto['link_github'])): ?>
                                <a href="<?= htmlspecialchars($projeto['link_github']) ?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn-admin btn-github">
                                    🔗 GitHub
                                </a>
                            <?php endif; ?>

                            <?php if ($projeto['status'] !== 'arquivado'): ?>
                                <form method="POST" action="admin.php" onsubmit="return confirm('Arquivar este projeto?');">
                                    <input type="hidden" name="acao" value="arquivar">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars((string) $projeto['id']) ?>">

                                    <button type="submit" class="btn-admin btn-arquivar">
                                        🗂️ Arquivar
                                    </button>
                                </form>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </article>

</section>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>