<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 07 — CRUD: Create e Read
 * Arquivo    : 05_crud/index.php
 */

// --- Proteção: apenas usuários autenticados ---
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// --- Dependências ---
require_once __DIR__ . '/includes/conexao.php';

// --- Busca ---
$pdo = conectar();
$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll();

$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';

$titulo_pagina = 'Meus Projetos — Portfólio';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: Arial, sans-serif;
    background: #f3f4f6;
    color: #111827;
}

/* CONTAINER */
.container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
}

/* TÍTULO */
.titulo-secao {
    font-size: 26px;
    color: #3b579d;
}

/* CARD */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 18px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    transition: 0.2s;
}

.card:hover {
    transform: translateY(-4px);
}

/* BOTÕES */
.btn-primario {
    background: #3b579d;
    color: white;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
}

.btn-primario:hover {
    background: #2f447a;
}

.btn-secundario {
    display: inline-block;
    margin-top: 10px;
    background: #e5e7eb;
    color: #111827;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-secundario:hover {
    background: #d1d5db;
}

/* ALERTA */
.alerta-sucesso {
    background: #dcfce7;
    border: 1px solid #22c55e;
    color: #166534;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

/* RESPONSIVO */
@media (max-width: 600px) {
    .titulo-secao {
        font-size: 20px;
    }
}

</style>

</head>
<body>

<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
        <h1 class="titulo-secao">📂 Meus Projetos</h1>

        <!-- ✅ CORRIGIDO AQUI -->
        <a href="/05_crud/cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
    </div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">✅ Projeto cadastrado com sucesso!</p>
        </div>
    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📁</p>
            <p style="font-size: 16px; margin: 0 0 16px;">Nenhum projeto cadastrado ainda.</p>

            <!-- ✅ CORRIGIDO AQUI -->
            <a href="/05_crud/cadastrar.php" class="btn-primario">➕ Cadastrar o primeiro projeto</a>
        </div>

    <?php else: ?>
        <div class="grid">
            <?php foreach ($projetos as $projeto): ?>
                <div class="card">
                    <h3 style="margin: 0 0 8px; color: #3b579d; font-size: 17px;">
                        <?php echo htmlspecialchars($projeto['nome']); ?>
                    </h3>
                    
                    <p style="margin: 0 0 10px; font-size: 14px; color: #374151; line-height: 1.6;">
                        <?php echo htmlspecialchars($projeto['descricacao']); ?>
                    </p>

                    <p style="margin: 0 0 6px; font-size: 13px; color: #6b7280;">
                        🛠️ <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                    </p>

                    <p style="margin: 0 0 12px; font-size: 13px; color: #6b7280;">
                        📅 <?php echo htmlspecialchars($projeto['ano']); ?>
                    </p>

                    <?php if ($projeto['link_github']): ?>
                        <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="btn-secundario">🔗 Ver no GitHub</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <p style="margin-top: 16px; font-size: 14px; color: #6b7280; text-align: right;">
            <?php echo count($projetos); ?> projeto(s) cadastrado(s)
        </p>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>