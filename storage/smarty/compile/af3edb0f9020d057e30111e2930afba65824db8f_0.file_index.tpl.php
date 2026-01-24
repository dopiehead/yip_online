<?php
/* Smarty version 5.7.0, created on 2026-01-24 21:09:06
  from 'file:products/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_697534f2206355_44965134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af3edb0f9020d057e30111e2930afba65824db8f' => 
    array (
      0 => 'products/index.tpl',
      1 => 1769288941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_697534f2206355_44965134 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_148091198697534f21e79a2_43402851', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_148091198697534f21e79a2_43402851 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
?>

<h1 class="mb-4">Products</h1>

<div class="row">
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="<?php echo $_smarty_tpl->getValue('product')['image'];?>
" class="card-img-top" alt="<?php echo $_smarty_tpl->getValue('product')['name'];?>
">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $_smarty_tpl->getValue('product')['name'];?>
</h5>
          <p class="card-text">$ <?php echo $_smarty_tpl->getValue('product')['price'];?>
</p>
          <a href="product?id=<?php echo $_smarty_tpl->getValue('product')['id'];?>
" class="btn btn-primary mt-auto">View</a>
        </div>
      </div>
    </div>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
<?php
}
}
/* {/block "content"} */
}
