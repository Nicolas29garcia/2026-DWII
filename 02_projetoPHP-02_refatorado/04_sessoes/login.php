<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : System Hub
 * Arquivo    : 04_sessoes/login.php
 * Autor      : Nicolas Henrique
 * Data       : [DATA DE HOJE]
 * Descrição  : Sistema de login utilizando sessões PHP.
 * ════════════════════════════════════════════════════════════
 */

session_start();

// ── Se já estiver logado ───────────────────────────────────
if (isset($_SESSION['usuario'])) {

    header('Location: painel.php');
    exit;

}

// ── Usuário fixo de teste ──────────────────────────────────
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA   = 'admin2026';

// ── Variáveis ──────────────────────────────────────────────
$erro = '';
$login = '';

// ── Processamento formulário ───────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // ── Validação login ───────────────────────────────────
    if (
        $login === $USUARIO_VALIDO &&
        $senha === $SENHA_VALIDA
    ) {

        // Segurança contra session fixation
        session_regenerate_id(true);

        // Sessão usuário
        $_SESSION['usuario'] = $login;

        // Data login
        $_SESSION['logado_em'] = date('d/m/Y H:i:s');

        // Redireciona painel
        header('Location: painel.php');
        exit;

    } else {

        $erro = 'Usuário ou senha inválidos.';

    }

}

// ── Variáveis template ─────────────────────────────────────
$titulo_pagina = 'Login | Sistema de Sessões';
$pagina_atual  = 'login';
$caminho_raiz  = '../';
$nome_dev      = 'NICOLAS';

// ── Cabeçalho global ───────────────────────────────────────
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<style>

    /* ───────────────────────────────────────────────────────
       Página login
    ─────────────────────────────────────────────────────── */

    .login-page{
        min-height:80vh;

        display:flex;
        align-items:center;
        justify-content:center;

        padding:40px 20px;

        background:
        linear-gradient(
            135deg,
            #eff6ff,
            #f8fafc
        );
    }

    /* ───────────────────────────────────────────────────────
       Card login
    ─────────────────────────────────────────────────────── */

    .login-card{
        width:100%;
        max-width:430px;

        background:#ffffff;

        border:1px solid #e5e7eb;
        border-radius:26px;

        padding:38px;

        box-shadow:
        0 24px 60px rgba(15,23,42,0.10);
    }

    /* ───────────────────────────────────────────────────────
       Cabeçalho login
    ─────────────────────────────────────────────────────── */

    .login-header{
        text-align:center;
        margin-bottom:28px;
    }

    .login-icon{
        width:60px;
        height:60px;

        margin:0 auto 16px;

        border-radius:18px;

        display:flex;
        align-items:center;
        justify-content:center;

        background:#dbeafe;
        color:#2563eb;

        font-size:1.5rem;
    }

    .login-header h1{
        font-size:2rem;
        color:#0f172a;

        margin-bottom:10px;
    }

    .login-header p{
        color:#64748b;
        font-size:0.95rem;
    }

    /* ───────────────────────────────────────────────────────
       Mensagem erro
    ─────────────────────────────────────────────────────── */

    .login-alert{
        background:#fef2f2;
        color:#dc2626;

        border:1px solid #fecaca;

        padding:14px;
        border-radius:14px;

        margin-bottom:20px;

        text-align:center;

        font-weight:700;
    }

    /* ───────────────────────────────────────────────────────
       Formulário
    ─────────────────────────────────────────────────────── */

    .login-form{
        display:flex;
        flex-direction:column;
        gap:18px;
    }

    .form-group label{
        display:block;

        margin-bottom:8px;

        font-weight:700;
        color:#334155;
    }

    .form-group input{
        width:100%;

        padding:14px 15px;

        border-radius:14px;
        border:1px solid #cbd5e1;

        background:#f8fafc;

        outline:none;

        font-size:0.95rem;

        transition:0.2s;
    }

    .form-group input:focus{
        background:#ffffff;

        border-color:#2563eb;

        box-shadow:
        0 0 0 4px rgba(37,99,235,0.16);
    }

    /* ───────────────────────────────────────────────────────
       Botão login
    ─────────────────────────────────────────────────────── */

    .btn-login{
        width:100%;

        border:none;
        border-radius:14px;

        padding:15px;

        margin-top:5px;

        background:
        linear-gradient(
            135deg,
            #2563eb,
            #1d4ed8
        );

        color:#ffffff;

        font-size:1rem;
        font-weight:800;

        cursor:pointer;

        transition:0.25s;
    }

    .btn-login:hover{
        transform:translateY(-2px);

        box-shadow:
        0 14px 30px rgba(37,99,235,0.25);
    }

    /* ───────────────────────────────────────────────────────
       Link voltar
    ─────────────────────────────────────────────────────── */

    .login-help{
        text-align:center;
        margin-top:22px;
    }

    .login-help a{
        color:#2563eb;

        text-decoration:none;
        font-weight:700;
    }

    .login-help a:hover{
        text-decoration:underline;
    }

</style>

<!-- ───────────────────────────────────────────────────────
     Página login
─────────────────────────────────────────────────────── -->

<section class="login-page">

    <!-- ── Card login ─────────────────────────────────── -->
    <article class="login-card">

        <!-- Cabeçalho -->
        <div class="login-header">

            <div class="login-icon">

                <i class="fa-solid fa-lock"></i>

            </div>

            <h1>
                Acesso Restrito
            </h1>

            <p>
                Faça login para acessar o painel.
            </p>

        </div>

        <!-- Mensagem erro -->
        <?php if ($erro): ?>

            <div class="login-alert">

                <?= htmlspecialchars($erro) ?>

            </div>

        <?php endif; ?>

        <!-- Formulário -->
        <form method="POST"
              class="login-form">

            <!-- Usuário -->
            <div class="form-group">

                <label for="usuario">

                    Usuário

                </label>

                <input
                    type="text"
                    name="usuario"
                    id="usuario"
                    placeholder="Digite seu usuário"
                    value="<?= htmlspecialchars($login) ?>"
                    required
                    autofocus
                >

            </div>

            <!-- Senha -->
            <div class="form-group">

                <label for="senha">

                    Senha

                </label>

                <input
                    type="password"
                    name="senha"
                    id="senha"
                    placeholder="Digite sua senha"
                    required
                >

            </div>

            <!-- Botão -->
            <button type="submit"
                    class="btn-login">

                Entrar no Sistema

            </button>

        </form>

        <!-- Voltar -->
        <div class="login-help">

            <a href="../index.php">

                ← Voltar ao Hub

            </a>

        </div>

    </article>

</section>

<!-- ── Rodapé global ─────────────────────────────────────── -->
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>