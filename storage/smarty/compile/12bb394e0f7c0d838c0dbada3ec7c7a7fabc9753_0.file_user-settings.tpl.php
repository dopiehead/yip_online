<?php
/* Smarty version 5.7.0, created on 2026-02-12 21:12:13
  from 'file:admin/user-settings.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698e422d6d96c7_39455233',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12bb394e0f7c0d838c0dbada3ec7c7a7fabc9753' => 
    array (
      0 => 'admin/user-settings.tpl',
      1 => 1770930421,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698e422d6d96c7_39455233 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1219112658698e422d6b8552_73531823', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layouts/admin.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1219112658698e422d6b8552_73531823 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?>


    <link rel="stylesheet" href="../css/user-settings.css"/>


<div class="container py-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">User Profile</h4>
        <button class="btn btn-success" onclick="openPopup()">
            <i class='fas fa-edit'></i>
        </button>
    </div>

    <!-- User Info Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="text-secondary small">Full Name</label>
                    <div class="fs-5 fw-semibold"><?php echo $_smarty_tpl->getValue('userDetails')['user_name'];?>
</div>
                </div>

                <div class="col-md-6">
                    <label class="text-secondary small">Email</label>
                    <div class="fs-6 text-danger" readonly><?php echo $_smarty_tpl->getValue('userDetails')['user_email'];?>
</div>
                </div>

                <div class="col-md-6">
                    <label class="text-secondary small">Joined</label>
                    <div class="fs-6"><?php echo $_smarty_tpl->getValue('userDetails')['created_at'];?>
</div>
                </div>

                <div class="col-md-6">
                     <label class="text-secondary small">User Type</label>
                     <div class="fs-6 text-capitalize"><?php echo $_smarty_tpl->getValue('userDetails')['user_type'];?>
</div>
                </div>

            </div>

        </div>
    </div>

</div>


<div  style='display:none;width:400px;z-index:1040;' class="popup-content p-3 position-fixed translate-middle top-50 start-50 shadow bg-light rounded" >
    
<div class="text-end">
    <button type="button" class="btn-close" onclick="closePopup()"></button>
</div>

<div class="popup-header">
    <h5 class="popup-title mb-4">Edit Profile</h5>
</div>

<div class="popup-body">

    <form method="POST" id="update-user">

        <!-- CSRF TOKEN -->
        <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->getValue('csrf_token');?>
">

        <div class="mb-3">
            <label class="form-label text-secondary small">Full Name</label>
            <input class="form-control" name="name" type="text"
                   value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('userDetails')['user_name'], ENT_QUOTES, 'UTF-8', true);?>
" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small">Email</label>
            <input class="form-control text-danger" name="email" type="email"
                   value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('userDetails')['user_email'], ENT_QUOTES, 'UTF-8', true);?>
" readonly>
        </div>


        <div class="mb-3">
        <label class="form-label text-secondary small">Switch Role</label>
        <select class="form-control" name="user_type" type="user_type">
              <option value='customer'>Customer</option> 
              <option value='vendor'>Vendor</option>
        </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small">Password</label>
            <input class="form-control text-danger" name="password" type="text"
                   value="">
        </div>

        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('userDetails')['id'], ENT_QUOTES, 'UTF-8', true);?>
">

        <button type='submit' class="btn btn-success w-100 mt-2">Save Changes</button>
    </form>
</div>

</div>

<div style='display:none;opacity:0.6;' class='w-100 h-100 top-0  full-height bg-dark position-fixed' id="popupOverlay"></div>

<?php echo '<script'; ?>
 src='../js/user-settings.js'><?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
