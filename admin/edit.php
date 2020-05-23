<?php
session_start();
if (!empty($_SESSION["username"])) {
    
}
//header("Location: index.php");
else
header("Location: login.php?message=2");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
        <link rel="stylesheet" href="styleadmin.css" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" type="text/css">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
        <div class="container">
<?php
include "../connection_to_database.php";
$menuid = $_GET["menuid"];
$sql = "SELECT * FROM menu WHERE menu_id = $menuid";
$result = mysqli_query($link, $sql);
?>
<form action='update.php' method='post'>
<?php
print "<h1>Edit raw menu_id = " . $menuid . "</h1>";
while ($raw = mysqli_fetch_assoc($result))
{
print "<div><label for='heading'>Heading</label><div>";
print "<input type='text' placeholder='Enter heading' 
		name='heading' value='" . $raw["heading"] . "'>";

print "<div><label for='content'>Content</label><div>";
print "<textarea name='content' placeholder='Enter content'>" . 
	$raw["content"] . "</textarea>";

print "<div><label for='published'>Published</label><div>";
print "<input type='text' placeholder='Enter published date' 
name='published' value=" . $raw["published"] . ">";
//print "<div><label for='image'>Image</label><div>";
//print "<input type='file'  name='image' placeholder='Enter image file name'>";
print "<div><label for='pic'>Picture</label><div>";
print "<input type='text' placeholder='Enter 
file name of picture' name='pic' value=" . $raw["pic"] . ">";
print "<input type='hidden' name='menu_id' value=" . $raw["menu_id"] . ">";
print "<input type='submit' value='Submit'>";
}
?>
</form>
</div>
</body>
</html>