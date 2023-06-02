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

	function adminLoggedIn() {
		if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin') {
			return true;
		} else {
			return false;
		}
	}

	function showAlert() {
		if (!empty($_SESSION['msg'])) {
			echo '<div id="msg" class="bg-white rounded-xl">' . $_SESSION['msg'] . '</div>';
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