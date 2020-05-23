<?php
session_start();
if (!empty($_SESSION["username"])) {
    
}
//header("Location: index.php");
else
header("Location: login.php?message=2");

include "../connection_to_database.php";
$menuid = $_GET["menuid"];
$sql = "DELETE FROM menu WHERE menu_id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $menuid);
mysqli_stmt_execute($stmt);
header("Location: index.php");
?>