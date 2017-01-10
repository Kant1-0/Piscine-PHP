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

    function ft_split($string) {
        $delimiters = array("\t", " ", "\n", "\r", "\0", "\x0B");
        $process = str_replace($delimiters, "\t\t", $string);
        $process = _is_trim($process);
        $array = explode(" ", $process);
        return $array;
    }

    function get_sort_val($c) {
        $tab = "abcdefghijklmnopqrstuvwxyz0123456789 !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
        $size = strlen($tab);
        for ($i = 0; $i < $size; $i++) {
            if ($c == $tab[$i])
                return ($i);
        }
        return (0);
    }

    function ascii_sort($str1, $str2) {
        $size1 = strlen($str1);
        $size2 = strlen($str2);
        $str1 = strtolower($str1);
        $str2 = strtolower($str2);
        for($i = 0; $i < $size1; $i++) {
            $val1 = get_sort_val($str1[$i]);
            $val2 = get_sort_val($str2[$i]);
            if ($val1 != $val2)
                return ($val1 - $val2);
        }
        return(0);
    }
    
    if ($argc > 1) {
        $list = implode(' ', $argv);
        $arr = ft_split($list);
        array_shift($arr);
        //sort($arr, SORT_FLAG_CASE | SORT_STRING);
        usort($arr, 'ascii_sort');
        foreach($arr as &$value) {
            echo("$value\n");
        }
    }
?>