<?php
/**
** AuthorName: Mutombo Riy Jean-Vincent
** Year 3 Business Information Technology
** University of Tourism, Technologies and Business Studies
***********************************************************
***********************************************************

In this file we are now using the slim framework to create API routing system
following the REST architecture

**/

//requiring the slim autoload
require_once dirname(__DIR__)."/lib/slim/vendor/autoload.php";

//requiring the config file that contains all constants
require_once dirname(__DIR__)."/class/Config.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

//charging the class autoloader
spl_autoload_register(function ($classname){
	require dirname(__DIR__)."/class/" . $classname . ".php";
});

/**
 * configuration the slim framework
 * @var array
*/
$config = [
	'settings' => [
		// Slim Settings
		'determineRouteBeforeAppMiddleware' => true,
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false
	]
];

$app = new \Slim\App($config);

$loginUser = function(Request $request, Response $response){

    //get login parameters
    $userName = htmlentities(trim($request->getParam('userName')));
    $password = htmlentities(trim($request->getParam('password')));

    //create the User object and check the login status
    $user = new User();
    $login = $user->checkUserLogin($userName, $password);

    if($login === TRUE){

        $responses['error']    = FALSE;
        $responses['userName'] = $userName;
        $responses['apiKey']   = uniqid();
    
    }else if($login === WRONG_PASSWORD){

        $responses['error']     = TRUE;
        $responses['errorPass'] = TRUE;

    }else{
        
        $responses['error']         = TRUE;
        $responses['errorUserName'] = TRUE;
    }

    return $response->withJson($responses);
};

$scanBarcode = function(Request $request, Response $response){

    //get barcode param
    $barcodeText = htmlentities(trim($request->getParam('barcodeText')));

    $app      = new Common();
    $personal = new User();

    $isBarcodeExist = $app->isBarcodeExist($barcodeText);

    if($isBarcodeExist === FALSE){

        $responses['error'] = TRUE;
        $responses['invalidBarcode'] = TRUE;

    }else{

        $responses['error'] = FALSE;
        $responses['personalInfo'] = $personal->getPersonal($barcodeText);
    }

    return $response->withJson($responses);

};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                           HERE THE API ROUTING SYSTEM                                              //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//route to login the client, employee and shopAdmin
$app->post('/loginUser', $loginUser);
$app->post('/scanBarcode', $scanBarcode);
$app->run();

?>