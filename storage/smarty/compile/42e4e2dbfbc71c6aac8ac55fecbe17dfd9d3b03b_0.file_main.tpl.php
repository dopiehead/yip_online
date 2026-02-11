<?php
/* Smarty version 5.7.0, created on 2026-02-11 12:41:20
  from 'file:layouts/main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c78f06cde60_73605898',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e4e2dbfbc71c6aac8ac55fecbe17dfd9d3b03b' => 
    array (
      0 => 'layouts/main.tpl',
      1 => 1770813671,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../partials/navbar.tpl' => 1,
    'file:../partials/footer.tpl' => 1,
  ),
))) {
function content_698c78f06cde60_73605898 (\Smarty\Template $_smarty_tpl) {
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
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2147242371698c78f06c4551_72291016', "content");
?>

    </div>

    <?php $_smarty_tpl->renderSubTemplate("file:../partials/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://unpkg.com/aos@next/dist/aos.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
      AOS.init({
          duration: 400, // values from 0 to 3000, with step 50ms
          easing: 'ease'
      });
    <?php echo '</script'; ?>
>

</body>
</html>
<?php }
/* {block "content"} */
class Block_2147242371698c78f06c4551_72291016 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/layouts';
}
}
/* {/block "content"} */
}
