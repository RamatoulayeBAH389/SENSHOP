<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:46:05
  from '/var/www/html/SENSHOP/themes/shopkart_lite/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5ded100162_37030341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e90693275157d1eaadd84d57c471406490203b4' => 
    array (
      0 => '/var/www/html/SENSHOP/themes/shopkart_lite/templates/_partials/footer.tpl',
      1 => 1564238984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5ded100162_37030341 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14173910275d3e5ded0fd538_33782693', 'hook_footer_before');
?>

<div class="footer-container">
    <div class="container">
        <div class="row">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19049655945d3e5ded0fdeb0_97963446', 'hook_footer');
?>

        </div>
        <div class="row">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5392065855d3e5ded0fe6e5_16513285', 'hook_footer_after');
?>

        </div>
        <div class="col-md-12 footer-bottom">
            <div class="row">
                <div class="col-md-12">
                    <p class="copyright">
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15477434845d3e5ded0feee5_85039389', 'copyright_link');
?>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }
/* {block 'hook_footer_before'} */
class Block_14173910275d3e5ded0fd538_33782693 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_14173910275d3e5ded0fd538_33782693',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'hook_footer_before'} */
/* {block 'hook_footer'} */
class Block_19049655945d3e5ded0fdeb0_97963446 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_19049655945d3e5ded0fdeb0_97963446',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'hook_footer'} */
/* {block 'hook_footer_after'} */
class Block_5392065855d3e5ded0fe6e5_16513285 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_5392065855d3e5ded0fe6e5_16513285',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'hook_footer_after'} */
/* {block 'copyright_link'} */
class Block_15477434845d3e5ded0feee5_85039389 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'copyright_link' => 
  array (
    0 => 'Block_15477434845d3e5ded0feee5_85039389',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <a class="_blank" href="http://www.prestashop.com" target="_blank">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%copyright% %year% - Ecommerce software by %prestashop%','sprintf'=>array('%prestashop%'=>'PrestaShop™','%year%'=>date('Y'),'%copyright%'=>'©'),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

                            </a>
                        <?php
}
}
/* {/block 'copyright_link'} */
}
