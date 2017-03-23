<?php

if( !function_exists('check_post_values') )
{
	function check_post_values( Array $var )
	{
		foreach( $var as $v )
		{
			if( !isset($_POST[$v]) )
			{
				return false;
			}
			else
			{
				$_POST[$v] = htmlspecialchars($_POST[$v]);
			}
		}
		return true;
	}
}

if( !function_exists('message') )
{
	function message( $type, $text )
	{
		$_SESSION['message'] = array(
			'type' => $type,
			'text' => $text );
	}
}

if( !function_exists('user_connected') )
{
	function user_connected()
	{
		return isset( $_SESSION['login'] );
	}
}

if( !function_exists('get_connected_user') )
{
	function get_connected_user()
	{
		if( isset($_SESSION['login']) )
		{
			$u = Utilisateur::get_by_login( $_SESSION['login'] );
			return $u;
		}
		else
		{
			return null;
		}
	}
}

if( !function_exists('is_administrator') )
{
	function is_administrator( $login )
	{
		$admins = "r_perrin:admin";
		$admins_list = explode(':', $admins);
		for( $i = 0; $i < count($admins_list); $i++)
		{
			if( strcmp( $admins_list[$i], $login ) == 0 )
				return true;
		}
		return false;
	}
}
