<?php

class Rendezvous {

    public function __construct(){
        $link = mysql_connect("localhost", "konkugam_pablo", "artemix22");
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		
		$db_selected = mysql_select_db("tecnocor_users", $link);
		if (!$db_selected) {
			die ('Can\'t use users : ' . mysql_error());
		}
	}

	public function match($name, $farID) {
		//look for existing players waiting to connect to someone
		$query = mysql_query("SELECT name, farID FROM users");
		
		if($query) {
			//if forever alone
			if (mysql_num_rows($query) == 0) {
				mysql_query("INSERT INTO users (name, farID)
									VALUES ('$name', '$farID')");
				return "waiting"; 					
			}
			//if someone is already waiting for you
			else {
				$aux = mysql_fetch_array($query, MYSQL_NUM);
				mysql_query("DELETE FROM users");
			}
			return $aux;
		}
	}
	
}
?>