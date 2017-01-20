<?php

    if (!($mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)))
         echo 'Connection to DB failed';

    function checkCategory($name) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT CategoryName FROM category where CategoryName = '$name'");
        return mysqli_num_rows($res);
    }

    function getIDCategory($name) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM category WHERE CategoryName = '$name'");
        if (mysqli_num_rows($res) == 0)
            return false;
        $res = mysqli_fetch_assoc($res);
        $id = $res['CategoryID'];
        return $id;
    }

    function getNameCategory($id) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM category WHERE CategoryID = '$id'");
        if (mysqli_num_rows($res) == 0)
            return false;
        $res = mysqli_fetch_assoc($res);
        $name = $res['CategoryName'];
        return $name;
    }

    function createCategory($name, $abstract) {
        global $mysqli;
        if (checkCategory($name))
            return "<h2> Error </h2>"
                . "<p'> The Category <strong>$name</strong> already exists.</p>";
        $abstract = htmlspecialchars($abstract, ENT_QUOTES);
        $sql = "INSERT INTO category (CategoryName, CategoryAbstract)
                VALUES ('$name', '$abstract')";
        if (mysqli_query($mysqli, $sql))
            return "<h2> Success! </h2>"
                . "<p> A new Category was created "
                . "with the name <strong>$name</strong>.";
        return "<h2> Error </h2><p> Couldn't insert the "
            . "category information into the database.</p>";
    }

    function createArticle($title, $category, $abstract, $price, $photo) {
        global $mysqli;
        $id = getIDCategory($category);
        if ($id === false)
            return "<h2> Error </h2>"
                . "<p'> The Category <strong>$category</strong> doesn't exist.</p>";
        $abstract = htmlspecialchars($abstract, ENT_QUOTES);
        $photo = urlencode($photo);
        $sql = "INSERT INTO items (CategoryID, ItemText, ItemAbstract, ItemPhotos, ItemPrice)
                VALUES ($id, '$title', '$abstract', '$photo', $price)";
        if (mysqli_query($mysqli, $sql))
            return "<h2> Success! </h2>"
                . "<p> A new article was created "
                . "with the name <strong>$title</strong>.";
        return "<h2> Error </h2><p> Couldn't insert the "
            . "article information into the database.</p>";
    }

    function modifyArticle($title, $category, $abstract, $price, $photo) {
        global $mysqli;
        $id = getIDCategory($category);
        if ($id === false)
            return "<h2> Error </h2>"
                . "<p'> The Category <strong>$category</strong> doesn't exist.</p>";
        $abstract = htmlspecialchars($abstract, ENT_QUOTES);
        $photo = urlencode($photo);
        $sql = "UPDATE items 
            SET CategoryID=$id, ItemPrice=$price, ItemAbstract='$abstract', ItemPhotos='$photo'
            WHERE ItemText='$title'";
        if (mysqli_query($mysqli, $sql))
            return "<h2> Success! </h2>"
                . "<p> The current article "
                . "with the name <strong>$title</strong> was modified.";
        return "<h2> Error </h2>"
                . "<p'> Couldn't modify the article <strong>$title</strong>" 
                . " information in the database.</p>";
    }

    function showAdminCategory() {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM category");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($res as &$category) {
            echo "<div>&emsp;&emsp;Title = <strong>" . $category['CategoryName'] . "</strong>&emsp;&emsp;Category ID = " . 
            $category['CategoryID'] . "</br>&emsp;&emsp;Description = '" . $category['CategoryAbstract']  . "'</br>" .
            "</div></br>";
        }
    }

    function showAdminArticle() {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM items");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($res as &$article) {
            $category = getNameCategory($article['CategoryID']);
            echo "<div>&emsp;&emsp;Title = <strong>" . $article['ItemText'] . "</strong>&emsp;&emsp;Item ID = " . 
            $article['ItemID'] . "&emsp;&emsp;" . "Category = " . $category . "&emsp;&emsp;Price = " . 
            $article['ItemPrice'] . "$</br>&emsp;&emsp;Description = '" . $article['ItemAbstract']  . "'</br>" .
            "&emsp;&emsp;" . "Photo URL = <a href='" . urldecode($article['ItemPhotos']) . "'>" . 
            urldecode($article['ItemPhotos']) . "</a></div></br>";
        }
    }

    function showAllArticles() {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM items");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($res as &$article) {
            $category = getNameCategory($article['CategoryID']);
            $id_str = "item_" . strval($article['ItemID']);
            echo "<div sytle='float:left'><span><h1 id='" . $id_str . "'>" . $article['ItemText'] . "</h1><i>in "
            . $category . "</i></span></br></br>" . "</br>" . $article['ItemAbstract']  . "</br></br>"
            . "&emsp;&emsp;<img src='" . urldecode($article['ItemPhotos'])
            . "'></br><h2 style='float:right'><a href='index.php?item=" . $article['ItemID'] . "#" 
            . $id_str . "'>" . "<img src='media/pay_icon.png'></a><strong>" . $article['ItemPrice'] 
            . "$</strong></h2>" . "</br></br></br></br></br></br></br></div><hr /></br></br>";
        }
    }

    function showAllCartArticles() {
        global $mysqli;
        if (isset($_COOKIE['cart'])) {
            $data = unserialize($_COOKIE['cart']);

            $res = mysqli_query($mysqli, "SELECT * FROM items");
            $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
            foreach ($res as &$article) {
                if (isset($data[$article['ItemID']])) {
                    $category = getNameCategory($article['CategoryID']);
                    $id_str = "item_" . strval($article['ItemID']);
                    $price[] = intval($article['ItemPrice']) * $data[$article['ItemID']];
                    echo "<div sytle='float:left'><span><h1 id='" . $id_str . "'>" . $article['ItemText'] 
                    . " x" . $data[$article['ItemID']] . "</h1><i>in ". $category 
                    . "</i></span></br></br>" . "</br>" . $article['ItemAbstract']  . "</br></br>"
                    . "&emsp;&emsp;<img src='" . urldecode($article['ItemPhotos'])
                    . "'></br><h2 style='float:right'><a href='index.php?item=" . $article['ItemID'] . "#" 
                    . $id_str . "'>" . "<img src='media/pay_icon.png'></a><strong>" . end($price)
                    . "$</strong></h2>" . "(" . $article['ItemPrice'] . "$)" 
                    . "</br></br></br></br></br></br></br></div><hr /></br></br>";
                }
            }
            echo "</br></br><hr/><h2>Total Price: " . array_sum($price) . "$"
                . "</br><div style='clear:both;float:right;'><a href='cart.php?valid=OK'><i><h1>Validation</i></a></div>";
        }
        else {
            echo "<h1 class='center'>What?! Your cart is empty.</br> Don't wait and start to eShoop!</h1>";
        }
    }

    function showArticlesfromCategory($category) {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM items");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $id = getIDCategory($category);
        foreach ($res as &$article) {
            if ($article['CategoryID'] == $id) {
                $category = getNameCategory($article['CategoryID']);
                $id_str = "item_" . strval($article['ItemID']);
                echo "<div sytle='float:left'><span><h1 id='" . $id_str . "'>" . $article['ItemText'] . "</h1><i>in "
                . $category . "</i></span></br></br>" . "</br>" . $article['ItemAbstract']  . "</br></br>"
                . "&emsp;&emsp;<img src='" . urldecode($article['ItemPhotos'])
                . "'></br><h2 style='float:right'><a href='index.php?category=" . $category
                . "&item=" . $article['ItemID'] . "#" 
                . $id_str . "'>" . "<img src='media/pay_icon.png'></a><strong>" . $article['ItemPrice'] 
                . "$</strong></h2>" . "</br></br></br></br></br></br></br></div><hr /></br></br>";
            }
        }
    }

    function getAllCategories() {
        global $mysqli;
        $res = mysqli_query($mysqli, "SELECT * FROM category");
        $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($res as &$category) {
            echo "<a href='index.php?category=" . $category['CategoryName'] . "' class='category button'>"
                . $category['CategoryName'] . "</a>&emsp;";
        }
    }

    function addArticletoCart($id) {
        global $mysqli;
        $sql = "SELECT ItemID FROM items where ItemID = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) == 0)
            return false;

        if (!isset($_COOKIE['cart'])) {
            $data[$id] = 1;
        } else {
            $data = unserialize($_COOKIE['cart']);
            if (isset($data[$id]))
                $data[$id] += 1;
            else
                $data[$id] = 1;
        }
        setcookie("cart", serialize($data));
    }

    function validCart($userid) {
        global $mysqli;
        $data = $_COOKIE['cart'];
        $sql = "INSERT INTO cart (UserID, ListItemID)
                VALUES ('$userid', '$data')";
        if (mysqli_query($mysqli, $sql)) {
            setcookie("cart", "", time()-3600);
            return "<h2> Success! </h2>"
                . "<p> We've been paid, you'll get your delivery soon!";
        }
        else
            echo mysqli_error($mysqli);
        return "<h2> Error </h2><p> Either your Bank is empty or our DB is full!</p>";
    }

?>