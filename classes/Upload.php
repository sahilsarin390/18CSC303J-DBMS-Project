<?php 
class Upload {
    public static function checkUpload() {
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
      
    }
}