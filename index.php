<!DOCTYPE html>
<html>
	<head>
		<title>LearnFramework1</title>
		<meta charset="UTF-8">
		
		
		<link rel="stylesheet" href="style55.css" type="text/css">
		<link rel="stylesheet" href="style32.css" type="text/css">

		<link href="//fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script>
			function myFunction() {
  				alert("Pslano! Hvala! Sljedi provjera sadrÅ¾aja.");
			}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $("#one").slideToggle();
  });
});
</script>
	</head>

	<body>
	
	<div class="container">
	<div class="grid12"><h1>LearnFramework1</h1></div>
		<div class="grid12">
			<form action="search.php" method="post">
				<input class="search_text" type="text" name="search">
				<input class="search" type="submit" value="Search">
			</form>
		</div><!-- GRID12 END -->
<?php
    //include connection script
    include "connection_to_database.php";
    //Is there menuid in the URL? Declaration of variable $menuid
	if (isset($_GET["menuid"]) && is_numeric($_GET["menuid"]))
	{
		$menuid = $_GET["menuid"];
	}
?>

<!-- Left side of web page -->

<div class="grid8">
		<div class="pad">
<?php
			//if no $menuid then Home Page
			// no need prepared stmt
			if (!isset($menuid))
			{
				$sql = "SELECT menu_id, heading,
				CONCAT(LEFT(content,400))
				AS content, published, pic, views_counter
			  	FROM menu ORDER BY menu_id ASC";

$result = mysqli_query($link, $sql);
//parts of every raw are display
While ($row = mysqli_fetch_assoc($result))
{
	if (!empty($row["pic"]))
						$image = $row["pic"];
					else {
						$image = NULL;
					}
					if ($image == NULL)
					{ print "<h2><a href='index.php?menuid=" . $row["menu_id"] . "'>
						<h1 style='text-align: center;font-size: 7rem;'>" . $row["menu_id"] . "." . "</h1>" . $row["heading"] . "</a></h2>";
						print "<h4>Published: " . $row["published"] . "</h4>"; 

						print "<div class='video-container'>";
						print "<p>" . $row["content"] . "</p>";
						print "</div><!-- VIDEO_CONTAINER END -->";				 
						print "<a href='index.php?menuid=" . $row["menu_id"] . "' class='link-button'>Comment</a>";
						print "<hr>";
					}
					
					else 
					{   print "<h2><a href='index.php?menuid=" . $row["menu_id"] . "'>"
						. $row["heading"] . "</a></h2>";

						print "<h4>" . $row["published"] . " " . $row["views_counter"] . " views</h4>";
						print "<p><img src='images/" . $row["pic"] . "'></p>";
						
						print "<div class='video-container'>";
						print "<p>" . $row["content"] . "</p>";
						print "</div><!-- VIDEO_CONTAINER END -->";
						
						print "<a href='index.php?menuid=" . $row["menu_id"] . "' class='link-button'>Comment</a>";
						
						print "<hr>";
					}
					
					
}
}

			//else one post with permanent web address
			//prepare statement is required: SELECT * FROM menu WHERE menu_id = ?
			else
			{	

        /*
        The meaning of abbreviations: 
        i Integers
        d Doubles
        b Blobs
        s Everything Else 
		*/
/*		
		$sql = "SELECT menu_id, heading, content, published, pic FROM menu WHERE menu_id = '$menuid'";
		$result = mysqli_query($link, $sql);
		var_dump($sql);
*/

		$sql = "SELECT menu_id, heading, content, published, pic, views_counter 
				FROM menu WHERE menu_id = ?";
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $menuid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		//var_dump($sql);

		//While loop
	

		While ($row = mysqli_fetch_assoc($result))
				{ 
					if (!empty($row["pic"]))
						$image = $row["pic"];
					else {
						$image = NULL;
					}
					if ($image == NULL)
					{ print "<h1 style='text-align: center;font-size: 7rem;'>" . $row["menu_id"]. "." . "</h1><h2>" . $row["heading"] . "</h2>";
						
						print "<h4>Objavljeno: " . $row["published"] . " Broj otvaranja: " . $row["views_counter"] . "</h4>"; 						
						print "<div class='video-container'>";
						print "<p>" . $row["content"] . "</p>";
						print "</div><!-- VIDEO_CONTAINER END -->";				 
						
					}
					
					else 
					{   print "<h2>" . $row["heading"] . "</h2>";

						print "<h4>" . $row["published"] . " " . $row["views_counter"] . " views</h4>";
						print "<div>";
						print "<p><img src='images/" . $row["pic"] . "'></p>";
						print "</div>";
						print "<div class='video-container'>";
						print "<p>" . $row["content"] . "</p>";
						print "</div><!-- VIDEO_CONTAINER END -->";	
						
						
					}
					
					
					$GLOBALS['views_counter_update'] = $row["views_counter"] + 1;	
				}
				//views_counter update
				$sql = "UPDATE menu SET views_counter = $views_counter_update WHERE menu_id = ?";
				$stmt = mysqli_stmt_init($link);
				mysqli_stmt_prepare($stmt, $sql);
				mysqli_stmt_bind_param($stmt, "i", $menuid);
				mysqli_stmt_execute($stmt);
				?>
		
				<form action="comment_insert.php" method="post">
				<div class="container round-corners">
				<div class="top round-corners"><h1>Pitaj, odgovori drugima ako znaš, riješi zadatak:</h1></div>
        <div class="middle">
			<input type="hidden" name="menu_id" value="<?php print $menuid; ?>">
			<div><label for="nickname">Nadimak</label></div>
    		<div><input type="text" name="nickname" placeholder="Tipkaj nadimak" style="width: 100%;"></div>
			<div><label for="content">Comment</label></div>
    		<div><textarea name="content" placeholder="Type comment" style="width:100%; height: 200px;"></textarea></div>

			<div><input type="checkbox" name="check" value="1"><label for="check">Ja sam čovjek</label></div>
			<input type="submit" onclick="myFunction()" value="Publish">
		</div><!-- MIDDLE END -->
        <div class="bottom round-corners"><h1>Comments:</h1></div>
    </div><!-- CONTAINER-ROUND END -->
			</form>
				<?php	
						//select from comments
						
						$sql = "SELECT menu_id, nickname,
						content, published, approved
						  FROM comments WHERE menu_id=$menuid AND approved = 1 ORDER BY comment_id DESC";
		
		$result = mysqli_query($link, $sql);
		//parts of every raw are display
		While ($row = mysqli_fetch_assoc($result))
		{
			print "<h2>" . $row["nickname"] . "</h2>";
			print "<h4>" . $row["published"] . "</h4>"; 
			print "<p>" . $row["content"] . "</p>";
			print "<hr>";
		}		
}
			

			?>
</div><!-- PAD VIDEO-CONTAINER -->
</div><!-- GRID8 END -->
<button>Close/Open right menu</button>
		<div class="grid4"id="one">
		<div class="pad-right">

<?php
				// no need prepared, right menu list
				$sql = "SELECT menu_id, heading, content, published, pic, views_counter 
				FROM menu ORDER BY menu_id";
				$result = mysqli_query($link, $sql);
				?>
				
				

<ul>
					<?php
					//links were scripted by PHP
					While ($row = mysqli_fetch_assoc($result))
					{
						if (isset($menuid)) {
							if ($row["menu_id"]  == $menuid) {
								print "<li><div class='sub-pad-click'><h3><a class='ClickedLink4' href='index.php?menuid=" . $row["menu_id"] . "'>" . $row["heading"] . "</a></h3></div></li>"; 
							}
							else {
								print "<li><h3><a href='index.php?menuid=" . $row["menu_id"] . "'>" . $row["heading"] . "</a></h3></li>"; 
							}
						}
						else {
							print "<li><h3><a href='index.php?menuid=" . $row["menu_id"] . "'>" . $row["heading"] . "</a></h3></li>";
						}
					}

					$sql = "SELECT menu_id, heading, content, published, pic, views_counter 
							FROM menu ORDER BY views_counter DESC";
					$result = mysqli_query($link, $sql);
					print "<h3>The most popular:</h3>";
					While ($row = mysqli_fetch_assoc($result)) {
						print "<li><a href='index.php?menuid=" . $row["menu_id"] . "'>" . $row["heading"] . "</a>
						<br />Broj otvaranja: " . $row["views_counter"] . "</li>";					
					}

					$sql = "SELECT menu_id, heading, content, published, pic, views_counter 
							FROM menu ORDER BY menu_id ASC";
					$result = mysqli_query($link, $sql);
					print "<h3>All posts:</h3>";
					While ($row = mysqli_fetch_assoc($result)) {
						print "<h6><a href='index.php?menuid=" . $row["menu_id"] . "'>" . $row["heading"] . "</a></h6>";
					}
					?>
</ul>
			</div><!-- PAD-RIGHT END -->
		</div><!-- GRID4 END --><div style="clear:both;"></div>
		<div class="grid8">
			<div class="pad-right">
				Footer
			</div><!-- PAD-RIGHT END -->
		</div><!-- GRID8 END -->
		<div class="grid4">
			<div class="pad-right">
			</div><!-- PAD-RIGHT END -->
		</div><!-- GRID4 END -->
		<div style="clear:both;"></div>
	</div><!-- CONTAINER END -->
	</body>
</html>