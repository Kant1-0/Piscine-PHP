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

    $start = 1970;
    $first_bisextile = 1972; // +1 day = 86400 sec for each bisextile year between 1972 and given year;
    $key_second = array(3600 => 0, 60 => 1);
    $key_day = 86400;
    $key_week = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
    $key_month = array(0 => "janvier", 2678400 => "février", 5097600 => "mars", 7776000 => "avril", 10368000 => "mai", 13046400 => "juin", 15638400 => "juillet", 18316800 => "aout", 20995200 => "septembre", 23587200 => "octbre", 26265600 => "novembre", 28857600 => "decembre");
    $key_year = 31536000;

    if ($argc > 1) {
        $arr = ft_split($argv[1]);
        print_r($arr);
        if (sizeof($arr) == 5) {

            if (array_search(strtolower($arr[0]), $key_week) === false)
                return return_wrong();

            if (is_numeric($arr[1]) && ($day = intval($arr[1])) <= 31 && $day >= 1 && is_int($day)) {
                $day = $key_day * $day;
                var_dump($day);
            }
            else
                return return_wrong();
            
            $month = array_search(strtolower($arr[2]), $key_month);
            var_dump($month);
            if ($month === false)
                return return_wrong();
            
            if (is_numeric($arr[3]) && ($year = intval($arr[3])) >= 1970 && is_int($year)) {
                $bisextile = ($year - $first_bisextile) / 4;
                $bisextile = intval($bisextile);
                var_dump($bisextile);

                $year -= $start;
                $year *= $key_year;
                $year += ($bisextile * $key_day);
                var_dump($year);
            }
            else
                return return_wrong();
            
            $hour = explode(":", $arr[4]);
            if (sizeof($hour) == 3 && array_is_digital($hour) == true) {
                var_dump($hour);
                $second = $hour[0] * $key_second[0] + $hour[1] * $key_second[1] + $hour[2];
                var_dump($second);
            }
            else
                return return_wrong();

            $time = $year + $month + $day + $sec;
            echo("\n$time\n");
                
        }
        else
            return return_wrong();
    }
?>