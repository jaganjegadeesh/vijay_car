<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    session_start();
    
      
    include("include/label.php");
    include("include/functions.php");
    include("include/validation.php");
    
    $obj = new billing();
    $valid = new validation();

    $view_action = $obj->encode_decode('encrypt', 'View'); $add_action = $obj->encode_decode('encrypt', 'Add');

    $edit_action = $obj->encode_decode('encrypt', 'Edit'); $delete_action = $obj->encode_decode('encrypt', 'Delete');
?>