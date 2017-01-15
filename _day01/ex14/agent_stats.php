#!/usr/bin/php
<?php

    if ($argc == 2) {
        $file = file_get_contents("php://stdin");
        $list = explode("\n", $file);

        $key = array("User", "Note", "Noteur", "Feedback");
        $test = explode(";", $list[0]);
        if (sizeof($test) == 4) {
            for ($i = 0; $i < 4; $i++) {
                if ($test[$i] != $key[$i])
                    return;
            }
        }
        array_shift($list);
        if ($list[sizeof($list) - 1] == "")
            array_pop($list);

        sort($list);
        foreach($list as &$value) {
            list($user[], $note[], $noteur[], $feedback[]) = explode(";", $value);
            if (end($note) == "" && end($feedback) == "") {
                array_pop($user);
                array_pop($note);
                array_pop($noteur);
                array_pop($feedback);
            }
        }

        if ($argv[1] == "moyenne") {
            $result = 0.0;
            $size = 0;
            for ($i = 0; $i < sizeof($note); $i++) {
                if ($noteur[$i] != "moulinette") {
                    $result += floatval($note[$i]);
                    $size++;
                }
            }
            $result /= $size;
            echo("$result\n");
        }
        elseif ($argv[1] == "moyenne_user") {
            for ($i = 0; $i < sizeof($user); $i++) {
                $size = 0;
                $tmp = 0.0;
                $name = $user[$i];
                while ($user[$i] == $name) {
                    $tmp += floatval($note[$i]);
                    $size++;
                    $i++;
                }
                $result[$user[$i-1]] = $tmp / $size;
            }
            echo(key($result));
            foreach ($result as &$value) {
                echo(":$value\n");
                echo(key($result));
            }
        }
        elseif ($argv[1] == "ecart_moulinette") {
            for ($i = 0; $i < sizeof($user); $i++) {
                $size = 0;
                $tmp = 0.0;
                $name = $user[$i];
                while ($user[$i] == $name) {
                    if ($noteur[$i] == "moulinette") {
                        $moulinette[$user[$i]] = floatval($note[$i]);
                    }
                    else {
                        $tmp += floatval($note[$i]);
                        $size++;
                    }
                    $i++;
                }
                $result[$user[$i-1]] = $tmp / $size;
            }
            $key = key($result);
            echo($key);
            foreach ($result as &$value) {
                $ret = $moulinette[$key];
                $ret = $value - $ret;
                echo(":$ret\n");
                $key = key($result);
                echo($key);
            }
        }
        else
            return;
    }
?>