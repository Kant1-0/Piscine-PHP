#!/usr/bin/php
<?php
    $fd = fopen("php://stdin", "r");

    while (true) {
        echo "Entrez un nombre: ";
        $line = fgets($fd);
        if ($line == null) {
            echo "\n";
            exit();
        }
        $line = rtrim($line);
        if (!is_numeric($line)) {
            var_export($line);
            echo " n'est pas un chiffre\n";
        }
        else {
            $nb = intval($line);
            if ($nb % 2 == 0) {
                echo "Le chiffre ";
                var_export($nb);
                echo " est Pair\n";
            }
            else {
                echo "Le chiffre ";
                var_export($nb);
                echo " est Impair\n";
            }
        }
    }
?>