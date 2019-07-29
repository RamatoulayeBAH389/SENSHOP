<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:46:05
  from '/var/www/html/SENSHOP/modules/ps_legalcompliance/views/templates/hook/hookDisplayFooterAfter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5ded149aa1_72773313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd625434a3933b5ad969b126980987a7b48cbf060' => 
    array (
      0 => '/var/www/html/SENSHOP/modules/ps_legalcompliance/views/templates/hook/hookDisplayFooterAfter.tpl',
      1 => 1564021443,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5ded149aa1_72773313 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="aeuc_footer_info">
	<?php if (isset($_smarty_tpl->tpl_vars['delivery_additional_information']->value)) {?>
		* <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery_additional_information']->value, ENT_QUOTES, 'UTF-8');?>

		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_shipping']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping and payment','d'=>'Modules.Legalcompliance.Shop'),$_smarty_tpl ) );?>
</a>
	<?php } else { ?>
		<?php if ($_smarty_tpl->tpl_vars['tax_included']->value) {?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All prices are mentioned tax included','d'=>'Modules.Legalcompliance.Shop'),$_smarty_tpl ) );?>

		<?php } else { ?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All prices are mentioned tax excluded','d'=>'Modules.Legalcompliance.Shop'),$_smarty_tpl ) );?>

		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['show_shipping']->value) {?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'and','d'=>'Modules.Legalcompliance.Shop'),$_smarty_tpl ) );?>

			<?php if ($_smarty_tpl->tpl_vars['link_shipping']->value) {?>
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_shipping']->value, ENT_QUOTES, 'UTF-8');?>
">
			<?php }?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'shipping excluded','d'=>'Modules.Legalcompliance.Shop'),$_smarty_tpl ) );?>

			<?php if ($_smarty_tpl->tpl_vars['link_shipping']->value) {?>
				</a>
			<?php }?>
		<?php }?>
	<?php }?>
</div>
<?php }
}
