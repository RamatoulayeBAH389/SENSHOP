<?php
/* Smarty version 3.1.33, created on 2019-07-29 03:23:54
  from '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/controllers/stats/helpers/view/view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e66ca3797f7_80333217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f193cb26d11c1ac4ccb20130094de9e97425d69e' => 
    array (
      0 => '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/controllers/stats/helpers/view/view.tpl',
      1 => 1563803867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e66ca3797f7_80333217 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_151419105d3e66ca3788c7_54407313', "override_tpl");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/view/view.tpl");
}
/* {block "override_tpl"} */
class Block_151419105d3e66ca3788c7_54407313 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_tpl' => 
  array (
    0 => 'Block_151419105d3e66ca3788c7_54407313',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
 type="text/javascript">
		$(function() {
			var btn_save_calendar = $('span[class~="process-icon-save-calendar"]').parent();
			var btn_submit_calendar = $('#submitDatePicker');

			if (btn_save_calendar.length > 0 && btn_submit_calendar.length > 0)
			{
				btn_submit_calendar.hide();
				btn_save_calendar.click(function() {
					btn_submit_calendar.before('<input type="hidden" name="'+btn_submit_calendar.attr("name")+'" value="1" />');

					$('#calendar_form').submit();
				});
			}

			var btn_save_settings = $('span[class~="process-icon-save-settings"]').parent();
			var btn_submit_settings = $('#submitSettings');

			if (btn_save_settings.length > 0 && btn_submit_settings.length > 0)
			{
				btn_submit_settings.hide();
				btn_save_settings.click(function() {
					btn_submit_settings.before('<input type="hidden" name="'+btn_submit_settings.attr("name")+'" value="1" />');

					$('#settings_form').submit();
				});
			}
		});
	<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "override_tpl"} */
}
