<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil do Aluno | Nicolas Henrique</title>

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

        :root{
            --primary:#2563eb;
            --primary-hover:#1d4ed8;
            --primary-light:#dbeafe;

            --bg:#f1f5f9;
            --white:#ffffff;

            --text:#0f172a;
            --text-light:#475569;

            --border:#cbd5e1;

            --radius:18px;

            --shadow:
                0 10px 25px rgba(0,0,0,0.08);
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter', sans-serif;
            background:linear-gradient(135deg,#e0f2fe,#f8fafc);
            color:var(--text);
            min-height:100vh;
        }

        /* NAVBAR */

        .main-nav{
            background:rgba(255,255,255,0.90);
            backdrop-filter:blur(10px);

            border-bottom:1px solid var(--border);

            position:sticky;
            top:0;

            z-index:1000;
        }

        .nav-container{
            max-width:1100px;
            margin:auto;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:18px 20px;
        }

        .nav-logo{
            text-decoration:none;
            color:var(--text);

            font-size:1.2rem;
            font-weight:800;

            display:flex;
            align-items:center;
            gap:10px;
        }

        .nav-logo i{
            color:var(--primary);
        }

        .nav-links{
            list-style:none;
            display:flex;
            gap:12px;
        }

        .nav-links a{
            text-decoration:none;
            color:var(--text-light);

            padding:10px 14px;
            border-radius:10px;

            font-weight:600;

            transition:0.3s;
        }

        .nav-links a:hover{
            background:var(--primary-light);
            color:var(--primary);
        }

        .nav-links .active{
            background:var(--primary);
            color:white;
        }

        /* CONTAINER */

        .container{
            max-width:900px;
            margin:50px auto;
            padding:20px;
        }

        /* CARD */

        .section-card{
            background:var(--white);

            border-radius:var(--radius);

            padding:40px;

            box-shadow:var(--shadow);

            animation:fadeUp 0.7s ease;
        }

        /* PERFIL */

        .perfil-header{
            text-align:center;
            margin-bottom:35px;
        }

        .foto-container{
            width:200px;
            height:200px;

            margin:0 auto 20px;

            border-radius:50%;
            overflow:hidden;

            border:5px solid var(--primary);

            box-shadow:
                0 12px 30px rgba(37,99,235,0.25);

            transition:0.3s;
        }

        .foto-container:hover{
            transform:scale(1.05);
        }

        .foto-container img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .perfil-header h1{
            font-size:2.5rem;
            margin-bottom:10px;
        }

        .info-aluno{
            display:inline-block;

            background:var(--primary-light);
            color:var(--primary-hover);

            padding:12px 18px;

            border-radius:999px;

            font-weight:700;
            font-size:0.95rem;
        }

        /* TEXTO */

        .apresentacao h2{
            margin-bottom:18px;
            color:var(--primary);

            display:flex;
            align-items:center;
            gap:10px;
        }

        .apresentacao p{
            margin-bottom:18px;

            line-height:1.8;

            color:var(--text-light);

            font-size:1.05rem;
        }

        .apresentacao strong{
            color:var(--text);
        }

        /* FOOTER */

        footer{
            text-align:center;

            padding:30px 20px;

            color:var(--text-light);

            font-size:0.9rem;
        }

        /* ANIMAÇÃO */

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(30px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* RESPONSIVO */

        @media(max-width:768px){

            .section-card{
                padding:25px;
            }

            .perfil-header h1{
                font-size:2rem;
            }

            .foto-container{
                width:150px;
                height:150px;
            }

            .nav-container{
                flex-direction:column;
                gap:15px;
            }

        }

    </style>

</head>

<body>

    <!-- NAVBAR -->
    <nav class="main-nav">

        <div class="nav-container">

            <a href="index.php" class="nav-logo">
                <i class="fa-solid fa-code"></i>
                NICOLAS
            </a>

            <ul class="nav-links">

                <li>
                    <a href="index.php">Hub</a>
                </li>

                <li>
                    <a href="sobre.php" class="active">Sobre</a>
                </li>

                <li>
                    <a href="contato.php">Contato</a>
                </li>

            </ul>

        </div>

    </nav>

    <!-- CONTEÚDO -->
    <main class="container">

        <section class="section-card">

            <div class="perfil-header">

                <div class="foto-container">

                    <!-- IMAGEM -->
                    <img src="includes/img/nicolas.jpg" alt="Foto de Nicolas Henrique">

                </div>

                <h1>Nicolas Henrique</h1>

                <div class="info-aluno">

                    <i class="fa-solid fa-graduation-cap"></i>

                    Informática • 3º Ano • IFPR

                </div>

            </div>

            <article class="apresentacao">

                <h2>
                    <i class="fa-solid fa-user"></i>
                    Sobre Mim
                </h2>

                <p>
                    Olá! Meu nome é <strong>Nicolas Henrique</strong>,
                    tenho <strong>17 anos</strong> e atualmente estudo no
                    curso Técnico em Informática do
                    <strong>IFPR - Campus Ponta Grossa</strong>.
                </p>

                <p>
                    Sou apaixonado por tecnologia e gosto bastante
                    da área de desenvolvimento web,
                    design de interfaces e programação.
                </p>

                <p>
                    Este projeto foi desenvolvido como atividade da disciplina
                    de <strong>Desenvolvimento Web II</strong>,
                    utilizando HTML, CSS, PHP e banco de dados.
                </p>

            </article>

        </section>

    </main>

    <!-- RODAPÉ -->
    <footer>

        <p>
            <strong>Nicolas Henrique</strong> © 2026
        </p>

        <p>
            IFPR - Campus Ponta Grossa
        </p>

    </footer>

</body>
</html>