<?php
	namespace App;
	session_start();
	include("/Projects/pobenirajitive/Asset/Authentication/authentication.php");
	include "/projects/pobenirajitive/Asset/Sql/sql.php";
	require_once("/projects/pobenirajitive/Asset/Helpers/pageFunctions.php");
	use Asset\Sql\Sql;
	use Asset\Authentication\Authentication;
	$authentication = Authentication::getInstance();
	if($authentication->isLoggedIn()){
		$authentication->selfAuthenticate();
	}
	else{
		sendToLoginPage();
	}
	$identity = $authentication->getIdentity();

?>
<?php include "/Projects/pobenirajitive/pages/topheaderpart.php"?>

<?php include "/Projects/pobenirajitive/pages/bottompart.php"?>
