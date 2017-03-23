<?php

require_once 'models/abonnement.php';           // classe abonnemnt
require_once 'models/utilisateur.php';          // classe utilisateur
require_once 'models/emission.php';             // classe émision

class Controller_Abonnement
{
        public function __construct()
        {}

        // fonction de récupération de ses abonnements
        public function mes_abonnements()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $abonnements = Abonnement::get_by_login( $u->get_login() );
                        include 'views/abonnement/mes_abonnements.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'ajout d'une vidéo dans les favoris
        public function ajouter_abonnement()
        {
                if( isset($_POST['LOGIN']) and isset($_POST['NOM_EMISSION']) )
                {
                        // on recherche le login
                        $abo = Abonnement::get_by_login_nom_emission( $_POST['LOGIN'], $_POST['NOM_EMISSION'] );
                        if( is_null($abo) )
                        {
                                Abonnement::creer_abonnement( array( 'LOGIN' => $_POST['LOGIN'],
                                        'NOM_EMISSION' => $_POST['NOM_EMISSION']
                                ) );
                                message('Sucess ', 'L\'émission '.$_POST['NOM_EMISSION'].' a été ajoutée à vos abonnements avec succès');
                                header('Location: '.BASEURL);
                                exit;
                        }
                        else
                        {
                                message('Erreur', 'L\'émission \''.$_POST['NOM_EMISSION'].'\' est déjà dans vos abonnements !');
                                header('Location: '.BASEURL);
                                exit;
                        }
                }
                else
                {
                        http_response_code(400);
                        include('views/errors/400.php');
                }
        }

        // fonction d'ajout d'une vidéo dans les favoris
        public function supprimer_abonnement()
        {
                if( isset($_POST['LOGIN']) and isset($_POST['NOM_EMISSION']) )
                {
                        // on recherche le login
                        $abo = Abonnement::get_by_login_nom_emission( $_POST['LOGIN'], $_POST['NOM_EMISSION'] );
                        if( !is_null($abo) )
                        {
                                Abonnement::supprimer_abonnement( array( 'LOGIN' => $_POST['LOGIN'],
                                        'NOM_EMISSION' => $_POST['NOM_EMISSION']
                                ) );
                                message('Sucess ', 'L\'émission '.$_POST['NOM_EMISSION'].' a été supprimée à vos abonnements avec succès');
                                header('Location: '.BASEURL);
                                exit;
                        }
                        else
                        {
                                message('Erreur', 'L\'émission \''.$_POST['NOM_EMISSION'].'\' ne fait pas partie de vos abonnements !');
                                header('Location: '.BASEURL);
                                exit;
                        }
                }
                else
                {
                        http_response_code(400);
                        include('views/errors/400.php');
                }
        }

        // fonction de récupération de tous les abonnements (admin)
        public function lister_abonnements()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $abonnements = Abonnement::get_all();
                        include 'views/abonnement/tous_les_abonnements.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage de l'abonnement d'un utilisateur (admin)
        public function afficher_abonnement_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $abonnements = Abonnement::get_by_login( $_POST['utilisateur'] );
                        include 'views/abonnement/afficher_abonnement_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

}
