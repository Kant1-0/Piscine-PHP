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

    function split_op($string) {
        $op = array("+", "-", "*", "/", "%");
        $_op_ = array(" + ", " - ", " * ", " / ", " % ");
        $string = str_replace($op, $_op_, $string);

        $delimiters = array("\t", " ", "\n", "\r", "\0", "\x0B");
        $process = str_replace($delimiters, "\t\t", $string);
        $process = _is_trim($process);
        $array = explode(" ", $process);
        return $array;
    }

    function return_wrong_param() {
        echo ("Incorrect Parameters\n");
    }

    function return_wrong_syntax() {
        echo ("Syntax Error\n");
    }

    if ($argc == 2) {
        $arr = split_op($argv[1]);

        if (sizeof($arr) != 3)
            return return_wrong_syntax();
        if (!is_numeric($arr[0]) || !is_numeric($arr[2]))
            return return_wrong_syntax();
        
        $arr[0] = floatval($arr[0]);
        $arr[2] = floatval($arr[2]);

        if ($arr[1] == '+')
            $result = $arr[0] + $arr[2];
        elseif ($arr[1] == '-')
            $result = $arr[0] - $arr[2];
        elseif ($arr[1] == '*')
            $result = $arr[0] * $arr[2];
        elseif ($arr[1] == '/' && $arr[2] != '0')
            $result = $arr[0] / $arr[2];
        elseif ($arr[1] == '%')
            $result = $arr[0] % $arr[2];
        else
            return return_wrong_syntax();

        echo("$result\n");
    }
    else
        return return_wrong_param();
?>