<?php
/* Smarty version 5.7.0, created on 2026-01-26 02:34:16
  from 'file:admin/components/topbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6976d2a83cb7b8_57784840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd8d88c26e82f3bd97bc84766b26ac68b43ef3a6' => 
    array (
      0 => 'admin/components/topbar.tpl',
      1 => 1769394852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6976d2a83cb7b8_57784840 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin/components';
?>

<div class="top-bar">
<?php if ((true && ($_smarty_tpl->hasVariable('user') && null !== ($_smarty_tpl->getValue('user') ?? null))) && $_smarty_tpl->getValue('user')) {?>
            <div>
                <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #1f2937;">Hello, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('user')['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
            </div>
            <div class="user-profile">
                <span style="color: #6b7280; font-size: 14px;"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('user')['created_at'], ENT_QUOTES, 'UTF-8', true);?>
</span>
           <div class='text-center user-avatar border-none rounded rounded-circle  d-flex justify-content-center align-items-center'></div>                
           
                <img class='d-none' src="" alt="" class="user-avatar">
         
                <div>
                    <div style="font-weight: 600; font-size: 14px;"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('user')['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                    <div style="color: #6b7280; font-size: 12px;">@<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('user')['user_name'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                </div>
                <div class="dropdown">
                    <a href='tel:+2347033506332' class="btn" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
                <div class="dropdown">
                    <a class="btn" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i> (<span class='text-danger'>0</span>)
                    </a>
                </div> 

            </div>

<?php }?>
        </div><?php }
}
