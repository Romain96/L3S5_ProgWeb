<?php

require_once 'models/model_base.php';
require_once 'models/utilisateur.php';

/**
* classe Favori représente la table Favoris
*/
class Favori extends Model_Base
{
	private $_login;
	private $_nom_favori;

	public function __construct( array $data )
	{
		$this->set_login($data['LOGIN']);
		$this->set_nom_favori($data['NOM_FAVORI']);
	}

	/**
	 * Crée un nouveau favori
	 */
	public static function creer_favori( array $data )
	{
		$u = new Favori( $data );
		$q = self::$_db->prepare('INSERT INTO Favoris( login, nom_favori ) VALUES( :login, :nom_favori )' );
		$q->bindParam(':login', $u->get_login(), PDO::PARAM_STR );
		$q->bindParam(':nom_favori', $u->get_nom_favori(), PDO::PARAM_STR );
		$q->execute();
		return $u;
	}

	/**
	* retourne tous les favoris de l'utilisateur identifié par login
	*/
	public static function get_by_login( $login )
	{
		$n = array();
		$stmt = self::$_db->prepare('SELECT * FROM Favoris WHERE login LIKE :login');
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Favori($data);
		}
		return $n;
	}

	/**
	* retourne le favori identifié par le couple (login,nom_favori) ou NULL si non existant
	*/
	public static function get_by_login_nom_favori( $login, $nom_favori )
	{
		$stmt = self::$_db->prepare('SELECT * FROM Favoris WHERE login LIKE :login AND nom_favori LIKE :nom_favori');
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':nom_favori', $nom_favori, PDO::PARAM_STR);
		$stmt->execute();
		if( $data = $stmt->fetch(PDO::FETCH_ASSOC) )
		{
			return new Favori( $data );
		}
		else
		{
			return null;
		}
	}

	/**
	 * Retourne tous les favoris
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Favoris ORDER BY login' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Favori( $data );
		}
		return $p;
	}

	/**
	 * Retourne/modifie le login
	 */
	public function get_login()
	{
		return $this->_login;
	}

	public function set_login( $login )
	{
		if( is_string( $login ) )
		{
			$this->_login = $login;
		}
	}

	/**
	 * Retourne/modifie le nom du favori
	 */
	public function get_nom_favori()
	{
		return $this->_nom_favori;
	}

	public function set_nom_favori( $nom_favori )
	{
		if( is_string( $nom_favori ) )
		{
			$this->_nom_favori = $nom_favori;
		}
	}

	/**
	 * sauvegarde la vidéo dans la base de données
	 */
	public function save()
	{
		if( !is_null( $this->nom ) )
		{
			$q = self::$_db->prepare('UPDATE Favoris( login, nom_favori ) VALUES( :login, :nom_favori )' );
			$q->bindParam(':login', $this->get_login(), PDO::PARAM_STR );
			$q->bindParam(':nom_favori', $this->get_nom_favori(), PDO::PARAM_STR );
			$q->execute();
		}
	}

	/**
	 * supprime l'émission de la base de données
	 */
	public function supprimer_favori( $data )
	{
		if( !is_null( $data ) )
		{
			$q = self::$_db->prepare( 'DELETE FROM Favoris WHERE login LIKE :login AND nom_favori LIKE :nom_favori' );
			$q->bindParam( ':login', $data['LOGIN'] );
			$q->bindParam( ':nom_favori', $data['NOM_FAVORI'] );
			$q->execute();
			$this->_nom = null;
		}
	}
}
