<?php
/* Smarty version 5.7.0, created on 2026-02-11 19:48:50
  from 'file:layouts/admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698cdd22401730_74440969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20c538625a8becccf1a4c4742d9a5642ddde8e58' => 
    array (
      0 => 'layouts/admin.tpl',
      1 => 1770839302,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/components/sidebar.tpl' => 1,
    'file:admin/components/topbar.tpl' => 1,
  ),
))) {
function content_698cdd22401730_74440969 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
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
  <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>

</head>
<body>

  <?php $_smarty_tpl->renderSubTemplate("file:admin/components/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <div class="main-content">

    <?php $_smarty_tpl->renderSubTemplate("file:admin/components/topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

       <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1365422501698cdd223fc956_98149416', "content");
?>


    </div>


    <?php echo '<script'; ?>
>
    $(document).ready(function () {
    
      $(document).on('click', '.sidebar-toggle', function (e) {
        e.preventDefault(); // important if it's a link or button
    
        $('.sidebar').toggleClass('active');
      });
    
    });
    <?php echo '</script'; ?>
>
    
</body>
</html>
<?php }
/* {block "content"} */
class Block_1365422501698cdd223fc956_98149416 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/layouts';
}
}
/* {/block "content"} */
}
