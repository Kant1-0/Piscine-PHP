<?php
    function auth($login, $passwd) {
        $file = "../private/passwd";
        if (file_exists($file)) {
            $accounts = unserialize(file_get_contents($file));
            if ($accounts != NULL) {
                foreach ($accounts as $account) {
                    if ($account['login'] == $login && $account['passwd'] == hash("whirlpool", $passwd))
                    return true;
                }
            }
        }
        return false;
    }
?>