<?php
/**
	** zoom4Shop 1.0 v1.0
	** AuthorName: Mutombo Riy Jean-Vincent 
	** Year 3 Business Information Technology
	** University of Tourism, Technologies and Business Studies
	*********************************************************************************************************************
	*********************************************************************************************************************

	** the class handles basic dbase Queries (C-R-U-D), it inherits DBConnection  
**/
//require the autoloader class 
require_once 'ClassAutoloader.php';

//charging the class autoloader
ClassAutoloader::Register();

class DBQuery extends DBConnection{

	public function __construct(){

		$db = new DBConnection();
		$this->db = $db->getConnect();

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * getRow() to retrieve 1 line or 1 row in the DB
     *
     * @return object fetch() 1 line
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @throws Exception
     */
	public function getRow($query, $params = []){
		
		try{

			$stmt = $this->db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetch();

		}catch(PDOException $e) {
			throw new Exception($e->getMessage());	
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * countRow() to retrieve the number of entries
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @return int
     * @throws Exception
     */
	public function countRow($query, $params = []){
		
		try{

			$stmt = $this->db->prepare($query);
			$stmt->execute($params);

			return $stmt->rowCount();

		}catch(PDOException $e) {
			
			throw new Exception($e->getMessage());	
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * getRows() to retrieve many lines or all rows in the DB
     *
     * @return object fetchAll() all lines
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @throws Exception
     */
	public function getRows($query, $params = []){
		
		try{

			$stmt = $this->db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll();

		}catch(PDOException $e) {
			
			throw new Exception($e->getMessage());	
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

    /**
     * insertRow() insert 1 line in the DB
     *
     * @return boolean true on success
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @throws Exception
     */
	public function insertRow($query, $params = []){
		
		try{
			
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			
			return TRUE;

		} catch (PDOException $e) {
			
			throw new Exception($e->getMessage());	
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * updateRow() modify or update 1 line in the DB
     *
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @return boolean true on success
     * @throws Exception
     */
	public function updateRow($query, $params = []){
		return $this->insertRow($query, $params);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * deleteRow() remove or delete 1 line in the DB
     *
     * @param  string $query = SQL Query
     * @param  array $params = Query parameters
     * @return boolean true
     * @throws Exception
     */
	public function deleteRow($query, $params = []){
		return $this->insertRow($query, $params);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * lastID() retrieve the last ID in the DB 
	 *
	 * @return int $lastID  
	**/
	public function getLastInsertId(){
		$lastID = $this->db->lastInsertId(); 
		return $lastID;
	}
}