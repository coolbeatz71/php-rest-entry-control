<?php
/**
	** AuthorName: Mutombo Riy Jean-Vincent 
	** Year 3 Business Information Technology
	** University of Tourism, Technologies and Business Studies
	***********************************************************
	***********************************************************

	* This handles the configuration of the REST API
	* It contains all constants that will be used soon  
**/

header("Content-Type: text/html; charset=utf-8");

//Constants for database connexion
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'entry');

//Authentication or Authorization (1-10)
define('WRONG_PASSWORD', 1);
define('WRONG_USERNAME', 2);
define('WRONG_BARCODE', 3);
define('INVALID_APIKEY', 4);
define('PERSONAL', 5);

//Sql error (11-20)
define('STMT_NOT_EXECUTED', 6);