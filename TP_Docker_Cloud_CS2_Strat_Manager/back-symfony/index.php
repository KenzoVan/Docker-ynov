<?php
// API CS2 Strat & Exec Book Manager (Symfony Backend)
declare(strict_types=1);

if (function_exists('pcntl_signal')) {
    pcntl_signal(SIGTERM, function () {
        echo "[Symfony] Signal SIGTERM reçu. Fermeture propre du backend API...
";
        exit(0);
    });
}

echo "[Symfony] API CS2 Strat Manager démarrée sur le port 8000...
";

while (true) {
    if (function_exists('pcntl_signal_dispatch')) {
        pcntl_signal_dispatch();
    }
    sleep(1);
}
