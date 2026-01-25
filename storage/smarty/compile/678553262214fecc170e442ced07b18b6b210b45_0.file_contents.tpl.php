<?php
/* Smarty version 5.7.0, created on 2026-01-25 06:02:14
  from 'file:admin/contents.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6975b1e66deb26_71059313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '678553262214fecc170e442ced07b18b6b210b45' => 
    array (
      0 => 'admin/contents.tpl',
      1 => 1769320931,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6975b1e66deb26_71059313 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20538848916975b1e66a7c17_12971577', "content");
?>


<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_20538848916975b1e66a7c17_12971577 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>

    <div class="container-fluid mt-3">
      <div class="form-container d-flex flex-wrap justify-content-start gap-3">
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('products')) > 0) {?>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
            <div class='package border border-1 border-muted position-relative'>
              <a href='edit-product?id=<?php echo (($tmp = $_smarty_tpl->getValue('product')['id'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
' 
                 class='text-dark px-2 py-1 text-decoration-none bg-white translate-top right-0 position-absolute'>
                <i class='fa fa-edit'></i>
              </a>
              <img style='height:200px;width:250px;' class='img-fluid' 
                   src='<?php echo (($tmp = $_smarty_tpl->getValue('product')['image'] ?? null)===null||$tmp==='' ? "https://placehold.co/400" ?? null : $tmp);?>
' 
                   alt='<?php echo (($tmp = $_smarty_tpl->getValue('product')['name'] ?? null)===null||$tmp==='' ? "Product" ?? null : $tmp);?>
'>
              <div class='d-flex flex-column p-2'>
                <span class='fw-bold text-capitalize'><?php echo (($tmp = $_smarty_tpl->getValue('product')['name'] ?? null)===null||$tmp==='' ? "No Name" ?? null : $tmp);?>
</span>
                <span class='text-danger text-capitalize'><?php echo (($tmp = $_smarty_tpl->getValue('product')['price'] ?? null)===null||$tmp==='' ? "N/A" ?? null : $tmp);?>
</span>
              </div>
            </div>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <p class="text-muted">No products found.</p>
        <?php }?>
      </div>
    </div>

    <?php
}
}
/* {/block "content"} */
}
