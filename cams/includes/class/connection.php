<?php
/**
 * @method
 * @
 */
class Connection{
  var $time;
  var $user;
  var $type;
  var $userid;

  function __construct($user, $type, $userid){
    $this->user = $user;
    $this->type = $type;
    $this->time = time();
    $this->userid = $userid;
  }

  function timeout(){ //checks if actual connection is in timeout
    if ( (time()-$this->time) > 3600) {//if last interaction was more than 1h, this sesion should be closed
      return true;
    }
    else {
      return false;
    }
  }

  function keepalive(){//update time without activity
    $this->time = time();
  }
  function isAdmin(){
		if ($this->type == 0){
			return true;
		}
		return false;
	}
}
?>
