<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$amount = $_REQUEST ['amount'];
$months = $_REQUEST ['months'];
$percent = $_REQUEST ['percent'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($amount) && isset($months) && isset($percent))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $amount == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $percent == "") {
	$messages [] = 'Nie podano liczby miesięcy';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $amount i $months są liczbami całkowitymi
	if (! is_numeric( $amount )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $percent )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$amount = intval($amount);
	$percent = intval($percent);
	$percent2 = $percent + 100;

	//wykonanie operacji
	switch ($months) {
		case 'six' :
			$all = ($amount * $percent2) / 100;
			$result = $all / 6;
		break;
		case 'twelve' :
			$all = ($amount * $percent2) / 100;
			$result = $all / 12;			
		break;
		case 'twentyFour' :
			$all = ($amount * $percent2) / 100;
			$result = $all / 24;			
		break;
		default :
			$all = ($amount * $percent2) / 100;
			$result = $all / 48;		
		break;
	}
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$months,$percent,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';