#!/usr/bin/php
<?php
    function return_wrong() {
        echo ("Incorrect Parameters\n");
    }

    if ($argc == 4) { 
        $num1 = floatval(trim($argv[1]));
        $op = trim($argv[2]);
        $num2 = floatval(trim($argv[3]));

        if ($op == '+')
            $result = $num1 + $num2;
        elseif ($op == '-')
            $result = $num1 - $num2;
        elseif ($op == '*')
            $result = $num1 * $num2;
        elseif ($op == '/' && $num2 != '0')
            $result = $num1 / $num2;
        elseif ($op == '%')
            $result = $num1 % $num2;
        else
            return;

        if ($op == '/' && $num2 == '0')
            return return_wrong();

        echo("$result\n");
    }
    else
        return return_wrong();
?>