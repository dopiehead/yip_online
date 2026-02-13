<?php
/* Smarty version 5.7.0, created on 2026-02-13 01:14:14
  from 'file:auth/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698e7ae64ec890_29937840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '950e77e4f73d09de62c11567927d03279b1d29e6' => 
    array (
      0 => 'auth/login.tpl',
      1 => 1770945242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698e7ae64ec890_29937840 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/auth';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->getValue('title');?>
</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="css/login.css" rel="stylesheet">
    
</head>
<body>
    <div id="login-page-wrapper">
        <div id="left-section">
            <div id="login-card">
                <form id="login-form">

                    <!-- Redirect URL (optional) -->
                    <input type="hidden" id="redirectUrl" name="redirectUrl" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('details'), ENT_QUOTES, 'UTF-8', true);?>
">

                    <div id="email-field-group">
                        <label id="email-label" for="email-input-field">Email</label>
                        <input 
                            type="email" 
                            id="email-input-field"
                            name="user_email" 
                            class="form-control-custom"
                            placeholder="Enter email"
                            required
                        >
                    </div>

                    <div id="password-field-group">
                        <label id="password-label" for="password-input-field">Password</label>
                        <input 
                            type="password" 
                            id="password-input-field"
                            name="user_password" 
                            class="form-control-custom"
                            placeholder="••••••••••"
                            required
                        >
                    </div>

                    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">

                    <button type="submit" class="btn-custom" id="login-submit-button">
                        <span class="signin-note">Login</span>
                        <span style="display:none;" class="spinner-border text-white"></span>
                    </button>

                    <p class='text-center mt-3 mb-2 text-danger'>Continue with</p>

                    <div class='text-center'>
                        <a href="google-login" class="btn shadow bg-light" id="google-submit-button">
                            <i class="fa-brands fa-google fs-5"></i>
                        </a>
                    </div>

                    <div id="signup-link-wrapper">
                        <span id="signup-text">Don't have an account? </span>
                        <a href="register" id="signup-link">Sign up</a>
                    </div>

                    <!-- Message Display -->
                    <div id="message" class="text-danger mt-2"></div>

                </form>
            </div>
        </div>

        <div id="right-section">
            <div id="decorative-circles">
                <div class="circle-decoration" id="circle-top-right"></div>
                <div class="circle-decoration" id="circle-middle-right"></div>
                <div class="circle-decoration" id="circle-bottom-right"></div>
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
    <!-- SweetAlert v1 -->
    <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 src="js/login.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
