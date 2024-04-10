<?php

class Database {
	private static $host = "localhost";
	private static $username = "root";
	private static $password = "";
	private static $dbname = "Convection";
	private static $connection;

	public static function connect() {
		self::$connection = new mysqli(self::$host, self::$username, self::$password,self::$dbname);
		if (self::$connection->connect_error) {
			die("Connessione fallita: " . self::$connection->connect_error);
			return false;
		}
		return true;
	}
	public  static function executeQuery($query) {
		$result = self::$connection->query($query);
		if (!$result) {
			echo "Errore nella query: " . self::$connection->error;
		}
		return $result;
	}

	public static  function disconnect() {
		self::$connection->close();
	}
	public  static function destroy() {
		self::executeQuery('drop database '.self::$dbname);
	}
}

?>
