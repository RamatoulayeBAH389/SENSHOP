<?php
/* Smarty version 3.1.33, created on 2019-07-29 02:46:04
  from '/var/www/html/SENSHOP/themes/shopkart_lite/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e5decdbdcd2_04719024',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9cfea9cfb865bb0388e7f0a1d24592950cd880e0' => 
    array (
      0 => '/var/www/html/SENSHOP/themes/shopkart_lite/templates/page.tpl',
      1 => 1564238984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e5decdbdcd2_04719024 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1037775005d3e5decdb8495_04145860', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_7836718505d3e5decdb9416_54793464 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_13256277825d3e5decdb8b35_24706228 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7836718505d3e5decdb9416_54793464', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_13897824195d3e5decdbb0a7_03414856 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_6293525955d3e5decdbb986_33804974 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_15228325735d3e5decdbaa32_50045151 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13897824195d3e5decdbb0a7_03414856', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6293525955d3e5decdbb986_33804974', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_12647802375d3e5decdbcd78_76380292 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_531437905d3e5decdbc731_80555404 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12647802375d3e5decdbcd78_76380292', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_1037775005d3e5decdb8495_04145860 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1037775005d3e5decdb8495_04145860',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_13256277825d3e5decdb8b35_24706228',
  ),
  'page_title' => 
  array (
    0 => 'Block_7836718505d3e5decdb9416_54793464',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_15228325735d3e5decdbaa32_50045151',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_13897824195d3e5decdbb0a7_03414856',
  ),
  'page_content' => 
  array (
    0 => 'Block_6293525955d3e5decdbb986_33804974',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_531437905d3e5decdbc731_80555404',
  ),
  'page_footer' => 
  array (
    0 => 'Block_12647802375d3e5decdbcd78_76380292',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13256277825d3e5decdb8b35_24706228', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15228325735d3e5decdbaa32_50045151', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_531437905d3e5decdbc731_80555404', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
