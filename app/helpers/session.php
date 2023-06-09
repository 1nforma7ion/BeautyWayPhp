<?php

	session_start();

	function notSession() {
		if (!isset($_SESSION['user_rol'])) {
			return true;
		} else {
			return false;
		}
	}

	function usuarioLoggedIn() {
		if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'usuario') {
			return true;
		} else {
			return false;
		}
	}

	function usuariopLoggedIn() {
		if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'usuariop') {
			return true;
		} else {
			return false;
		}
	}

	function adminLoggedIn() {
		if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin') {
			return true;
		} else {
			return false;
		}
	}

	function showAlert() {
		if (!empty($_SESSION['msg'])) {
			echo '<div id="msg" class="text-center p-2 w-full bg-primaryDark text-lg rounded-xl">' . $_SESSION['msg'] . '</div>';
			unset($_SESSION['msg']);
		}
	}

	function fixedFecha($date) {
		setlocale(LC_TIME, "spanish");
		$fecha = $date;
		$fecha = str_replace("/", "-", $fecha); 
		$fecha = strftime("%d-%m-%Y", strtotime($fecha));
		return $fecha;
	}
?>