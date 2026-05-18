<?php
/**
 * ========================================================
 * Arquivo    : 05_crud/cadastrar.php
 * Projeto    : Central de Projetos Web
 * Autor      : Nicolas Henrique
 * Descrição  : Tela responsável por cadastrar novos projetos.
 * ========================================================
 */

// Proteção da página
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Conexão com o banco
require_once __DIR__ . '/includes/conexao.php';

$erro = '';

$form = [
    'nome'        => '',
    'descricao'   => '',
    'tecnologias' => '',
    'link_github' => '',
    'ano'         => date('Y'),
];

// Recebe os dados do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form['nome']        = trim($_POST['nome'] ?? '');
    $form['descricao']   = trim($_POST['descricao'] ?? '');
    $form['tecnologias'] = trim($_POST['tecnologias'] ?? '');
    $form['link_github'] = trim($_POST['link_github'] ?? '');
    $form['ano']         = (int) ($_POST['ano'] ?? date('Y'));

    // Conferência dos campos obrigatórios
    if ($form['nome'] === '') {
        $erro = 'Informe o nome do projeto.';
    } elseif ($form['descricao'] === '') {
        $erro = 'Informe uma descrição para o projeto.';
    } elseif ($form['tecnologias'] === '') {
        $erro = 'Informe pelo menos uma tecnologia utilizada.';
    } elseif ($form['ano'] < 2000 || $form['ano'] > (int) date('Y')) {
        $erro = 'Informe um ano válido entre 2000 e ' . date('Y') . '.';
    }

    // Salva no banco
    if ($erro === '') {
        try {
            $pdo = conectar();

            $sql = '
                INSERT INTO projetos
                (nome, descricao, tecnologias, link_github, ano)
                VALUES
                (:nome, :descricao, :tecnologias, :link_github, :ano)
            ';

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nome'        => $form['nome'],
                ':descricao'   => $form['descricao'],
                ':tecnologias' => $form['tecnologias'],
                ':link_github' => $form['link_github'] !== '' ? $form['link_github'] : null,
                ':ano'         => $form['ano'],
            ]);

            header('Location: index.php?cadastro=ok');
            exit;

        } catch (PDOException $e) {
            error_log('Erro ao cadastrar projeto: ' . $e->getMessage());
            $erro = 'Não foi possível salvar o projeto agora.';
        }
    }
}

$titulo_pagina = 'Cadastrar Projeto';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
.cadastro-area {
    max-width: 760px;
    margin: 0 auto;
    padding: 35px 0 60px;
}

.voltar-lista {
    display: inline-block;
    margin-bottom: 24px;
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.voltar-lista:hover {
    text-decoration: underline;
}

.cadastro-topo {
    text-align: center;
    margin-bottom: 30px;
}

.cadastro-topo h1 {
    font-size: 2.2rem;
    color: #0f172a;
    margin-bottom: 8px;
}

.cadastro-topo p {
    color: #64748b;
}

.form-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    padding: 34px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
}

.erro-box {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 22px;
    font-weight: 700;
}

.formulario-projeto {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.campo label {
    display: block;
    margin-bottom: 8px;
    font-weight: 800;
    color: #334155;
}

.campo span {
    color: #dc2626;
}

.campo input,
.campo textarea {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #cbd5e1;
    border-radius: 14px;
    background: #f8fafc;
    font-size: 0.95rem;
    outline: none;
    transition: 0.2s;
}

.campo input:focus,
.campo textarea:focus {
    background: #ffffff;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
}

.dica {
    margin-top: 6px;
    color: #64748b;
    font-size: 0.82rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.btn-salvar {
    width: 100%;
    margin-top: 8px;
    border: none;
    border-radius: 14px;
    padding: 15px;
    background: #2563eb;
    color: #ffffff;
    font-size: 1rem;
    font-weight: 800;
    cursor: pointer;
    transition: 0.25s;
}

.btn-salvar:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

@media (max-width: 700px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-card {
        padding: 26px;
    }
}
</style>

<main class="cadastro-area">

    <a href="index.php" class="voltar-lista">
        ← Voltar para projetos
    </a>

    <section class="cadastro-topo">
        <h1>➕ Cadastrar Projeto</h1>
        <p>Preencha as informações para adicionar um projeto ao portfólio.</p>
    </section>

    <article class="form-card">

        <?php if ($erro): ?>
            <div class="erro-box">
                🚫 <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="cadastrar.php" method="post" class="formulario-projeto">

            <div class="campo">
                <label for="nome">Nome do Projeto <span>*</span></label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($form['nome']) ?>"
                    placeholder="Ex: Sistema de Login"
                    maxlength="120"
                    required
                >
            </div>

            <div class="campo">
                <label for="descricao">Descrição <span>*</span></label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="4"
                    placeholder="Descreva brevemente o projeto..."
                    required
                ><?= htmlspecialchars($form['descricao']) ?></textarea>
            </div>

            <div class="campo">
                <label for="tecnologias">Tecnologias <span>*</span></label>
                <input
                    type="text"
                    id="tecnologias"
                    name="tecnologias"
                    value="<?= htmlspecialchars($form['tecnologias']) ?>"
                    placeholder="PHP, MySQL, CSS..."
                    required
                >
                <p class="dica">Separe as tecnologias por vírgula.</p>
            </div>

            <div class="form-grid">

                <div class="campo">
                    <label for="link_github">GitHub</label>
                    <input
                        type="url"
                        id="link_github"
                        name="link_github"
                        value="<?= htmlspecialchars($form['link_github']) ?>"
                        placeholder="https://github.com/seu-usuario/projeto"
                    >
                </div>

                <div class="campo">
                    <label for="ano">Ano <span>*</span></label>
                    <input
                        type="number"
                        id="ano"
                        name="ano"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= htmlspecialchars($form['ano']) ?>"
                        required
                    >
                </div>

            </div>

            <button type="submit" class="btn-salvar">
                💾 Salvar Projeto
            </button>

        </form>

    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>