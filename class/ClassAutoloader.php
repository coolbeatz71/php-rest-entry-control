<?php 
/**
	** zoom4Shop 1.0 v1.0
	** AuthorName: Mutombo Riy Jean-Vincent 
	** Year 3 Business Information Technology
	** University of Tourism, Technologies and Business Studies
	***********************************************************
	***********************************************************

	* This class handles the autoloading of differents classes  
**/

class ClassAutoloader{

	//Registering  classes
	static function Register(){
		spl_autoload_register(array(__CLASS__, 'getClasses'));
	}

	//handles the classes loading
	static function getClasses($className){
		require_once $className.'.php';
	}

}  
