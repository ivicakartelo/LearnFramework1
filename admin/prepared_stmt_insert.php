    <?php
    include "../connection_to_database.php";
    $heading = $_POST["heading"];   
    $content = $_POST["content"];  
    $published = date("Y-m-d");
    $pic = $_FILES["image"]["name"];

    if (isset($_FILES['image']['error'])) {
        $errorCode = $_FILES['image']['error'];
        if ($errorCode == UPLOAD_ERR_INI_SIZE) {
            print "UPLOAD_ERR_INI_SIZE<br>";
            print "Value: 1"; 
            print " The uploaded file exceeds the upload_max_filesize directive in php.ini.";
            exit; }
        elseif ($errorCode == 2) {
            print "UPLOAD_ERR_FORM_SIZE<br>";
            print "Value: 2 The uploaded file 
            exceeds the MAX_FILE_SIZE directive 
            that was specified in the HTML form.";
            exit;
        }
    }
    
/*
    class UploadException extends Exception
{
    public function __construct($code) {
        $message = $this->codeToMessage($code);
        parent::__construct($message, $code);
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
        return $message;
    }
}

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //uploading successfully done
    } else {
    throw new UploadException($_FILES['image']['error']);
    }
*/
    // Check extensions
    $ext = pathinfo($_FILES["image"]["name"]);
    if ($ext["extension"] == "jpg" || 
    $ext["extension"] == "jpeg" || 
    $ext["extension"] == "png" || 
    $ext["extension"] == "gif") {
        $pic = $_FILES["image"]["name"];    
    }
    else {
       /* echo "File is not image.";
        exit;*/
    }
    $post_image_temp = $_FILES["image"]["tmp_name"];
    move_uploaded_file($post_image_temp, "../images/$pic");
        //prepared query = safeguard against SQL injection
            $sql = "INSERT INTO menu (heading, content, 
                    published, pic)
                    VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $heading,
                                   $content, $published, $pic);
            
            mysqli_stmt_execute($stmt);
            header("Location: index.php");

            /*
            The meaning of abbreviations ssss: 
            i Integers
            d Doubles
            b Blobs
            s Everything Else 
            */
    ?>