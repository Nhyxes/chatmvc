<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class loginModel extends Model
{
	protected $dbh;

	public function __construct()
	{
		parent::__construct(); // Appel du constructeur de la classe parente
		$this->dbh = $this->getConnection();
	}

	// Fonction qui verifie si l'utilisateur existe dans la base de données pour la fonction pour login
	public function existsUser($username, $password)
	{

		$sql = "SELECT user_id, user_password FROM users WHERE user_name = :username";

		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);

		if (!empty($result) && password_verify($password, $result->user_password)) {
			return $result->user_id;
		} else {
			return 0;
		}
	}



	/** Plus courte et sera utilisé pour les suivantes : 
		$stmt = $this->_connection->prepare("SELECT id FROM users WHERE username = :pseudo AND password = :password ");
		$stmt->execute(array(':pseudo' => $pseudo, ':password' => $password));
		return $stmt->fetch(PDO::FETCH_ASSOC);

		ou bien 

		    $stmt = $this->_connection->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
			$stmt->execute(array($pseudo, $password));
			return $stmt->fetch(PDO::FETCH_ASSOC);
	 */
	//----------------------------------------------------------------

	// Fonction qui verifie pour la fonction createUser si dans la base de données un user existe deja avec le pseudo ou l'email entré
	private function issetUserOrEmail($pseudo, $email)
	{
		$stmt = $this->dbh->prepare("SELECT COUNT(*) FROM users WHERE user_name = ? OR user_email = ?");
		$stmt->execute(array($pseudo, $email));
		$count = $stmt->fetchColumn();

		return $count > 0;
	}

	// Fonction createUser qui permet de creer un utilisateur
	public function createUser($pseudo, $password, $email)
	{
		if ($this->issetUserOrEmail($pseudo, $email) == true) {
			return 0;
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $this->dbh->prepare("INSERT INTO users (user_name, user_password, user_email) VALUES (:username, :password, :email)");
			$stmt->bindParam(':username', $pseudo);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
		}


		$lastInsertId = $this->getConnection()->lastInsertId();

		if ($lastInsertId > 0) {
			return $lastInsertId;
		} else {
			return 0;
		}
	}


	//		$result = $this->dbh->lastInsertId();
	//----------------------------------------------------------------

	// Fonction issetuser verifie pour retrive password si le pseudo et l'email existe dans la bse de donnée donc si un utilisateur existe

	private function issetUser($pseudo, $email)
	{
		$stmt = $this->dbh->prepare("SELECT COUNT(*) FROM users WHERE user_name = ? AND user_email = ?");

		$stmt->execute(array($pseudo, $email));
		$count = $stmt->fetchColumn();
		echo '<script>alert("isset User bien deroulé");</script>';
		return $count > 0;
	}

	public function retrievePassword($pseudo, $email, $password)
	{
		if ($this->issetUser($pseudo, $email) == false) {
			return false;
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $this->dbh->prepare("UPDATE users SET user_password = :password WHERE user_email = :email");
			$stmt->execute(array(':email' => $email, ':password' => $password));
			return true;
		}
	}
}
