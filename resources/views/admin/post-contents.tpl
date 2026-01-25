{extends file="layouts/admin.tpl"}

{block name="content"}

    <div class="container-fluid mt-3">
      <div class="form-container">
        <form id="productForm" action="create-product"  method="POST" enctype="multipart/form-data">
          
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
                  <label class="form-label">Price (₦)</label>
                  <input type="number" name="product_price" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" name="product_quantity" class="form-control" required>
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
                    <i class="fas fa-upload me-2"></i>Click or Drag and Drop to Upload Image
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
  
  <script src='../js/post-content.js'></script>

{/block}
  

