<?php
/* Smarty version 5.7.0, created on 2026-02-11 13:10:21
  from 'file:partials/filter-form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_698c7fbd1e5a57_93471601',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40bfe015b808d25784d8cc74ce47167a8d66352a' => 
    array (
      0 => 'partials/filter-form.tpl',
      1 => 1770815389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_698c7fbd1e5a57_93471601 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/yip_online/resources/views/partials';
?><!-- Overlay -->
<div id="filterOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none" style="z-index:998;"></div>

<!-- Centered Filter Form -->
<div id="filterPopup" class="position-fixed top-50 start-50 translate-middle d-none" style="z-index: 999; width: 100%; max-width: 500px;">
  <div class="card p-4 shadow bg-light">

    <!-- Close Button -->
    <div class='text-end'>
    <button type="button" class="btn-close position-relative " aria-label="Close" onclick="closeFilter()"></button>
    </div>
    <!-- Filter Form -->


 <div class="mb-3">
    <label for="quantity" class="form-label fw-bold">Category</label>
    <select class="form-select" id="category" name="category">

      <option value="">All categories</option>
      <option value="electronics">Electronics</option>
      <option value="accessories">Accessories</option>

    </select>
  </div>

    <div>

      <div class="row g-3 mb-3">
        <!-- Min Price -->
        <div class="col-md-6 col-6">
          <label for="min_price" class="form-label fw-bold">From <span class='text-danger fas fa-naira-sign'></span></label>
          <input type="number" class="form-control" id="min_price" name="minprice" min="0" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('min_price'), ENT_QUOTES, 'UTF-8', true);?>
">
        </div>

        <!-- Max Price -->
        <div class="col-md-6 col-6">
          <label for="max_price" class="form-label fw-bold">To <span class='text-danger fas fa-naira-sign'></span></label>
          <input type="number"  class="form-control" id="max_price" name="maxprice" max="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('max_price'), ENT_QUOTES, 'UTF-8', true);?>
"  value='<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('max_price'), ENT_QUOTES, 'UTF-8', true);?>
'>
        </div>

      </div>
      
      <div class='text-center'>
          <button class='btn btn-outline-primary mt-2' name='update' id='update'> Update price  </button>
      </div>

</div>

      <!-- Quantity -->
      <div class="mb-3">
        <label for="quantity" class="form-label fw-bold">Sort By</label>
        <select class="form-select" id="sort" name="sort">

          <option value="newest">Newest (Default)</option>
          <option value="oldest">Oldest</option>
          <option value="price_high">Highest price</option>
          <option value="price_low">Lowest Price</option>
        </select>
      </div>

  </div>
</div>
<?php }
}
