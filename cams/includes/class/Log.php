<?php
include_once "../sqlfunctions.php";

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

        public static function Get(Sqlconnection $connection, int $last = 10):mysql{
            if($connection != null){
                return $connection->getLast($last);
            }
        }

        public static function GetAll(Sqlconnection $connection){
            if($connection != null){
                return $connection->getAllRecords();
            }
        }

        public static function Add(Sqlconnection $connection){
            if($connection != null){
                //$connection->logRecord()
            }
        }
    }

?>