<?php

    function check_user($login, $tab) {
        foreach ($tab as $account) {
            if ($account["login"] === $login)
                return true;
        }
        return false;
    }

if ($_POST["login"] != "") {
    if ($_POST["passwd"] != "") {
		if ($_POST["submit"] != "OK") {
			echo "ERROR\n";
			return false;
		}
		$stock["login"] = $_POST["login"];
		$stock["passwd"] = hash("whirlpool", $_POST["passwd"]);
		if (!file_exists('../private/'))
			mkdir('../private/');
		$file = '../private/passwd';
		if (file_exists($file))
			$data = file_get_contents($file);
		if (check_user($_POST["login"], (array)unserialize($data))) {
			echo "ERROR\n";
			return false;
		}
		if ($data)
			$data = unserialize($data);
		$data[] = $stock;
		$data = serialize($data);
		file_put_contents($file, $data);
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>