<?php
include "connection_to_database.php";
if (isset($_POST["search"])) {
	$search = "%{$_POST['search']}%";
	print "Keyword: " . $_POST['search'];
}
$sql = "SELECT menu_id, heading, content, published, pic, views_counter 
				FROM menu WHERE heading like ?";
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "s", $search);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		While ($row = mysqli_fetch_assoc($result)) {
			print "<h1><a href='http://localhost/cms/index.php?menuid=" 
			. $row["menu_id"] . "'>" . $row["heading"] . "</a></h1>";
		}
?>