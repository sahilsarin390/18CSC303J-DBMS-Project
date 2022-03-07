
<?php 

require "includes/init.php";

require "includes/head.php";


$db = new Database();
$conn = $db->getConn();

Auth::requireLogin();

$article = Article::getArticle($conn,$_GET["id"]);



if(isset($_GET["id"])) {

   
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_FILES)) {
        echo 'Invalid Upload';
    }
    else {
            try {
                switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                    break;
                case UPLOAD_ERR_INI_SIZE;
                    throw new Exception('File too Large');
                    break;
                default:
                throw new Exception('An error has occured');
            }
            
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
           
           $filetypes = ['image/gif', 'image/png', 'image/jpeg'];
            if (!in_array($mime_type, $filetypes)) {
                throw new Exception('Invalid File Type');
            }
            if ($_FILES['file']['size'] > 1000000) {
                throw new Exception('File too large');
            }

            //get details of file as an array
            $pathinfo = pathinfo($_FILES['file']['name']);
            $filename = $pathinfo['filename'];
            $pattern = '/[^a-zA-Z0-9_-]/';
            $replacement = '_';
            //replace invalid characters with _ 
            $filename = preg_replace($pattern, $replacement, $filename);
            $filename = mb_substr($filename, 0, 200); //restrict filename to 200 characters

            $file = $filename . "." . $pathinfo["extension"];

            //location of file on server
            $destination = getcwd() . "/uploads/$file";

            $i = 1;
            while(file_exists($destination)) {
                $file = $file = $filename. "-$i." . $pathinfo["extension"];
                $destination = getcwd() . "/uploads/$file";
                $i++;
            }
          

            if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
                
                $previous_image = $article->image_file;

                //update the image
                if($article->setImageFile($conn,$file)) { 

                    if ($previous_image) { // exist
                    unlink( getcwd() . "/uploads/$article->image_file");
                    }

                    echo '<div class="container"><div class = "alert alert-success">File Uploaded Sucessfully</div></div>';
                    redirect("single.php?id=" . $article->id); 

                }

            }
            else {
                throw new Exception('Upload Failed');
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }
    

 }
}
 ?>

<div class = "container">
        <h1>Post New Article </h1>

        <form method="post" enctype="multipart/form-data">
        <div class="form-group form-control">

   
        <input  type="file" name="file" id="">
        </div>
        <button class = "btn btn-outline-dark" >Upload</button>

        </form>
        <?php if (!empty($article->image_file)): ?>
      <div class="card-body" style="padding-top: 5px !important;">
      <img src= "/uploads/<?=$article->image_file;?>" style="max-width:400px;" /> 
      </div>
      <?php endif; ?>


        </div>
<?php require "includes/foot.php" ?>
