<?php
/* Smarty version 5.7.0, created on 2026-02-12 17:05:55
  from 'file:admin/order-history.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698e08730efb64_50962873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a87d98cd970cad9a366f545bc4b559af949f035' => 
    array (
      0 => 'admin/order-history.tpl',
      1 => 1770915930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698e08730efb64_50962873 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_775992712698e08730c4e29_91538310', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_775992712698e08730c4e29_91538310 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>


  <link rel="stylesheet" href="../css/order-history.css"/>

  <div style='display:none;z-index:999;' class='position-fixed popup-receipt translate-middle top-50 start-50 ' id='result'></div>
  <div style='opacity:0.7;z-index:990;' class='w-100 h-100 bg-dark bg-overlay position-fixed top-0 d-none'></div>
  <div class='loader' style='display:none'>
      <span class='spinner-border text-secondary fs-2'></span>
  </div>
    <div class="container-fluid mt-3">
    <div class="form-container d-flex justify-content-md-start justify-content-between align-items-center gap-4 flex-md-row flex-column">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
      <div class='package border border-1 border-mute position-relative'>
        <img style='height:200px;width:250px;' class='img-fluid' src='<?php echo (($tmp = $_smarty_tpl->getValue('product')['image'] ?? null)===null||$tmp==='' ? "https://placehold.co/400" ?? null : $tmp);?>
'>
        <div class='d-flex flex-column flex-row p-2'>
          <span class='fw-bold text-capitalize'><?php echo $_smarty_tpl->getValue('product')['name'];?>
</span>
          <span class='text-danger text-capitalize'><?php echo $_smarty_tpl->getValue('product')['price'];?>
 ( <?php echo $_smarty_tpl->getValue('product')['total'];?>
 )</span>
        </div>
        <div class='mt-2 d-flex justify-content-end px-3 pb-2'>
             <a href='#' id='btn-receipt' class='text-sm text-primary text-decoration-underline' data-id='<?php echo $_smarty_tpl->getValue('product')['reference_no'];?>
'>View receipt <i class='fas fa-arrow-right'></i></a>
        </div>
      </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>
  </div>
  </div>
  <?php echo '<script'; ?>
 src='../js/order-history.js'><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
