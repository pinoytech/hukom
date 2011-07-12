<?php
class CustomHelper extends AppHelper {
    
    function get_first_last_name($user_id) {
        $personal_infos =& ClassRegistry::init('personal_infos');
        $personal_info = $personal_infos->query("SELECT first_name, last_name FROM personal_infos WHERE user_id = $user_id");

        return $personal_info[0]['personal_infos']['first_name'] .' '. $personal_info[0]['personal_infos']['last_name'];
    }
    
    function get_username($user_id) {
        $personal_infos =& ClassRegistry::init('users');
        $personal_info = $personal_infos->query("SELECT username FROM users WHERE id = $user_id");

        return $personal_info[0]['users']['username'];
    }
    
    function get_personal_info_id($user_id) {
        $personal_infos =& ClassRegistry::init('personal_infos');
        $personal_infos = $personal_infos->query("SELECT id FROM personal_infos WHERE user_id = $user_id");

        if (isset($personal_infos[0]['personal_infos']['id']) && $personal_infos[0]['personal_infos']['id']) {
            return $personal_infos[0]['personal_infos']['id'];
        }
        else {
            return null;
        }
    }
    
    function get_spouse_info_id($user_id) {
        $spouse_infos =& ClassRegistry::init('spouse_infos');
        $spouse_info = $spouse_infos->query("SELECT id FROM spouse_infos WHERE user_id = $user_id");

        if (isset($spouse_info[0]['spouse_infos']['id']) && $spouse_info[0]['spouse_infos']['id']) {
            return $spouse_info[0]['spouse_infos']['id'];
        }
        else {
            return null;
        }
    }
    
    function get_children_info_id($user_id) {
        $children_infos =& ClassRegistry::init('children_infos');
        $children_info = $children_infos->query("SELECT id FROM children_infos WHERE user_id = $user_id");

        if (isset($children_info[0]['children_infos']['id']) && $children_info[0]['children_infos']['id']) {
            return $children_info[0]['children_infos']['id'];
        }
        else {
            return null;
        }
    }
    
    function get_civil_status($user_id) {
        $personal_infos =& ClassRegistry::init('personal_infos');
        $personal_info = $personal_infos->query("SELECT civil_status FROM personal_infos WHERE user_id = $user_id");

        return $personal_info[0]['personal_infos']['civil_status'];
    }
    
    //List Payment Options
    function list_payment_option() {
        return array(
            'Bank Deposit' => 'Bank Deposit', 
            'Paypal'       => 'Paypal', 
            'GCash'        => 'GCash', 
            'SmartMoney'   => 'SmartMoney'
        );
    }
    
    //List GCash Types
    function list_gcash_type() {
        return array(
            'GCash Mobile' => 'GCash Mobile',
            'GCash Online' => 'GCash Online',
            'GCash Remit'  =>'GCash Remit'
        );
    }
    
    //List SmartMoney Types
    function list_smartmoney_type() {
        return array(
            'Over-the-Counter'       => 'Over-the-Counter',
            'Wallet-to-Wallet'       => 'Wallet-to-Wallet',
            'Mobile Banking Service' => 'Mobile Banking Service',
            'Smart Padala'           => 'Smart Padala'
        );
    }
    
    //List Payment Status
    function list_payment_status() {
        return array(
            'Pending'   => 'Pending', 
            'Overdue'   => 'Overdue', 
            'Confirmed' => 'Confirmed'
        );
    }
    
    //List Eductaion Attained
    function list_education_attained() {
        return array(
            'Grade School'                          => 'Grade School',
            'High School'                           => 'High School',
            'Vocational/Short Course'               => 'Vocational/Short Course',
            "Bachelor's/College Degree"             => "Bachelor's College Degree",
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
    
    //List Gender
    function list_gender() {
        return array(
            'Male'   => 'Male',
            'Female' => 'Female',
        );
    }
    
    //List Corporation Type
    function list_corporation_type() {
        return array(
            'Stock Corporation'   => 'Stock Corporation',
            'Non-Stock'           => 'Non-Stock',
            'General Partnership' => 'General Partnership',
            'Limited Partnership' => 'Limited Partnership',
        );
    }
    
    //List Stockholder Type
    function list_stockholder_type() {
        return array(
            'Publicly Listed'     => 'Publicly Listed',
            'Not Publicly Listed' => 'Not Publicly Listed',
        );
    }
    
    //Double Code! Also found on components/custom.php
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

	function calendar_time_select() {
		return array(
            '08:00 am'  => '08:00 am',
            '09:00 am'  => '09:00 am',
            '10:00 am' => '10:00 am',
            '11:00 am' => '11:00 am',
            '12:00 pm' => '12:00 pm',
            '01:00 pm'  => '01:00 pm',
            '02:00 pm'  => '02:00 pm',
            '03:00 pm'  => '03:00 pm',
            '04:00 pm'  => '04:00 pm',
            '05:00 pm'  => '05:00 pm',
            '06:00 pm'  => '06:00 pm',
            '07:00 pm'  => '07:00 pm',
            '08:00 pm'  => '08:00 pm',
            '09:00 pm'  => '09:00 pm',
            '10:00 pm'  => '10:00 pm',
            '11:00 pm'  => '11:00 pm',
        );
	}
}
?>