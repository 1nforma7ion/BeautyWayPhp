<?php 
	require_once 'config/config.php';
	require_once 'helpers/session.php';
	require_once 'helpers/url.php';

	spl_autoload_register(function ($className) {
		require_once 'libraries/' . $className . '.php';
	})
?>