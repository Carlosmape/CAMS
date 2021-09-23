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
	static Sqlconnection $database;

	public static function Get(int $last = 10){
		if($this->database != null){
			return $this->database->getLastLogs($last);
		}
	}

	public static function GetAll(){
		if($this->database != null){
			return $this->database->getAllRecords();
		}
	}

	public static function Add(Exception $exception){
		if($this->database != null){
			$this->database->addLogException($exception);
		}
	}

	public static function AddMsg(string $message, LogLevels $level = LogLevels::DEBUG){
		$this->database->addLog($level, $message);
	}

}

?>
