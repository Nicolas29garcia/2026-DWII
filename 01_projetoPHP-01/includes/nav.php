<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo_pagina ?? 'Sistema Acadêmico') ?></title>

```
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --dark: #0f172a;
        --text: #64748b;
        --border: #e2e8f0;
        --bg: #f8fafc;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--bg);
        padding-top: 70px;
        color: var(--dark);
    }

    /* NAVBAR */
    header {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .main-nav {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--border);
        height: 65px;
        display: flex;
        align-items: center;
    }

    .nav-container {
        max-width: 1100px;
        margin: 0 auto;
        width: 100%;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-logo {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--dark);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-logo i {
        color: var(--primary);
        font-size: 1rem;
    }

    .nav-links {
        display: flex;
        gap: 10px;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 8px;
        transition: 0.2s ease;
    }

    .nav-links a:hover {
        color: var(--primary);
        background: #ecfdf5;
    }

    .nav-links a.active {
        color: var(--primary);
        background: #d1fae5;
    }

    /* CONTAINER */
    .container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
        min-height: calc(100vh - 120px);
    }

    /* RESPONSIVO */
    @media (max-width: 768px) {
        .nav-links {
            gap: 5px;
        }

        .nav-links a {
            padding: 6px 8px;
            font-size: 0.8rem;
        }
    }
</style>
```

</head>
<body>

<header>
    <nav class="main-nav">
        <div class="nav-container">

```
        <!-- Logo -->
        <a href="<?= $caminho_raiz ?>index.php" class="nav-logo">
            <i class="fa-solid fa-code"></i>
            <?= htmlspecialchars($nome_dev ?? 'NICOLAS') ?>
        </a>

        <!-- Menu -->
        <ul class="nav-links">
            <li>
                <a href="<?= $caminho_raiz ?>index.php"
                   class="<?= ($pagina_atual ?? '') === 'home' ? 'active' : '' ?>">
                    Hub
                </a>
            </li>

            <li>
                <a href="<?= $caminho_raiz ?>00_apresentacao/index.html">
                    Bio
                </a>
            </li>

            <li>
                <a href="<?= $caminho_raiz ?>../02_formularios/contato.php"
                   class="<?= ($pagina_atual ?? '') === 'contato' ? 'active' : '' ?>">
                    Contato
                </a>
            </li>

            <li>
                <a href="<?= $caminho_raiz ?>04_sessoes/login.php"
                   class="<?= ($pagina_atual ?? '') === 'login' ? 'active' : '' ?>">
                    Acesso
                </a>
            </li>
        </ul>

    </div>
</nav>
```

</header>

<main class="container">
    <?= $conteudo ?? '' ?>
</main>

</body>
</html>
