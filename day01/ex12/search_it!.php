#!/usr/bin/php
<?php    
    if ($argc > 2) {
        for($i = ($argc - 1); $i != 0; $i--) {
            if ($i == 1)
                $key = $argv[$i];
            else {
                $tmp = explode(":", $argv[$i]);
                if (sizeof($tmp) != 2)
                    return;
                $arr[$tmp[1]] = $tmp[0];
            }
        }
        $needle = array_search($key, $arr);
        if ($needle != false)
            echo("$needle\n");
    }
?>