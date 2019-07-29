<?php
/* Smarty version 3.1.33, created on 2019-07-29 03:23:32
  from '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/controllers/attributes_groups/helpers/list/list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e66b4257434_63135697',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3c9cb4639f96f73098c7a312184dd72b21bd8fa' => 
    array (
      0 => '/var/www/html/SENSHOP/admin523wv7vhl/themes/default/template/controllers/attributes_groups/helpers/list/list_header.tpl',
      1 => 1563803867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e66b4257434_63135697 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6126215605d3e66b4256c85_68727249', 'leadin');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block 'leadin'} */
class Block_6126215605d3e66b4256c85_68727249 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'leadin' => 
  array (
    0 => 'Block_6126215605d3e66b4256c85_68727249',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function() {
			$(location.hash).click();
		});
	<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'leadin'} */
}
