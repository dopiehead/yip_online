<?php
/* Smarty version 5.7.0, created on 2026-01-25 02:42:33
  from 'file:admin/components/sidebar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_69758319050778_82946142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7db966e4b12903f0b07e84774d1332f7fedd69dd' => 
    array (
      0 => 'admin/components/sidebar.tpl',
      1 => 1769308950,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69758319050778_82946142 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin/components';
?>


<div class="sidebar">

    <div class="logo d-flex  justify-content-between">
        <i class="fas fa-th-large"></i>Yiponline

        <div class="sidebar-toggle"><span class='fa fa-bars text-white'></i></span></div>

    </div>

    <nav class="nav flex-column">
        <a class="nav-link" href="admin"><i class="fas fa-home"></i> Home</a>
        <a class="nav-link" href="post-contents"><i class="fas fa-shopping-cart"></i> Post Ad</a>
        <a class="nav-link" href="contents"><i class="fas fa-book"></i> Contents</a>
        <a class="nav-link" href="order-history"><i class="fas fa-history"></i> Order History</a>

        <!-- Settings toggle link -->

    </nav>

    <div class='logout' style="padding: 24px;">
        <div style="margin-top: 16px;">
            <a href="logout" style="color: #a0aec0; text-decoration: none; font-size: 14px;"><i class="fas fa-sign-out-alt"></i> Log out</a>
        </div>
    </div>
</div>



<?php echo '<script'; ?>
>
 $(document).ready(function () {
    $('.sidebar-toggle').on('click', function () {
      $('.sidebar-container').toggleClass('active');
    });
  });
<?php echo '</script'; ?>
>



<!-- End of image upload modal -->





<?php }
}
