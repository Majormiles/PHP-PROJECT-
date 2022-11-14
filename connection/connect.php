<?php

//main connection file for both admin & front end
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "onlinefoodphp";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());

    //stop the script from continuing since there is no 404 page
    exit(1);

    //if there is a 404 page, we will just display its contents at the bottom
}else{
    $folderName = "/OnlineFood PHP";

    //comment the line below on your machine
    $folderName = "/PHP-PROJECT-";

    //creating a default root path for finding php documents
    $rootPath = $_SERVER["DOCUMENT_ROOT"];   //remove the line below if you are deploying or hosting it
    $rootPath = $_SERVER["DOCUMENT_ROOT"].$folderName;

    //The above is used to access paths to images or other files in your main directory

    //creating a default url for folder files
    //grabbing protocol
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off" || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    //adding the domain name
    $domain_name = $_SERVER['HTTP_HOST'];

    $url = $protocol.$domain_name;  //remove the line below if you are deploying or hosting it
    $url = $protocol.$domain_name.$folderName;

    //start your session
    session_start();
}

?>