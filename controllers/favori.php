<?php

require_once 'models/favori.php';       // classe favori
require_once 'models/utilisateur.php';  // classe utilisateur
require_once 'models/video.php';         // classe vidéo

class Controller_Favori
{
        public function __construct()
        {}

        // fonction de récupération de ses favoris
        public function mes_favoris()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $favoris = Favori::get_by_login( $u->get_login() );
                        include 'views/favori/mes_favoris.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'ajout d'une vidéo dans les favoris
        public function ajouter_favori()
        {
                if( isset($_POST['LOGIN']) and isset($_POST['NOM_FAVORI']) )
                {
                        // on recherche le login
                        $fav = Favori::get_by_login_nom_favori( $_POST['LOGIN'], $_POST['NOM_FAVORI'] );
                        if( is_null($fav) )
                        {
                                Favori::creer_favori( array( 'LOGIN' => $_POST['LOGIN'],
                                        'NOM_FAVORI' => $_POST['NOM_FAVORI']
                                ) );
                                message('Sucess ', 'La vidéo '.$_POST['NOM_FAVORI'].' a été ajoutée à vos favoris avec succès');
                                header('Location: '.BASEURL);
                                exit;
                        }
                        else
                        {
                                message('Erreur', 'La vidéo \''.$_POST['NOM_FAVORI'].'\' est déjà dans vos favoris !');
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
        public function supprimer_favori()
        {
                if( isset($_POST['LOGIN']) and isset($_POST['NOM_FAVORI']) )
                {
                        // on recherche le login
                        $fav = Favori::get_by_login_nom_favori( $_POST['LOGIN'], $_POST['NOM_FAVORI'] );
                        if( !is_null($fav) )
                        {
                                Favori::supprimer_favori( array( 'LOGIN' => $_POST['LOGIN'],
                                        'NOM_FAVORI' => $_POST['NOM_FAVORI']
                                ) );
                                message('Sucess ', 'La vidéo '.$_POST['NOM_FAVORI'].' a été supprimée à vos favoris avec succès');
                                header('Location: '.BASEURL);
                                exit;
                        }
                        else
                        {
                                message('Erreur', 'La vidéo \''.$_POST['NOM_FAVORI'].'\' ne fait pas partie de vos favoris !');
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

        // fonction de récupération de tous les favoris (administrateur seulement)
        public function lister_favoris()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        // TODO tester si l'utilisateur a le droit
                        $favoris = Favori::get_all();
                        include 'views/favori/tous_les_favoris.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage des favoris d'un utilisateur (administrateur seulement)
        public function afficher_favoris_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $favoris = Favori::get_by_login( $_POST['utilisateur'] );
                        include 'views/favori/afficher_favoris_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

}
