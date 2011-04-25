<?php
class CustomHelper extends AppHelper {
    
    function get_first_last_name($user_id) {
        $personal_infos =& ClassRegistry::init('personal_infos');
        $personal_info = $personal_infos->query("SELECT first_name, last_name FROM personal_infos WHERE user_id = $user_id");

        return $personal_info[0]['personal_infos']['first_name'] .' '. $personal_info[0]['personal_infos']['last_name'];
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
}
?>