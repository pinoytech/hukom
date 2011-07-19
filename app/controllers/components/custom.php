<?php
class CustomComponent extends Object {
	function rrmdir($dir) { 
	   if (is_dir($dir)) { 
	     $objects = scandir($dir); 
	     foreach ($objects as $object) { 
	       if ($object != "." && $object != "..") { 
	         if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object); 
	       } 
	     } 
	     reset($objects); 
	     rmdir($dir); 
	   } 
	}
	
	//List all files inside a folder
    function list_folder_files($dir) {
        $dir_name = $dir;
        
        if (!$this->is_empty_dir($dir)){
            $files    = scandir($dir, 0);
            $filename = array();
            
            for( $ctr = 1; $ctr < sizeof( $files ); $ctr++ ){
                if($files[$ctr] != "." && $files[$ctr] != ".."){
					
					if(!is_dir($dir.'/'.$files[$ctr])) {
						$filename[] = $files[$ctr];
					}
                }
            }
            
            return $filename;
        }
        else{
            return array();
        }
    }
    
    //Check if folder is empty
    function is_empty_dir($dir){
        if (($files = @scandir($dir)) && count($files) <= 2) {
            return true;
        }
        return false;
    }
    
    //List Files uploaded
    function show_files($upload_folder) {
		
		//Create Legalcase_id Folder
		$file = $_SERVER{'DOCUMENT_ROOT'} . $upload_folder; 
		if (!file_exists($file)) {
			mkdir($file);
			chmod($file, 0755);
		}
		
		//Show files
		$folder = $_SERVER['DOCUMENT_ROOT'] . $upload_folder;
		$files = $this->list_folder_files($folder);
		
		return $files;
    }
    
    function date_difference($date1, $date2, $interval) {
        $diff = abs(strtotime($date2) - strtotime($date1)); 

        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 
        
        switch ($interval) {
            case 'y':
                return $years;
                break;
            case 'm':
                return $months;
                break;
            case 'd':
                return $days;
                break;
            case 'h':
                return $hours;
                break;
            case 'm':
                return $months;
                break;
            case 's':
                return $seconds;
                break;
            default:
                # code...
                break;
        }
        
        //printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds);
    }
}
?>