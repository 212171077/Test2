<?php
//	define('HOST','mysql13.000webhost.com');
//	define('USER','a5374953_room');
//        define('PASS','Venus_18');
//	define('DB','a5374953_room');
        
        define('HOST','localhost');
	define('USER','root');
        define('PASS','');
	define('DB','voting_system');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
	
?>