<?php
// Define o nome do autor caso não venha da página principal
$autor = isset($nome_dev) ? htmlspecialchars($nome_dev) : "Nicolas Henrique";
?>

    </main> <footer>
        <div class="container">
            <div class="footer-content">
                <p>
                    <strong><?= $autor; ?></strong> &copy; <?= date("Y"); ?> 
                    <span class="separator">|</span> 
                    Desenvolvido com <i class="fa-brands fa-php" style="color: #777bb4;"></i>
                </p>
                <p>
                    <i class="fa-solid fa-location-dot"></i> <strong>IFPR</strong> – Campus Ponta Grossa
                </p>
                
                <div class="footer-bottom" style="margin-top: 15px; opacity: 0.7;">
                    <small>Desenvolvimento Web II - Nicolas H.</small>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>