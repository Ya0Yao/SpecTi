<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

include _ROOT_PATH.'/app/security/check.php';


function getParams(&$amount, &$years ,&$percent, &$role){
	$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
	$years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
	$percent = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;	
	$role = $_SESSION['role'];
}

function validate(&$amount, &$years ,&$percent,&$messages, &$role){

	// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($amount) && isset($years) && isset($percent))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $amount == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $years == "") {
		$messages [] = 'Nie podano liczby lat';
	}
	if ( $percent == "") {
		$messages [] = 'Nie podano procentów';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (empty( $messages )) {
		
		// sprawdzenie, czy $amount i $years są liczbami całkowitymi
		if (! is_numeric( $amount )) {
			$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
		}
		if (! is_numeric( $percent )) {
			$messages [] = 'Nie jest to liczba float';
		}
		$percent = floatval($percent);
		$amount = intval($amount);
		if($role == 'user'){
			if( $amount > 100000){
				$messages [] = 'Nie masz uprawnień dla tak dużych kwot';
			}
			if( $percent < 5){
				$messages [] = 'Nie masz uprawnień dla tak małego oprocentowania';
			}
		}
		if (count($messages) != 0) return false ;
		else return true;
	}
}

function process(&$amount, &$years ,&$percent,&$messages,&$result, &$all){

	// 3. wykonaj zadanie jeśli wszystko w porządku
	if (empty ( $messages )) { // gdy brak błędów
		
		//konwersja parametrów na int
		
		$percent2 = ($percent + 100 ) * $years;

		$all = ($amount * $percent2) / 100;
		$result = $all/12;
		
	}
}

$amount = null;
$years = null;
$percent = null;
$result = null;
$messages = array();
$all = null;
$role = null;
getParams($amount,$years,$percent,$role);
if ( validate($amount, $years,$percent, $messages , $role)){
	process($amount, $years, $percent, $messages, $result,$all);
}
// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$years,$percent,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';