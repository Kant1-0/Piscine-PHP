<?php
    include_once "common/base.php";
    $pageTitle = "Register";
    include_once "common/header.php";
 
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])):
        include_once "inc/class.users.inc.php";
        echo createAccount($_POST['username'], hash('whirlpool', $_POST['password']));
    else:
?>
        <br/><br/>

        <div class="center">
            <div class="connect-container" style="margin-left:auto;margin-right:auto;">
    
                <div class="title2 center">Start to eshoop!</div><br/>
                <form method="post" action="signup.php" id="registerform" class="center">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" placeholder="Login" name="username" id="username" required/>
                        <br/><br/>
                        <label for="password">Password: </label>
                        <input type="password" placeholder="Password" name="password" id="password" required/>
                        <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
                        <br/><br/>
                        <div class="center">
                            <input type="submit" name="register" id="register" value="Sign up" class="button" />
                        </div>
                    </div>
                </form><br/>

            </div>
        </div>


<script type="text/javascript">
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

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
        
 
<?php
    endif;
    include_once 'common/close.php';
?>