<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal
 * Arquivo    : index.php
 * Autor      : Nicolas Henrique
 * Descrição  : Página inicial com layout próprio em estilo dashboard.
 * ============================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pagina_atual  = 'home';
$caminho_raiz  = './';
$titulo_pagina = 'Portfólio | Nicolas Henrique';

$nome      = 'Nicolas Henrique';
$projeto   = 'Desenvolvimento Web II • 2026';
$curso     = 'Técnico em Informática';
$instituto = 'IFPR • Campus Ponta Grossa';


$foto = './includes/img/nicolas2.jpg';

$logado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($titulo_pagina) ?></title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

<style>
:root {
    --blue: #2563eb;
    --green: #10b981;
    --orange: #f97316;
    --dark: #0f172a;
    --soft-dark: #1e293b;
    --text: #475569;
    --muted: #64748b;
    --line: #e2e8f0;
    --bg: #f8fafc;
    --card: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: #eef4ff;
    color: var(--dark);
}

/* LAYOUT GERAL */

.app {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 280px 1fr;
}

/* SIDEBAR */

.sidebar {
    background: var(--dark);
    color: #ffffff;
    padding: 30px 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 36px;
}

.brand-icon {
    width: 42px;
    height: 42px;
    background: var(--green);
    color: #052e16;
    border-radius: 14px;
    display: grid;
    place-items: center;
    font-weight: 900;
}

.brand strong {
    display: block;
    font-size: 1rem;
}

.brand span {
    color: #94a3b8;
    font-size: 0.78rem;
}

.side-menu {
    display: grid;
    gap: 10px;
}

.side-menu a {
    color: #cbd5e1;
    text-decoration: none;
    padding: 13px 14px;
    border-radius: 14px;
    font-weight: 800;
    font-size: 0.92rem;
    display: flex;
    gap: 10px;
    align-items: center;
    transition: 0.22s;
}

.side-menu a:hover,
.side-menu a.active {
    background: rgba(255,255,255,0.10);
    color: #ffffff;
}

.side-menu .logout {
    background: rgba(239,68,68,0.16);
    color: #fecaca;
}

.sidebar-footer {
    color: #94a3b8;
    font-size: 0.78rem;
    line-height: 1.6;
    border-top: 1px solid rgba(255,255,255,0.10);
    padding-top: 20px;
}

/* CONTEÚDO */

.content {
    padding: 34px;
}

.top-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    margin-bottom: 28px;
}

.top-info h1 {
    font-size: 1.45rem;
    color: var(--dark);
}

.top-info p {
    color: var(--muted);
    margin-top: 4px;
}

.status-pill {
    background: #dcfce7;
    color: #166534;
    padding: 10px 14px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 0.82rem;
}

/* HERO DASHBOARD */

.dashboard {
    display: grid;
    grid-template-columns: 1.35fr 360px;
    gap: 26px;
    align-items: stretch;
}

.hero-card {
    background: var(--card);
    border-radius: 30px;
    padding: 42px;
    border: 1px solid var(--line);
    box-shadow: 0 22px 55px rgba(15, 23, 42, 0.08);
    position: relative;
    overflow: hidden;
}

.hero-card::after {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    background: rgba(37, 99, 235, 0.08);
    border-radius: 50%;
    right: -90px;
    bottom: -90px;
}

.badge {
    display: inline-block;
    background: #dbeafe;
    color: var(--blue);
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 900;
    margin-bottom: 22px;
}

.hero-card h2 {
    position: relative;
    z-index: 2;
    font-size: clamp(2.3rem, 5vw, 4.2rem);
    line-height: 1;
    letter-spacing: -0.06em;
    margin-bottom: 20px;
}

.hero-card h2 span {
    color: var(--blue);
}

.hero-card p {
    position: relative;
    z-index: 2;
    color: var(--text);
    max-width: 620px;
    line-height: 1.8;
    font-size: 1.05rem;
    margin-bottom: 30px;
}

.hero-actions {
    position: relative;
    z-index: 2;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-radius: 14px;
    padding: 13px 18px;
    text-decoration: none;
    font-weight: 900;
    transition: 0.22s;
}

.btn:hover {
    transform: translateY(-3px);
}

.btn-primary {
    background: var(--blue);
    color: #ffffff;
}

.btn-light {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid var(--line);
}

/* CARD PERFIL */

.profile-panel {
    background: var(--soft-dark);
    color: #ffffff;
    border-radius: 30px;
    padding: 24px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
}

.photo-box {
    height: 330px;
    border-radius: 24px;
    overflow: hidden;
    background: #334155;
    margin-bottom: 20px;
}

.photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-panel h3 {
    font-size: 1.55rem;
    margin-bottom: 8px;
}

.profile-panel p {
    color: #cbd5e1;
    line-height: 1.6;
    font-size: 0.94rem;
}

.profile-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
}

.profile-tags span {
    background: rgba(255,255,255,0.10);
    color: #e2e8f0;
    border: 1px solid rgba(255,255,255,0.10);
    padding: 7px 10px;
    border-radius: 999px;
    font-size: 0.76rem;
    font-weight: 800;
}

/* CARDS DE ACESSO */

.quick-grid {
    margin-top: 26px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.quick-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 24px;
    padding: 24px;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 14px 32px rgba(15, 23, 42, 0.06);
    transition: 0.22s;
}

.quick-card:hover {
    transform: translateY(-5px);
    border-color: #bfdbfe;
}

.quick-icon {
    width: 48px;
    height: 48px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    font-size: 1.45rem;
    margin-bottom: 16px;
}

.quick-card:nth-child(1) .quick-icon {
    background: #dbeafe;
}

.quick-card:nth-child(2) .quick-icon {
    background: #dcfce7;
}

.quick-card:nth-child(3) .quick-icon {
    background: #ffedd5;
}

.quick-card h3 {
    margin-bottom: 8px;
    color: var(--dark);
}

.quick-card p {
    color: var(--muted);
    line-height: 1.6;
    font-size: 0.9rem;
}

/* RODAPÉ */

.page-footer {
    margin-top: 30px;
    text-align: center;
    color: var(--muted);
    font-size: 0.88rem;
}

/* RESPONSIVO */

@media(max-width: 1000px) {
    .app {
        grid-template-columns: 1fr;
    }

    .sidebar {
        position: relative;
    }

    .dashboard {
        grid-template-columns: 1fr;
    }

    .quick-grid {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 650px) {
    .content {
        padding: 22px;
    }

    .top-info {
        flex-direction: column;
        align-items: flex-start;
    }

    .hero-card {
        padding: 30px;
    }

    .photo-box {
        height: 270px;
    }
}
</style>
</head>

<body>

<div class="app">

    <aside class="sidebar">

        <div>
            <div class="brand">
                <div class="brand-icon">NH</div>

                <div>
                    <strong>Nicolas Henrique</strong>
                    <span>Portfólio DWII</span>
                </div>
            </div>

            <nav class="side-menu">
                <a href="index.php" class="active">🏠 Início</a>
                <a href="sobre.php">👤 Sobre</a>
                <a href="projetos.php">💡 Projetos</a>
                <a href="catalogo.php">📁 Catálogo</a>
                <a href="contato.php">📞 Contato</a>

                <?php if ($logado): ?>
                    <a href="04_sessoes/painel.php">🔐 Painel</a>
                    <a href="04_sessoes/logout.php" class="logout">🚪 Sair</a>
                <?php else: ?>
                    <a href="04_sessoes/login.php">🔑 Login</a>
                <?php endif; ?>
            </nav>
        </div>

        <div class="sidebar-footer">
            IFPR • Campus Ponta Grossa<br>
            Desenvolvimento Web II • <?= date('Y') ?>
        </div>

    </aside>

    <main class="content">

        <section class="top-info">
            <div>
                <h1>Dashboard do Portfólio</h1>
                <p><?= htmlspecialchars($projeto) ?></p>
            </div>

            <span class="status-pill">
                <?= $logado ? 'Sessão ativa' : 'Visitante' ?>
            </span>
        </section>

        <section class="dashboard">

            <article class="hero-card">

                <span class="badge">
                    <?= htmlspecialchars($curso) ?>
                </span>

                <h2>
                    Meu portfólio <br>
                    <span>web acadêmico</span>
                </h2>

                <p>
                    Página inicial do meu projeto de Desenvolvimento Web II.
                    Aqui estão reunidos meus estudos com PHP, banco de dados,
                    autenticação, sessões, CRUD, painel administrativo e organização
                    de sistemas web.
                </p>

                <div class="hero-actions">
                    <a href="projetos.php" class="btn btn-primary">
                        Ver projetos
                    </a>

                    <a href="catalogo.php" class="btn btn-light">
                        Abrir catálogo
                    </a>

                    <?php if ($logado): ?>
                        <a href="admin.php" class="btn btn-light">
                            Admin
                        </a>
                    <?php endif; ?>
                </div>

            </article>

            <aside class="profile-panel">

                <div class="photo-box">
                    <img src="<?= htmlspecialchars($foto) ?>"
                         alt="Foto de <?= htmlspecialchars($nome) ?>">
                </div>

                <h3><?= htmlspecialchars($nome) ?></h3>

                <p>
                    Estudante do <?= htmlspecialchars($curso) ?> no
                    <?= htmlspecialchars($instituto) ?>.
                </p>

                <div class="profile-tags">
                    <span>PHP</span>
                    <span>PDO</span>
                    <span>MariaDB</span>
                    <span>CRUD</span>
                    <span>Sessões</span>
                </div>

            </aside>

        </section>

        <section class="quick-grid">

            <a href="projetos.php" class="quick-card">
                <div class="quick-icon">💡</div>
                <h3>Projetos</h3>
                <p>Veja os projetos publicados no portfólio.</p>
            </a>

            <a href="sobre.php" class="quick-card">
                <div class="quick-icon">🎓</div>
                <h3>Formação</h3>
                <p><?= htmlspecialchars($curso) ?> — <?= htmlspecialchars($instituto) ?></p>
            </a>

            <a href="catalogo.php" class="quick-card">
                <div class="quick-icon">📚</div>
                <h3>Catálogo</h3>
                <p>Acesse conteúdos e registros conectados ao banco.</p>
            </a>

        </section>

        <footer class="page-footer">
            Nicolas Henrique • IFPR • <?= date('Y') ?>
        </footer>

    </main>

</div>

</body>
</html>