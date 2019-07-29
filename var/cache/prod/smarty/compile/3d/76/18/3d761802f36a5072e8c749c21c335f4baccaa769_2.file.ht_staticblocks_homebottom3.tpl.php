<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:46:05
  from '/var/www/html/SENSHOP/modules/ht_staticblocks/views/templates/hook/ht_staticblocks_homebottom3.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5ded0dfca3_83174809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d761802f36a5072e8c749c21c335f4baccaa769' => 
    array (
      0 => '/var/www/html/SENSHOP/modules/ht_staticblocks/views/templates/hook/ht_staticblocks_homebottom3.tpl',
      1 => 1564238984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5ded0dfca3_83174809 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Static Block module -->
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['block_list']->value, 'block');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
?>
	<?php if (isset($_smarty_tpl->tpl_vars['block']->value['content'])) {?>
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['block']->value['content'],'quotes','UTF-8' ));?>

	<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<!-- /Static block module --><?php }
}
