#!/usr/bin/php
<?php
    date_default_timezone_set("Europe/Paris");

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

    function array_is_digital(&$array) {
        $i = 0;
        foreach ($array as &$value) {
            if ($i == 0) {
                if (!is_numeric($value) || ($value = intval($value)) >= 24 || $value < 0 || !is_int($value))
                    return false;
            }
            else {
                if (!is_numeric($value) || ($value = intval($value)) >= 60 || $value < 0 || !is_int($value))
                    return false;
            }
            $i++;
        }
        return true;
    }

    function return_wrong() {
        echo ("Wrong Format\n");
    }

    $key_week = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
    $key_month = array(01 => "janvier", 02 => "fevrier", 03 => "mars", 04 => "avril", 05 => "mai", 06 => "juin", 07 => "juillet", 08 => "aout", 09 => "septembre", 10 => "octbre", 11 => "novembre", 12 => "decembre");
    $key_daylimit = array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 31, 10 => 31, 11 => 30, 12 => 31);

    if ($argc == 2) {
        $arr = ft_split($argv[1]);
        if (sizeof($arr) == 5) {

            if (array_search(strtolower($arr[0]), $key_week) === false)
                return return_wrong();

            if (!is_numeric($arr[1]) || ($day = intval($arr[1])) > 31 || $day <= 0 || !is_int($day))
                return return_wrong();

            if (($month = array_search(strtolower($arr[2]), $key_month)) === false)
                return return_wrong();
            
            if (!is_numeric($arr[3]) || ($year = intval($arr[3])) < 1970 || !is_int($year))
                return return_wrong();

            //bisextile check
            if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {
                $key_daylimit[2] = 29;
            }
            if ($day > $key_daylimit[$month])
                return return_wrong();
            
            $hour = explode(":", $arr[4]);
            if (!sizeof($hour) == 3 && !array_is_digital($hour))
                return return_wrong();

            $arrstamp = array($year, $month, $day);
            $strstamp = implode('-', $arrstamp);
            $arrstamp = array($strstamp, $arr[4]);
            $strstamp = implode(' ', $arrstamp);
            if (!($time = strtotime($strstamp)))
                return return_wrong();

            echo("$time\n");
        }
        else
            return return_wrong();
    }
    if ($argc > 2)
        return return_wrong();
?>