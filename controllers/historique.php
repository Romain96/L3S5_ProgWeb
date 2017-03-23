<?php

require_once 'models/historique.php';           // classe abonnemnt
require_once 'models/utilisateur.php';          // classe utilisateur
require_once 'models/video.php';                 // classe émission

class Controller_Historique
{
        public function __construct()
        {}

        // fonction de récupération de son historique
        public function mon_historique()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $historiques = Historique::get_by_login( $u->get_login() );
                        include 'views/historique/mon_historique.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'ajout d'une vidéo dans l'historique (visionner)
        public function ajouter_historique()
        {
                if( isset($_POST['LOGIN']) and isset($_POST['NOM_VIDEO']) )
                {
                        Historique::creer_historique( array( 'LOGIN' => $_POST['LOGIN'],
                                'NOM_VIDEO' => $_POST['NOM_VIDEO'],
				'DATE_VISIONNAGE' => date('Y-m-d H:i:s')
                        ) );
                        message('Sucess ', 'La vidéo '.$_POST['NOM_VIDEO'].' a été visionnée avec succès');
                        header('Location: '.BASEURL);
                        exit;
                }
                else
                {
                        http_response_code(400);
                        include('views/errors/400.php');
                }
        }

        // fonction de récupération de tous les historiques (administrateur seulement)
        public function lister_historiques()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        // TODO tester si l'utilisateur a le droit
                        $historiques = Historique::get_all();
                        include 'views/historique/tous_les_historiques.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage de l'historique d'un utilisateur (admin)
        public function afficher_historique_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $historiques = Historique::get_by_login( $_POST['utilisateur'] );
                        include 'views/historique/afficher_historique_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

}
