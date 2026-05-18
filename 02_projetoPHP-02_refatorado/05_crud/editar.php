<?php
/**
 * ========================================================
 * Arquivo    : 05_crud/editar.php
 * Projeto    : Central de Projetos Web
 * Autor      : Nicolas Henrique
 * Descrição  : Página para atualizar os dados de um projeto.
 * ========================================================
 */

// Verifica se o usuário está autenticado
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Importa a conexão do CRUD
require_once __DIR__ . '/includes/conexao.php';

// Recebe o ID do projeto pela URL
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

$pdo = conectar();

// Busca o projeto atual
$stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id LIMIT 1');
$stmt->execute([
    ':id' => $id
]);

$projeto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projeto) {
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

$erro = '';

// Atualiza os dados quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome        = trim($_POST['nome'] ?? '');
    $descricao   = trim($_POST['descricao'] ?? '');
    $tecnologias = trim($_POST['tecnologias'] ?? '');
    $link_github = trim($_POST['link_github'] ?? '');
    $ano         = (int) ($_POST['ano'] ?? date('Y'));

    if ($nome === '') {
        $erro = 'Informe o nome do projeto.';
    } elseif ($descricao === '') {
        $erro = 'Informe a descrição do projeto.';
    } elseif ($tecnologias === '') {
        $erro = 'Informe ao menos uma tecnologia.';
    } elseif ($ano < 2000 || $ano > (int) date('Y')) {
        $erro = 'Informe um ano válido entre 2000 e ' . date('Y') . '.';
    }

    if ($erro === '') {
        try {
            $sql = '
                UPDATE projetos
                SET
                    nome = :nome,
                    descricao = :descricao,
                    tecnologias = :tecnologias,
                    link_github = :link_github,
                    ano = :ano
                WHERE id = :id
            ';

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nome'        => $nome,
                ':descricao'   => $descricao,
                ':tecnologias' => $tecnologias,
                ':link_github' => $link_github !== '' ? $link_github : null,
                ':ano'         => $ano,
                ':id'          => $id,
            ]);

            header('Location: index.php?editado=ok');
            exit;

        } catch (PDOException $e) {
            error_log('Erro ao editar projeto: ' . $e->getMessage());
            $erro = 'Não foi possível salvar as alterações agora.';
        }
    }

    // Mantém os dados preenchidos se houver erro
    $projeto['nome']        = $nome;
    $projeto['descricao']   = $descricao;
    $projeto['tecnologias'] = $tecnologias;
    $projeto['link_github'] = $link_github;
    $projeto['ano']         = $ano;
}

$titulo_pagina = 'Editar Projeto';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
.editar-area {
    max-width: 820px;
    margin: 0 auto;
    padding: 35px 0 65px;
}

.voltar-editar {
    display: inline-block;
    margin-bottom: 24px;
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.voltar-editar:hover {
    text-decoration: underline;
}

.editar-topo {
    text-align: center;
    margin-bottom: 30px;
}

.editar-badge {
    display: inline-block;
    background: #dbeafe;
    color: #1d4ed8;
    padding: 7px 14px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 0.8rem;
    margin-bottom: 12px;
}

.editar-topo h1 {
    font-size: 2.2rem;
    color: #0f172a;
    margin-bottom: 8px;
}

.editar-topo p {
    color: #64748b;
}

.editar-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 34px;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
}

.erro-editar {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 22px;
    font-weight: 700;
}

.form-editar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.campo-editar label {
    display: block;
    margin-bottom: 8px;
    color: #334155;
    font-weight: 800;
}

.campo-editar span {
    color: #dc2626;
}

.campo-editar input,
.campo-editar textarea {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #cbd5e1;
    border-radius: 14px;
    background: #f8fafc;
    font-size: 0.95rem;
    outline: none;
    transition: 0.2s;
}

.campo-editar input:focus,
.campo-editar textarea:focus {
    background: #ffffff;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
}

.editar-grid {
    display: grid;
    grid-template-columns: 1fr 180px;
    gap: 20px;
}

.acoes-editar {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 12px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn-cancelar-editar,
.btn-salvar-editar {
    border-radius: 14px;
    padding: 14px 20px;
    font-weight: 800;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-cancelar-editar {
    background: #f1f5f9;
    color: #334155;
}

.btn-salvar-editar {
    background: #2563eb;
    color: #ffffff;
}

.btn-salvar-editar:hover {
    background: #1d4ed8;
}

.btn-cancelar-editar:hover {
    background: #e2e8f0;
}

@media (max-width: 700px) {
    .editar-grid {
        grid-template-columns: 1fr;
    }

    .editar-card {
        padding: 26px;
    }

    .acoes-editar {
        flex-direction: column;
    }

    .btn-cancelar-editar,
    .btn-salvar-editar {
        text-align: center;
        width: 100%;
    }
}
</style>

<main class="editar-area">

    <a href="index.php" class="voltar-editar">
        ← Voltar para projetos
    </a>

    <section class="editar-topo">
        <span class="editar-badge">
            Registro #<?= htmlspecialchars((string) $id) ?>
        </span>

        <h1>✏️ Editar Projeto</h1>

        <p>Atualize as informações cadastradas neste projeto.</p>
    </section>

    <article class="editar-card">

        <?php if ($erro): ?>
            <div class="erro-editar">
                🚫 <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="editar.php?id=<?= urlencode($id) ?>" method="POST" class="form-editar">

            <div class="campo-editar">
                <label for="nome">Nome do Projeto <span>*</span></label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($projeto['nome'] ?? '') ?>"
                    required
                >
            </div>

            <div class="campo-editar">
                <label for="descricao">Descrição <span>*</span></label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="5"
                    required
                ><?= htmlspecialchars($projeto['descricao'] ?? '') ?></textarea>
            </div>

            <div class="campo-editar">
                <label for="tecnologias">Tecnologias <span>*</span></label>
                <input
                    type="text"
                    id="tecnologias"
                    name="tecnologias"
                    value="<?= htmlspecialchars($projeto['tecnologias'] ?? '') ?>"
                    placeholder="PHP, MySQL, CSS..."
                    required
                >
            </div>

            <div class="editar-grid">

                <div class="campo-editar">
                    <label for="link_github">GitHub</label>
                    <input
                        type="url"
                        id="link_github"
                        name="link_github"
                        value="<?= htmlspecialchars($projeto['link_github'] ?? '') ?>"
                        placeholder="https://github.com/seu-usuario/projeto"
                    >
                </div>

                <div class="campo-editar">
                    <label for="ano">Ano <span>*</span></label>
                    <input
                        type="number"
                        id="ano"
                        name="ano"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= htmlspecialchars((string) ($projeto['ano'] ?? date('Y'))) ?>"
                        required
                    >
                </div>

            </div>

            <div class="acoes-editar">

                <a href="index.php" class="btn-cancelar-editar">
                    Cancelar
                </a>

                <button type="submit" class="btn-salvar-editar">
                    💾 Salvar Alterações
                </button>

            </div>

        </form>

    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>