<?php

    if (!($mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)))
         echo 'Connection to DB failed';

    function checkUser($username) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT Username FROM users where Username = '$username'");
        return mysqli_num_rows($res);
    }

    function checkAuth($username, $password) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM users WHERE Username = '$username'");
        $res = mysqli_fetch_assoc($res);
        if ($res['Username'] == $username && $res['Password'] == $password)
            return true;
        return false;
    }

    function getIDUser($username) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM users WHERE Username = '$username'");
        if (mysqli_num_rows($res) == 0)
            return false;
        $res = mysqli_fetch_assoc($res);
        $id = $res['UserID'];
        return $id;
    }

    function checkSuperUser($username) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM users WHERE Username = '$username'");
        $res = mysqli_fetch_assoc($res);
        if ($res['Username'] == $username && $res['SuperUser'] == 1)
            return true;
        return false;
    }

    function confirmSuperUser($username, $password) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM users WHERE Username = '$username'");
        $res = mysqli_fetch_assoc($res);
        if ($res['Username'] == $username && $res['Password'] == $password && $res['SuperUser'] == 1)
            return true;
        return false;
    }
    
    function createAccount($username, $password) {
        global $mysqli;
        if (checkUser($username))
            return "<h2> Error </h2>"
                . "<p'> Sorry, this user already exists. "
                . "Please try again. </p>";
        $sql = "INSERT INTO users (Username, Password)
                VALUES ('$username', '$password')";
        if (mysqli_query($mysqli, $sql))
            return "<h2> Success! </h2>"
                . "<p> Your account was successfully "
                . "created with the username <strong>$username</strong>.";
        return "<h2> Error </h2><p> Couldn't insert the "
            . "user information into the database. </p>";
    }

    function loginAccount($username, $password) {
        global $mysqli;
        if (checkAuth($username, $password) === true) {
            $_SESSION['Username'] = $username;
            $_SESSION['LoggedIn'] = 1;
            if (checkSuperUser($username))
                $_SESSION['SuperUser'] = 1;
            return true;
        }
        return false;
    }

    function showAdminUsers() {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM users");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($res as &$user) {
            if ($user['SuperUser'] == 1)
                $status = "Admin";
            else
                $status = "Customer";
            echo "<div>&emsp;&emsp;Username = <strong>" . $user['Username'] . "</strong>&emsp;&emsp;"
            . "UserID = " . $user['UserID'] . "&emsp;&emsp;" . $status . "</br>" 
            . "<form method='post' action='deleteaccount.php' id='delete-account-form'>
            <input type='hidden' name='ThisUsername' value='" . $user['Username'] . "' />"
            . "<div>&emsp;&emsp; <input type='submit'name='delete-account-submit' id='delete-account-submit'
            value='Delete this User' class='red-button' /></div></form>"
            . "</div></br>";
        }
    }

    function deleteUser($username) {
        global $mysqli;
        $sql = "DELETE FROM users WHERE Username='$username'";
        if (mysqli_query($mysqli, $sql))
            return "<h1 class='center'>Your account was successfully deleted</h1>";
        return "<h2> You may have already been deleted?! </p>";
    }

?>