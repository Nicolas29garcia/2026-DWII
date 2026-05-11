<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : includes/conexao.php
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Conexão PDO única do projeto.
 *              Resolve P5 (dois bancos) e P6 (dois conexao.php).
 * ============================================================
 */

/**
 * conectar() — cria e devolve uma instância PDO conectada
 * ao banco 'portfolio'.
 */
function conectar(): PDO
{
    // 127.0.0.1 força TCP (melhor para Codespaces)
    $dsn = "mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4";

    $usuario = "root";
    $senha   = "dwii2026"; // senha padrão

    try {
        return new PDO($dsn, $usuario, $senha, [

            // Erros viram exceção (facilita debug)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // Retorna array associativo
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            // Prepared statements reais (mais seguro)
            PDO::ATTR_EMULATE_PREPARES => false,

        ]);
    } catch (PDOException $e) {

        // Em produção não mostrar detalhes
        die("Erro de conexão com o banco de dados.");
    }
}