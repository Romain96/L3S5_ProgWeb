<?php

require_once 'models/model_base.php';

/**
* classe Utilisateur représente la table Utilisateurs
*/
class Utilisateur extends Model_Base
{
	private $_login;
	private $_mdp;
	private $_prenom;
	private $_nom;
	private $_naissance;
	private $_email;
	private $_pays;
	private $_newsletter;

	public function __construct( array $data )
	{
		$this->set_login($data['LOGIN']);
		$this->set_mdp($data['MDP']);
		$this->set_prenom($data['PRENOM']);
		$this->set_nom($data['NOM']);
		$this->set_date_naissance($data['DATE_NAISSANCE']);
		$this->set_email($data['EMAIL']);
		$this->set_pays($data['PAYS']);
		$this->set_newsletter($data['NEWSLETTER']);
	}

	/**
	 * Crée un nouvel utilisateur
	 */
	public static function creer_utilisateur( array $data )
	{
		$u = new Utilisateur( $data );
		$stmt = self::$_db->prepare( 'INSERT INTO Utilisateurs( login, mdp, prenom, nom, date_naissance, email, pays, newsletter )
		VALUES( :login, :mdp, :prenom, :nom, to_date(:naissance, \'DD/MM/YYYY\'), :adresse, :pays, :newsletter )' );
		$stmt->bindValue(':login', $u->get_login(), PDO::PARAM_STR );
		$stmt->bindValue(':mdp', $u->get_mdp(), PDO::PARAM_STR );
		$stmt->bindValue(':prenom', $u->get_prenom(), PDO::PARAM_STR );
		$stmt->bindValue(':nom', $u->get_nom(), PDO::PARAM_STR );
		$stmt->bindValue(':naissance', $u->get_date_naissance(), PDO::PARAM_STR );
		$stmt->bindValue(':adresse', $u->get_email(), PDO::PARAM_STR );
		$stmt->bindValue(':pays', $u->get_pays(), PDO::PARAM_STR );
		$stmt->bindValue(':newsletter', intval($u->get_newsletter()), PDO::PARAM_INT );
		$stmt->execute();
		return $u;
	}

	/**
	 * retourne l'utilisateur correspondant au login ou NULL s'il n'existe pas
	 */
	public static function get_by_login( $login )
	{
		if(is_string( $login ) )
		{
			$q = self::$_db->prepare( "SELECT * FROM Utilisateurs WHERE LOGIN LIKE :login" );
			$q->bindParam( ':login', $login, PDO::PARAM_STR );
			$q->execute();
			if( $data = $q->fetch(PDO::FETCH_ASSOC) )
			{
				return new Utilisateur( $data );
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}

	/**
	 * Retourne tous les utilisateurs
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Utilisateurs ORDER BY LOGIN' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Utilisateur( $data );
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
	 * retourne/modifie le mot de passe
	 */
	public function get_mdp()
	{
		return $this->_mdp;
	}

	public function set_mdp( $mdp )
	{
		if( is_string( $mdp ) )
		{
			$this->_mdp = $mdp;
		}
	}

	/**
	 * retourne/modifie le prenom
	 */
	public function get_prenom()
	{
		return $this->_prenom;
	}

	public function set_prenom( $prenom )
	{
		if( is_string( $prenom ) )
		{
			$this->_prenom = $prenom;
		}
	}

	/**
	 * retourne/modifie le nom
	 */
	public function get_nom()
	{
		return $this->_nom;
	}

	public function set_nom( $nom )
	{
		if( is_string( $nom ) )
		{
			$this->_nom = $nom;
		}
	}

	/**
	 * retourne/modifie la date de naissance
	 */
	public function get_date_naissance()
	{
		return $this->_naissance;
	}

	public function set_date_naissance( $date_naissance )
	{
		if( is_string( $date_naissance ) )
		{
			$this->_naissance = $date_naissance;
		}
	}

	/**
	 * retourne/modifie l'email
	 */
	public function get_email()
	{
		return $this->_email;
	}

	public function set_email( $email )
	{
		if( is_string( $email ) )
		{
			$this->_email = $email;
		}
	}

	/**
	 * retourne/modifie le pays
	 */
	public function get_pays()
	{
		return $this->_pays;
	}

	public function set_pays( $pays )
	{
		if( is_string( $pays ) )
		{
			$this->_pays = $pays;
		}
	}

	/**
	 * retourne/modifie la newsletter
	 */
	public function get_newsletter()
	{
		return $this->_newsletter;
	}

	public function set_newsletter( $newsletter )
	{
		if( is_string( $newsletter ) )
		{
			$this->_newsletter = $newsletter;
		}
	}

	/**
	 * sauvegarde l'utilisateur dans la base de données
	 */
	public function sauvegarder_utilisateur( $data )
	{
		$u = new Utilisateur( $data );
		$stmt = self::$_db->prepare( 'UPDATE Utilisateurs SET mdp = :mdp, prenom = :prenom, nom = :nom,
			date_naissance = to_date(:naissance, \'DD/MM/YYYY\'), email = :email,
			pays = :pays, newsletter = :newsletter WHERE login LIKE :login' );
		$stmt->bindValue(':login', $u->get_login(), PDO::PARAM_STR );
		$stmt->bindValue(':mdp', $u->get_mdp(), PDO::PARAM_STR );
		$stmt->bindValue(':prenom', $u->get_prenom(), PDO::PARAM_STR );
		$stmt->bindValue(':nom', $u->get_nom(), PDO::PARAM_STR );
		$stmt->bindValue(':naissance', $u->get_date_naissance(), PDO::PARAM_STR );
		$stmt->bindValue(':email', $u->get_email(), PDO::PARAM_STR );
		$stmt->bindValue(':pays', $u->get_pays(), PDO::PARAM_STR );
		$stmt->bindValue(':newsletter', intval($u->get_newsletter()), PDO::PARAM_INT );
		$stmt->execute();
	}

	/**
	 * supprime l'utilisateur de la base de données
	 */
	public function supprimer_utilisateur( $login )
	{
		if( !is_null( $login ) )
		{
			$stmt = self::$_db->prepare( 'DELETE FROM Utilisateurs WHERE LOGIN LIKE :login' );
			$stmt->bindParam( ':login', $login );
			$stmt->execute();
			$this->_login = null;
		}
	}
}
