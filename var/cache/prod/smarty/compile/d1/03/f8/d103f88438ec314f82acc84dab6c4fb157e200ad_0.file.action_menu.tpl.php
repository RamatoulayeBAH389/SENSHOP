<?php
/* Smarty version 3.1.33, created on 2019-07-29 03:24:03
  from '/var/www/html/SENSHOP/modules/ps_mbo/views/templates/admin/include/action_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e66d3dc8861_71011942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd103f88438ec314f82acc84dab6c4fb157e200ad' => 
    array (
      0 => '/var/www/html/SENSHOP/modules/ps_mbo/views/templates/admin/include/action_menu.tpl',
      1 => 1563804443,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e66d3dc8861_71011942 (Smarty_Internal_Template $_smarty_tpl) {
?> 
<div v-if="module.attributes.url_active == 'buy'" class="form-action-button-container">
    <a class="btn btn-primary btn-primary-reverse btn-block btn-outline-primary light-button module_action_menu_go_to_addons" v-bind:href="module.attributes.url" target="_blank">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discover','d'=>'Admin.Modules.Feature'),$_smarty_tpl ) );?>

    </a>
 </div>
<div v-else class="btn-group form-action-button-container">
	<form class="btn-group form-action-button" method="post" v-bind:action="module.attributes.urls.install">
		<button type="submit" class="btn btn-primary-reverse btn-outline-primary light-button module_action_menu_install" >
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Install','d'=>'Admin.Modules.Feature'),$_smarty_tpl ) );?>

		</button>
	</form>
</div><?php }
}
