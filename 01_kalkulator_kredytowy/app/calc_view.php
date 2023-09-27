<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="styles.css">
<title>Kalkulator</title>
</head>
<body>
<section id="caly">
<section id="formularz">
	<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
		<label for="amount">Kwota kredytu: </label>
		<input id="amount" type="text" name="amount" value="<?php isset($amount) ? print($amount):''; ?>" /><br />
		<label for="years">Ilość Lat: </label>
		<input type="number" id="years" name="years"><br>
		<label for="percent">Oprocentowanie: </label>
		<input id="percent" type="text" name="percent" value="<?php isset($percent) ? print($percent):''; ?>" /> % <br />
		<input type="submit" value="Oblicz" />
	</form>	
</section>
	<?php
	//wyświeltenie listy błędów, jeśli istnieją
	if (isset($messages)) {
		if (count ( $messages ) > 0) {
			echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
			foreach ( $messages as $key => $msg ) {
				echo '<li>'.$msg.'</li>';
			}
			echo '</ol>';
		}
	}
	?>

	<?php if (isset($result)){ ?>
	<div id="okno" style="margin-left:550px;margin-right:550px; margin-top: 20px; padding: 10px; border-radius: 5px; background-color: #22C70F; width:300px;">
	<?php echo 'Rata miesięczna: '.$result."<br>".'Cała kwota: '.$all; ?>
	</div>
	<?php } ?>
</section>
</body>
</html>