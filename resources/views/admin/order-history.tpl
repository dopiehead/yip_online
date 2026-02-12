{extends file="layouts/admin.tpl"}

{block name="content"}

  <link rel="stylesheet" href="../css/order-history.css"/>

  <div style='display:none;z-index:999;' class='position-fixed popup-receipt translate-middle top-50 start-50 ' id='result'></div>
  <div style='opacity:0.7;z-index:990;' class='w-100 h-100 bg-dark bg-overlay position-fixed top-0 d-none'></div>
  <div class='loader' style='display:none'>
      <span class='spinner-border text-secondary fs-2'></span>
  </div>
    <div class="container-fluid mt-3">
    <div class="form-container d-flex justify-content-md-start justify-content-between align-items-center gap-4 flex-md-row flex-column">
    {foreach from=$products item=product
    }
      <div class='package border border-1 border-mute position-relative'>
        <img style='height:200px;width:250px;' class='img-fluid' src='{$product.image|default:"https://placehold.co/400"}'>
        <div class='d-flex flex-column flex-row p-2'>
          <span class='fw-bold text-capitalize'>{$product.name}</span>
          <span class='text-danger text-capitalize'>{$product.price} ( {$product.total} )</span>
        </div>
        <div class='mt-2 d-flex justify-content-end px-3 pb-2'>
             <a href='#' id='btn-receipt' class='text-sm text-primary text-decoration-underline' data-id='{$product.reference_no}'>View receipt <i class='fas fa-arrow-right'></i></a>
        </div>
      </div>
    {/foreach}
  </div>
  </div>
  </div>
  <script src='../js/order-history.js'></script>
{/block}