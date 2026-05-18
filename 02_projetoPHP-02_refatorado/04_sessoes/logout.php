<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo    : logout.php
 * Autor      : Nicolas Henrique
 * Descrição  : Encerra a sessão do usuário com segurança.
 * ============================================================
 */

require_once __DIR__ . '/includes/auth.php';

// Garante que a sessão esteja iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Remove todos os dados salvos na sessão
$_SESSION = [];

// Remove o cookie da sessão no navegador
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destrói a sessão no servidor
session_destroy();

// Redireciona para a página inicial
header('Location: /02_projetoPHP-02_refatorado/index.php');
exit;