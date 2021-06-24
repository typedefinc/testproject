<?php

namespace App\Base;

class BasicAuth
{

	public function getUsers()
	{
		return [
			'admin' => ['admin', 'admin'],
			'user' => ['user', 'user'],
			'user2' => ['user2', 'user'],
		];
	}

	public function auth()
	{
		$users = BasicAuth::getUsers();
		if (
			!isset($_SERVER['PHP_AUTH_USER']) ||
			($users[$_SERVER['PHP_AUTH_USER']] == null || $users[$_SERVER['PHP_AUTH_USER']][0] != $_SERVER['PHP_AUTH_PW']) ||
			($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'] && $_POST['OldAuth'] != '')
		) {
			BasicAuth::reauth();
		}
	}

	public function reauth()
	{
		header('WWW-Authenticate: Basic realm="Test Authentication System"');
		header('HTTP/1.0 401 Unauthorized');
		var_dump($_SERVER['PHP_AUTH_USER']);
		var_dump($_POST);
	}

	public function isAdmin()
	{
		$users = BasicAuth::getUsers();
		return $users[$_SERVER['PHP_AUTH_USER']][1] === 'admin' ? true : false;
	}

	public static function isAuth()
	{
		return $_SERVER['PHP_AUTH_USER'] ? true : false;
	}

}
