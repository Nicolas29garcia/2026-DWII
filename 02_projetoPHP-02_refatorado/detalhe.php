<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : detalhe.php
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Exibe um projeto individual pelo ID vindo
 *               via query string em $_GET.
 * ============================================================
 */

if (session_status() === PHP_SESSION_NONE) session_start();

// Página atual = catálogo
$pagina_atual = 'catalogo';
$titulo_pagina = 'Detalhe do Projeto | Portfólio DWII';
$caminho_raiz = '../';

require_once __DIR__ . '/../includes/conexao.php';

// conectar() devolve uma instância PDO nova.
$pdo = conectar();

// Cast + validação do ID
// Cint() converte string → int.
// filter_var valida se é inteiro positivo.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === null || $id === false || $id <= 0) {
    http_response_code(400);
    die('ID inválido.');
}

// Prepared Statement: valor vai separado do SQL
// e o banco monta tudo com segurança.
$stmt = $pdo->prepare("
SELECT *
FROM projetos
WHERE id = :id
LIMIT 1
");

$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

// Se não existir projeto com esse ID
if (!$projeto) {
    http_response_code(404);
    die('Projeto não encontrado.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include __DIR__ . '/../includes/cabecalho.php'; ?>
</head>

<body>

<div class="container">

    <a href="index.php" class="btn-secundario">
        ← Voltar ao catálogo
    </a>

    <div class="card" style="margin-top: 30px;">

        <div style="
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        ">

            <div>
                <h2 style="margin-bottom: 8px;">
                    <?php echo htmlspecialchars($projeto['nome']); ?>
                </h2>

                <span style="
                    background: #0f172a;
                    color: white;
                    padding: 5px 12px;
                    border-radius: 999px;
                    font-size: 13px;
                ">
                    <?php echo htmlspecialchars($projeto['status']); ?>
                </span>
            </div>

            <div style="text-align: right;">
                <strong>Ano:</strong><br>

                <?php echo (int) $projeto['ano']; ?>
            </div>

        </div>

        <hr style="margin: 25px 0; border-color: #e5e7eb;">

        <h3>Tecnologias</h3>

        <p>
            <?php echo htmlspecialchars($projeto['tecnologias']); ?>
        </p>

        <h3>Descrição</h3>

        <p style="line-height: 1.8;">
            <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?>
        </p>

    </div>

</div>

<?php include __DIR__ . '/../includes/rodape.php'; ?>

</body>
</html>