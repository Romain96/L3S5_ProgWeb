<?php

require_once 'models/utilisateur.php';  // classe utilisateur
require_once 'models/video.php';         // classe vidéo

class Controller_Video
{
        public function __construct()
        {}

        // fonction de création d'une vidéo
        public function creer_video()
        {
                switch( $_SERVER['REQUEST_METHOD'] )
                {
                        case 'POST':
                                if( isset($_POST['NOM']) and isset($_POST['DESCRIPTION']) and
                                 isset($_POST['DUREE']) and isset($_POST['PREMIERE_DIFFUSION']) and
                                 isset($_POST['DERNIERE_DIFFUSION']) and isset($_POST['PAYS']) and
                                 isset($_POST['MULTI_LANGUE']) and isset($_POST['FORMAT_IMAGE']) and
                                 isset($_POST['NOM_EMISSION']) and isset($_POST['NUMERO']) and
                                 isset($_POST['DISPONIBILITE']) and isset($_POST['VUES'])
                                 )
                                {
                                        // on recherche le login
                                        $e = Video::get_by_nom( $_POST['NOM'] );
                                        if( is_null($e) )
                                        {
                                                Video::creer_video( array( 'NOM' => $_POST['NOM'],
                                                                'DESCRIPTION' => $_POST['DESCRIPTION'],
                                                                'DUREE' => $_POST['DUREE'],
                                                                'PREMIERE_DIFFUSION' => $_POST['PREMIERE_DIFFUSION'],
                                                                'DERNIERE_DIFFUSION' => $_POST['DERNIERE_DIFFUSION'],
                                                                'PAYS' => $_POST['PAYS'],
                                                                'MULTI_LANGUE' => $_POST['MULTI_LANGUE'],
                                                                'FORMAT_IMAGE' => $_POST['FORMAT_IMAGE'],
                                                                'NOM_EMISSION' => $_POST['NOM_EMISSION'],
                                                                'NUMERO' => $_POST['NUMERO'],
                                                                'DISPONIBILITE' => $_POST['DISPONIBILITE'],
                                                                'VUES' => $_POST['VUES']
                                                        ) );
                                                        message('Sucess ', 'La vidéo '.$_POST['NOM_VIDEO'].' a été créée avec succès');
                                                        header('Location: '.BASEURL.'/index.php/video/toutes_les_videos_admin');
                                                        exit;
                                        }
                                        else
                                        {
                                                // s'il existe on ne le créera pas puisque le login est unique
                                                message('Erreur', 'La vidéo \''.$_POST['NOM_VIDEO'].'\' existe déjà !');
						header('Location: '.BASEURL.'/index.php/video/creer_video');
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
                                include 'views/video/ajouter_video.php';
                                break;
                }
        }

        // fonction de récupération de toutes les vidéos
        public function lister_videos()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $videos = Video::get_all();
                        include 'views/video/toutes_les_videos.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction de récupération de toutes les vidéos (administrateur seulement)
        public function lister_videos_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        // TODO tester si l'utilisateur a le droit
                        $videos = Video::get_all();
                        include 'views/video/toutes_les_videos_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage des vidéos d'un émission
        public function afficher_videos_emission()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $videos = Video::get_by_nom_emission( $_POST['nom_emission'] );
                        include 'views/video/afficher_videos_emission.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage des vidéos d'un émission (admin)
        public function afficher_videos_emission_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $videos = Video::get_by_nom_emission( $_POST['nom_emission'] );
                        include 'views/video/afficher_videos_emission_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction de suppression d'une vidéo (admin)
        public function supprimer_video()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        Video::supprimer_video( $_POST['nom_video'] );
                        message('success', 'La vidéo '.$_POST['nom_video'].' a bien été supprimée');
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
