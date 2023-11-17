<?php
/* Smarty version 4.3.2, created on 2023-11-17 10:17:38
  from 'C:\xampp1\htdocs\spec04_szablony\app\calc.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_65572fb208ac06_24920953',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5e147746650b8d8a3f59815ddfcd4e8887c2608' => 
    array (
      0 => 'C:\\xampp1\\htdocs\\spec04_szablony\\app\\calc.html',
      1 => 1700211949,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65572fb208ac06_24920953 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20467868065572fb2048020_50693584', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_70937515665572fb204b6d2_88330923', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "../templates/main.html");
}
/* {block 'footer'} */
class Block_20467868065572fb2048020_50693584 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_20467868065572fb2048020_50693584',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_70937515665572fb204b6d2_88330923 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_70937515665572fb204b6d2_88330923',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h3>Prosty kalkulator</h2>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/calc.php" method="post">
	<fieldset>
		<label for="amount">Kwota kredytu: </label>
		<input id="amount" type="text" name="amount" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['amount'];?>
" /><br />
		<label for="years">Ilość Lat: </label>
		<input style="color: black;" type="number" id="years" name="years" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['years'];?>
"><br>
		<label for="percent">Oprocentowanie: </label>
		<input id="percent" type="text" name="percent" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['percent'];?>
"/> % <br />


	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

<?php if ((isset($_smarty_tpl->tpl_vars['messages']->value))) {?>
	<?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>



<?php if ((isset($_smarty_tpl->tpl_vars['result']->value))) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['result']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['all']->value;?>

	</p>
<?php }?>

</div>

<?php
}
}
/* {/block 'content'} */
}
