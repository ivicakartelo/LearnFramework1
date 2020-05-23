<?php
session_start();
if (!empty($_SESSION["username"])) {  
}
//header("Location: index.php");
else
header("Location: login.php?message=2");
include "../connection_to_database.php";
$commentid = $_GET["commentid"];

$sql = "DELETE FROM comments WHERE comment_id = ?";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $commentid);
mysqli_stmt_execute($stmt);

header("Location: comments.php");
?>