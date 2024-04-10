<?php

class chatModel extends Model
{

	public function __construct()
	{
	}

	public function insertMessage(int $userId, int $roomId, string $message): string
	{
		 // Cette fonction integrera des messages au rooms donnée en fonction des userid
		// et va donc devoir les recevoir de chat controller 
		// et integrer cela dans la table messagesen fonction des données
		$stmt = $this->_connection->prepare("INSERT INTO messages (user_id ,room_id ,msg_text, msg_color) VALUES (:user_id ,:room_id ,:msg_text");

		$stmt->execute(array(':user_id' => $userId, ':room_id' => $roomId, ':msg_text' => $message, ':msg_color' => $_SESSION['color']));

		return 0;

		// fonction a finir il faut quelle renvoie un string je ne sais pas encore lequel
		
	}

}
