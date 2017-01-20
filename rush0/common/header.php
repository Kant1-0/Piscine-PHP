<?php ob_start(); ?>
<!doctype html>
<html>
<!-- 
==========================================
# Page Info
==========================================
-->
<head>
    <link rel="icon" href="media/icon.png">
    <link rel="shortcut icon" href="media/icon.png">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <title>eShoop | <?php echo $pageTitle ?></title>
</head>
<!-- 
==========================================
# Body
==========================================
-->
<body>
        
<!-- 
==========================================
# Header
==========================================
-->
<div class="header">

    <div class="center"> <a href="index.php">
        <div class="logo"><img src="media/eShoop.png" alt="eShoop"></div></a>
    </div>

    <hr />

    <!-- IF LOGGED IN -->
    <?php if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']) && empty($_SESSION['SuperUser'])): ?>
        &ensp;<a href="account.php" class="account button">Your account</a>
        <div style="clear:both;float:right;"><a href="cart.php" class="cart button">Your Cart</a> &ensp;
        <a href="logout.php" class="login button">Log out</a>&ensp;</div>

    <!-- IF LOGGED IN AS SUPERUSER-->
    <?php elseif(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']) && !empty($_SESSION['SuperUser'])): ?>
        &ensp;<a href="account.php" class="account button">Your account</a>
        &ensp;<a href="admin.php" class="admin button">Admin Panel</a>
        <div style="clear:both;float:right;"><a href="cart.php" class="card button">Your Cart</a>&ensp;
        <a href="logout.php" class="login button">Log out</a>&ensp;</div>

    <!-- IF LOGGED OUT -->
    <?php else: ?>
        <div style="clear:both;float:right;"><a href="cart.php" class="card button">Your Cart</a>&ensp;
        <a href="signup.php" class="signin button">Sign up</a>&ensp;
        <a href="login.php" class="login button">Log in</a>&ensp;</div>
    <?php endif; ?>
    </br></br>

    <div class="center">
        <?php 
        include_once "inc/class.articles.inc.php";
        getAllCategories();
        ?>
    </div>

</div>