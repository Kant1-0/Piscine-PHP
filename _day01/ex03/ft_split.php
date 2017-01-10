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

    function ft_split($string) {
        $delimiters = array("\t", " ", "\n", "\r", "\0", "\x0B");
        $process = str_replace($delimiters, "\t\t", $string);
        $process = _is_trim($process);
        $array = explode(" ", $process);
        return $array;
    }
?>