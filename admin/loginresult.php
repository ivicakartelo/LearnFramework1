<?php
session_start();
if ($_POST["username"] == "a" && $_POST["password"] == "a") {
$_SESSION["username"] = $_POST["username"];
header("Location: index.php");
}
else {
header("Location: login.php?message=1");
}
?>