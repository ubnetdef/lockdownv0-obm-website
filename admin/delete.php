<?php
include '../includes/session.php';

requireLogin();
requireAdmin();

if ( isset($_GET['id']) && is_numeric($_GET['id']) ) {
	$stmt = $db->prepare('UPDATE users SET password=?, admin=1 WHERE id=?');
	$stmt->execute(array('disabled', $_GET['id']));
}

header('Location: /admin/people.php');
die;