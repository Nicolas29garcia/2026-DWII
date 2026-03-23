<?php
/**
 * ARQUIVO: index.php (RAIZ DO REPOSITÓRIO)
 * Versão Final: Nicolas - System Hub 2026
 * Correção: Links exatos para arquivos específicos (contato.php, login.php, etc.)
 */

// 1. Resolve o caminho base para evitar erros de 404 e pastas repetidas
$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

$usuario = "Nicolas";
$projeto = "Desenvolvimento Web II // 2026";

// 2. MAPA DE ARQUIVOS (Certifique-se que os nomes batem com suas pastas)
$modulos = [
    [
        "id" => "00", 
        "titulo" => "Apresentação Pessoal", 
        "tag" => "HTML/CSS", 
        "arquivo" => "00_apresentacao/index.html"
    ],
    [
        "id" => "01", 
        "titulo" => "Portfólio Dinâmico", 
        "tag" => "PHP Intro", 
        "arquivo" => "01_php-intro/index.php"
    ],
    [
        "id" => "04", 
        "titulo" => "Formulários e Filtros", 
        "tag" => "Segurança", 
        "arquivo" => "02_formularios/contato.php" // CORRIGIDO: de index para contato
    ],
    [
        "id" => "05", 
        "titulo" => "Integração com Banco", 
        "tag" => "Database", 
        "arquivo" => "03_pdo/index.php"
    ],
    [
        "id" => "06", 
        "titulo" => "Gestão de Sessões", 
        "tag" => "Auth", 
        "arquivo" => "04_sessoes/login.php" // CORRIGIDO: apontando para o login
    ],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hub // <?= $usuario ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --bg: #f1f5f9;
            --text: #0f172a;
            --border: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            padding: 40px 20px;
        }

        .wrapper { max-width: 600px; margin: 0 auto; }

        header {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border);
        }

        header h1 { font-size: 2.2rem; font-weight: 800; letter-spacing: -1px; }
        header p { color: #64748b; font-weight: 500; }

        .lista { display: grid; gap: 15px; }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
        }

        .card:hover {
            border-color: var(--primary);
            transform: translateX(8px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-size: 0.65rem;
            font-weight: 800;
            background: #ecfdf5;
            color: var(--primary);
            padding: 4px 8px;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .card h3 { margin: 5px 0; font-size: 1.1rem; }
        .tag { font-size: 0.8rem; color: #94a3b8; font-family: monospace; }

        .seta { font-weight: bold; color: var(--primary); opacity: 0; transition: 0.2s; }
        .card:hover .seta { opacity: 1; }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.8rem;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <header>
            <h1><?= $usuario ?></h1>
            <p><?= $projeto ?></p>
        </header>

        <nav class="lista">
            <?php foreach ($modulos as $m): ?>
            <a href="<?= $base_url . $m['arquivo'] ?>" class="card">
                <div>
                    <span class="badge">Aula <?= $m['id'] ?></span>
                    <h3><?= htmlspecialchars($m['titulo']) ?></h3>
                    <span class="tag">#<?= $m['tag'] ?></span>
                </div>
                <div class="seta">ABRIR →</div>
            </a>
            <?php endforeach; ?>
        </nav>

        <footer>
            IFPR - Campus Ponta Grossa | <?= date("Y") ?>
        </footer>
    </div>

</body>
</html>