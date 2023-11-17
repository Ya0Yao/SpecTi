<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów



function getParams(&$form){
	$form['amount'] = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
	$form['years'] = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
	$form['percent'] = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;	
	// $role = $_SESSION['role'];
}

function validate(&$form,&$infos,&$msgs,&$hide_intro){

	// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($form['amount']) && isset($form['years']) && isset($form['percent']))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		return false;
	}
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';
	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['amount'] == "") {
		$msgs [] = 'Nie podano kwoty';
	}
	if ( $form['years'] == "") {
		$msgs [] = 'Nie podano liczby lat';
	}
	if ( $form['percent'] == "") {
		$msgs [] = 'Nie podano procentów';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (empty( $msgs )) {
		
		// sprawdzenie, czy $form['amount'] i $form['years'] są liczbami całkowitymi
		if (! is_numeric( $form['amount'] )) {
			$msgs [] = 'Pierwsza wartość nie jest liczbą całkowitą';
		}
		if (! is_numeric( $form['percent'] )) {
			$msgs [] = 'Nie jest to liczba float';
		}
		// if($role == 'user'){
		// 	if( $form['amount'] > 100000){
		// 		$msgs [] = 'Nie masz uprawnień dla tak dużych kwot';
		// 	}
		// 	if( $form['percent'] < 5){
		// 		$msgs [] = 'Nie masz uprawnień dla tak małego oprocentowania';
		// 	}
		// }
		
		if (!empty($msgs) ) return false ;
		else return true;
	}
}

function process(&$form,&$infos,&$msgs,&$result, &$all){

	// 3. wykonaj zadanie jeśli wszystko w porządku
	if (empty ( $msgs )) { // gdy brak błędów
		
		//konwersja parametrów na int
		$percent = floatval($form['percent']);
		$amount = intval($form['amount']);

		$percent2 = ($percent + 100 ) * $form['years'];

		$all = ($amount * $percent2) / 100;
		$result = $all/12;
		
	}
}

$form = null;
$infos = array();
$msgs = array();
$result = null;
$all = null;
// $role = null;
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro)){
	process($form,$infos,$messages,$result,$all);
}
// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($msgs,$x,$form['years'],$form['percent'],$result)
//   będą dostępne w dołączonym skrypcie

// $page_title = 'Przykład 03';
// $page_description = 'Najprostsze szablonowanie oparte na budowaniu widoku poprzez dołączanie kolejnych części HTML zdefiniowanych w różnych plikach .php';
// $page_header = 'Proste szablony';
// $page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('msgs',$msgs);
$smarty->assign('infos',$infos);
$smarty->assign('all',$all);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');
