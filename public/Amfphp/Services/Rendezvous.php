<?php

class Rendezvous {

    public function __construct(){
        $link = mysql_connect("localhost");
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		
		$db_selected = mysql_select_db("test", $link);
		if (!$db_selected) {
			die ('Can\'t use test : ' . mysql_error());
		}
	}

	//TOOD: ADD LOGIC TO NOT CONNECT WITH YOURSELF, AND TO CHECK MULTIPLES RESPONSES.
	
	public function match($user_name, $game_name, $number_of_players, $game_id) {
		
		//look for existing players waiting to play
		$games = mysql_query("SELECT match_id FROM games where game_name = '$game_name' AND number_of_players = '$number_of_players' 
		AND user != '$user_name' AND status <> 'playing'" );
		
		$row = mysql_fetch_row($games);
		
		$match_id = $row[0];
		
		$usersQuery = mysql_query("SELECT u.name from games g join users u on g.user = u.name where 
								  '$match_id' = match_id AND game_name = '$game_name' AND number_of_players = '$number_of_players' AND user != '$user_name' AND status <> 'playing'");
		
		//if no-one is there, I create the group
		if (mysql_num_rows($usersQuery) == 0) {
		
			$match_id = $this->createRoom();
			
		}
		
		mysql_query("INSERT INTO games (user, game_name, match_id, number_of_players)
								VALUES ('$user_name', '$game_name', '$match_id', '$number_of_players')");
								
		$usersData = array();

		while(($row =  mysql_fetch_assoc($usersQuery))) {
			$usersData[] = $row;
		}
			
		$matchData = array('match_id'=>$match_id, 'usersData'=>$usersData, 'gameName'=>$game_name, 'gameID'=>$game_id);
			
		return $matchData;
			

	}
	
	public function updateStatus($user_name, $match_id) {
	
		mysql_query("UPDATE games set status = 'connected' where match_id = '$match_id' AND user = '$user_name'");
		
		$connected_players = mysql_query("SELECT number_of_players FROM games where match_id = '$match_id' AND status = 'connected'");
		
		$row = mysql_fetch_row($connected_players);
		$number_of_players = $row[0];
		
		if(mysql_num_rows($connected_players) == $number_of_players){
		
			mysql_query("UPDATE games set status = 'playing' where match_id = '$match_id' AND status = 'connected'");
			
			$waiting_players = mysql_query("SELECT number_of_players FROM games where match_id = '$match_id' AND status = 'waiting'");
			
			if(mysql_num_rows($waiting_players) > 0){
				
				$new_match_id = $this->createRoom();
				
				mysql_query("UPDATE games set match_id = '$new_match_id' where match_id = '$match_id' AND status = 'waiting'");
			
			}
			
			
		}
	}
	
	private function createRoom(){
	
		$result = mysql_query("SELECT match_id FROM matches");
		$row = mysql_fetch_row($result);
		$match_id = $row[0];
		$match_id ++;               
			
		mysql_query("UPDATE matches set match_id = '$match_id'");
		
		return $match_id;
	
	}
	
	
	//to debug
	//throw new Exception(print_r($row, true));
	
	
}














?>