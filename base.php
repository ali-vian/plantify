<?php 

define("BASEURL", "http://localhost:8080/plantify");
define("BASEPATH", $_SERVER["DOCUMENT_ROOT"]."/plantify");
define("DB", new PDO('mysql:host=localhost;dbname=store', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));   // database connection 

?>