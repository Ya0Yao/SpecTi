<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>
<body>

<section id="caly">
<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>

<section id="formularz">
	<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
		<label for="amount">Kwota kredytu: </label>
		<input id="amount" type="text" name="amount" value="<?php out($amount); ?>" /><br />
		<label for="years">Ilość Lat: </label>
		<input style="color: black;" type="number" id="years" name="years"><br>
		<label for="percent">Oprocentowanie: </label>
		<input id="percent" type="text" name="percent" value="<?php out($percent); ?>" /> % <br />
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
<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>
</html>