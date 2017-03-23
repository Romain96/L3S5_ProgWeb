<?php

require_once 'models/model_base.php';

/**
* classe Vidéo représente la table Videos
*/
class Video extends Model_Base
{
	private $_nom;
	private $_description;
	private $_duree;
	private $_premiere_diffusion;
	private $_derniere_diffusion;
	private $_pays;
	private $_multi_langue;
	private $_format_image;
	private $_nom_emission;
	private $_numero;
	private $_disponibilite;
	private $_vues;

	public function __construct( array $data )
	{
		$this->set_nom($data['NOM']);
		$this->set_description($data['DESCRIPTION']);
		$this->set_duree($data['DUREE']);
		$this->set_premiere_diffusion($data['PREMIERE_DIFFUSION']);
		$this->set_derniere_diffusion($data['DERNIERE_DIFFUSION']);
		$this->set_pays($data['PAYS']);
		$this->set_multi_langue($data['MULTI_LANGUE']);
		$this->set_format_image($data['FORMAT_IMAGE']);
		$this->set_nom_emission($data['NOM_EMISSION']);
		$this->set_numero($data['NUMERO']);
		$this->set_disponibilite($data['DISPONIBILITE']);
		$this->set_vues($data['VUES']);
	}

	/**
	 * Crée une nouvelle vidéo
	 */
	public static function creer_video( array $data )
	{
		$u = new Video( $data );
		$q = self::$_db->prepare('INSERT INTO Videos( nom, description, duree, premiere_diffusion,
			derniere_diffusion, pays, multi_langue, format_image, nom_emission, numero, disponibilite, vues )
			 values( :nom, :description, :duree, :premiere_diffusion, to_date(:derniere_diffusion, \'DD/MM/YYYY\'),
				 :pays, :multi_langue, :format_image, :nom_emission, :numero, to_date(:disponibilite,\'DD/MM/YYYY\'), :vues )' );
		$q->bindParam(':nom', $u->get_nom(), PDO::PARAM_STR );
		$q->bindParam(':description', $u->get_description(), PDO::PARAM_STR );
		$q->bindParam(':duree', intval($u->get_duree()), PDO::PARAM_INT );
		$q->bindParam(':premiere_diffusion', intval($u->get_premiere_diffusion()), PDO::PARAM_INT );
		$q->bindParam(':derniere_diffusion', $u->get_derniere_diffusion(), PDO::PARAM_STR );
		$q->bindParam(':pays', $u->get_pays(), PDO::PARAM_STR );
		$q->bindParam(':multi_langue', intval($u->get_multi_langue()), PDO::PARAM_INT );
		$q->bindParam(':format_image', $u->get_format_image(), PDO::PARAM_STR );
		$q->bindparam(':nom_emission', $u->get_nom_emission(), PDO::PARAM_STR );
		$q->bindParam(':numero', intval($u->get_numero()), PDO::PARAM_INT );
		$q->bindParam(':disponibilite', $u->get_disponibilite(), PDO::PARAM_STR );
		$q->bindParam(':vues', intval($u->get_vues()), PDO::PARAM_INT );
		$q->execute();
		return $u;
	}

	/**
	 * retourne la vidéo correspondant au nom ou NULL si elle n'existe pas
	 */
	public static function get_by_nom( $nom )
	{
		if(is_string( $nom ) )
		{
			$q = self::$_db->prepare( 'SELECT * FROM Videos WHERE nom LIKE :nom' );
			$q->bindParam( ':nom', $nom, PDO::PARAM_STR );
			$q->execute();
			if( $data = $q->fetch(PDO::FETCH_ASSOC) )
			{
				return new Video( $data );
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
	 * Retourne toutes les vidéos
	 */
	public static function get_all()
	{
		$p = array();
		$q = self::$_db->prepare( 'SELECT * FROM Videos ORDER BY nom' );
		$q->execute();
		while( $data = $q->fetch(PDO::FETCH_ASSOC) )
		{
			$p[] = new Video( $data );
		}
		return $p;
	}

	/**
	 * retourne la vidéo correspondant au nom ou NULL si elle n'existe pas
	 */
	public static function get_by_nom_emission( $nom_emission )
	{
		if(is_string( $nom_emission ) )
		{
			$p = array();
			$q = self::$_db->prepare( 'SELECT * FROM Videos WHERE nom_emission LIKE :nom_emission' );
			$q->bindParam( ':nom_emission', $nom_emission, PDO::PARAM_STR );
			$q->execute();
			while( $data = $q->fetch(PDO::FETCH_ASSOC) )
			{
				$p[] = new Video( $data );
			}
			return $p;
		}
		else
		{
			return null;
		}
	}

	/**
	 * Retourne/modifie le nom de la vidéo
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
	 * Retourne/modifie la description
	 */
	public function get_description()
	{
		return $this->_description;
	}

	public function set_description( $description )
	{
		if( is_string( $description ) )
		{
			$this->_description = $description;
		}
	}

	/**
	 * Retourne/modifie la durée
	 */
	public function get_duree()
	{
		return $this->_duree;
	}

	public function set_duree( $duree )
	{
		if( is_string( $duree ) )
		{
			$this->_duree = $duree;
		}
	}

	/**
	 * Retourne/modifie la date de premiere diffusion
	 */
	public function get_premiere_diffusion()
	{
		return $this->_premiere_diffusion;
	}

	public function set_premiere_diffusion( $premiere_diffusion )
	{
		if( is_string( $premiere_diffusion ) )
		{
			$this->_premiere_diffusion = $premiere_diffusion;
		}
	}

	/**
	 * Retourne/modifie la date de dernière diffusion
	 */
	public function get_derniere_diffusion()
	{
		return $this->_derniere_diffusion;
	}

	public function set_derniere_diffusion( $derniere_diffusion )
	{
		if( is_string( $derniere_diffusion ) )
		{
			$this->_derniere_diffusion = $derniere_diffusion;
		}
	}

	/**
	 * Retourne/modifie le pays
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
	 * Retourne/modifie le multi-langue
	 */
	public function get_multi_langue()
	{
		return $this->_multi_langue;
	}

	public function set_multi_langue( $multi_langue )
	{
		if( is_string( $multi_langue ) )
		{
			$this->_multi_langue = $multi_langue;
		}
	}

	/**
	 * Retourne/modifie le format de l'image
	 */
	public function get_format_image()
	{
		return $this->_format_image;
	}

	public function set_format_image( $format_image )
	{
		if( is_string( $format_image ) )
		{
			$this->_format_image = $format_image;
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
	 * Retourne/modifie le numéro de la vidéo
	 */
	public function get_numero()
	{
		return $this->_numero;
	}

	public function set_numero( $numero )
	{
		if( is_string( $numero ) )
		{
			$this->_numero = $numero;
		}
	}

	/**
	 * Retourne/modifie la disponibilité de la vidéo
	 */
	public function get_disponibilite()
	{
		return $this->_disponibilite;
	}

	public function set_disponibilite( $disponibilite )
	{
		if( is_string( $disponibilite ) )
		{
			$this->_disponibilite = $disponibilite;
		}
	}

	/**
	 * Retourne/modifie le nombre de vues de la vidéo
	 */
	public function get_vues()
	{
		return $this->_vues;
	}

	public function set_vues( $vues )
	{
		if( is_string( $vues ) )
		{
			$this->_vues = $vues;
		}
	}

	/**
	 * sauvegarde la vidéo dans la base de données
	 */
	public function sauvegarder_video()
	{
		if( !is_null( $this->nom ) )
		{
			$q = self::$_db->prepare('UPDATE Videos( nom, description, duree, premiere_diffusion, derniere_diffusion,
				pays, multi_langue, format_image, nom_emission, numero, disponibilite, vues )
				VALUES( :nom, :description, :duree, :premiere_diffusion, :derniere_diffusion, :pays,
					:multi_langue, :format_image, :nom_emission, :numero, :disponibilite, :vues )');
			$q->bindParam(':nom', $u->get_nom(), PDO::PARAM_STR );
			$q->bindParam(':description', $u->get_description(), PDO::PARAM_STR );
			$q->bindParam(':duree', intval($u->get_duree()), PDO::PARAM_INT );
			$q->bindParam(':premiere_diffusion', $u->get_premiere_diffusion(), PDO::PARAM_STR );
			$q->bindParam(':derniere_diffusion', $u->get_derniere_diffusion(), PDO::PARAM_STR );
			$q->bindParam(':pays', $u->get_pays(), PDO::PARAM_STR );
			$q->bindParam(':multi_langue', intval($u->get_multi_langue()), PDO::PARAM_INT );
			$q->bindParam(':format_image', $u->get_format_image(), PDO::PARAM_STR );
			$q->bindparam(':nom_emission', $u->get_nom_emission(), PDO::PARAM_STR );
			$q->bindParam(':numero', intval($u->get_numero()), PDO::PARAM_INT );
			$q->binbParam(':disponibilite', $u->get_disponibilite(), PDO::PARAM_STR );
			$q->bindParam(':vues', intval($u->get_vues()), PDO::PARAM_INT );
			$q->execute();
		}
	}

	/**
	 * supprime la vidéo de la base de données
	 */
	public function supprimer_video( $nom )
	{
		if( !is_null( $nom ) )
		{
			$q = self::$_db->prepare( 'DELETE FROM Videos WHERE nom LIKE :nom' );
			$q->bindParam( ':nom', $nom );
			$q->execute();
			$this->_nom = null;
		}
	}
}
