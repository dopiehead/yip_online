<?php
/* Smarty version 5.7.0, created on 2026-01-24 21:49:42
  from 'file:products/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_69753e769f1fa5_52238873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ec03842403674df5bdd660ddbe6703250ec1abb' => 
    array (
      0 => 'products/show.tpl',
      1 => 1769291363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69753e769f1fa5_52238873 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_65931738569753e769d19e0_08572619', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_65931738569753e769d19e0_08572619 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
?>

<div class="row">
    <div class="col-md-6 mb-3">
        <img src="<?php echo $_smarty_tpl->getValue('product')['image'];?>
" class="img-fluid rounded" alt="<?php echo $_smarty_tpl->getValue('product')['name'];?>
">
    </div>

    <div class="col-md-6">
        <h2><?php echo $_smarty_tpl->getValue('product')['name'];?>
</h2>
        <h4 class="text-primary mb-3">$ <?php echo $_smarty_tpl->getValue('product')['price'];?>
</h4>
        <?php if ($_smarty_tpl->getValue('userId')) {?>
           <input id="seller_id" value="<?php echo $_smarty_tpl->getValue('userId');?>
">
        <?php }?>
        <p><?php echo (($tmp = $_smarty_tpl->getValue('product')['description'] ?? null)===null||$tmp==='' ? "No description available." ?? null : $tmp);?>
</p>

        <div class="d-flex gap-2 mt-4">
            <input type="number" id="noofitem" min="1" value="1" id="qty" class="form-control w-25">
            <button 
                class="btn btn-success add-to-cart"
                data-id="<?php echo $_smarty_tpl->getValue('product')['id'];?>
">
                <span class='submit-note'>Add to Cart</span>
                <span style='display:none;' class='spinner-border text-white'></span>
            </button>
        </div>

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
