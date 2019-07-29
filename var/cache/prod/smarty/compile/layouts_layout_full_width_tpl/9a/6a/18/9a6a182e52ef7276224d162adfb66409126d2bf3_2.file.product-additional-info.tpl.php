<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:57:02
  from '/var/www/html/SENSHOP/themes/shopkart_lite/templates/catalog/_partials/product-additional-info.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e607e133232_29450775',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a6a182e52ef7276224d162adfb66409126d2bf3' => 
    array (
      0 => '/var/www/html/SENSHOP/themes/shopkart_lite/templates/catalog/_partials/product-additional-info.tpl',
      1 => 1564238984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e607e133232_29450775 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="product-additional-info">
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductAdditionalInfo','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

</div>
<?php }
}
