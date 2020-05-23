    <?php
    include "connection_to_database.php";
    $menu_id = $_POST["menu_id"];
    $nickname = $_POST["nickname"];
    $content = $_POST["content"];
    $published = date("Y-m-d");
    

    if (!isset($_POST["check"])) {
        print "You are not man.";
    }
    else {
        //$check = $_POST["check"];
        //prepared query = safeguard against SQL injection
            $sql = "INSERT INTO comments (menu_id, nickname, content, published)
                    VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $menu_id,
                                   $nickname, $content, $published);
            
            mysqli_stmt_execute($stmt);
            //header("Location: index.php");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
    

            /*
            The meaning of abbreviations ssss: 
            i Integers
            d Doubles
            b Blobs
            s Everything Else 
            */
    }
    ?>