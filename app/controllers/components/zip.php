<?php  
class ZipComponent extends Object 
{
    /* creates a compressed zip file */
    function create_zip($files = array(),$destination = '',$overwrite = false) {
      //if the zip file already exists and overwrite is false, return false
      if(file_exists($destination) && !$overwrite) { return false; }
      //vars
      $valid_files = array();
      //if files were passed in...
      if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
          //make sure the file exists
          if(file_exists($file)) {
            $valid_files[] = $file;
          }
        }
      }
      //if we have good files...
      if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
          return false;
        }
        //add the files
        foreach($valid_files as $file) {
          $zip->addFile($file,$file);
        }
        //debug
        echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
      }
      else
      {
        return false;
      }
    }
    
    //function to zip and force download the files using PHP
    function zipFilesAndDownload($file_names,$archive_file_name,$file_path) {
        //create the object
        $zip = new ZipArchive();
        //create the file and throw the error if unsuccessful
        if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
        exit("cannot open <$archive_file_name>\n");
        }
        //add each files of $file_name array to archive
        foreach($file_names as $files)
        {
        $zip->addFile($file_path.$files,$files);
        }
        $zip->close();
        //then send the headers to foce download the zip file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$archive_file_name");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("$archive_file_name");
        exit;
    }
    
    //Modified Function
    /* creates a compressed zip file */
    function create_zip_modified($files = array(),$archive_name,$overwrite = false) {
      //if the zip file already exists and overwrite is false, return false
      // if(file_exists($destination) && !$overwrite) { return false; }
      //vars
      $valid_files = array();
      //if files were passed in...
      if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
          //make sure the file exists
          if(file_exists($file)) {
            $valid_files[] = $file;
          }
        }
      }
      //if we have good files...
      if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($archive_name,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
          return false;
        }
        //add the files
        foreach($valid_files as $file) {
          $zip->addFile($file,$file);
        }
        //debug
        echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        // return file_exists($destination);
        
        //then send the headers to foce download the zip file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$archive_name");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("$archive_name");
        exit;
        
      }
      else
      {
        return false;
      }
    }
}
?>
