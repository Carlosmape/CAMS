<?php

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

        public static function Get(Sqlconnection $connection, int $last = 10){
            if($connection != null){
                return $connection->getLastLogs($last);
            }
        }

        public static function GetAll(Sqlconnection $connection){
            if($connection != null){
                return $connection->getAllRecords();
            }
        }

        public static function Add(Sqlconnection $connection, Exception $exception){
            if($connection != null){
                $connection->addLog($exception);
            }
        }
    }

?>
