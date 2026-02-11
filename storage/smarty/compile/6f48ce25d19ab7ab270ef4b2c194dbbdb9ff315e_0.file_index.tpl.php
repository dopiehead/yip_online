<?php
/* Smarty version 5.7.0, created on 2026-02-11 21:52:26
  from 'file:cart/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698cfa1a690e56_00942676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f48ce25d19ab7ab270ef4b2c194dbbdb9ff315e' => 
    array (
      0 => 'cart/index.tpl',
      1 => 1770846739,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698cfa1a690e56_00942676 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1022200930698cfa1a64a721_33515034', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1022200930698cfa1a64a721_33515034 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
?>

    <style>
    .cart-link{
        background-color:rgba(48, 151, 255, 0.758) !important;
    }
    </style>


<h2 class="mb-4">Shopping Cart</h2>

<?php if (( !$_smarty_tpl->hasVariable('product') || empty($_smarty_tpl->getValue('product')))) {?>
    <div class="alert alert-info">Your cart is empty</div>
<?php } else { ?>
<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Product</th>
            <th width="120">Qty</th>
            <th width="120">Price</th>
            <th width="120">Total</th>
            <th width="80"></th>
        </tr>
    </thead>
    <tbody>
        <?php $_smarty_tpl->assign('grandTotal', 0, false, NULL);?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('product'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
            <?php $_smarty_tpl->assign('itemTotal', $_smarty_tpl->getValue('item')['total']*$_smarty_tpl->getValue('item')['price'], false, NULL);?>
            <?php $_smarty_tpl->assign('grandTotal', $_smarty_tpl->getValue('grandTotal')+$_smarty_tpl->getValue('itemTotal'), false, NULL);?>
        <tr>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['total'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><span class='fas fa-naira-sign'></span> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['price'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><span class='fas fa-naira-sign'></span> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemTotal'), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td>
                <button class="btn btn-sm btn-danger remove-item" data-id="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                    ✕
                </button>
                <input id='crsf' name='csrf' type='hidden' value='<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
'>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
</table>

<div class="d-flex justify-content-between mt-3">
    <h4>Total: <span class='fas fa-naira-sign'></span> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('grandTotal'), ENT_QUOTES, 'UTF-8', true);?>
</h4>
    <a href="checkout" class="btn btn-primary">Proceed to Checkout</a>
</div>
<?php }
echo '<script'; ?>
 src='js/remove-item.js'><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
