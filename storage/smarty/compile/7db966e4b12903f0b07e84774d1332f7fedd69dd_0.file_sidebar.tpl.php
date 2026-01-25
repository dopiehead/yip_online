<?php
/* Smarty version 5.7.0, created on 2026-01-25 07:35:42
  from 'file:admin/components/sidebar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6975c7ce3d6653_23642146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7db966e4b12903f0b07e84774d1332f7fedd69dd' => 
    array (
      0 => 'admin/components/sidebar.tpl',
      1 => 1769326539,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6975c7ce3d6653_23642146 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin/components';
?>

<div style='z-index:9999999' class=' position-relative text-center'><span class='sidebar-toggle' id="toggle-bars"><i class='fa fa-bars text-danger'></i></span></div>
<div class="sidebar sidebar-container ">

    <div class="logo d-flex  justify-content-between">
        <i class="fas fa-th-large"></i>Yiponline
    </div>

    <nav class="nav flex-column">
        <a class="nav-link" href="index"><i class="fas fa-home"></i> <span class='link-label'>Home</span></a>
        <a class="nav-link" href="post-contents"><i class="fas fa-shopping-cart"></i> <span class='link-label'>Post Ad</span></a>
        <a class="nav-link" href="contents"><i class="fas fa-book"></i> <span class='link-label'>Contents</span></a>
        <a class="nav-link" href="order-history"><i class="fas fa-history"></i> <span class='link-label'>Order History</span></a>
        <a class="nav-link" href="sold-history"><i class="fas fa-clock"></i> <span class='link-label'>Sold History</span></a>

        <!-- Settings toggle link -->

    </nav>

    <div class='logout' style="padding: 24px;">
        <div style="margin-top: 16px;">
            <a href="logout" style="color: #a0aec0; text-decoration: none; font-size: 14px;"><i class="fas fa-sign-out-alt"></i><span class='link-label'> Log out</span></a>
        </div>
    </div>
</div>




<!-- End of image upload modal -->





<?php }
}
