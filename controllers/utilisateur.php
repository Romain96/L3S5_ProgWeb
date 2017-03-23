<?php

require_once 'models/utilisateur.php'; // classe utilisateur

class Controller_Utilisateur
{
        public function __construct()
        {}

        // fonction d'inscription d'un nouvel utilisateur
        public function inscription()
        {
                switch( $_SERVER['REQUEST_METHOD'] )
                {
                        case 'POST':
                                if( isset($_POST['LOGIN']) and isset($_POST['MDP'])
                                and isset($_POST['PRENOM']) and isset($_POST['NOM'])
                                and isset($_POST['DATE_NAISSANCE']) and isset($_POST['EMAIL'])
                                and isset($_POST['PAYS']) and isset($_POST['NEWSLETTER']) )
                                {
                                        // on recherche le login
                                        $u = Utilisateur::get_by_login( $_POST['LOGIN'] );
                                        if( is_null($u) )
                                        {
                                                Utilisateur::creer_utilisateur( array( 'LOGIN' => $_POST['LOGIN'],
                                                                'MDP' => sha1($_POST['MDP']),
                                                                'PRENOM' => $_POST['PRENOM'],
                                                                'NOM' => $_POST['NOM'],
                                                                'DATE_NAISSANCE' => $_POST['DATE_NAISSANCE'],
                                                                'EMAIL' => $_POST['EMAIL'],
                                                                'PAYS' => $_POST['PAYS'],
                                                                'NEWSLETTER' => $_POST['NEWSLETTER']
                                                        ) );
                                                        message('Success ', 'L\'utilisateur '.$_POST['LOGIN'].' a été créé avec succès');
                                                        header('Location: '.BASEURL.'/index.php/utilisateur/connexion');
                                                        exit;
                                        }
                                        else
                                        {
                                                // s'il existe on ne le créera pas puisque le login est unique
                                                message('Erreur', 'Le login \''.$_POST['LOGIN'].'\' est déja utilisé');
						header('Location: '.BASEURL.'/index.php/utilisateur/inscription');
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
                                include 'views/utilisateur/signup.php';
                                break;
                }
        }

        // fonction de connexion d'un utilisateur
        public function connexion()
	{
		switch( $_SERVER['REQUEST_METHOD'] )
                {
			case 'POST':
				if( isset($_POST['LOGIN']) and isset($_POST['MDP']) )
                                {
					$u = Utilisateur::get_by_login( $_POST['LOGIN'] );
					if( !is_null($u) )
                                        {
						if( $u->get_mdp() == sha1($_POST['MDP']) )
                                                {
							$_SESSION['login'] = $_POST['LOGIN'];
                                                        // test pour savoir si l'utilisateur est un administrateur
                                                        if( is_administrator( $_POST['LOGIN'] ) )
                                                                $_SESSION['admin'] = true;
                                                        else
                                                                unset($_SESSION['admin']);
							message('success', 'L\'utilisateur '.$_POST['LOGIN'].' s\'est bien connecté');
							header('Location: '.BASEURL);
							exit;
						}
                                                else
                                                {
							message('error', 'Le mot de passe est incorrect !');
							header('Location: '.BASEURL.'/index.php/utilisateur/connexion');
							exit;
						}
					}
                                        else
                                        {
						message('error', 'L\'utilisateur '.$_POST['LOGIN'].' n\'existe pas !');
						header('Location: '.BASEURL.'/index.php/utilisateur/connexion');
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
				include 'views/utilisateur/signin.php';
				break;
		}
	}

        // fonction de déconnexion d'un utilisateur
        public function deconnexion()
	{
		unset( $_SESSION['login'] );
                unset( $_SESSION['admin'] );
		message('success', "L'utilisateur s'est déconnecté");
		header('Location: '.BASEURL);
		exit;
	}

        // fonction de récupération de tous les utilisateurs (administrateur seulement)
        public function lister_utilisateurs()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $utilisateurs = Utilisateur::get_all();
                        include 'views/utilisateur/tous_les_utilisateurs.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction d'affichage de son profil
        public function afficher_profil()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $utilisateur = Utilisateur::get_by_login( $u->get_login() );
                        include 'views/utilisateur/afficher_profil.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction de modification du profil
        public function modifier_profil()
        {
                switch( $_SERVER['REQUEST_METHOD'] )
                {
                        case 'POST':
                                if( isset($_POST['LOGIN']) and isset($_POST['MDP'])
                                and isset($_POST['PRENOM']) and isset($_POST['NOM'])
                                and isset($_POST['DATE_NAISSANCE']) and isset($_POST['EMAIL'])
                                and isset($_POST['PAYS']) and isset($_POST['NEWSLETTER']) )
                                {
                                        Utilisateur::sauvegarder_utilisateur( array( 'LOGIN' => $_POST['LOGIN'],
                                                        'MDP' => sha1($_POST['MDP']),
                                                        'PRENOM' => $_POST['PRENOM'],
                                                        'NOM' => $_POST['NOM'],
                                                        'DATE_NAISSANCE' => $_POST['DATE_NAISSANCE'],
                                                        'EMAIL' => $_POST['EMAIL'],
                                                        'PAYS' => $_POST['PAYS'],
                                                        'NEWSLETTER' => $_POST['NEWSLETTER']
                                                ) );
                                                message('Sucess ', 'L\'utilisateur '.$_POST['LOGIN'].' a été modifié avec succès');
                                                header('Location: '.BASEURL);
                                                exit;
                                }
                                else
                                {
                                        http_response_code(400);
					include('views/errors/400.php');
                                }
                                break;
                        case 'GET':
                                $u = get_connected_user();
                                include 'views/utilisateur/modifier_profil.php';
                                break;
                }
        }

        // fonction de d'affichage du profil d'un utilisateur (admin)
        public function afficher_profil_admin()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        $utilisateur = Utilisateur::get_by_login( $_POST['utilisateur'] );
                        include 'views/utilisateur/afficher_profil_admin.php';
                }
                else
                {
                        header('Location: '.BASEURL);
                        exit;
                }
        }

        // fonction de suppression d'un utilisateur (admin)
        public function supprimer_utilisateur()
        {
                if( user_connected() )
                {
                        $u = get_connected_user();
                        Utilisateur::supprimer_utilisateur( $_POST['utilisateur'] );
                        message('success', 'L\'utilisateur '.$_POST['utilisateur'].' a bien été supprimé');
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
