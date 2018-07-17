<?php
/**
	** AuthorName: Mutombo Riy Jean-Vincent 
	** Year 3 Business Information Technology
	** University of Tourism, Technologies and Business Studies
	***********************************************************
	***********************************************************

	* This class contains common methods for all other classes
**/

//loading required files
require_once 'Config.php'; 
require_once 'ClassAutoloader.php';

//charging the class autoloader
ClassAutoloader::Register();

class Common{

	/**
     * @var DBQuery
    */
    protected $db;

    public function __construct(){

		$db = new DBQuery();
		$this->db = $db;
	}


    /**
     * isUserNameExist() check if the userName is already used
     * @param  string $userName
     * @param  string $userRole [personnal]
     * @return boolean
     * @throws Exception
     */
	public function isUserNameExist($userName, $userRole){

		switch ($userRole) {
			
			case PERSONAL:
                $query = "SELECT id from user WHERE username = ?";
			break;
		}

		$countRow = $this->db->countRow($query, [ $userName ]);
		return $countRow > 0;
	}

    /**
     * isBarcodeExist() check if the barcode scanned exist in the DB
     * @param  [type]  $barcodeText
     * @return boolean
     */
    public function isBarcodeExist($barcodeText){

        $query = "SELECT Personal_id FROM personal WHERE Tel = ?";
        $countRow = $this->db->countRow($query, [ $barcodeText ]);
        return $countRow > 0;

    }
}