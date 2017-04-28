<?php
/* Smarty version 3.1.31, created on 2017-04-03 15:44:23
  from "C:\XAMPP\htdocs\a-project\webtool\views\ticketform.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58e251b7b90250_59315434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e504f6f9d0924adf578a1e3c6141e4af2f1ad7a' => 
    array (
      0 => 'C:\\XAMPP\\htdocs\\a-project\\webtool\\views\\ticketform.tpl',
      1 => 1491214908,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58e251b7b90250_59315434 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
	<head>
	<meta http-equiv="Content-type" content=text/html; charset=utf-8" />
	<title>Mauve System3 Ticketsystem</title>
		<h2>Willkommen im Mauve System3 Ticketsystem</h2>
		<h3>Zum Erstellen eines Tickets bitte das Formular ausfüllen und absenden.</h3>
	</head>
	<body>
	<p>Ticketformular</p>
	<input type="text" name="Vorname" value="<?php echo $_smarty_tpl->tpl_vars['prename']->value;?>
"/>


	<!-- Kundennummer -->
	<!--
	<div id="name-wrap" class="slider">
		<label for="name">Kundennummer <sup>(*)</sup></label>
		<input type="text" id="name" <?php if ($_smarty_tpl->tpl_vars['ticketErrorCustomerID']->value) {?>class="ticketErrorField"<?php }?> name="name" value="<?php echo $_smarty_tpl->tpl_vars['ticketCustomerID']->value;?>
" tabindex="1" />
        <?php if ($_smarty_tpl->tpl_vars['ticketErrorCustomerID']->value) {?>
			<span class="ticketError"><?php echo $_smarty_tpl->tpl_vars['ticketErrorCustomerID']->value;?>
</span>
        <?php }?>
	</div>
	-->

	<!-- Vorname und Name -->
	<div id="name-wrap" class="slider">
		<label for="name">Name <sup>(*)</sup></label>
		<input type="text" id="name" <?php if ($_smarty_tpl->tpl_vars['ticketErrorName']->value) {?>class="ticketErrorField"<?php }?> name="name" value="<?php echo $_smarty_tpl->tpl_vars['ticketName']->value;?>
" tabindex="1" />
        <?php if ($_smarty_tpl->tpl_vars['ticketErrorName']->value) {?>
			<span class="ticketError"><?php echo $_smarty_tpl->tpl_vars['ticketErrorName']->value;?>
</span>
        <?php }?>
	</div>

	<!-- E-Mail -->
	<div id="email-wrap"  class="slider">
		<label for="email">E–Mail <sup>(*)</sup></label>
		<input type="text" id="email" <?php if ($_smarty_tpl->tpl_vars['ticketErrorEmail']->value) {?>class="ticketErrorField"<?php }?> name="email" value="<?php echo $_smarty_tpl->tpl_vars['ticketMail']->value;?>
" tabindex="2" />
        <?php if ($_smarty_tpl->tpl_vars['ticketErrorEmail']->value) {?>
			<span class="kontaktFehler"><?php echo $_smarty_tpl->tpl_vars['ticketErrorEmail']->value;?>
</span>
        <?php }?>
	</div>

	<!-- Shopadresse -->
	<!--
	<div id="homepage-wrap"  class="slider">
		<label for="homepage">Shop (http://)</label>
		<input type="text" id="homepage" <?php if ($_smarty_tpl->tpl_vars['ticketErrorShop']->value) {?>class="formularErrorField"<?php }?> name="Shopadresse" size="25" value="<?php echo $_smarty_tpl->tpl_vars['ticketHomepage']->value;?>
" tabindex="3" />
        <?php if ($_smarty_tpl->tpl_vars['ticketErrorHomepage']->value) {?>
			<span class="ticketError"><?php echo $_smarty_tpl->tpl_vars['ticketErrorHomepage']->value;?>
</span>
        <?php }?>
	</div>
	-->

	<!-- Buttons -->
	<div id="button-wrap">
		<input type="submit" name="ticketSend" value="Absenden" />
		<input type="submit" name="ticketAbort" value="Abbrechen" />
	</div>

	<div id="hinweis-wrap">
		<em><sup>(*)</sup> Pflichtfelder</em>
	</div>

	</body>
</html><?php }
}
