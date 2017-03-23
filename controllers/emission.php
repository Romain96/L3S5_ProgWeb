<?php

require_once 'models/emission.php';     // classe émission
require_once 'models/video.php';         // classe vidéo
require_once 'models/video_archive.php';
require_once 'models/utilisateur.php';

class Controller_Emission
{
        public function __construct()
        {}

        // fonction de création d'une émission
        public function creer_emission()
        {
                switch( $_SERVER['REQUEST_METHOD'] )
                {
                        case 'POST':
                                if( isset($_POST['NOM_EMISSION']) and isset($_POST['CATEGORIE']) )
                                {
                                        // on recherche le login
                                        $e = Emission::get_by_nom( $_POST['NOM_EMISSION'] );
                                        if( is_null($e) )
                                        {
                                                Emission::creer_emission( array( 'NOM_EMISSION' => $_POST['NOM_EMISSION'],
                                                                'CATEGORIE' => $_POST['CATEGORIE']
                                                        ) );
                                                        message('Sucess ', 'L\'émission '.$_POST['NOM_EMISSION'].' a été créée avec succès');
                                                        header('Location: '.BASEURL.'/index.php/emission/toutes_les_emissions_admin');
                                                        exit;
                                        }
                                        else
                                        {
                                                // s'il existe on ne le créera pas puisque le login est unique
                                                message('Erreur', 'L\'émission \''.$_POST['NOM_EMISSION'].'\' existe déjà !');
						header('Location: '.BASEURL.'/index.php/emission/creer_emission');
						exit;
                                        }
                                }
                                else
                                {
                                        http_response_code(400);
					include('views/errors/400.php');
                                }
                                break;
                        case 'GET':
                                include 'views/emission/ajouter_emission.php';
                                break;
                }
        }

        // fonction de récupération des émissions
        public function lister_emissions()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $emissions = Emission::get_all();
                        include 'views/emission/toutes_les_emissions.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction de récupération de toutes les émissions (administrateur seulement)
        public function lister_emissions_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $emissions = Emission::get_all();
                        include 'views/emission/toutes_les_emissions_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage d'une émission
        public function afficher_emission()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $emission = Emission::get_by_nom( $_POST['nom_emission'] );
                        include 'views/emission/afficher_emission.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage d'une émission (admin)
        public function afficher_emission_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $emission = Emission::get_by_nom( $_POST['nom_emission'] );
                        include 'views/emission/afficher_emission_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }


        // fonction de supprimer une émission (admin)
        public function supprimer_emission()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $vids = Video::get_by_nom_emission( $_POST['nom_emission'] );
                        $vids_arch = VideoArchive::get_all_by_nom_emission( $_POST['nom_emission'] );
                        foreach( $vids as $vid )
                                Video::supprimer_video( $vid->get_nom() );
                        foreach( $vids_arch as $vid_arch )
                                VideoArchive::supprimer_video( $vid->get_nom() );
                        Emission::supprimer_emission( $_POST['nom_emission'] );
                        message('success', 'L\'émission '.$_POST['nom_emission'].' a bien été supprimée');
                        header('Location: '.BASEURL);
                        exit;
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }


}
