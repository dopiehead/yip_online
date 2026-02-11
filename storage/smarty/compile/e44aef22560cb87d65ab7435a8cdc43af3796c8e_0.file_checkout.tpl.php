<?php
/* Smarty version 5.7.0, created on 2026-02-11 13:13:20
  from 'file:cart/checkout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c8070451310_65406001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e44aef22560cb87d65ab7435a8cdc43af3796c8e' => 
    array (
      0 => 'cart/checkout.tpl',
      1 => 1770811412,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698c8070451310_65406001 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1894883565698c8070432e38_71261245', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1894883565698c8070432e38_71261245 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
?>

<h2 class="mb-4">Checkout</h2>

<form id="paymentForm">
    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">
    <input type="hidden" id="buyer_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('buyer'), ENT_QUOTES, 'UTF-8', true);?>
">
    <input type="hidden" id="amount" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('subtotal'), ENT_QUOTES, 'UTF-8', true);?>
">
    <input type="hidden" id="email" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('email'), ENT_QUOTES, 'UTF-8', true);?>
">
    <input type="hidden" id="key" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('paystackKey'), ENT_QUOTES, 'UTF-8', true);?>
">
    <input type="hidden" id="txn_ref" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('txn_ref'), ENT_QUOTES, 'UTF-8', true);?>
">

    <div class="mb-3">
        <label>Delivery Address</label>
        <textarea id="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" id="phone" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-100">
        Pay ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('subtotal'),2);?>

    </button>
</form>

<!-- Paystack SDK -->
<?php echo '<script'; ?>
 src="https://js.paystack.co/v1/inline.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/payment.js"><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
