<?php
/* Smarty version 5.7.0, created on 2026-01-25 22:17:41
  from 'file:cart/verify-transaction.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_69769685411cd4_78948540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29c5b7953335adfa65888e408f61780c6cc9c3ab' => 
    array (
      0 => 'cart/verify-transaction.tpl',
      1 => 1769379456,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69769685411cd4_78948540 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1875183471697696853d2a77_71477398', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1875183471697696853d2a77_71477398 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/cart';
?>

<div class="container mt-5">

    <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
        <div class="alert alert-danger text-center">
            <h4>Payment Failed ❌</h4>
            <p><?php echo $_smarty_tpl->getValue('error');?>
</p>
            <a href="../checkout" class="btn btn-danger mt-3">Try Again</a>
        </div>
    <?php }?>

    <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null)))) {?>
        <div class="alert alert-success text-center">
            <h3>Payment Successful 🎉</h3>
            <p><strong>Reference:</strong> <?php echo $_smarty_tpl->getValue('reference');?>
</p>
            <p><strong>Amount Paid:</strong> ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('amount'),2);?>
</p>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price (₦)</th>
                            <th>Quantity</th>
                            <th>Subtotal (₦)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cart_items'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('item')['product_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['price'],2);?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('item')['quantity'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('item')['price']*$_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['quantity'],2);?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <p class="mb-1"><strong>Subtotal:</strong> ₦<?php echo $_smarty_tpl->getValue('subtotal');?>
</p>
                <p class="mb-1"><strong>VAT (5%):</strong> ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('VAT'),2);?>
</p>
                <p class="mb-1"><strong>Delivery Fee:</strong> ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('delivery_fee'),2);?>
</p>
                <h5 class="mb-0"><strong>Grand Total:</strong> ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('grand_total'),2);?>
</h5>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Buyer Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo $_smarty_tpl->getValue('userName');?>
</p>
                <p><strong>Email:</strong> <?php echo $_smarty_tpl->getValue('userEmail');?>
</p>
                <p><strong>Address:</strong> <?php echo $_smarty_tpl->getValue('userAddress');?>
</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/orders" class="btn btn-success">View My Orders</a>
            <a href="/shop" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php }?>

</div>
<?php
}
}
/* {/block "content"} */
}
