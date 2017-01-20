<?php

    function check_new_mdp($login, $passwd, $newwp, $data, $file) {
        foreach ($data as &$account) {
            if ($account["login"] === $login && $account["passwd"] === $passwd) {
                $account["passwd"] = $newwp;
                $data = serialize($data);
                file_put_contents($file, $data);
                echo "OK\n";
                return true;
            }
        }
        return false;
    }

    if ($_POST["login"] != "" && $_POST["oldpw"] != "" && $_POST["newpw"] != "") {
		if ($_POST["submit"] != "OK") {
			echo "ERROR\n";
			return false;
		}
		$login = $_POST["login"];
		$oldpw = hash("whirlpool", $_POST["oldpw"]);
        $newpw = hash("whirlpool", $_POST["newpw"]);
        $file = '../private/passwd';
		if (!file_exists($file)) {
            echo "ERROR\n";
			return false;
        }
		$data = file_get_contents($file);
        if (!check_new_mdp($login, $oldpw, $newpw, (array)unserialize($data), $file)) {
			echo "ERROR\n";
			return false;
		}
	}
	else
		echo "ERROR\n";
?>