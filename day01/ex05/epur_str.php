#!/usr/bin/php
<?php
    function _is_trim($string) {
        $tmp = strstr($string, "\t");
        $start = strpos($string, "\t");
        $len = strspn($tmp, "\t");
        if ($len > 1) {
            $string = substr_replace($string, " ", $start, $len);
            $string = _is_trim($string);
        }
        $string = str_replace("\t", " ", $string);
        $string = trim($string);
        return $string;
    }

    function epur_str($string) {
        $delimiters = array("\t", " ", "\n", "\r", "\0", "\x0B");
        $process = str_replace($delimiters, "\t\t", $string);
        $process = _is_trim($process);
        return $process;
    }

    if ($argc == 2) {
        $newline = epur_str($argv[1]);
        echo("$newline\n");
    }
?>