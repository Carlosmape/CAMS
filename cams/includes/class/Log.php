<?php
include_once "../sqlfunctions.php";

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
    }

?>