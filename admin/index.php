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
        <link rel="stylesheet" href="styleadmin1.css" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" type="text/css">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
    function delete_confirmation()
    {
       return confirm("Are you sure you want to delete?");
    }
</script>

	</head>
	<body>
        <div class="container">
<?php
include "../connection_to_database.php";
$sql = "SELECT menu_id, heading, content, published, pic FROM menu";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
//mysqli_stmt_bind_param($stmt, "i", $menuid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<h1>Administration</h1>
<p><a href="logout.php">Logout</a> <a href="../index.php">Home</a></p>
<form action='update.php' method='post'>
<table>
    <thead>
        <tr>
            <td>Menu id</td>
            <td>Heading</td>
            <td>Content</td>
            <td>Published</td>
            <td>Picture</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
</thead>
<tbody>
<?php
While ($row = mysqli_fetch_assoc($result))
{
    print "<tr>";
    print "<td>" . $row["menu_id"] . "</td>";
    print "<td>" . $row["heading"] . "</td>";

    print "<td style='width: 20%'>";
    print "<div class='video-container'>";
    print $row["content"];
    print "</div><!-- VIDEO_CONTAINER END -->";	
    print "</td>";


    
    print "<td>" . $row["published"] . "</td>";
    print "<td>" . $row["pic"] . "</td>";
    print "<td><a href='edit.php?menuid=" . $row["menu_id"] . "'>Edit</a></td>";
    print "<td><a onclick='return delete_confirmation()' 
    href='delete.php?menuid=" . $row["menu_id"] . "'>Delete</a>";
    print "</tr>"; 
}
?>
<tbody>
</table>
</form>
</div>

<div class="container">
<h1>Add raw:</h1>
<form action="prepared_stmt_insert.php" method="post" enctype="multipart/form-data">
    <div><label for="heading">Heading</label></div>
    <div><input type="text" name="heading" placeholder="Enter heading"></div>
    <div><label for="content">Content</label></div>
    <div><textarea name="content" placeholder="Enter content or iframe video"></textarea></div>
    <!--
    <div><label for="published">Published</label></div>
    <div><input type="text" name="published" placeholder="Enter published date"></div>
    -->
    <div><label for="image">Image</label></div>
    <div><input type="file"  name="image"></div>
    <div><input type="submit" name="submit" value="Add raw"></div>
</form>
</div>
</body>
</html>