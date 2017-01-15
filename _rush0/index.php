<?php
    include_once "common/base.php";
    include_once "common/header.php";
    include_once "inc/class.articles.inc.php";
    $pageTitle = "Home";
?>

<!-- 
==========================================
# Section
==========================================
-->

<?php if(isset($_GET['item'])):
    addArticletoCart($_GET['item']);
endif; ?>

    </br><h2 class="this-is-shop center">
        WOW SUPER SHOP!
    </h2></br>

<?php if(isset($_GET['category'])): ?>

    <div style="margin:10%;">
        <?php showArticlesfromCategory($_GET['category']); ?>
    </div>

<?php else: ?>

    <div style="margin:10%;">
        <?php showAllArticles(); ?>
    </div>

<?php endif; ?>


<?php include_once "common/sidebar.php"; ?>
<?php include_once "common/footer.php"; ?>