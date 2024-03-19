<?php
class Model
{
	// Informations de la base de données
	const DB_HOST = 'localhost';
	const DB_USER = 'root';
	const DB_PASS = 'root';
	const DB_NAME = 'messagerie';

	// Propriété qui contient l'instance de la connexion
	protected $_connection;

	// Propriétés permettant de personnaliser les requêtes
	public $table;
	public $id;

	/** Constructeur */
	public function __construct()
	{
		try {
			$this->_connection = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
		} catch (PDOException $exception) {
			echo "Erreur de connexion : " . $exception->getMessage();
		}
	}

	/**
	 * Getter 
	 *
	 //@return objet PDO
	 */
	public function getConnection()
	{
		return $this->_connection;
	}

	/**
	 * Méthode permettant d'obtenir un enregistrement de la table choisie en fonction d'un id
	 */

	public function getOne()
	{
		$sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id;
		$query = $this->_connection->prepare($sql);
		$query->execute();
		return $query->fetch();
	}

	/**
	 * Méthode permettant d'obtenir tous les enregistrements de la table choisie
	 */
	public function getAll(): array
	{
		$sql = "SELECT * FROM " . $this->table;
		$query = $this->_connection->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	/**
	 * Retourne un article en fonction de son slug
	 *
	 * @param string $slug
	 * @return void
	 */
	public function findBySlug(string $slug)
	{
		$sql = "SELECT * FROM " . $this->table . " WHERE `slug`='" . $slug . "'";
		$query = $this->_connection->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}
