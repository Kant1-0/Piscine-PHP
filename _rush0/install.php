<?php
if (!($sql = mysqli_connect('localhost', 'root', 'root')))
    echo "Error while connecting to the DBMS";
mysqli_query($sql,"CREATE DATABASE 768_42rush");
mysqli_close($sql);
if (!($sql = mysqli_connect('localhost', 'root', 'root', '768_42rush')))
    echo "Error while connecting to the DBMS";
else{
    $sqlSource = file_get_contents('set-db.sql');
    if (!(mysqli_multi_query($sql, $sqlSource)))
        echo "Error while populating the database";
}
?>
