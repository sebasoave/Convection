<?php

class Database {
	private static $host = "localhost";
	private static $username = "root";
	private static $password = "";
	private static $dbname = "Convection";
	private static $connection;

	public static function connect() {
		self::$connection = new mysqli(self::$host, self::$username, self::$password,self::$dbname);
		return true;
	}
	public  static function executeQuery($query) {
		$result = self::$connection->query($query);
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
