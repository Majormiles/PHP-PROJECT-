<?php
//destroy the sesssion opened in the browser
session_destroy();

//redirect to login page
header('Location: login.php'); 
?>