<?php
/* Smarty version 5.7.0, created on 2026-02-11 21:25:53
  from 'file:admin/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698cf3e159e805_66400862',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a3ce4e996977513c8f6b24398804eec8268a518' => 
    array (
      0 => 'admin/index.tpl',
      1 => 1770845070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698cf3e159e805_66400862 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_957436416698cf3e1568cd3_63863330', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_957436416698cf3e1568cd3_63863330 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>


    <link rel="stylesheet" href="../css/dashboard.css"/>

    <div class="container-fluid">

        <h4 class="mb-3">📦 My Inventory</h4>
    
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('products')) == 0) {?>
            <div class="alert alert-info">
                You have no products yet.
            </div>
        <?php } else { ?>
    
        <table style='overflow-x:auto;' class="table table-bordered table-hover w-100">
        
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Price (₦)</th>
                    <th>In Stock</th>
                    <th>Sold</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
    
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('product')['name'];?>
</td>
    
                    <td>
                        ₦<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')['price'],2);?>

                    </td>
    
                    <td><?php echo $_smarty_tpl->getValue('product')['quantity'];?>
</td>
    
                    <td><?php echo $_smarty_tpl->getValue('product')['quantity_sold'];?>
</td>
    
                    <td>
                        <?php if ($_smarty_tpl->getValue('product')['quantity'] == 0) {?>
                            <span class="badge bg-danger">Out of stock</span>
                        <?php } elseif ($_smarty_tpl->getValue('product')['quantity'] <= 5) {?>
                            <span class="badge bg-warning text-dark">Low stock</span>
                        <?php } else { ?>
                            <span class="badge bg-success">In stock</span>
                        <?php }?>
                    </td>
    
                    <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('product')['created_at'],"%b %e, %Y");?>
</td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    
            </tbody>
        </table>
    
        <?php }?>
    </div>
     
  </div>

<?php
}
}
/* {/block "content"} */
}
