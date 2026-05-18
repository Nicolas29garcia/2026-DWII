<?php
/**
 * ========================================================
 * Arquivo    : 05_crud/excluir.php
 * Projeto    : Central de Projetos Web
 * Autor      : Nicolas Henrique
 * Descrição  : Confirmação e remoção de projetos cadastrados.
 * ========================================================
 */

// Bloqueia acesso de usuários não autenticados
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Conexão com o banco de dados
require_once __DIR__ . '/includes/conexao.php';

// Captura e valida o ID recebido pela URL
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

$pdo = conectar();

// Busca o projeto antes de permitir a exclusão
$stmt = $pdo->prepare('SELECT id, nome, descricao FROM projetos WHERE id = :id LIMIT 1');
$stmt->execute([
    ':id' => $id
]);

$projeto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projeto) {
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

// Exclusão somente após confirmação via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $stmt = $pdo->prepare('DELETE FROM projetos WHERE id = :id');
        $stmt->execute([
            ':id' => $id
        ]);

        header('Location: index.php?excluido=ok');
        exit;

    } catch (PDOException $e) {
        error_log('Erro ao excluir projeto: ' . $e->getMessage());
        $erro = 'Não foi possível excluir o projeto no momento.';
    }
}

$titulo_pagina = 'Excluir Projeto';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';
$nome_dev      = 'NICOLAS';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>
.excluir-area {
    max-width: 720px;
    margin: 0 auto;
    padding: 45px 0 70px;
}

.excluir-topo {
    text-align: center;
    margin-bottom: 28px;
}

.excluir-icone {
    width: 76px;
    height: 76px;
    margin: 0 auto 18px;
    border-radius: 24px;
    background: #fee2e2;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
}

.excluir-topo h1 {
    color: #991b1b;
    font-size: 2.2rem;
    margin-bottom: 8px;
}

.excluir-topo p {
    color: #64748b;
}

.excluir-card {
    background: #ffffff;
    border: 1px solid #fecaca;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 22px 50px rgba(153, 27, 27, 0.10);
}

.excluir-alerta {
    background: #fef2f2;
    color: #991b1b;
    padding: 20px 28px;
    border-bottom: 1px solid #fecaca;
    font-weight: 700;
}

.excluir-conteudo {
    padding: 32px 28px;
    text-align: center;
}

.excluir-conteudo h2 {
    color: #0f172a;
    font-size: 1.7rem;
    margin-bottom: 14px;
}

.excluir-conteudo p {
    color: #64748b;
    line-height: 1.6;
}

.excluir-descricao {
    margin-top: 18px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 16px;
    color: #475569;
    font-size: 0.95rem;
}

.excluir-erro {
    margin: 20px 28px 0;
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
    padding: 14px;
    border-radius: 14px;
    font-weight: 700;
}

.excluir-acoes {
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    padding: 24px 28px;
}

.excluir-form {
    display: grid;
    gap: 12px;
}

.btn-excluir-final,
.btn-cancelar {
    width: 100%;
    border: none;
    border-radius: 14px;
    padding: 14px;
    font-size: 1rem;
    font-weight: 800;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: 0.25s;
}

.btn-excluir-final {
    background: #dc2626;
    color: #ffffff;
}

.btn-excluir-final:hover {
    background: #b91c1c;
    transform: translateY(-2px);
}

.btn-cancelar {
    background: #ffffff;
    color: #334155;
    border: 1px solid #cbd5e1;
}

.btn-cancelar:hover {
    background: #f1f5f9;
}
</style>

<main class="excluir-area">

    <section class="excluir-topo">
        <div class="excluir-icone">
            ⚠️
        </div>

        <h1>Excluir Projeto</h1>

        <p>Confirme antes de remover este registro do sistema.</p>
    </section>

    <article class="excluir-card">

        <div class="excluir-alerta">
            Esta ação não poderá ser desfeita.
        </div>

        <?php if (!empty($erro)): ?>
            <div class="excluir-erro">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <div class="excluir-conteudo">

            <h2>
                <?= htmlspecialchars($projeto['nome']) ?>
            </h2>

            <p>
                Ao confirmar, este projeto será removido permanentemente do banco de dados.
            </p>

            <?php if (!empty($projeto['descricao'])): ?>
                <div class="excluir-descricao">
                    <?= htmlspecialchars($projeto['descricao']) ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="excluir-acoes">

            <form action="excluir.php?id=<?= urlencode($id) ?>" method="POST" class="excluir-form">

                <button type="submit" class="btn-excluir-final">
                    🗑️ Sim, excluir projeto
                </button>

                <a href="index.php" class="btn-cancelar">
                    Cancelar e voltar
                </a>

            </form>

        </div>

    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>