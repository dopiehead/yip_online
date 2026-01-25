<?php
/* Smarty version 5.7.0, created on 2026-01-25 02:44:54
  from 'file:admin/contents.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_697583a69f61b2_99792482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '678553262214fecc170e442ced07b18b6b210b45' => 
    array (
      0 => 'admin/contents.tpl',
      1 => 1769309089,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/components/sidebar.tpl' => 2,
  ),
))) {
function content_697583a69f61b2_99792482 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo $_smarty_tpl->getValue('title');?>
</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/sidebar.css"/>
  <link rel="stylesheet" href="../css/topbar.css"/>
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
>
</head>
<body>

  <?php $_smarty_tpl->renderSubTemplate("file:admin/components/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <div class="main-content">

    <?php $_smarty_tpl->renderSubTemplate("file:admin/components/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <div class="container-fluid">
    <div class="form-container d-flex justify-content-between align-items-center gap-2 flex-md-row flex-column">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
      <div class='package border border-1 border-mute position-relative'>
        <a href='editProduct.php?id=<?php echo $_smarty_tpl->getValue('product')['id'];?>
' class='text-dark px-2 py-1 text-decoration-none bg-white translate-top right-0 position-absolute'><i class='fa fa-edit'></i></a>
        <img style='height:200px;width:250px;' class='img-fluid' src='<?php echo (($tmp = $_smarty_tpl->getValue('product')['product_image'][0] ?? null)===null||$tmp==='' ? "https://placehold.co/400" ?? null : $tmp);?>
'>
        <div class='d-flex flex-column flex-row p-2'>
          <span class='fw-bold text-capitalize'><?php echo $_smarty_tpl->getValue('product')['product_name'];?>
</span>
          <span class='text-danger text-capitalize'><?php echo $_smarty_tpl->getValue('product')['product_price'];?>
</span>
        </div>
      </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>
     </div>
  </div>

  </body>
  </html><?php }
}
