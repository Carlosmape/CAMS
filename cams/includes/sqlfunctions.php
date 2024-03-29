<?php
require_once "config.php";
require_once "class/log.php";
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
		return $this->connection->query(" SELECT U.*, R.NAME AS ROLE FROM USERS AS U INNER JOIN ROLES AS R ON (U.TYPE = R.ID);");
	}
	function getUser($username){
		return $this->connection->query(" SELECT * FROM USERS WHERE USER='$username';");
	}
	function countUsers(){
		return $this->connection->query(" SELECT COUNT(*) FROM USERS;");
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
	/*ROLES*/
	function getRoles(){
		return $this->connection->query(" SELECT * FROM ROLES;");
	}
	function getRole($name){
		return $this->connection->query(" SELECT * FROM ROLES WHERE `NAME` = '$name';");
	}
	function countRoles(){
		return $this->connection->query(" SELECT COUNT(*) FROM ROLES;");
	}
	function addRole($name, $description){
		return $this->connection->query(" INSERT INTO `ROLES`(`NAME`, `DESCRIPTION`) VALUES ('$name', '$description');");
	}
	function deleteRole($id){
		return $this->connection->query(" DELETE FROM `ROLES` WHERE ID=$id;");
	}

	/*SECTIONS*/
	function getSections(){
		return $this->connection->query(" SELECT * FROM SECTIONS;");
	}

	/*PERMISSIONS*/
	function getPermissionsPerRole($role){
		return $this->connection->query(" SELECT * FROM ROLES_PERMISSIONS WHERE `ID_ROLE` = '$role'");
	}
	function addPermissionToRole($role, $permission){
		return $this->connection->query(" INSERT INTO `ROLES_PERMISSIONS` (`ID_ROLE`, `ID_PERMISSION`) VALUES ('$role', '$permission');");
	}

	/*CATEGORIES*/
	function getAllCategories(){
		return $this->connection->query(" SELECT * FROM CATEGORIES;");
	}
	function countCategories(){
		return $this->connection->query(" SELECT COUNT(*) FROM CATEGORIES;");
	}
	function getParentCategories(){
		return $this->connection->query(" SELECT * FROM CATEGORIES WHERE PARENTID IS NULL;");
	}
	function getChildCategories(){
		return $this->connection->query(" SELECT * FROM CATEGORIES WHERE PARENTID IS NOT NULL ORDER BY PARENTID;");
	}
	function addCategory($title, $parentid){
		$result = $this->connection->query("INSERT INTO `CATEGORIES`(`PARENTID`, `TITLE`) VALUES ($parentid ,'$title');");
		echo mysqli_error($this->connection);
		return $result;
	}
	function editCategory($id, $title, $parentid){
		$result = $this->connection->query("UPDATE `CATEGORIES` SET `TITLE`='$title',`PARENTID`=$parentid WHERE `ID`=$id;");
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
		return $this->connection->query(" SELECT * FROM `PAGES` WHERE TYPE=0 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getHiddenPages(){
		return $this->connection->query(" SELECT * FROM `PAGES` WHERE TYPE=2 ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getAllArticles(){
		return $this->connection->query(" SELECT * FROM `ARTICLES` ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getAllPages(){
		return $this->connection->query(" SELECT * FROM `PAGES` ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function countArticles(){
		return $this->connection->query(" SELECT COUNT(*) FROM ARTICLES;");
	}
	function countPages(){
		return $this->connection->query(" SELECT COUNT(*) FROM PAGES;");
	}
	function getRandomArticles(){
		return $this->connection->query(" SELECT TITLE,IMAGEHEADER FROM ARTICLES ORDER BY RAND() LIMIT 6;");
	}
	function getArticlesByCategory($category){
		return $this->connection->query(" SELECT ARTICLES.TITLE,ARTICLES.DATE,ARTICLES.IMAGEHEADER FROM ARTICLES, CATEGORIES WHERE ARTICLES.CATEGORY = CATEGORIES.ID AND CATEGORIES.TITLE = '$category';");
	}
	function getAllArticlesIndex($limit = 0){
		$limit = $limit*10;
		return $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER FROM `ARTICLES` ORDER BY `DATE` DESC, `ID` DESC LIMIT $limit,10;");
	}
	function getAllArticlesLike($string){
		return $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER FROM `ARTICLES` WHERE CONTENT LIKE '%$string%' OR TITLE LIKE '%$string%' ORDER BY `DATE` DESC, `ID` DESC;");
	}
	function getArticle($id){
		return $this->connection->query(" SELECT * FROM `ARTICLES` WHERE `ID`=$id;");
	}
	function getPage($id){
		return $this->connection->query(" SELECT * FROM `PAGES` WHERE `ID`=$id;");
	}	
	function getArticleByTITLE($title){
		return $this->connection->query(" SELECT TITLE,DATE,IMAGEHEADER,CONTENT FROM `ARTICLES` WHERE `TITLE`='$title';");
	}
	function deleteArticle($id){
		$result = $this->connection->query("DELETE FROM `ARTICLES` WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function deletePage($id){
		$result = $this->connection->query("DELETE FROM `PAGES` WHERE `ID`=$id;");
		echo mysqli_error($this->connection);
		return $result;
	}	
	function getLastArticleID(){
		$result = $this->connection->query("SELECT MAX(ID) FROM ARTICLES;");
		echo mysqli_error($this->connection);
		return $result;
	}
	function saveArticle($id,$title, $category, $date, $text, $imagepath, $autor){
		if(!empty($id)){ //modify A NEW ARTICLE
			$result = $this->connection->query("UPDATE `ARTICLES` SET `TITLE`='$title',`CATEGORY`=$category,`CONTENT`='$text',`IMAGEHEADER`='$imagepath' WHERE `ID`=$id;");
		}else{	//create ONE
			$result = $this->connection->query("INSERT INTO `ARTICLES`(`ID`, `TITLE`, `CATEGORY`, `DATE`, `CONTENT`, `IMAGEHEADER`, `AUTOR`) VALUES (NULL, '$title',$category,'$date','$text','$imagepath','$autor')");
		}
		echo mysqli_error($this->connection);
		return $result;
	}
	function savePage($id,$title, $type, $category, $date, $text, $imagepath, $autor){
		if(!empty($id)){ //modify A NEW ARTICLE
			$result = $this->connection->query("UPDATE `PAGES` SET `TITLE`='$title',`TYPE`=$type,`CATEGORY`=$category,`CONTENT`='$text',`IMAGEHEADER`='$imagepath' WHERE `ID`=$id;");
		}else{	//create ONE
			$result = $this->connection->query("INSERT INTO `PAGES`(`ID`, `TITLE`, `TYPE`, `CATEGORY`, `DATE`, `CONTENT`, `IMAGEHEADER`, `AUTOR`) VALUES (NULL, '$title','$type',$category,'$date','$text','$imagepath','$autor')");
		}
		echo mysqli_error($this->connection);
		return $result;
	}

	/*ACTIONS RECORD*/
	function getAllRecords(){
		return $this->connection->query(" SELECT * FROM RECORD ORDER BY DATE;");
	}
	function getLastRecords(){
		return $this->connection->query(" SELECT * FROM RECORD ORDER BY DATE LIMIT 10;");
	}
	function logRecord($action,$autor,$reciber,$context){
		$date = new DateTime();
		return $this->connection->query("INSERT INTO `RECORD`(`ID`, `ACTION`, `AUTOR`, `RECIBER`, `RECIBERCONTEXT`, `DATE`) VALUES (NULL, '$action','$autor','$reciber','$context','".$date->format('Y-m-d H:i:s')."')");
	}

	#region Log
	function addLogException(Exception $exception){
		return $this->addLog(LogLevels::ERROR, $exception->getMessage(), $exception->getFile(), $exception->getLine(),
		   $exception->getTraceAsString());
	}
	function addLog(int $level, string $message, string $file = "", string $line = "", string $proccess = ""){
		$date = new DateTime();
		return $this->connection->query("INSERT INTO `LOG` (`ID`, `LEVEL`, `MESSAGE`, `FILE`, `LINE`, `PROCCESS`, `SESSION_VALUE`, `DATE`) 
			VALUES (NULL, '$level', '$message', '$file', '$line', '$proccess', '".serialize($_SESSION)."', '".$date->format('Y-m-d H:i:s')."')");
	}
	function getLastLogs($last){
		if(!is_int($last)) $last = 10;
		return $this->connection->query("SELECT * FROM LOG ORDER BY DATE LIMIT $last;");
	}
	#endregion
}

?>
