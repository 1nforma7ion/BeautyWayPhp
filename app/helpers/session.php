<?php

	session_start();

	function setTurnos($turno, $dia) {
		for($a = 0; $a < count($turno); $a++) {
			$turno[$a]['dia'] = $dia;
			$turno[$a]['user_id'] = $_SESSION['user_id'];
		}

		return $turno;
	}

	function customHour() {
		setlocale(LC_TIME, "es_AR");
		$fecha = date('H:i');
		echo $fecha;
	}

	function fixedFecha($date) {
		setlocale(LC_TIME, "es_AR");
		$fecha = $date;
		$fecha = str_replace("-", "/", $fecha); 
		$fecha = date("d-m-Y", strtotime($fecha));
		return $fecha;
	}

	// function getMes() {
	// 	$format = new IntlDateFormatter('es-AR', 
	// 		IntlDateFormatter::FULL, 
	// 		IntlDateFormatter::FULL, 
	// 		'America/Argentina/Buenos_Aires', 
	// 		IntlDateFormatter::GREGORIAN, 'HH:mm');
		
	// 	$dia = new Datetime();
	
	// 	echo strtoupper($format->format($dia));
	// }


	// function getCurrentWeek() {
	// 	$dt = new DateTime;

	// 	$dates = [];
	// 	for ($d = 1; $d <= 7; $d++) {

	// 	  $dt->setISODate($dt->format('o'), $dt->format('W'), $d);
	// 	  // $dates[$dt->format('D')] = $dt->format('d-m-Y');
	// 	  $dates[$d] = $dt->format('d-m-Y');
	// 	}

	// 	return($dates);
	// }



	function setReservaStatus($estado) {
		if ($estado == 'pendiente') {
			echo '<div class="text-dark font-bold">' . ucwords($estado) .'</div>';
		} else if ($estado == 'confirmado') {
			echo '<div class="text-green font-bold">' . ucwords($estado) .'</div>';
		} else if ($estado == 'cancelado'){
			echo '<div class="text-red font-bold">' . ucwords($estado) .'</div>';
		} else {
			echo '<div class="text-neutral font-bold">' . ucwords($estado) . '</div>';
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
			echo '<div id="msg" class="text-center p-2 w-full bg-primary text-lg rounded-xl">' . $_SESSION['msg'] . '</div>';
			unset($_SESSION['msg']);
		}
	}

	function showMsg() {
		if (!empty($_SESSION['success_msg'])) {
			echo '<div id="success_msg" class="text-center p-4 w-full bg-ctaDark text-dark text-lg rounded-xl">' . $_SESSION['success_msg'] . '</div>';
			unset($_SESSION['success_msg']);
		}
	}


?>