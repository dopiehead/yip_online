<?php
/* Smarty version 5.7.0, created on 2026-01-25 01:57:57
  from 'file:admin/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_697578a52f0fe8_40744559',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a3ce4e996977513c8f6b24398804eec8268a518' => 
    array (
      0 => 'admin/index.tpl',
      1 => 1769306274,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/components/sidebar.tpl' => 1,
    'file:admin/components/topbar.tpl' => 1,
  ),
))) {
function content_697578a52f0fe8_40744559 (\Smarty\Template $_smarty_tpl) {
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

    <?php $_smarty_tpl->renderSubTemplate("file:admin/components/topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <div class="container-fluid">
    
     </div>
     
  </div>

  </body>
  </html><?php }
}
