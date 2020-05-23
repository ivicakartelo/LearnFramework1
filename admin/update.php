<?php
session_start();
if (!empty($_SESSION["username"])) {
    
}
//header("Location: index.php");
else
header("Location: login.php?message=2");
include "../connection_to_database.php";
$menuid = $_POST["menu_id"];
$heading = $_POST["heading"];
$content = $_POST["content"];
$published = $_POST["published"];
$pic = $_POST["pic"];

        $sql = "UPDATE menu
            SET heading = ?, content = ?, 
            published = ?, pic = ?
            WHERE menu_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $heading, $content, 
                                        $published, $pic, $menuid);
        /*
        The meaning of abbreviations: 
        i Integers
        d Doubles
        b Blobs
        s Everything Else 
        */
        mysqli_stmt_execute($stmt);
        header("Location: index.php");   
?>