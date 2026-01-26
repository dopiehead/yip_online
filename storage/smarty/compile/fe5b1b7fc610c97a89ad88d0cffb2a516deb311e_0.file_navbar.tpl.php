<?php
/* Smarty version 5.7.0, created on 2026-01-26 09:46:34
  from 'file:/Applications/MAMP/htdocs/yip_online/resources/views/layouts/../partials/navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_697737fac34c62_87765699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe5b1b7fc610c97a89ad88d0cffb2a516deb311e' => 
    array (
      0 => '/Applications/MAMP/htdocs/yip_online/resources/views/layouts/../partials/navbar.tpl',
      1 => 1769420786,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_697737fac34c62_87765699 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/partials';
?><nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">

    <a class="navbar-brand" href="/">E-Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index">Products</a></li>
        <?php if ((true && ($_smarty_tpl->hasVariable('user') && null !== ($_smarty_tpl->getValue('user') ?? null)))) {?> 
            <li class="nav-item"><a class="nav-link" href="cart">Cart<span class='numbering'></span></a></li>
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
