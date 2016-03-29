<?php
include 'config.php';
$db = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_info, $db_user, $db_pass);
$curuserid = 0;
$curusername = '';
$curpassword = '';
$curisadmin = false;
$curloggedin = false;

function userLoggedIn() {
	global $db, $curuserid, $curusername, $curpassword, $curisadmin, $curloggedin;

	if ( !isset($_COOKIE['user']) || !isset($_COOKIE['pass']) || !is_numeric($_COOKIE['user']) || !is_string($_COOKIE['pass']) ) {
		return false;
	}

	$user = $_COOKIE['user'];
	$pass = $_COOKIE['pass'];
	$res  = array();

	// I heard pdo prepare makes sqlinjection impossible! Whoohoo!
	$stmt = $db->prepare('SELECT username,admin FROM users WHERE id=?');
	$stmt->execute(array($user));

	if ( $stmt->rowCount() == 0 ) {
		return false;
	}

	$res += $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = $db->prepare('SELECT id FROM users WHERE password=?');
	$stmt->execute(array($pass));

	if ( $stmt->rowCount() == 0 ) {
		return false;
	}

	$res += $stmt->fetch(PDO::FETCH_ASSOC);

	$curuserid = $res['id'];
	$curusername = $res['username'];
	$curpassword = $pass;
	$curisadmin = ($res['admin'] == 1);
	$curloggedin = true;

	return true;
}

function tryLogin($username, $password, &$help) {
	global $db;

	$stmt = $db->prepare('SELECT id,password FROM users WHERE username=?');
	$stmt->execute(array($username));

	if ( $stmt->rowCount() == 0 ) {
		$help = 'Pssh...I don\'t know that username';
		return false;
	}

	$res = $stmt->fetch(PDO::FETCH_ASSOC);

	if ( $password == $res['password'] ) {
		// Cookies shall be there for 30 days
		// Users complained about constantly having to login
		setcookie('user', $res['id'], time() + (60 * 60 * 24 * 30));
		setcookie('pass', $password, time() + (60 * 60 * 24 * 30));

		return true;
	}

	$help = 'Pssh...Does '.$password2.' help?';
	return false;
}

function logout() {
	setcookie('user', '', time() + (60 * 60 * 24 * 30));

	header('Location: /');
	die;
}

function requireLogin() {
	global $curloggedin;

	if ( !$curloggedin ) {
		header('Location: /login.php');
		die;
	}
}

function requireAdmin() {
	global $curisadmin;

	requireLogin();
	if ( !$curisadmin ) {
		header('Location: /noaccess.php');
		die;
	}
}

// STUFF TO BE RUN ON EVERY PAGE
userLoggedIn();
