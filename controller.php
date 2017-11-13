<?php

try {
    // Retrieve command:
    $cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
    
    if(!empty($cmd)){
        if($cmd == "clientToken"){
            // Process mobile transaction:
            require_once realpath( dirname(__FILE__).'/token.php' );
        }
        // else if($cmd == "..."){}
    }
    else {
        // Error ...
    }
} catch(Exception $e){
    echo $e->getMessage();
}