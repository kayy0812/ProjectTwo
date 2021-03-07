<?php
namespace Systems;

use PDO;
use PDOException;

Class Database{

	public $database;
	public $sql;

	public function __construct($db_host, $db_user, $db_pass, $db_table)
	{
		$this->host = $db_host;
		$this->user = $db_user;
		$this->pass = $db_pass;
		$this->table = $db_table;

		try{
			$this->database = new PDO('mysql:host='.$this->host.'; dbname='.$this->table.'',''.$this->user.'',''.$this->pass.'');
			$this->database->query('SET NAMES "UTF8"');
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
			die();  
		}
	}

	// public function call()
	// {
	// 	try{
	// 		$this->database = new PDO('mysql:host='.$this->host.'; dbname='.$this->table.'',''.$this->user.'',''.$this->pass.'');
	// 		$this->database->query('SET NAMES "UTF8"');
	// 	}
	// 	catch(PDOException $ex){
	// 		echo $ex->getMessage();
	// 		die();  
	// 	}
	// }

	public function SetQuery($sql)
	{
		$this->sql = $sql;
	}

	public function fetch_assoc()
	{
		$query = $this->database->prepare($this->sql);
    	$query->setFetchMode(PDO::FETCH_ASSOC);
    	$query->execute();
    	return $query->fetchAll();
	}
}
