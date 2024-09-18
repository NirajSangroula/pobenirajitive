<?php
namespace Asset\Sql;
include "/Projects/pobenirajitive/Asset/Helpers/sqlStringCreator.php";

use Asset\Helpers\SqlStringCreator;
class Sql{
	private $mysqli;
	private $stringCreator;
	public function __construct(){
		$this->mysqli = new \mysqli("pobenirajitive.com", "root", "", "pobenirajitive");
		$this->stringCreator = new SqlStringCreator();
	}
	public function getMySqli(){
		return $this->mysqli;
	}
	public function insert(array $data, $tableName){
		$string = $this->stringCreator->createDataString($data);
		$sql = "insert into $tableName( {$string[0]} ) values( {$string[1]} )";
		return $this->mysqli->query($sql);
	}
	public function update(array $data, array $identifier, $tableName){
		$string = $this->stringCreator->createUpdateString($data);
		$identifierString = $this->stringCreator->createIdentifierString($identifier);
		$sql = "update $tableName set $string where $identifierString";
		return $this->mysqli->query($sql);
	}
	public function delete(array $identifier, $tableName){
		$string = $this->stringCreator->createIdentifierString($identifier);
		$sql = "delete from $tableName where $string";
		return $this->mysqli->query($sql);
	}
	public function selectAll($tableName){
		$sql = "select * from $tableName";
		return $this->mysqli->query($sql);
	}
	public function select(array $identifier, $tableName){
		$string = $this->stringCreator->createIdentifierString($identifier);
		$sql = "select * from $tableName where $string";
		return $this->mysqli->query($sql);
	}
	public function selectFollowing(array $selection, array $identifier, $tableName){
		$string = "";
		$i = 1;
		foreach ($selection as $value) {
			if($i++ < count($selection))
				$string .= ($value.', ');
			else
				$string .= $value;
		}
		$iString = $this->stringCreator->createIdentifierString($identifier);
		$sql = "select $string from $tableName where $iString";
		return $this->mysqli->query($sql);
	}

	public function selectWithLimit(array $selection, array $identifier, $tableName, $pageNo = 1, $no = 20){
		$string = "";
		$i = 1;
		foreach ($selection as $value) {
			if($i++ < count($selection))
				$string .= ($value.', ');
			else
				$string .= $value;
		}
		$iString = $this->stringCreator->createIdentifierString($identifier);
		$sql = "select $string from $tableName where $iString limit " . ($pageNo - 1) * $no . ", $no";
		return $this->mysqli->query($sql);

	}
}


