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
$sql = "SELECT comment_id, menu_id, nickname, content, published, 
approved FROM comments ORDER BY comment_id DESC";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
//mysqli_stmt_bind_param($stmt, "i", $menuid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<h1>Administration</h1>
<p><a href="logout.php">Logout</a> <a href="../index.php">Home</a></p>
<form method='post'>
<table>
    <thead>
        <tr>
            <td>comment_id</td>
            <td>menu_id</td>
            <td>nickname</td>
            <td>content</td>
            <td>published</td>
            <td>approved</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
</thead>
<tbody>
<?php
While ($row = mysqli_fetch_assoc($result))
{
    print "<tr>";
    print "<td>" . $row["comment_id"] . "</td>";
    print "<td>" . $row["menu_id"] . "</td>";
    print "<td>" . $row["nickname"] . "</td>";
    print "<td>" . $row["content"] . "</td>";
    print "<td>" . $row["published"] . "</td>";
    print "<td>" . $row["approved"] . "</td>";

    print "<td><a href='edit_comments.php?commentid=" . 
        $row["comment_id"] . "'>Edit</a></td>";
        
    print "<td><a onclick='return delete_confirmation()' 
    href='delete_comments.php?commentid=" . 
    $row["comment_id"] . "'>Delete</a>";
    print "</tr>"; 
}
?>
<tbody>
</table>
</form>
</div>
</body>
</html>