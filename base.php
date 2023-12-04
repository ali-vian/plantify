<?php 
// note 
// folder plantify ditaruh langsung di direktori htdocs (jika pakai xampp) 

define("BASEURL", "http://localhost/plantify");
define("BASEPATH", $_SERVER["DOCUMENT_ROOT"]."/plantify");
define("DB", new PDO('mysql:host=localhost;dbname=store', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));   // database connection 

?>