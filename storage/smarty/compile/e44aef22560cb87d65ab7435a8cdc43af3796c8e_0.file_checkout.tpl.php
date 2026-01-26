<?php
/* Smarty version 5.7.0, created on 2026-01-25 23:28:56
  from 'file:cart/checkout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6976a7380aec90_89572283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e44aef22560cb87d65ab7435a8cdc43af3796c8e' => 
    array (
      0 => 'cart/checkout.tpl',
      1 => 1769381625,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6976a7380aec90_89572283 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_469942056976a738094ac5_55139811', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_469942056976a738094ac5_55139811 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
?>

<h2 class="mb-4">Checkout</h2>

<form id="paymentForm">
    <input type="hidden" name="csrf" value="<?php echo $_smarty_tpl->getValue('csrf_token');?>
">
    <input type="hidden" id="buyer_id" value="<?php echo $_smarty_tpl->getValue('buyer');?>
">
    <input type="hidden" id="amount" value="<?php echo $_smarty_tpl->getValue('subtotal');?>
">
    <input type="hidden" id="email" value="<?php echo $_smarty_tpl->getValue('email');?>
">
    <input type="hidden" id="key" value="<?php echo $_smarty_tpl->getValue('paystackKey');?>
">
    <input type="hidden" id="txn_ref" value="<?php echo $_smarty_tpl->getValue('txn_ref');?>
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
>
$(function () {

    $('#paymentForm').on('submit', function (e) {
        e.preventDefault();

        let address = $('#address').val().trim();
        let phone   = $('#phone').val().trim();
        let buyer   = $('#buyer_id').val();
        let email   = $('#email').val();
        let key     = $('#key').val();
        let ref     = $('#txn_ref').val();
        let amount  = Math.round(parseFloat($('#amount').val()) * 100); // Kobo

        if (!address || !phone || !buyer || !email || !key || !ref || !amount) {
            alert('Missing required fields');
            return;
        }

        let handler = PaystackPop.setup({
            key: key,
            email: email,
            amount: amount,
            currency: "NGN",
            ref: ref,

            metadata: {
                custom_fields: [
                    {
                        display_name: "Buyer ID",
                        variable_name: "buyer_id",
                        value: buyer
                    },
                    {
                        display_name: "Phone",
                        variable_name: "phone",
                        value: phone
                    },
                    {
                        display_name: "Address",
                        variable_name: "address",
                        value: address
                    }
                ]
            },

            callback: function (response) {
                // ✅ ALWAYS use response.reference
                window.location.href =
                    "cart/verify-transaction" +
                    "?status=success" +
                    "&reference=" + encodeURIComponent(response.reference) +
                    "&id=" + encodeURIComponent(buyer) +
                    "&amount=" + encodeURIComponent(amount / 100);
            },

            onClose: function () {
                alert("Payment cancelled");
            }
        });

        handler.openIframe();
    });

});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
