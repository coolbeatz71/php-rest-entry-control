<?php
/**
   ** AuthorName: Mutombo Riy Jean-Vincent 
   ** Year 3 Business Information Technology
   ** University of Tourism, Technologies and Business Studies
   ***********************************************************
   ***********************************************************
**/

//loading required files
require_once 'Config.php'; 
require_once 'ClassAutoloader.php';

//charging the class autoloader
ClassAutoloader::Register();

class User{

	/**
	 * the user role = CLIENT
	 * @var string
	 */
	public $userRole = PERSONAL;

    /**
     * @var DBQuery
     */
    private $db;
    /**
     * @var Common
     */
    private $user;

    public function __construct(){
		
		$db = new DBQuery();
		$user = new Common(); 
		
		$this->db = $db;
		$this->user = $user;
	}

    /**
     * login the user to his account
     * @param  string $userName
     * @param  string $password
     * @return boolean or string
     * @throws Exception
     */
	public function checkUserLogin($userName, $password){

		if($this->user->isUserNameExist($userName, $this->userRole)){

			$query = "SELECT password FROM user WHERE username = ?";
			$login = $this->db->getRow($query, [ $userName ]);

			if($login){

				$dbPassword = $login->password;

				return $dbPassword == $password ? true : WRONG_PASSWORD;

			}else{

				return STMT_NOT_EXECUTED;
			}

		}else{

			return FALSE;
		}
	}

    /**
     * getPersonal() return all info about personal using the barcode
     * @param  string $barcodeText
     * @return array
    */
    public function getPersonal($barcodeText){

        $query = "SELECT * FROM personal WHERE Tel = ?";
        $res = $this->db->getRow($query, [ $barcodeText ]);

        if($res){
            
            $id = $res->Personal_id;

            $query2 = "SELECT * FROM equipment WHERE Personal_id = ?";
            $res2 = $this->db->getRow($query2, [ $id ]);

            $response['firstName']     = $res->First_name;
            $response['lastName']      = $res->Last_name;
            $response['Gender']        = $res->Gender;
            $response['phoneNumber']   = $res->Tel;
            $response['nationalId']    = $res->National_Id;
            $response['status']        = $res->Status;
            $response['date']          = $res->Date;
            $response['equipmentName'] = $res2->Equipment_name;
            $response['model']         = $res2->Model;
            $response['serialNumber']  = $res2->Serial_no;

            return $response;

        }else{
            return STMT_NOT_EXECUTED;
        }
    }
}