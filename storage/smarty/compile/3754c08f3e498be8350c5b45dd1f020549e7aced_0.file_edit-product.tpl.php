<?php
/* Smarty version 5.7.0, created on 2026-01-25 08:13:55
  from 'file:admin/edit-product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6975d0c3c02de9_36669613',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3754c08f3e498be8350c5b45dd1f020549e7aced' => 
    array (
      0 => 'admin/edit-product.tpl',
      1 => 1769328832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6975d0c3c02de9_36669613 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17718676516975d0c3be0bb8_09982472', "content");
?>


<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_17718676516975d0c3be0bb8_09982472 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>


    <div class="container-fluid mt-4">
      <div class="form-container p-3 border rounded shadow bg-white">

        <form method="POST" action="update-product">
          <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('product')['id'];?>
" />
          
          <div class="mb-3">
            <label class="form-label fw-bold">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')['name'], ENT_QUOTES, 'UTF-8', true);?>
">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Product Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')['price'], ENT_QUOTES, 'UTF-8', true);?>
">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('product')['quantity'] ?? null)===null||$tmp==='' ? 1 ?? null : $tmp);?>
">
          </div>

          <input type="hidden" name="csrf" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">
          <div>
          
          <button type="submit" class="btn btn-primary">Update Product</button>

          </div>
        </form>
        <button  class="btn btn-danger delete-product form-control mt-2" id="<?php echo $_smarty_tpl->getValue('product')['id'];?>
"><i class='fa fa-trash text-white'></i> Delete Product</button>
      </div>
    </div>
    <?php echo '<script'; ?>
 src='../js/delete-product.js'>
    

<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
