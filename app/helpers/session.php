<?php

	session_start();

	function setTurnos($turno, $dia) {
		for($a = 0; $a < count($turno); $a++) {
			$turno[$a]['dia'] = $dia;
			$turno[$a]['user_id'] = $_SESSION['user_id'];
		}

		return $turno;
	}

	function fixedFecha($date) {
		setlocale(LC_TIME, "spanish");
		$fecha = $date;
		$fecha = str_replace("-", "/", $fecha); 
		$fecha = strftime("%d.%m.%Y", strtotime($fecha));
		return $fecha;
	}

	function getMes() {
		$format = new IntlDateFormatter('es-PE', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Lima', IntlDateFormatter::GREGORIAN, 'MMMM y');
		$dia = new DateTime();
		return strtoupper($format->format($dia));
	}


	function getCurrentWeek() {
		$dt = new DateTime;

		$dates = [];
		for ($d = 1; $d <= 7; $d++) {

		  $dt->setISODate($dt->format('o'), $dt->format('W'), $d);
		  // $dates[$dt->format('D')] = $dt->format('d-m-Y');
		  $dates[$d] = $dt->format('d-m-Y');
		}

		return($dates);
	}

	function setDayStatus($value) {
		if ($value) {
			echo '<i class="px-2 text-xl fas fa-check text-green"></i> ';
		} else {
			echo '<i class="fas fa-xmark text-red"></i>';
		}
	}


	function setStatus($estado) {
		if ($estado == 1) {
			echo '<div class="text-green"><i class="fas fa-check mr-2"></i> Activo </div>';
		} else {
			echo '<div class="text-red"><i class="fas fa-xmark mr-2"></i> Inactivo </div>';
		}
	}

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


?>