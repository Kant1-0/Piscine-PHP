<?php
    $pageTitle = "Admin Panel";
    include_once "common/base.php";
    include_once "common/header.php";
?>

<!-- 
==========================================
# Section
==========================================
-->

<?php
    if($_SESSION['SuperUser'] != 1):
        echo "<meta http-equiv='refresh' content='0;index.php'>";
        exit;
    endif;

    include_once "inc/class.users.inc.php";
    include_once "inc/class.articles.inc.php";

    if(!empty($_POST['name']) && !empty($_POST['description'])):
        if ($_POST['newcategory'] == "Submit") :
            echo createCategory($_POST['name'], $_POST['description']);
        elseif ($_POST['newcategory'] == "Modify") :
            echo createCategory($_POST['name'], $_POST['description']);
        endif;
    endif;

    if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['abstract']) && 
        !empty($_POST['price']) && !empty($_POST['photo'])):
        if ($_POST['newarticle'] == "Submit") :
            echo createArticle($_POST['title'], $_POST['category'], $_POST['abstract'], $_POST['price'], $_POST['photo']);
        elseif ($_POST['newarticle'] == "Modify") :
            echo modifyArticle($_POST['title'], $_POST['category'], $_POST['abstract'], $_POST['price'], $_POST['photo']);
        endif;
    endif;
?>
        <br/><br/>

        <div class="center">
            <div class="connect-container" style="margin-left:auto;margin-right:auto;">
    
                <h2 class="title2 center">Create an article</h2><br/>
                <form method="post" action="admin.php" id="articleform" class="center">
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" placeholder="Your Title" name="title" id="title" maxlength="150" required/>
                        <br/><br/>
                        <label for="category">Category Name:</label>
                        <input type="text" placeholder="Existing Category" name="category" id="category" maxlength="150" required/>
                        <br/><br/>
                        <label for="abstract">Abstract: </label>
                        <textarea name="abstract" placeholder="Type a description here" id="abstract" rows="10" cols="90" maxlength="500" required></textarea>
                        <br/><br/>
                        <label for="price">Price: </label>
                        <input type="number" placeholder="Your Price $" name="price" id="price" min="0" required/>
                        <br/><br/>
                        <label for="photo">Photo URL: </label>
                        <input type="url" placeholder="Your Link" name="photo" id="photo" maxlength="150" required/>
                        <br/><br/>
                        <div class="center">
                            <input type="submit" name="newarticle" id="newarticle" value="Submit" class="button" />&emsp;
                            <input type="submit" name="newarticle" id="modifyarticle" value="Modify" class="button" />
                        </div>
                    </div>
                </form><br/>

                <hr /><br />

            </div>
        </div>

        <br/>
        

        <div class="center">
            <div class="connect-container" style="margin-left:auto;margin-right:auto;">
    
                <h2 class="title2 center">Create a category</h2><br/>
                <form method="post" action="admin.php" id="categoryform" class="center">
                    <div>
                        <label for="name">Category Name:</label>
                        <input type="text" placeholder="Your Title" name="name" id="name" maxlength="150" required/>
                        <br/><br/>
                        <label for="description">Abstract: </label>
                        <textarea name="description" placeholder="Type a description here" id="description" rows="10" cols="90" maxlength="500" required></textarea>
                        <br/><br/>
                        <div class="center">
                            <input type="submit" name="newcategory" id="newcategory" value="Submit" class="button" />&emsp;
                            <input type="submit" name="modifycategory" id="modifycategory" value="Modify" class="button" />
                        </div>
                    </div>
                </form><br/>

                <hr /><br />

            </div>
        </div>

        <br />

<h1>Categories</h1>
<?php showAdminCategory(); ?>
<br/><br/>
<h1>Articles</h1>
<?php showAdminArticle(); ?>
<br/><br/>
<h1>Users</h1>
<?php showAdminUsers(); ?>
<br/><br/>

<?php include_once "common/sidebar.php";
include_once "common/footer.php";
?>