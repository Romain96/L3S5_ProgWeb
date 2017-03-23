<?php

require_once 'models/model_base.php';

/**
* classe Historique représente la table Historiques
*/
class Historique extends Model_Base
{
	private $_login;
	private $_nom_video;
	private $_date_visionnage;

	public function __construct( array $data )
	{
		$this->set_login($data['LOGIN']);
		$this->set_nom_video($data['NOM_VIDEO']);
		$this->set_date_visionnage($data['DATE_VISIONNAGE']);
	}

	/**
	 * Crée un nouvel historique
	 */
	public static function creer_historique( array $data )
	{
		$u = new Historique( $data );
		$q = self::$_db->prepare('INSERT INTO Historiques( login, nom_video, date_visionnage )
		VALUES( :login, :nom_video, to_date(SYSDATE,\'DD/MM/YYYY HH24:MI:SS\') )' );
		$q->bindParam(':login', $u->get_login(), PDO::PARAM_STR );
		$q->bindParam(':nom_video', $u->get_nom_video(), PDO::PARAM_STR );
		//$q->bindParam(':date_visionnage, $u->get_date_visionnage(), PDO::PARAM_STR );
		$q->execute();
		return $u;
	}

	/**
	 * Retourne toutes les vidéos
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Historiques ORDER BY nom_video' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Historique( $data );
		}
		return $p;
	}

	/**
	* retourne tous les historiques de l'utilisateur identifié par login
	*/
	public static function get_by_login( $login )
	{
		$n = array();
		$stmt = self::$_db->prepare('SELECT * FROM Historiques WHERE login LIKE :login');
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$n[] = new Historique($data);
		}
		return $n;
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
	 * Retourne/modifie le nom de la vidéo
	 */
	public function get_nom_video()
	{
		return $this->_nom_video;
	}

	public function set_nom_video( $nom_video )
	{
		if( is_string( $nom_video ) )
		{
			$this->_nom_video = $nom_video;
		}
	}

	/**
	 * Retourne/modifie la date de visionnage
	 */
	public function get_date_visionnage()
	{
		return $this->_date_visionnage;
	}

	public function set_date_visionnage( $date_visionnage )
	{
		if( is_string( $date_visionnage ) )
		{
			$this->_date_visionnage = $date_visionnage;
		}
	}

	/**
	 * sauvegarde la vidéo dans la base de données
	 */
	public function save()
	{
		if( !is_null( $this->nom ) )
		{
			$q = self::$_db->prepare('UPDATE Historiques( login, nom_video, date_visionnage )
			VALUES( :login, :nom_video, :date_visionnage' );
			$q->bindParam(':login', $this->get_login(), PDO::PARAM_STR );
			$q->bindParam(':nom_video', $this->get_nom_video(), PDO::PARAM_STR );
			$q->bindParam(':date_visionnage', $this->get_date_visionnage(), PDO::PARAM_STR );
			$q->execute();
		}
	}

	/**
	 * supprime l'émission de la base de données
	 */
	public function delete()
	{
		if( !is_null( $this->_nom ) )
		{
			$q = self::$_db->prepare( 'DELETE FROM Historiques WHERE login = :login' );
			$q->bindParam( ':login', $this->_login );
			$q->execute();
			$this->_nom = null;
		}
	}
}
