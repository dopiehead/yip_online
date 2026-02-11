<?php
/* Smarty version 5.7.0, created on 2026-02-11 03:33:55
  from 'file:partials/products.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698bf8a3967923_71293312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8367c51641475ecc6a17a82750b6cc231d67732' => 
    array (
      0 => 'partials/products.tpl',
      1 => 1770780758,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698bf8a3967923_71293312 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/partials';
?>
<div class='text-end my-2'>
      <span class='fw-bold text-secondary'><?php echo $_smarty_tpl->getValue('totalRecord');?>
</span> Product(s) found
</div>

<div class="row g-4">

<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0 product-card">

            <!-- Product Image -->
            <div class="ratio ratio-4x3">
                <img src="<?php echo $_smarty_tpl->getValue('product')['image'];?>
" 
                     class="card-img-top object-fit-cover" 
                     alt="<?php echo $_smarty_tpl->getValue('product')['name'];?>
">
            </div>

            <div class="card-body d-flex flex-column">

                <h5 class="card-title fw-semibold mb-2 text-truncate">
                    <?php echo $_smarty_tpl->getValue('product')['name'];?>

                </h5>

                <p class="text-danger fw-bold fs-5 mb-3">
                    $ <?php echo $_smarty_tpl->getValue('product')['price'];?>

                </p>

                <a href="product?id=<?php echo $_smarty_tpl->getValue('product')['id'];?>
" 
                   class="btn btn-primary mt-auto w-100">
                    View Product
                </a>

            </div>
        </div>
    </div>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
<!-- Pagination -->
<?php echo $_smarty_tpl->getValue('pagination');?>

</div><?php }
}
