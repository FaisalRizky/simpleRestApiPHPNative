<?php
require(__DIR__.'/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
Class dbObj{
	/* Database connection start */
	function getConnstring() {
		$con = mysqli_connect($_ENV['DB_HOST'].':'.$_ENV['DB_PORT'], 
							  $_ENV['DB_USERNAME'], 
							  $_ENV['DB_PASSWORD'], 
							  $_ENV['DB_DATABASE']) or die("Connection failed: " . mysqli_connect_error()
			    );
 
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		return $con;
	}
}