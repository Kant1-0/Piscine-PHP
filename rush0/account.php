<?php
    include_once "common/base.php";

    if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1):
        $pageTitle = "Your Account";
        include_once "common/header.php";
        include_once 'inc/class.users.inc.php';
 
        if(isset($_GET['password']) && $_GET['password']=="changed")
        {
            echo "<div class='message good'>Your password "
                . "has been changed.</div>";
        }
 
        if(isset($_GET['delete']) && $_GET['delete']=="failed")
        {
            echo "<div class='message bad'>There was an error "
                . "deleting your account.</div>";
        }
?>

<br /><br />

<div class="center">
<div class="connect-container">
    <div class="center">
        <div>
        
        <h2 class="title2 center">Your Account</h2><br />
 
        <form method="post" action="account.php"
            id="change-password-form" class="center">
            <div>
                <input readonly type="text" name="username" value="<?php echo $_SESSION['Username'] ?>"/>
                <label for="username">Your Username</label>
                <br /><br />

                <hr /><br />

                <input type="password" name="password" id="password" required/>
                <label for="password">Old Password</label>
                <br /><br />

                <input type="password" name="new-password" id="new-password" required/>
                <label for="password">New Password</label>
                <br /><br />

                <input type="password" name="repeat-new-password" id="repeat-new-password" required/>
                <label for="password">Confirm New Password</label>
                <br /><br />

                <div class="center">
                <input type="submit" name="change-password-submit" id="change-password-submit" value="Change Password" class="button" />
                </div><br />
            </div>
        </form>
        <hr /><br />
 
        <form method="post" action="deleteaccount.php"
            id="delete-account-form" class="center">
            <div>
                <input type="hidden" name="Username"
                    value="<?php echo $_SESSION['Username'] ?>" />
                <div class="center">
                <input type="submit"
                    name="delete-account-submit" id="delete-account-submit"
                    value="Delete Account?" class="red-button" />
                </div><br />
            </div>
        </form><br />
        
        </div>
    </div>
</div>
</div>
 
<?php
    else:
        header("Location: index.php");
        exit;
    endif;
?>

<script type="text/javascript">
var password = document.getElementById("new-password")
  , confirm_password = document.getElementById("repeat-new-password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<div class="clear"></div>
 
<?php
    include_once "common/close.php";
?>