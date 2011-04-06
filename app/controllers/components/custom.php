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
    
    //List Gender
    function list_gender() {
        return array(
            'Male'   => 'Male',
            'Female' => 'Female',
        );
    }
    
    //List Eductaion Attained
    function list_education_attained() {
        return array(
            'Grade School'                          => 'Grade School',
            'High School'                           => 'High School',
            'Vocational/Short Course'               => 'Vocational/Short Course',
            "Bachelor's/College Degree"             => "Bachelor's/College Degree",
            "Post Graduate Diploma/Master's Degree" => "Post Graduate Diploma/Master's Degree",
            'Professional License'                  => 'Professional License',
            'Doctorate Degree'                      => 'Doctorate Degree'
        );
    }
    
    //List Civil Status
    function list_civil_status() {
        return array(
            'Single'            => 'Single',
            'Married'           => 'Married',
            'Divorced/Annulled' => 'Divorced/Annulled',
            'Living In'         => 'Living In'
        );
    }
    
    //List Work Status
    function list_work_status() {
        return array(
            'Regular'      => 'Regular',
            'Probationary' => 'Probationary',
            'Casual'       => 'Casual',
            'Project'      => 'Project',
            'Other'        => 'Other'
        );
    }
}
?>