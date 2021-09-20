<?php
function CreateDatabase($connection){
	$result = mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS `".$_POST['Databasename']."`;");
	$result = $connection->select_db($_POST['Databasename']);
	return $result;
}

function CreateTablesStructures($connection){
	try{
		$creationResult = true;
		$creationResult &= CreateUsersTable($connection);
		$creationResult &= CreateRecordTable($connection);
		$creationResult	&= CreateCategoriesTable($connection);
		$creationResult	&= CreateArticlesTable($connection);
		$creationResult	&= CreateLogTable($connection);	
		echo "Tables created.";
	} catch (Exception $e){
		echo'"Error CAMS: Could not create necesary tables"' + $e->getMessage();
		$creationResult = false;
	}
	return $creationResult;
}

function CreateUsersTable($connection){
	try {
		return mysqli_query($connection,
		"CREATE TABLE IF NOT EXISTS USERS(
		`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`USER` VARCHAR(32),
		`MAIL` VARCHAR(32),
		`PASSWORD` VARCHAR(64),
		`TYPE` INT(11),
		UNIQUE (`USER`,`MAIL`),
		CHECK (TYPE BETWEEN 0 AND 1));"); 
	} catch (Exception $e){
		throw $e;
	}
}

function CreateRecordTable($connection){
	try{
		return mysqli_query($connection,
		"CREATE TABLE IF NOT EXISTS `RECORD` (
		`ID` INT(11) NOT NULL AUTO_INCREMENT,
		`ACTION` VARCHAR(45) NULL,
		`AUTOR` INT(11) NOT NULL,
		`RECIBER` INT(11) NOT NULL,
		`RECIBERCONTEXT` VARCHAR(45) NOT NULL,
		`DATE` DATETIME NOT NULL,
		PRIMARY KEY (`ID`));"); 
	} catch (Exception $e) {
		throw $e;
	}
}

function CreateCategoriesTable($connection){
	try{
		return mysqli_query($connection,
		"CREATE TABLE IF NOT EXISTS `CATEGORIES`(
		`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`PARENTID` INT(11),
		`TITLE` VARCHAR(32) UNIQUE;"); 
	} catch(Exception $e){
		throw $e;
	}
}
function CreateArticlesTable($connection){
	mysqli_query($connection,
	"CREATE TABLE IF NOT EXISTS `ARTICLES`(
	`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`TITLE` VARCHAR(96) UNIQUE,
	`TYPE` INT(11),
	`CATEGORIES` INT(11),
	`DATE` DATE,
	`CONTENT`	TEXT,
	`IMAGEHEADER` TEXT,
	`AUTOR` INT(11),
	CHECK (TYPE BETWEEN 0 AND 2));");

}
function CreateLogTable($connection){
	mysqli_query($connection, 
	"CREATE TABLE IF NOT EXISTS `LOG` ( 
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	`LEVEL` INT NOT NULL , 
	`MESSAGE` TEXT NOT NULL , 
	`FILE` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL , 
	`LINE` INT NULL , 
	`PROCCESS` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , 
	`SESSION_VALUE` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL ,
	`DATE` DATE NOT NULL);");
}
?>
