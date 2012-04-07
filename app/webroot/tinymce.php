<?php // this must be the very first line in your PHP file!

// You can't simply echo everything right away because we need to set some headers first!
$output = ''; // Here we buffer the JavaScript code we want to send to the browser.
$delimiter = "\n"; // for eye candy... code gets new lines



// Since TinyMCE3.x you need absolute image paths in the list...
$abspath = preg_replace('~^/?(.*)/[^/]+$~', '/$1', $_SERVER['SCRIPT_NAME']);

if ($_GET['type'] == 'external_image_list_url') {
    
    $output .= 'var tinyMCEImageList = new Array(';
    
    $directory = "/img"; // Use your correct (relative!) path here
    $absolute_path = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/img';

    $direc = opendir($absolute_path);
    while ($file = readdir($direc)) {
        if (is_file("$absolute_path/$file") && getimagesize("$absolute_path/$file") != FALSE) {
            // We got ourselves a file! Make an array entry:
            $output .= $delimiter
                . '["'
                . utf8_encode($file)
                . '", "'
                . utf8_encode("$directory/$file")
                . '"],';
        }
    }
}

if ($_GET['type'] == 'template_external_list_url') {
    
    $output .= 'var tinyMCETemplateList = new Array(';
    
    $directory = "/templates"; // Use your correct (relative!) path here
    $absolute_path = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/templates';

    $allow_ext = array('html');
    
    $direc = opendir($absolute_path);
    while ($file = readdir($direc)) {
        if (is_file("$absolute_path/$file") != FALSE) {
            $output .= $delimiter
                . '["'
                . utf8_encode($file)
                . '", "'
                . utf8_encode("$directory/$file")
                . '"],';
        }
    }
}


$output = substr($output, 0, -1); // remove last comma from array item list (breaks some browsers)
$output .= $delimiter;

closedir($direc);

// Finish code: end of array definition. Now we have the JavaScript code ready!
$output .= ');';

// Make output a real JavaScript file!
header('Content-type: text/javascript'); // browser will now recognize the file as a valid JS file

// prevent browser from caching
header('pragma: no-cache');
header('expires: 0'); // i.e. contents have already expired

// Now we can send data to the browser because all headers have been set!
echo $output;

?>