<?php
/* Smarty version 5.7.0, created on 2026-01-25 07:42:52
  from 'file:admin/sold-history.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6975c97c46a836_63700876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e529897db82e88d78d2ed9eabe84210da195699' => 
    array (
      0 => 'admin/sold-history.tpl',
      1 => 1769326948,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6975c97c46a836_63700876 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8076226996975c97c456c79_43419915', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_8076226996975c97c456c79_43419915 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>

    <div class="container-fluid">
    <div class="form-container d-flex justify-content-between align-items-center gap-2 flex-md-row flex-column">
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
</span>
        </div>
      </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>
     </div>
 <?php
}
}
/* {/block "content"} */
}
