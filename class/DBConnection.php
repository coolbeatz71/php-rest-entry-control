<?php
/**
	** zoom4Shop 1.0 v1.0
	** AuthorName: Mutombo Riy Jean-Vincent 
	** Year 3 Business Information Technology
	** University of Tourism, Technologies and Business Studies
	***********************************************************
	***********************************************************

	* This class handles the connection to the database using PDO,
	* The class contains a method getConnect() which return the connexion ressource
	* and getDisconnect() to destroy the connection  
**/

require_once 'Config.php';

class DBConnection{

	protected $db;
	
	/**
	 * getConnect() create DB connection
	 *
	 * @return object PDO 
	**/
	public function getConnect(){
		//create new connection only if it doesn't exist, else return the existing connection
		if($this->db === NULL){

			try{
				//on success return the connection 
				$db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8", DB_USERNAME, DB_PASSWORD);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				$this->db = $db;

			}catch(Exception $e){
				//on error return the error message
				echo "Sorry, an error occurs while connecting to database";
				die();

			}
		}

		return $this->db;
	}

	/**
	 * getDisconnect() destroy DB Connection
	 *
	 * @return void 
	**/
	public function getDisconnect(){
		$this->db = NULL;
	}
}