<?php
if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1):
    include_once "common/base.php";
    include_once "common/header.php";
    include_once "inc/class.users.inc.php";
    $pageTitle = "See you!";
?>

<?php

    if (htmlentities($_POST['delete-account-submit']) == "Delete Account?") :
        echo deleteUser($_SESSION['Username']);
        unset($_SESSION['LoggedIn']);
        unset($_SESSION['Username']);
        unset($_SESSION['SuperUser']);

    elseif (htmlentities($_POST['delete-account-submit']) == "Delete this User") :
        echo deleteUser(htmlentities($_POST['ThisUsername']));

    endif;
?>
 
<meta http-equiv="refresh" content="3;index.php">

<?php
else:
    header("Location: index.php");
    exit;
endif;
?>

<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?>