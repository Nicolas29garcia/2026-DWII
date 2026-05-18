<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Central de Projetos Web
 * Arquivo    : index.php
 * Autor      : Nicolas Henrique
 * Descrição  : Página inicial com acesso aos módulos do projeto.
 * ============================================================
 */

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// ── Dados principais ───────────────────────────────────────
$usuario = "Nicolas Henrique";

$projeto = "Desenvolvimento Web II • 2026";

// ── Módulos do sistema ─────────────────────────────────────
$modulos = [

    [
        "id" => "01",
        "titulo" => "Sobre Mim",
        "tag" => "PHP",
        "arquivo" => "./sobre.php"
    ],

    [
        "id" => "02",
        "titulo" => "Contato",
        "tag" => "Formulários",
        "arquivo" => "./contato.php"
    ],

    [
        "id" => "03",
        "titulo" => "Catálogo PDO",
        "tag" => "Banco de Dados",
        "arquivo" => "./catalogo.php"
    ],

    [
        "id" => "04",
        "titulo" => "Sistema Login",
        "tag" => "Sessões",
        "arquivo" => "./04_sessoes/login.php"
    ],

    // ── CRUD protegido por login ─────────────────────────
    [
        "id" => "05",
        "titulo" => "CRUD Projetos",
        "tag" => "CRUD",
        "arquivo" => "./04_sessoes/login.php"
    ]

];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Hub - <?= htmlspecialchars($usuario) ?>
</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap"
      rel="stylesheet">

<style>

:root{
    --primary:#2563eb;
    --secondary:#0ea5e9;
    --bg:#f1f5f9;
    --dark:#0f172a;
    --border:#cbd5e1;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:'Inter', sans-serif;

    background:
    linear-gradient(
        135deg,
        #e0f2fe,
        #f8fafc
    );

    min-height:100vh;

    padding:50px 20px;

    color:var(--dark);
}

.wrapper{

    max-width:760px;

    margin:auto;
}

/* ───────────────────────────────────────────────────────
   Cabeçalho
─────────────────────────────────────────────────────── */

header{

    text-align:center;

    margin-bottom:45px;
}

header h1{

    font-size:3rem;

    font-weight:800;

    margin-bottom:10px;

    color:#0f172a;
}

header p{

    color:#475569;

    font-size:1.05rem;
}

/* ───────────────────────────────────────────────────────
   Lista módulos
─────────────────────────────────────────────────────── */

.lista{

    display:grid;

    gap:18px;
}

/* ───────────────────────────────────────────────────────
   Card módulo
─────────────────────────────────────────────────────── */

.card{

    background:white;

    border:1px solid var(--border);

    border-radius:20px;

    padding:24px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    text-decoration:none;

    color:inherit;

    transition:0.3s;

    box-shadow:
    0 5px 15px rgba(0,0,0,0.05);
}

.card:hover{

    transform:translateY(-5px);

    border-color:var(--primary);

    box-shadow:
    0 12px 25px rgba(37,99,235,0.15);
}

/* ───────────────────────────────────────────────────────
   Badge aula
─────────────────────────────────────────────────────── */

.badge{

    display:inline-block;

    background:#dbeafe;

    color:var(--primary);

    padding:5px 10px;

    border-radius:8px;

    font-size:0.72rem;

    font-weight:700;

    margin-bottom:10px;
}

/* ───────────────────────────────────────────────────────
   Título módulo
─────────────────────────────────────────────────────── */

.card h3{

    font-size:1.25rem;

    margin-bottom:6px;
}

/* ───────────────────────────────────────────────────────
   Tag módulo
─────────────────────────────────────────────────────── */

.tag{

    color:#64748b;

    font-size:0.9rem;
}

/* ───────────────────────────────────────────────────────
   Texto acessar
─────────────────────────────────────────────────────── */

.seta{

    color:var(--primary);

    font-size:1rem;

    font-weight:bold;

    transition:0.3s;
}

.card:hover .seta{

    transform:translateX(5px);
}

/* ───────────────────────────────────────────────────────
   Rodapé
─────────────────────────────────────────────────────── */

footer{

    text-align:center;

    margin-top:50px;

    color:#64748b;

    font-size:0.9rem;
}

/* ───────────────────────────────────────────────────────
   Responsivo
─────────────────────────────────────────────────────── */

@media(max-width:768px){

    header h1{

        font-size:2.2rem;
    }

    .card{

        flex-direction:column;

        align-items:flex-start;

        gap:15px;
    }
}

</style>

</head>

<body>

<div class="wrapper">

    <!-- ── Cabeçalho ─────────────────────────────────── -->

    <header>

        <h1>
            <?= htmlspecialchars($usuario) ?>
        </h1>

        <p>
            <?= htmlspecialchars($projeto) ?>
        </p>

    </header>

    <!-- ── Lista módulos ─────────────────────────────── -->

    <nav class="lista">

        <?php foreach($modulos as $m): ?>

            <a href="<?= $m['arquivo'] ?>"
               class="card">

                <div>

                    <span class="badge">

                        Aula <?= $m['id'] ?>

                    </span>

                    <h3>

                        <?= htmlspecialchars($m['titulo']) ?>

                    </h3>

                    <span class="tag">

                        #<?= htmlspecialchars($m['tag']) ?>

                    </span>

                </div>

                <div class="seta">

                    ACESSAR →

                </div>

            </a>

        <?php endforeach; ?>

    </nav>

    <!-- ── Rodapé ────────────────────────────────────── -->

    <footer>

        IFPR • Campus Ponta Grossa • <?= date("Y") ?>

    </footer>

</div>

</body>
</html>