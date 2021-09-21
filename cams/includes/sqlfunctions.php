<?php
require_once "config.php";
/**
 *
 */
class Sqlconnection {

	var $connection;

	function __construct(){
		//first of all comprobate that database exist if not, try to create
		$this->connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if (!$this->connection) {
			echo "Error CAMS: Unable to connect to MySQL. Debugging errno: ".mysqli_connect_errno()."Debugging error: ".mysqli_connect_error();
			return NULL;
		}
	}

	/*USERS*/
	function getAllUsers(){
		return $result = $this->connection->query(" SELECT * FROM USERS;");
	}
	function getUser($username){
		return $result = $this->connection->query(" SELECT * FROM USERS WHERE USER='$username';");
	}
	function countUsers(){
		return $result = $this->connection->query(" SELECT COUNT(*) FROM USERS;");
	}
	function checkLogin($user, $pass){
		$result = $this->connection->query(" SELECT * FROM USERS WHERE USER = '$user' AND PASSWORD = '$pass';");
		//echo ($result->num_rows);
		if ($result->num_rows < 1) {
			return false;
		}
		else {
			return $result;
		}
	}
	function addUser($username, $mail, $userpass, $usertype){
		$result = $this->connection->query("INSERT INTO `USERS`(`USER`, `MAIL`, `PASSWORD`, `TYPE`) VALUES ('$username','$mail','$userpass','$usertype')");
		echo mysqli_error($this->connection);
		return $result;
	}
	function editUser($id,$username, $mail, $userpass, $type){
		if(empty($userpass)){ //DONT MODIFY PASSWORD
			$result = $this->connection->query("UPDATE `USERS` SET `USER`='$username',`MAIL`='$mail',`TYPE`=$type WHERE `ID`=$id;");
		}else{
			$result = $this->connection->query("UPDATE `USERS` SET `USER`='$username',`MAIL`='$mail',`PASSWORD`='".md5($userpass)."',`TYPE`=$type WHERE `ID`=$id;");
		}
		echo mysqli_error($this->connection);
		return $result;
	}     
	function deleteUser($id){
		$result = $this->connection->query("DELETE FROM `USERS` WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function countArticlesByUser($idautor){
		$result = $this->connection->query("SELECT COUNT(ID),AUTOR FROM ARTICLES WHERE TYPE = 1 AND AUTOR='$idautor' GROUP BY AUTOR;");
		echo mysqli_error($this->connection);
		return $result;
	}

	/*CATEGORIES*/
	function getAllCategories(){
		return $result = $this->connection->query(" SELECT * FROM CATEGORIES;");
	}
	function countCategories(){
		return $result = $this->connection->query(" SELECT COUNT(*) FROM CATEGORIES;");
	}
	function getParentCategories(){
		return $result = $this->connection->query(" SELECT * FROM CATEGORIES WHERE PARENTID=0;");
	}
	function getChildCategories(){
		return $result = $this->connection->query(" SELECT * FROM CATEGORIES WHERE PARENTID>0 ORDER BY PARENTID;");
	}
	function addCategory($title, $parentid){
		$result = $this->connection->query("INSERT INTO `CATEGORIES`(`PARENTID`, `TITLE`) VALUES ($parentid ,'$title');");
		echo mysqli_error($this->connection);
		return $result;
	}
	function editCategory($id, $title, $parentid){
		$result = $this->connection->query("UPDATE `CATEGORIES` SET `TITLE`='$title',`PARENTID`='$parentid' WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function deleteCategory($id){
		$result = $this->connection->query("DELETE FROM `CATEGORIES` WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}


	/*PAGES AND ARTICLES*/
	function getMenuPages(){
		return $result = $this->connection->query(" SELECT * FROM `ARTICLES` WHERE TYPE=0 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getHiddenPages(){
		return $result = $this->connection->query(" SELECT * FROM `ARTICLES` WHERE TYPE=2 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getAllArticles(){
		return $result = $this->connection->query(" SELECT * FROM `ARTICLES` WHERE TYPE=1 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getAllPages(){
		return $result = $this->connection->query(" SELECT * FROM `ARTICLES` WHERE TYPE!=1 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function countArticles(){
		return $result = $this->connection->query(" SELECT COUNT(*) FROM ARTICLES WHERE TYPE=1;");
	}
	function countPages(){
		return $result = $this->connection->query(" SELECT COUNT(*) FROM ARTICLES WHERE TYPE!=1;");
	}
	function getRandomArticles(){
		return $result = $this->connection->query(" SELECT TITLE,IMAGEHEADER FROM ARTICLES WHERE TYPE=1 ORDER BY RAND() LIMIT 6;");
	}
	function getArticlesByCategory($category){
		return $result = $this->connection->query(" SELECT ARTICLES.TITLE,ARTICLES.DATE,ARTICLES.IMAGEHEADER FROM ARTICLES, CATEGORIES WHERE ARTICLES.CATEGORIES = CATEGORIES.ID AND CATEGORIES.TITLE = '$category';");
	}
	function getAllArticlesIndex($limit = 0){
		$limit = $limit*10;
		return $result = $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER FROM `ARTICLES` WHERE TYPE=1 ORDER BY `DATE` DESC, `ID` DESC LIMIT $limit,10;");
	}
	function getAllArticlesLike($string){
		return $result = $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER FROM `ARTICLES` WHERE CONTENT LIKE '%$string%' OR TITLE LIKE '%$string%' ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getArticle($id){
		return $result = $this->connection->query(" SELECT * FROM `ARTICLES` WHERE `ID`=$id;");
	}
	function getArticleByTITLE($title){
		return $result = $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER,CONTENT,TYPE FROM `ARTICLES` WHERE `TITLE`='$title';");
	}
	function deleteArticle($id){
		$result = $this->connection->query("DELETE FROM `ARTICLES` WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function getLastArticleID(){
		$result = $this->connection->query("SELECT MAX(ID) FROM ARTICLES;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function saveArticle($id,$title, $type, $category, $date, $text, $imagepath, $autor){
		if(!empty($id)){ //modify A NEW ARTICLE
			$result = $this->connection->query("UPDATE `ARTICLES` SET `TITLE`='$title',`TYPE`=$type,`CATEGORIES`='$category',`CONTENT`='$text',`IMAGEHEADER`='$imagepath' WHERE `ID`=$id;");
		}else{	//create ONE
			$result = $this->connection->query("INSERT INTO `ARTICLES`(`ID`, `TITLE`, `TYPE`, `CATEGORIES`, `DATE`, `CONTENT`, `IMAGEHEADER`, `AUTOR`) VALUES (NULL, '$title','$type','$category','$date','$text','$imagepath','$autor')");
		}
		echo mysqli_error($this->connection);
		return $result;
	}

	/*ACTIONS RECORD*/
	function getAllRecords(){
		return $result = $this->connection->query(" SELECT * FROM RECORD ORDER BY DATE;");
	}
	function getLastRecords(){
		return $result = $this->connection->query(" SELECT * FROM RECORD ORDER BY DATE LIMIT 10;");
	}
	function logRecord($action,$autor,$reciber,$context){
		$date = new DateTime();
		return $result = $result = $this->connection->query("INSERT INTO `RECORD`(`ID`, `ACTION`, `AUTOR`, `RECIBER`, `RECIBERCONTEXT`, `DATE`) VALUES (NULL, '$action','$autor','$reciber','$context','".$date->format('Y-m-d H:i:s')."')");
	}

	#region Log
	function addLog(Exception $exception){
		$level = LogLevels::ERROR;
		$date = new DateTime();
		return $result = $result = $this->connection->query("INSERT INTO `log` (`ID`, `LEVEL`, `MESSAGE`, `FILE`, `LINE`, `PROCCESS`, `SESSION_VALUE`, `DATE`) 
			VALUES (NULL, '$level', '".$exception->getMessage()."', '".$exception->getFile()."', '".$exception->getLine()."', '', '".serialize($_SESSION)."', '".$date->format('Y-m-d H:i:s')."')");
	}
	#endregion
}

?>
