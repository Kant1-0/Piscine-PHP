#!/usr/bin/php
<?php
    include("ft_split.php");

    $fd = fopen("php://stdin", "r");

    while (true) {
        echo "Entrez une string: ";
        $line = fgets($fd);
        print_r(ft_split($line));
    }
?>