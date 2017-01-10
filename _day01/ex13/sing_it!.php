#!/usr/bin/php
<?php
    $sing = array("Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo\n" => "mais pourquoi cette demo ?", "Parce que Kwame a des enfants\n" => "mais pourquoi cette chanson ?", "Nan c'est parce que c'est le premier avril\n|Oui il a vraiment des enfants\n" => "vraiment ?");

    if ($argc == 2) {
        $key = $argv[1];
        $needle = array_search($key, $sing);
        if ($needle != false) {
            $arr = explode("|", $needle);
            if (sizeof($arr) == 1)
                $i = 0;
            else
                $i = rand(0, 1);
            echo("$arr[$i]");
        }
    }
?>