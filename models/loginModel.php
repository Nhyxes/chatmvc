<?php

class loginModel extends Model
{

	public function __construct()
	{
	}

	// Fonction qui verifie si l'utilisateur existe dans la base de données pour la fonction pour login
	public function existsUser($pseudo, $password)
	{
		$sql = "SELECT id FROM users WHERE username = :pseudo AND password = :password ";
		$stmt = $this->_connection->prepare($sql);
		$stmt->bindParam(':pseudo', $pseudo);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

		/** Plus courte et sera utilisé pour les suivantes : 
		$stmt = $this->_connection->prepare("SELECT id FROM users WHERE username = :pseudo AND password = :password ");
		$stmt->execute(array(':pseudo' => $pseudo, ':password' => $password));
		return $stmt->fetch(PDO::FETCH_ASSOC);

		ou bien 

		    $stmt = $this->_connection->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
			$stmt->execute(array($pseudo, $password));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		 */
	}
	//----------------------------------------------------------------

	// Fonction qui verifie pour la fonction createUser si dans la base de données un user existe deja avec le pseudo ou l'email entré
	private function issetUserOrEmail($pseudo, $email){
		$stmt = $this->_connection->prepare("SELECT COUNT(*) FROM users WHERE pseudo = ? OR email = ?"); 
		$stmt->execute(array($pseudo, $email));
		$count =  $stmt->fetchColumn();

		return $count > 0;
	}

	// Fonction createUser qui permet de creer un utilisateur
	public function createUser($pseudo, $password, $email)
	{
		if($this->issetUserOrEmail($pseudo,$email)){
			return FALSE;
		}

		$stmt = $this->_connection->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email");

		return $stmt->execute(array(':username' => $pseudo, ':password' => $password, ':email' => $email));

	}
	//----------------------------------------------------------------

	// Fonction issetuser verifie pour retrive password si le peudo et l'email existe dans la bse de donnée donc si un utilisateur existe

	private function issetUser($pseudo, $email){
		$stmt = $this->_connection->prepare("SELECT COUNT(*) FROM users WHERE ursername = ? AND email = ?");

		return $stmt->execute(array($pseudo, $email));
	}

	public function retrievePassword($pseudo, $email, $password)
	{
		if (!$this->issetUser($pseudo, $email)){
			return FALSE;
		}

		$stmt = $this->_connection->prepare("UPDATE users SET password = :password WHERE email = :email");
		$stmt->execute(array(':email' => $email, ':password' => $password));
	}
}
