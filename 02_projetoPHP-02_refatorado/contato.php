<?php
/**
 * =========================================================
 * CONTATO.PHP
 * =========================================================
 */

$nome_visitante = '';
$email = '';
$assunto = '';
$mensagem = '';
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // VALIDAÇÕES

    if (empty($nome_visitante)) {
        $erros[] = 'Digite seu nome.';
    }

    if (empty($email)) {
        $erros[] = 'Digite seu e-mail.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Digite um e-mail válido.';
    }

    if (empty($assunto)) {
        $erros[] = 'Selecione um assunto.';
    }

    if (empty($mensagem)) {
        $erros[] = 'Digite sua mensagem.';
    }

    // REDIRECIONA

    if (empty($erros)) {

        $url = "obrigado.php?nome=" . urlencode($nome_visitante);

        header("Location: $url");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contato | NICOLAS</title>

<style>

/* =========================================================
   CORES
========================================================= */

:root {

    --primary: #2563eb;

    --primary-hover: #1d4ed8;

    --primary-light: #dbeafe;

    --bg: #eef5ff;

    --white: #ffffff;

    --text: #0f172a;

    --text-light: #475569;

    --border: #cbd5e1;

    --danger: #dc2626;

    --radius: 18px;

    --shadow: 0 20px 40px rgba(37,99,235,0.12);
}

/* =========================================================
   BODY
========================================================= */

body {

    margin: 0;

    font-family: Arial, Helvetica, sans-serif;

    background: linear-gradient(135deg,#e0f2fe,#f8fafc);

    color: var(--text);
}

/* =========================================================
   HEADER
========================================================= */

header {

    background: rgba(255,255,255,0.95);

    backdrop-filter: blur(10px);

    box-shadow: 0 4px 18px rgba(37,99,235,0.08);

    padding: 20px;

    position: sticky;

    top: 0;

    z-index: 999;
}

/* REMOVE O BOTÃO NICOLAS */

.logo {
    display: none;
}

/* MENU */

nav ul {

    list-style: none;

    display: flex;

    justify-content: center;

    gap: 14px;

    padding: 0;

    margin: 0;

    flex-wrap: wrap;
}

nav ul li a {

    text-decoration: none;

    color: var(--text);

    font-weight: bold;

    padding: 10px 18px;

    border-radius: 12px;

    transition: 0.3s;
}

nav ul li a:hover {

    background: var(--primary-light);

    color: var(--primary);

    transform: translateY(-2px);
}

/* =========================================================
   CONTAINER
========================================================= */

.container {

    max-width: 900px;

    margin: 70px auto;

    padding: 20px;
}

/* =========================================================
   TOPO
========================================================= */

.topo {

    text-align: center;

    margin-bottom: 40px;
}

.topo h1 {

    font-size: 3rem;

    margin-bottom: 10px;
}

.topo p {

    color: var(--text-light);

    font-size: 1.1rem;
}

/* =========================================================
   CARD
========================================================= */

.card {

    background: rgba(255,255,255,0.96);

    padding: 40px;

    border-radius: var(--radius);

    box-shadow: var(--shadow);

    border: 1px solid rgba(203,213,225,0.7);
}

/* =========================================================
   FORM
========================================================= */

.form-group {

    margin-bottom: 22px;
}

.form-group label {

    display: block;

    margin-bottom: 8px;

    font-weight: bold;
}

.form-control {

    width: 100%;

    padding: 15px;

    border-radius: 14px;

    border: 1px solid var(--border);

    font-size: 1rem;

    box-sizing: border-box;

    transition: 0.3s;
}

.form-control:focus {

    outline: none;

    border-color: var(--primary);

    box-shadow: 0 0 0 4px rgba(37,99,235,0.12);
}

textarea.form-control {

    resize: vertical;

    min-height: 140px;
}

/* =========================================================
   BOTÕES
========================================================= */

.form-actions {

    display: flex;

    gap: 15px;

    margin-top: 30px;
}

.btn {

    border: none;

    border-radius: 14px;

    padding: 16px 24px;

    font-size: 1rem;

    font-weight: bold;

    cursor: pointer;

    text-decoration: none;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    transition: 0.3s;
}

.btn-primary {

    flex: 1;

    background: linear-gradient(135deg,#2563eb,#1d4ed8);

    color: white;
}

.btn-primary:hover {

    transform: translateY(-3px);

    box-shadow: 0 12px 24px rgba(37,99,235,0.25);
}

.btn-secondary {

    background: var(--primary-light);

    color: var(--primary);
}

.btn-secondary:hover {

    background: #bfdbfe;

    transform: translateY(-3px);
}

/* =========================================================
   ERROS
========================================================= */

.alert-error {

    background: #fee2e2;

    color: #991b1b;

    border-left: 5px solid var(--danger);

    padding: 18px 22px;

    border-radius: 14px;

    margin-bottom: 25px;
}

/* =========================================================
   RODAPÉ CENTRALIZADO
========================================================= */

footer {

    text-align: center;

    padding: 40px 20px;

    margin-top: 60px;

    color: var(--text);
}

footer p {

    margin: 5px 0;
}

/* =========================================================
   RESPONSIVO
========================================================= */

@media(max-width:768px){

    .container {

        margin: 40px auto;
    }

    .topo h1 {

        font-size: 2.2rem;
    }

    .card {

        padding: 25px;
    }

    .form-actions {

        flex-direction: column;
    }

    .btn {

        width: 100%;
    }
}

</style>

</head>

<body>

<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <nav>

        <ul>

            <li>
                <a href="index.php">Hub</a>
            </li>

            <li>
                <a href="sobre.php">Bio</a>
            </li>

            <li>
                <a href="contato.php">Contato</a>
            </li>

            <li>
                <a href="04_sessoes/login.php">Acesso</a>
            </li>

        </ul>

    </nav>

</header>

<!-- =========================================================
     CONTEÚDO
========================================================= -->

<main class="container">

    <div class="topo">

        <h1>Entre em Contato</h1>

        <p>
            Envie sua mensagem para iniciarmos uma conversa.
        </p>

    </div>

    <?php if (!empty($erros)): ?>

        <div class="alert-error">

            <strong>⚠ Corrija os erros abaixo:</strong>

            <ul>

                <?php foreach ($erros as $erro): ?>

                    <li><?= htmlspecialchars($erro) ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <article class="card">

        <form action="contato.php" method="POST">

            <div class="form-group">

                <label for="nome_visitante">
                    Nome Completo
                </label>

                <input
                    type="text"
                    name="nome_visitante"
                    id="nome_visitante"
                    class="form-control"
                    placeholder="Digite seu nome"
                    value="<?= htmlspecialchars($nome_visitante) ?>"
                >

            </div>

            <div class="form-group">

                <label for="email">
                    E-mail
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="exemplo@email.com"
                    value="<?= htmlspecialchars($email) ?>"
                >

            </div>

            <div class="form-group">

                <label for="assunto">
                    Assunto
                </label>

                <select
                    name="assunto"
                    id="assunto"
                    class="form-control"
                >

                    <option value="">
                        Selecione uma opção
                    </option>

                    <option value="Duvida"
                        <?= $assunto === 'Duvida' ? 'selected' : '' ?>>
                        ❓ Dúvida
                    </option>

                    <option value="Projeto"
                        <?= $assunto === 'Projeto' ? 'selected' : '' ?>>
                        💻 Projeto
                    </option>

                    <option value="Outro"
                        <?= $assunto === 'Outro' ? 'selected' : '' ?>>
                        📩 Outro
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label for="mensagem">
                    Sua mensagem
                </label>

                <textarea
                    name="mensagem"
                    id="mensagem"
                    class="form-control"
                    placeholder="Digite sua mensagem..."
                ><?= htmlspecialchars($mensagem) ?></textarea>

            </div>

            <div class="form-actions">

                <a href="index.php" class="btn btn-secondary">
                    ← Voltar
                </a>

                <button type="submit" class="btn btn-primary">
                    ✈ Enviar Mensagem
                </button>

            </div>

        </form>

    </article>

</main>

<!-- =========================================================
     RODAPÉ
========================================================= -->

<footer>

    <p>© 2026 - Desenvolvido por NICOLAS</p>

    <p><strong>IFPR</strong> Ponta Grossa</p>

</footer>

</body>
</html>