<?php
/**
 * Klasse für den Datenzugriff
 */
class todoModel{

	private static $tablename = "task";
	public static function init() {
		$pdo = new PDO('mysql:host=localhost;dbname=scripting', 'root', 'root');
		return $pdo;
	}
	/**
	 * Gibt alle Einträge des Blogs zurück.
	 *
	 * @return Array Array von Blogeinträgen.
	 */
	public static function getEntries(){
		$pdo = self::init();
		$sql = "select * from ".self::$tablename." where subtask_of IS NULL and completed=false";
		$rows = array();
		foreach ($pdo->query($sql) as $entry) {
			array_push($rows, $entry);
		}
		return $rows;
	}
	
	/**
	 * Gibt alle Einträge des Blogs zurück.
	 *
	 * @return Array Array von Blogeinträgen.
	 */
	public static function getCompletedTodos(){
		$pdo = self::init();
		$sql = "select * from ".self::$tablename." where completed = true";
		$rows = array();
		foreach ($pdo->query($sql) as $entry) {
			array_push($rows, $entry);
		}
		return $rows;
	}


	/**
	 * Gibt einen bestimmten Eintrag zurück.
	 *
	 * @param int $id Id des gesuchten Eintrags
	 * @return Array Array, dass einen Eintrag repräsentiert, bzw. 
	 * 					wenn dieser nicht vorhanden ist, null.
	 */
	public static function getEntry($id) {
		$pdo = self::init();
		$sql = "select * from ".self::$tablename." where id=".$id;
		$result = $pdo->query($sql)->fetch();
		return $result;
	}
	
		public static function getSubtasks($id) {
		$pdo = self::init();
		$sql = "select * from ".self::$tablename. " where subtask_of=".$id ." and completed=false";
		$rows = array();
			
		foreach($pdo->query($sql) as $entry) {
			array_push($rows, $entry);
		} 
			
			
		$rows = array_filter($rows);
		if(empty($rows)) {
			return NULL;
		}
			
		return $rows;
	}

	public static function newEntry($row) {
		/*
		if(!array_key_exists("date", $row)) {
			throw new Exception("Please provide Date in your Array");
		}
		if(!array_key_exists("weight", $row) {
			throw new Exception("Please provide a Column weight in your array");
		}
		*/
		$pdo = self::init();
		if(empty($row["subtask_of"])) {
			$row["subtask_of"] = NULL;
		}
		if(empty($row["completed"])) {
			$row["completed"] = 0;
		}
		$statement = $pdo->prepare("Insert into ".self::$tablename." (name, subtask_of, completed) VALUES (?, ?, ?)");
		return $statement->execute(array($row["name"], $row["subtask_of"], $row["completed"]));
		
		
	}
	
	public static function updateEntry($row) {
		$pdo = self::init();
		print_r($row);
		
		$statement = $pdo->prepare("Update ".self::$tablename." SET name=?, completed=? where id=". $row["id"]);
		$statement->execute(array($row["name"], $row["completed"]));
		return $statement;
	}
	
	public static function deleteEntry($id) {
		$pdo = self::init();;
		$statement = $pdo->prepare("DELETE FROM ".self::$tablename." WHERE id = ?");
		$statement->execute(array($id));
	}
}
?>
