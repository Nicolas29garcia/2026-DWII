<?php

/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo    : includes/auth.php
 * Autor      : Nicolas Henrique
 * Descrição  : Funções auxiliares para autenticação e proteção
 *               de páginas privadas do sistema.
 * ============================================================
 */

// ------------------------------------------------------------
// Inicializa a sessão apenas se ainda não existir
// ------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * ------------------------------------------------------------
 * Verifica se existe um usuário autenticado
 * ------------------------------------------------------------
 * @return bool
 */
function usuario_logado(): bool
{
    return isset($_SESSION['usuario'])
        && $_SESSION['usuario'] !== '';
}

/**
 * ------------------------------------------------------------
 * Retorna o nome do usuário autenticado
 * ------------------------------------------------------------
 * @return string|null
 */
function usuario_atual(): ?string
{
    return $_SESSION['usuario'] ?? null;
}

/**
 * ------------------------------------------------------------
 * Protege páginas privadas
 * ------------------------------------------------------------
 * Caso o usuário não esteja logado,
 * redireciona automaticamente para login.php
 *
 * IMPORTANTE:
 * Esta função deve ser chamada ANTES de qualquer HTML.
 * ------------------------------------------------------------
 */
function requer_login(): void
{
    if (!usuario_logado()) {

        header(
            'Location: /02_projetoPHP-02_refatorado/04_sessoes/login.php'
        );

        exit;
    }
}