<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : System Hub — versão moderna
 * Arquivo    : includes/rodape.php
 * Autor      : Nicolas
 * Data       : [DATA DE HOJE]
 * Descrição  : Rodapé global do sistema.
 *              Responsabilidades:
 *              1. Fechar a <main> aberta no layout
 *              2. Exibir informações do autor
 *              3. Exibir ano atual dinamicamente
 *              4. Padronizar o final de todas as páginas
 *
 * Variáveis esperadas:
 *   $nome_dev → nome do desenvolvedor (opcional)
 * ════════════════════════════════════════════════════════════
 */

// ── Fallback defensivo ───────────────────────────────────────
// Caso $nome_dev não exista, usamos "Nicolas" como padrão
$autor = $nome_dev ?? 'Nicolas';
?>

<!-- ── Fechamento do conteúdo principal ─────────────────── -->
</main>

<!-- ── Rodapé ───────────────────────────────────────────── -->
<footer>

    <?php
    /*
     * date('Y') gera o ano atual automaticamente.
     * Evita precisar atualizar manualmente todo ano.
     */
    ?>
    <p>
        &copy; <?= date('Y') ?> 
        - Desenvolvido por <?= htmlspecialchars($autor) ?>
    </p>

    <p>
        <strong>IFPR</strong> Ponta Grossa
    </p>

</footer>

<!-- ── Encerramento do HTML ─────────────────────────────── -->
</body>
</html>