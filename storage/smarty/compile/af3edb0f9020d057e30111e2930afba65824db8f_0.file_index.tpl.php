<?php
/* Smarty version 5.7.0, created on 2026-02-11 21:34:59
  from 'file:products/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698cf60380cb11_99181065',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af3edb0f9020d057e30111e2930afba65824db8f' => 
    array (
      0 => 'products/index.tpl',
      1 => 1770845696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:partials/filter-form.tpl' => 1,
  ),
))) {
function content_698cf60380cb11_99181065 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_760388795698cf6037f92f9_91521765', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_760388795698cf6037f92f9_91521765 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/products';
?>


<style>
.product-link{
    background-color:rgba(48, 151, 255, 0.758) !important;
}
</style>

<div class="container py-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Products</h1>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-md-10">
                    <input 
                        type="search" 
                        name="q" 
                        id="q" 
                        class="form-control form-control-lg" 
                        placeholder="Search for anything..."
                    >
                </div>
                <div class="col-md-2 text-md-end">
                    <button class="btn btn-outline-danger w-100"  onclick="openFilter()" id="btn-filter">
                        <i class="fa fa-sliders-h me-2"></i> Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div id="results">
         <div class='w-100 text-center'><span style='width:200px; height:200px;' class='spinner-border text-secondary fs-3 mt-3'></span> </div>
    </div>
 
</div>

<?php $_smarty_tpl->renderSubTemplate("file:partials/filter-form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
 src='js/filter.js'><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
