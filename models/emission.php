<?php

require_once 'models/model_base.php';

/**
* classe Emission représente la table Emissions
*/
class Emission extends Model_Base
{
	private $_nom_emission;
	private $_categorie;

	public function __construct( array $data )
	{
		$this->set_nom_emission($data['NOM_EMISSION']);
		$this->set_categorie($data['CATEGORIE']);
	}

	/**
	 * Crée une nouvelle émission
	 */
	public static function creer_emission( array $data )
	{
		$u = new Emission( $data );
		$q = self::$_db->prepare('INSERT INTO Emissions( nom_emission, categorie )
		VALUES( :nom_emission, :categorie )' );
		$q->bindParam(':nom_emission', $u->get_nom_emission(), PDO::PARAM_STR );
		$q->bindParam(':categorie', $u->get_categorie(), PDO::PARAM_STR );
		$q->execute();
		return $u;
	}

	/**
	 * retourne la vidéo correspondant au nom ou NULL si elle n'existe pas
	 */
	public static function get_by_nom( $nom_emission )
	{
		if(is_string( $nom_emission ) )
		{
			$q = self::$_db->prepare( 'SELECT * FROM Emissions WHERE nom_emission = :nom_emission' );
			$q->bindParam( ':nom_emission', $nom_emission, PDO::PARAM_STR );
			$q->execute();
			if( $data = $q->fetch(PDO::FETCH_ASSOC) )
			{
				return new Emission( $data );
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
	 * Retourne toutes les émissions
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Emissions ORDER BY categorie' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Emission( $data );
		}
		return $p;
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
	 * Retourne/modifie la catégorie
	 */
	public function get_categorie()
	{
		return $this->_categorie;
	}

	public function set_categorie( $categorie )
	{
		if( is_string( $categorie ) )
		{
			$this->_categorie = $categorie;
		}
	}


	/**
	 * sauvegarde la vidéo dans la base de données
	 */
	public function sauvegarder_emission()
	{
		if( !is_null( $this->nom ) )
		{
			$q = self::$_db->prepare('UPDATE Emissions( nom_emission, categorie )
			VALUES( :nom_emission, :categorie )' );
			$q->bindParam(':nom_emission', $this->get_nom_emission(), PDO::PARAM_STR );
			$q->bindParam(':categorie', $this->get_categorie(), PDO::PARAM_STR );
			$q->execute();
		}
	}

	/**
	 * supprime l'émission de la base de données
	 */
	public function supprimer_emission( $nom_emission )
	{
		if( !is_null( $nom_emission ) )
		{
			$q = self::$_db->prepare( 'DELETE FROM Emissions WHERE nom_emission = :nom_emission' );
			$q->bindParam( ':nom_emission', $nom_emission );
			$q->execute();
			$this->_nom = null;
		}
	}
}
