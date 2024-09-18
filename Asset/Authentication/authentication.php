<?php
namespace Asset\Authentication;
use Asset\Sql\Sql;
class Authentication{
	public $status = 0;
	private $identity;
	private static $instance;
	public $sql;
	public function __construct(){
		$this->sql = new Sql();
	}
	public static function getInstance(){
		if(self::$instance)
			return self::$instance;
		else{
			self::$instance = new Authentication();
			return self::$instance;
		}

	}
	public function authenticate(array $identity){
		$results = $this->sql->selectFollowing(['id', 'email', 'password', 'authID'], $identity, 'users');
		if($results){
			$results = $results->fetch_all();
			if(count($results) > 0){
				$status = 1;
				$this->storageOperations($results[0]);
				return true;
			}
		}
		else{
			return false;
		}
	}
	public function selfAuthenticate(){
		$results = $this->sql->selectFollowing(['id', 'email', 'password', 'authID'], ['id' => $this->getID()], 'users');
		if($results){
			$results = $results->fetch_all();
			if(count($results) > 0){
				$status = 1;
				$this->storageOperations($results[0]);
				return true;
			}
		}
		else{
			return false;
		}
	}
	public function isLoggedIn(){
		if(isset($_SESSION['id'])){
			$results = $this->sql->selectFollowing(['id', 'authID'], ['id' => $_SESSION['id']], 'users')->fetch_all();
			if(count($results) > 0){
				if($_SESSION['authID'] == $results[0][1]){
					$status = 1;
					return true;
				}
			}
		}
		else{
			if(isset($_COOKIE['id'])){
				$results = $this->sql->selectFollowing(['id', 'authID'], ['id' => $_COOKIE['id']], 'users')->fetch_all();
				if(count($results) > 0){
					if($_COOKIE['authID'] == $results[0][1]){
						$status = 1;
						return true;
					}
				}
			}
		}
		return false;
	}
	public function storageOperations(array $results){
		$_SESSION['id'] =  $results[0];
		$_SESSION['authID'] =  $results[3];
		setcookie('id', $results[0], time() + 86400 * 60);
		setcookie('authID', $results[3], time() + 86400 * 60);
		$this->identity = $this->sql->selectFollowing(['*'], ['id' => $results[0]], 'users')->fetch_all()[0];
	}
	private function getID(){
		return isset($_COOKIE['id']) ? $_COOKIE['id'] : (isset($_SESSION['id']) ? $_SESSION['id'] : false);
	}

	public function getIdentity(){
		if($this->identity){
			return $this->identity;
		}
		else{
			if($this->isLoggedIn()){
				$identity = $this->sql->selectFollowing(['*'], ['id' => $this->getID()], 'users')->fetch_all();
				if(count($identity) > 0){
					$this->identity = $identity[0];
					return $this->identity;
				}
			}
		}
	}
}
?>