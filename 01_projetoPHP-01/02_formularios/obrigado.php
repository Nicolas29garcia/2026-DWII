<?php
/**
 * -------------------------------------------------------------
 * ARQUIVO : 02_formularios/obrigado.php
 * Versão : Nicolas - Confirmação de Protocolo
 * Conceitos : Extração de GET, Fallback de segurança, UI Moderna
 * -------------------------------------------------------------
 */

// — CONFIGURAÇÕES DE AMBIENTE
$nome_dev = "Nicolas";
$titulo_pagina = "Mensagem Recebida!";
$caminho_raiz = "../";

// Captura o nome com fallback para 'Visitante'
// Nota: 'user' é o parâmetro que definimos no redirecionamento do contato.php
$usuario_msg = htmlspecialchars($_GET['user'] ?? 'Visitante');
$status = $_GET['status'] ?? '';

?>

<?php include '../includes/cabecalho.php'; ?>

<style>
    .success-wrapper {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
    }

    .success-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 40px;
        max-width: 450px;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .icon-circle {
        width: 64px;
        height: 64px;
        background: #ecfdf5;
        color: #10b981;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 20px;
    }

    .success-card h2 { color: #1e293b; margin-bottom: 10px; font-weight: 700; }
    .success-card p { color: #64748b; margin-bottom: 30px; line-height: 1.6; }

    .actions { display: flex; flex-direction: column; gap: 10px; }

    .btn-primary {
        background: #10b981; color: white; text-decoration: none;
        padding: 12px; border-radius: 8px; font-weight: 600;
        transition: background 0.2s;
    }
    .btn-primary:hover { background: #059669; }

    .btn-secondary {
        background: transparent; color: #64748b; text-decoration: none;
        padding: 12px; border-radius: 8px; font-size: 0.9rem;
        border: 1px solid #e2e8f0; transition: all 0.2s;
    }
    .btn-secondary:hover { background: #f8fafc; color: #1e293b; }
</style>

<div class="success-wrapper">
    <div class="success-card">
        <div class="icon-circle">✓</div>
        
        <h2>Tudo certo, <?= $usuario_msg ?>!</h2>
        
        <p>
            Sua mensagem foi protocolada com sucesso em nosso sistema. 
            Vou analisar os dados e retorno em breve no seu e-mail.
        </p>

        <div class="actions">
            <a href="../index.php" class="btn-primary">Voltar ao Painel Principal</a>
            <a href="contato.php" class="btn-secondary">Enviar outra mensagem</a>
        </div>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>