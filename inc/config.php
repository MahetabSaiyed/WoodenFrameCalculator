<?php
    session_start();
    
    // Display errors
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);

    include_once "inc/defined.php";

    // Generate a unique session ID if it's not already set
    if (!isset($_SESSION['session_id'])) {
        $_SESSION['session_id'] = session_id();
    }

    // Function to Manage Autoload Class
    function classAutoLoader($rawClass){
        
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $rawClass); // Replace '\' to System's Directory Separator

        // Possible Paths
        $ClassDir[] = "Classes/className.php";
    
        // Iterate Path Array to Check and Include Class File
        foreach ($ClassDir as $temppath)
        {
            $path = str_replace(["\\", "className"], [DIRECTORY_SEPARATOR, $class], $temppath); // Replace Directory Separator and Classname

            // Check Does Class file exists?
            if (file_exists($path))
            {
                // Include Class file
                require_once "$path";
            }
        }
    }
    spl_autoload_register("classAutoLoader"); // Register Autoload (So, We do not everytime to include Class file)
    
    // Database connection
    $con = new PDO("mysql:host=localhost;dbname=".DBN , DBU, DBP);
    
    // Check connection
    if (!$con) {
        die("Connection failed!");
    }
