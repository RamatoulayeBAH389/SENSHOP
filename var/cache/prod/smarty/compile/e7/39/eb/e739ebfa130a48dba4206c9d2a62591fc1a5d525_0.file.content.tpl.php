<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:48:17
  from '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5e71cccaa1_43209708',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e739ebfa130a48dba4206c9d2a62591fc1a5d525' => 
    array (
      0 => '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/content.tpl',
      1 => 1563803867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5e71cccaa1_43209708 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
