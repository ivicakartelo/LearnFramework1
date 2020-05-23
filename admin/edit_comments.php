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
$commentid = $_GET["commentid"];
$sql = "SELECT * FROM comments WHERE comment_id = $commentid";
$result = mysqli_query($link, $sql);
?>
<form action='update_comment.php' method='post'>
<?php
print "<h1>Edit raw comment_id = " . $commentid . "</h1>";
while ($raw = mysqli_fetch_assoc($result))
{
print "<div><label for='comment_id'>comment_id</label><div>";
print "<input type='text' placeholder='Enter heading' name='comment_id' value='" . $raw["comment_id"] . "'>";

print "<div><label for='menu_id'>menu_id</label><div>";
print "<input type='text' placeholder='Enter heading' name='menu_id' value='" . $raw["menu_id"] . "'>";

print "<div><label for='nickname'>nickname</label><div>";
print "<input type='text' placeholder='Enter heading' name='nickname' value='" . $raw["nickname"] . "'>";

print "<div><label for='content'>Content</label><div>";
print "<textarea name='content' placeholder='Enter content'>" . $raw["content"] . "</textarea>";

print "<div><label for='published'>Published</label><div>";
print "<input type='text' placeholder='Enter published date' name='published' value=" . $raw["published"] . ">";

print "<div><label for='approved'>approved</label><div>";
print "<input type='text' placeholder='Enter approved' name='approved' value=" . $raw["approved"] . ">";


print "<input type='submit' value='Submit'>";
}
?>
</form>
</div>
</body>
</html>