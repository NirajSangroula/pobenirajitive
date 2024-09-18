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
		sendToHomepage();
	}
	if(isPost()){
		$email = getPost('email');
		$password = getPost('password');
		$status = $authentication->authenticate(['email' => $email, 'password' => $password]);
		if($status){
			sendToHomepage();
		}
		else{
			echo "Incorrect Credentials";
		}
	}
?>
<?php include "/Projects/pobenirajitive/pages/topheaderpart.php"?>
	<form method="post">
		<input type="text" name="email">
		<input type="password" name="password">
		<input type="submit" name="submit" value="log in">
	</form>
<?php include "/Projects/pobenirajitive/pages/bottompart.php"?>