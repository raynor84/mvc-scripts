<?php
/**
 * Klasse für den Datenzugriff
 */
class Model{


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
		$sql = "select * from weightjournal";
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
		$sql = "select * from weightjournal where id=".$id;
		$result = $pdo->query($sql)->fetch();
		return $result;
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
		var_dump($row);
		$pdo = self::init();
		$statement = $pdo->prepare("Insert into weightjournal (weight, date) VALUES (?,?)");
		return $statement->execute(array($row["weight"], date('y-m-d')));
		
	}
	
	public static function updateEntry($row) {
		$pdo = self::init();
		print_r($row);
		$statement = $pdo->prepare("Update weightjournal SET weight = ? , date = ? where id=". $row["id"]);
		$statement->execute(array($row["weight"], $row["date"]));
		return $statement;
	}
	
	public static function deleteEntry($id) {
		$pdo = self::init();;
		$statement = $pdo->prepare("DELETE FROM weightjournal WHERE id = ?");
		$statement->execute(array($id));
	}
}
?>
