<?php
session_start();
if (!empty($_SESSION["username"])) {  
}
//header("Location: index.php");
else
header("Location: login.php?message=2");
include "../connection_to_database.php";
$commentid = $_POST["comment_id"];
$menuid = $_POST["menu_id"];
$nickname = $_POST["nickname"];
$content = $_POST["content"];
$published = $_POST["published"];
$approved = $_POST["approved"];

$sql = "UPDATE comments
    SET comment_id = ?, menu_id = ?, nickname = ?, content = ?,
        published = ?, approved = ?
        WHERE comment_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "iisssii", $commentid, $menuid, $nickname, $content, 
                                        $published, $approved, $commentid);
        /*
        The meaning of abbreviations: 
        i Integers
        d Doubles
        b Blobs
        s Everything Else 
        */
        mysqli_stmt_execute($stmt);
        header("Location: comments.php");   
?>