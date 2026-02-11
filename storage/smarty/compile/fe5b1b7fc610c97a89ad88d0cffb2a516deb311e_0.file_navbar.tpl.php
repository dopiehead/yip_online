<?php
/* Smarty version 5.7.0, created on 2026-02-11 07:47:36
  from 'file:/Applications/MAMP/htdocs/yip_online/resources/views/layouts/../partials/navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c3418be7be8_58720133',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe5b1b7fc610c97a89ad88d0cffb2a516deb311e' => 
    array (
      0 => '/Applications/MAMP/htdocs/yip_online/resources/views/layouts/../partials/navbar.tpl',
      1 => 1770796032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698c3418be7be8_58720133 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/partials';
?><nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">

    <a class="navbar-brand" href="index">Yiponline</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index">Products</a></li>
        <?php if ((true && ($_smarty_tpl->hasVariable('user') && null !== ($_smarty_tpl->getValue('user') ?? null)))) {?> 
        <li class="nav-item"><a class="nav-link" href="cart">Cart<span style='font-size:12px' class='numbering  ms-1 pe-1 rounded rounded-circle text-white <?php if ($_smarty_tpl->getValue('mycart') > 0) {?> bg-danger <?php }?>'> <?php if ($_smarty_tpl->getValue('mycart') > 0) {?> <?php echo $_smarty_tpl->getValue('mycart');?>
  <?php }?></span></a></li>
            <li class="nav-item"><a class="nav-link" href="admin/index"> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="admin/logout">Logout</a></li>
        <?php } else { ?>
            <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
        <?php }?>
      </ul>
    </div>
  </div>
</nav>
<?php }
}
