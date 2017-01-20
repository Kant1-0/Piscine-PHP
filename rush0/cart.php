<?php
    $pageTitle = "Home";
    include_once "common/base.php";
    include_once "common/header.php";
    include_once "inc/class.articles.inc.php";
?>

<!-- 
==========================================
# Section
==========================================
-->

<?php if(!empty($_GET['valid']) && $_GET['valid'] == "OK"):
    include_once "inc/class.users.inc.php";
    $id = getIDUser($_SESSION['Username']);
    echo validCart(intval($id));
    echo "<meta http-equiv='refresh' content='2;cart.php'>";
endif;?>

</br>
<h2 class="center">
    Your awesome cart
</h2>

<div style="margin:10%;">
    <?php showAllCartArticles(); ?>
</div>


<?php include_once "common/sidebar.php"; ?>

<?php include_once "common/footer.php"; ?>
