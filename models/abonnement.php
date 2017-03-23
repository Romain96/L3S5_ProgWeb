<?php

require_once 'models/model_base.php';

/**
* classe Abonnement représente la table Abonnements
*/
class Abonnement extends Model_Base
{
	private $_login;
	private $_nom_emission;

	public function __construct( array $data )
	{
		$this->set_login($data['LOGIN']);
		$this->set_nom_emission($data['NOM_EMISSION']);
	}

	/**
	 * Crée un nouvel abonnement
	 */
	public static function creer_abonnement( array $data )
	{
		$u = new Abonnement( $data );
		$q = self::$_db->prepare('INSERT INTO Abonnements( login, nom_emission )
		VALUES( :login, :nom_emission )' );
		$q->bindParam(':login', $u->get_login(), PDO::PARAM_STR );
		$q->bindParam(':nom_emission', $u->get_nom_emission(), PDO::PARAM_STR );
		$q->execute();
		return $u;
	}

	/**
	 * Retourne toutes les vidéos
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Abonnements ORDER BY nom_emission' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Abonnement( $data );
		}
		return $p;
	}

	/**
	* retourne tous les abonnements de l'utilisateur login
	*/
	public static function get_by_login( $login )
	{
		$n = array();
		$stmt = self::$_db->prepare('SELECT * FROM Abonnements WHERE login LIKE :login');
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Abonnement($data);
		}
		return $n;
	}

	/**
	* retourne l'inique abonnement identifié par le couple (login,nom_emission) ou null si non existant
	*/
	public static function get_by_login_nom_emission( $login, $nom_emission )
	{
		$stmt = self::$_db->prepare('SELECT * FROM Abonnements WHERE login LIKE :login AND nom_emission LIKE :nom_emission');
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':nom_emission', $nom_emission, PDO::PARAM_STR);
		$stmt->execute();
		if( $data = $stmt->fetch(PDO::FETCH_ASSOC) )
		{
			return new Abonnement( $data );
		}
		else
		{
			return null;
		}
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
	 * Retourne/modifie le nom de l'émission
	 */
	public function get_nom_emission()
	{
		return $this->_nom_emission;
	}

	public function set_nom_emission( $nom_emission )
	{
		if( is_string( $nom_emission ) )
		{
			$this->_nom_emission = $nom_emission;
		}
	}

	/**
	 * sauvegarde la vidéo dans la base de données
	 */
	public function save()
	{
		if( !is_null( $this->nom ) )
		{
			$q = self::$_db->prepare('UPDATE Abonnements( login, nom_emission )
			VALUES( :login, :nom_emission )' );
			$q->bindParam(':login', $this->get_login(), PDO::PARAM_STR );
			$q->bindParam(':nom_emission', $this->get_nom_emission(), PDO::PARAM_STR );
			$q->execute();
		}
	}

	/**
	 * supprime l'émission de la base de données
	 */
	public function supprimer_abonnement( $data )
	{
		if( !is_null( $data ) )
		{
			$q = self::$_db->prepare( 'DELETE FROM Abonnements WHERE nom_emission LIKE :nom_emission and login LIKE :login' );
			$q->bindParam( ':login', $data['LOGIN']);
			$q->bindParam( ':nom_emission', $data['NOM_EMISSION'] );
			$q->execute();
			$this->_nom = null;
		}
	}
}
