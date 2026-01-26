<?php
/* Smarty version 5.7.0, created on 2026-01-26 09:26:38
  from 'file:auth/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6977334e583fa1_90589677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b3e9343d9ff06d83ffc72cd5d0071a2ef4e0952' => 
    array (
      0 => 'auth/register.tpl',
      1 => 1769419178,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6977334e583fa1_90589677 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/auth';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('title'), ENT_QUOTES, 'UTF-8', true);?>
</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">

    <link rel="stylesheet" href="css/register.css">

    <!-- jQuery + SweetAlert -->
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><?php echo '</script'; ?>
>
</head>

<body>

    <div class="container">

        <!-- LEFT SIDE / SIGN UP FORM -->
        <div class="signup-section">
            <form id="signupForm" class="signup-form">
            <input type="hidden" name="csrf" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">
                <h1 class="form-title">Create Account</h1>

                <!-- FULL NAME -->
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input 
                        type="text" 
                        id="fullName" 
                        name="user_name" 
                        placeholder="John Doe" 
                        required
                    >
                    <div class="error-message">Please enter your full name</div>
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="user_email" 
                        placeholder="john.doe@example.com" 
                        required
                    >
                    <div class="error-message">Please enter a valid email address</div>
                </div>


                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input 
                            type="password" 
                            id="password" 
                            name="user_password" 
                            placeholder="••••••••••" 
                            required
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            onclick="togglePassword('password', this)"
                        >Show</button>
                    </div>
                    <div class="error-message">Password must be at least 8 characters long</div>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="password-field">
                        <input 
                            type="password" 
                            id="confirmPassword" 
                            name="confirmPassword" 
                            placeholder="••••••••••" 
                            required
                        >

                        <button 
                            type="button" 
                            class="password-toggle" 
                            onclick="togglePassword('confirmPassword', this)"
                        >Show</button>
                    </div>
                    <div class="error-message">Passwords do not match</div>
                </div>

                <!-- USER TYPE -->
                <div class="form-group">
                    <label for="userType">User Type</label>
                    <select name="user_type" class="text-secondary py-2">
                        <option value="customer">I am a Customer</option>
                        <option value="vendor">I am a Vendor</option>
                    </select>
                    <div class="error-message">Select user type</div>
                </div>

                <!-- SUBMIT -->
                <div class="form-group">
                    <button type="submit" class="signup-btn btn-custom bg-success">Create Account</button>
                    <div class="spinner-border text-primary ms-3 d-none" role="status"></div>
                    <small class="signup-note text-muted ms-2 d-none">Processing...</small>
                </div>


                <div class="login-link">
                    Already have an account? <a href="login">Sign in</a>
                </div>

            </form>
        </div>

        <!-- RIGHT SIDE / IMAGE AREA -->
        <div class="image-section">
            <div class="image-overlay"></div>

            <!-- Floating elements -->
            <div class="floating-element small"></div>
            <div class="floating-element medium"></div>
            <div class="floating-element large"></div>
        </div>

    </div>

    <!-- Password toggle script -->
    <?php echo '<script'; ?>
>
        function togglePassword(fieldId, button) {
            const input = document.getElementById(fieldId);

            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Hide";
            } else {
                input.type = "password";
                button.textContent = "Show";
            }
        }
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="js/register.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
