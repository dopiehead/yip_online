<?php
/* Smarty version 5.7.0, created on 2026-02-11 12:14:37
  from 'file:products/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c72ad009a58_37529446',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ec03842403674df5bdd660ddbe6703250ec1abb' => 
    array (
      0 => 'products/show.tpl',
      1 => 1770812072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698c72ad009a58_37529446 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_619853788698c72acf1d8b2_09514007', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_619853788698c72acf1d8b2_09514007 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
?>

<div class="row">
    <div class="col-md-6 mb-3">
        <img src="<?php echo $_smarty_tpl->getValue('product')['image'];?>
" class="img-fluid rounded w-100 h-100" alt="<?php echo $_smarty_tpl->getValue('product')['name'];?>
">
    </div>

    <div class="col-md-6">
        <h2><?php echo $_smarty_tpl->getValue('product')['name'];?>
</h2>
        <h4 class="text-primary mb-3">$ <?php echo $_smarty_tpl->getValue('product')['price'];?>
</h4>
        <?php if ($_smarty_tpl->getValue('userId')) {?>
           <input type='hidden' name="buyer_id" id="buyer_id" value="<?php echo $_smarty_tpl->getValue('userId');?>
">
        <?php }?>

        <div class="d-flex gap-2 mt-4">
            <input type="button" value="-" id="subs" class="btn btn-light" onclick="subst()">&nbsp;
            <input type="number" id="noofitem" min="1" value="<?php echo $_smarty_tpl->getValue('product')['quantity'];?>
" id="qty" class="form-control w-25">
            <input type="button" value="+" id="adds" onclick="add()" class="btn btn-light"> 
          <?php if ($_smarty_tpl->getValue('userId') != $_smarty_tpl->getValue('product')['user_id']) {?>  
            <button 
                class="btn btn-success add-to-cart"
                data-id="<?php echo $_smarty_tpl->getValue('product')['id'];?>
">
                <span class='submit-note'>Add to Cart</span>
                <span style='display:none;' class='spinner-border text-white'></span>
            </button>
         <?php } else { ?>
            <a
            class="btn btn-success"
            href="admin/edit-product?id=<?php echo (($tmp = $_smarty_tpl->getValue('product')['id'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
">
            <span>Manage this product</span>
           
        </a>
         <?php }?>


        </div>
        <input type="hidden" value="<?php echo $_smarty_tpl->getValue('product')['quantity'];?>
" id="maximum">
        <input type="hidden" name="csrf" id="csrf" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">
        <div id="cart-feedback" class="mt-3"></div>
    </div>
</div>

<?php echo '<script'; ?>
 src='js/product.js'><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
