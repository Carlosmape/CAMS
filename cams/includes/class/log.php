<?php
/*
 * @AUTHOR Carlos G. Martín <cagrmape@gmail.com>
 *
 * */

abstract class ActionTypes{
	public const EDIT = "EDIT";
}
abstract class LogLevels{
	public const INFO = 0;
	public const DEBUG = 1;
	public const WARNING = 2;
	public const ERROR = 3;
}

class Log{
	static $database;

	public static function Get(int $last = 10){
		if(self::$database == null){
			self::$database = new Sqlconnection;
		}
		return self::$database->getLastLogs($last);
	}

	public static function GetAll(){
		if(self::$database == null){
			self::$database = new Sqlconnection;
		}
		return self::$database->getAllRecords();
	}

	public static function Add(Exception $exception){
		if(self::$database == null){
			self::$database = new Sqlconnection;
		}
		self::$database->addLogException($exception);
	}

	public static function AddMsg(string $message, LogLevels $level = LogLevels::DEBUG){
		if(self::$database == null){
			self::$database = new Sqlconnection;
		}
		self::$database->addLog($level, $message);
	}

}

?>
