<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:46:04
  from '/var/www/html/SENSHOP/modules/ps_legalcompliance/views/templates/hook/hookDisplayProductPriceBlock_old_price.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5decc89221_19598364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5acc5974509a991673749c569a8d303331e12eca' => 
    array (
      0 => '/var/www/html/SENSHOP/modules/ps_legalcompliance/views/templates/hook/hookDisplayProductPriceBlock_old_price.tpl',
      1 => 1564021443,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5decc89221_19598364 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['smartyVars']->value)) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['smartyVars']->value['old_price']) && isset($_smarty_tpl->tpl_vars['smartyVars']->value['old_price']['before_str_i18n'])) {?>
        <span class="aeuc_before_label">
            <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['smartyVars']->value['old_price']['before_str_i18n'],'htmlall' )), ENT_QUOTES, 'UTF-8');?>

        </span>
    <?php }
}
}
}
