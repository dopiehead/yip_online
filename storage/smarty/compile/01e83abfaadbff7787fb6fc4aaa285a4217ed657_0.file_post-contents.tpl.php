<?php
/* Smarty version 5.7.0, created on 2026-01-25 02:43:36
  from 'file:admin/post-contents.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_697583586483b0_31750844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01e83abfaadbff7787fb6fc4aaa285a4217ed657' => 
    array (
      0 => 'admin/post-contents.tpl',
      1 => 1769309013,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin/components/sidebar.tpl' => 2,
  ),
))) {
function content_697583586483b0_31750844 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/admin';
?><!DOCTYPE html>
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
</head>
<body>

  <?php $_smarty_tpl->renderSubTemplate("file:admin/components/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <div class="main-content">
    <?php $_smarty_tpl->renderSubTemplate("file:admin/components/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <div class="container-fluid">
      <div class="form-container">
        <form id="productForm"  method="POST" enctype="multipart/form-data">
          
        <div class="row">
            <!-- Product Info -->
            <div class="col-lg-6">
              <div class="form-section">
                <h2 class="section-title">Product Information <i class="fas fa-info-circle info-icon"></i></h2>

                <div class="mb-3">
                  <label class="form-label">Product Name</label>
                  <input type="text" name="product_name" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Product Details</label>
                  <textarea name="product_details" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Price (₦)</label>
                  <input type="number" name="product_price" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" name="product_quantity" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Discount (%)</label>
                  <input type="number" name="product_discount" class="form-control">
                </div>

                <div class="mb-3">
                  <label class="form-label">Category</label>
                  <select name="product_category" class="form-select" required>
                    <option value="">Select category</option>
                    <option value="electronics">Electronics</option>
                    <option value="fashion">Fashion</option>
                    <option value="accessories">Accessories</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Image Upload -->
            <div class="col-lg-6">
              <div class="form-section">
                <h2 class="section-title">Upload Image</h2>

                <div id='drop-area' class="drop-area text-center p-4 border rounded shadow-sm bg-light">
                <div class="product-image mb-3 d-flex justify-content-center align-items-center" style="height: 150px;">
                    <div class="bag-illustration position-relative" style="width: 80px; height: 100px;">
                        <div class="bag-handle bg-dark" style="width: 40px; height: 10px; margin: 0 auto; border-radius: 5px;"></div>
                        <div class="bag-clasp bg-secondary mt-2" style="width: 80px; height: 80px; border-radius: 10px;"></div>
                    </div>
                </div>
            
                <label for="fileElem" class="btn btn-outline-primary w-100 mb-2">
                    <i class="fas fa-upload me-2"></i>Click to Upload Image
                </label>
            
                <input type="file" name="product_images[]" id="fileElem" accept=".jpg, .jpeg, .png" class="d-none" multiple>
            
                <div class="upload-hint small text-muted mt-2">
                    Allowed formats: <strong>.jpg</strong>, <strong>.jpeg</strong>, <strong>.png</strong><br>
                    Minimum size: <strong>300x300px</strong> | Best: <strong>700x700px</strong>
                </div>
            
            
                <!-- Image Preview Area -->
                  <div id="preview" class="mt-3 d-flex flex-wrap gap-3 justify-content-start"></div>

            </div>
        
                <!-- Submit -->
                <button name='submit' type="submit" class="btn btn-success mt-3 w-100"><span class='submit-note'>Submit Product</span><span style='display:none' class='spinner-border text-white'></span></button>
                <div id="messages"></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
  
    <?php echo '<script'; ?>
>
      $('#productForm').on('submit', function (e) {
        e.preventDefault();
        $("#messages").html('');
        $(".submit-note").hide();
        $(".spinner-border").show();
    
        const formData = new FormData(this); // This already includes all form fields and files
    
        $.ajax({
          url: 'postcontents',
          method: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            try {
              const res = typeof response === "string" ? JSON.parse(response) : response;
    
              if (res.success) {
                $("#messages").html("<span class='alert-success'>" + res.message + "</span>");
                $(".submit-note").show();
                $('#productForm')[0].reset();
                $('#preview').html('');
              } else {
                $("#messages").html('<span class="alert-danger"> ' + res.message + '</span>');
              }
            } catch (err) {
              console.error("JSON parse error:", response);
              $("#messages").html("<span class='alert-danger'> Something went wrong (invalid response)</span>");
            } finally {
              $(".spinner-border").hide();
            }
          },
          error: function (xhr) {
            $("#messages").html("<span class='alert-danger'> Server error: " + xhr.statusText + "</span>");
            $(".spinner-border").hide();
          }
        });
      });
    <?php echo '</script'; ?>
>
    
    


  <?php echo '<script'; ?>
 src='../../assets/js/post-contents.js'><?php echo '</script'; ?>
>
  
</body>
</html>
<?php }
}
