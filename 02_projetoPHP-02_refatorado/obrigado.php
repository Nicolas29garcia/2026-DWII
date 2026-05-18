<?php
/**
 * ============================================================
 * Arquivo    : obrigado.php
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal
 * Autor      : Nicolas Henrique
 * Descrição  : Página de confirmação do formulário de contato.
 * ============================================================
 */

// Variáveis do template
$nome = "Nicolas Henrique";
$pagina_atual = "contato";
$caminho_raiz = "./";
$titulo_pagina = "Mensagem Enviada - {$nome}";

// Recebimento dos dados via GET
$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'Visitante');
$assunto = htmlspecialchars($_GET['assunto'] ?? 'Contato Geral');

// Cabeçalho
include __DIR__ . '/includes/cabecalho.php';
?>

<main>

    <section class="card" style="
        max-width: 700px;
        margin: 40px auto;
        padding: 3rem 2rem;
        text-align: center;
        border-radius: 20px;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    ">

        <!-- Ícone -->
        <div style="
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #22c55e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 12px rgba(34,197,94,0.4);
        ">
            ✓
        </div>

        <!-- Título -->
        <h1 style="
            font-size: 2.3rem;
            margin-bottom: 10px;
            color: #f8fafc;
        ">
            Obrigado, <?php echo $nome_visitante; ?>!
        </h1>

        <!-- Assunto -->
        <p style="
            margin-bottom: 20px;
            color: #cbd5e1;
            font-size: 1rem;
        ">
            Assunto enviado:
            <strong style="color: #38bdf8;">
                <?php echo $assunto; ?>
            </strong>
        </p>

        <!-- Mensagem -->
        <p style="
            font-size: 1.1rem;
            line-height: 1.6;
            color: #e2e8f0;
            margin-bottom: 35px;
        ">
            Sua mensagem foi enviada com sucesso.
            Em breve retornarei o contato pelo e-mail informado.
        </p>

        <!-- Botões -->
        <div style="
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        ">

            <a href="index.php" style="
                text-decoration: none;
                padding: 12px 22px;
                border-radius: 10px;
                background: #38bdf8;
                color: white;
                font-weight: bold;
                transition: 0.3s;
            ">
                Voltar ao Início
            </a>

            <a href="contato.php" style="
                text-decoration: none;
                padding: 12px 22px;
                border-radius: 10px;
                background: #1e293b;
                border: 1px solid #38bdf8;
                color: #38bdf8;
                font-weight: bold;
                transition: 0.3s;
            ">
                Enviar Nova Mensagem
            </a>

        </div>

    </section>

</main>

<?php include __DIR__ . '/includes/rodape.php'; ?>