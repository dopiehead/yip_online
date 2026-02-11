<?php
/* Smarty version 5.7.0, created on 2026-02-11 13:10:21
  from 'file:layouts/main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c7fbd1c3452_69626868',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e4e2dbfbc71c6aac8ac55fecbe17dfd9d3b03b' => 
    array (
      0 => 'layouts/main.tpl',
      1 => 1770815415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../partials/navbar.tpl' => 1,
    'file:../partials/footer.tpl' => 1,
  ),
))) {
function content_698c7fbd1c3452_69626868 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (($tmp = $_smarty_tpl->getValue('title') ?? null)===null||$tmp==='' ? "Yiponline" ?? null : $tmp);?>
</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>


</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:../partials/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <div class="container py-4">
        <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <div class="alert alert-danger"><?php echo $_smarty_tpl->getValue('error');?>
</div>
        <?php }?>
        <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null)))) {?>
            <div class="alert alert-success"><?php echo $_smarty_tpl->getValue('success');?>
</div>
        <?php }?>

        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_983958945698c7fbd1b4dc8_60577426', "content");
?>

    </div>

    <?php $_smarty_tpl->renderSubTemplate("file:../partials/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
/* {block "content"} */
class Block_983958945698c7fbd1b4dc8_60577426 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/layouts';
}
}
/* {/block "content"} */
}
