{extends file="layouts/admin.tpl"}

{block name="content"}

  <link rel="stylesheet" href="../css/contents.css"/>

    <div class="container-fluid mt-3">
      <div class="form-container d-flex flex-wrap justify-content-start gap-3">
        {* Check if products exist *}
        {if $products|@count > 0}
          {foreach from=$products item=product}
            <div class='package border border-1 border-muted position-relative'>
              <a href='edit-product?id={$product.id|default:0}' 
                 class='text-dark px-2 py-1 text-decoration-none bg-white translate-top right-0 position-absolute'>
                <i class='fa fa-edit'></i>
              </a>
              <img style='height:200px;width:250px;' class='img-fluid' 
                   src='{$product.image|default:"https://placehold.co/400"}' 
                   alt='{$product.name|default:"Product"}'>
              <div class='d-flex flex-column p-2'>
                <span class='fw-bold text-capitalize'>{$product.name|default:"No Name"}</span>
                <span class='text-danger text-capitalize'>{$product.price|default:"N/A"}</span>
              </div>
            </div>
          {/foreach}
        {else}
          <p class="text-muted">No products found.</p>
        {/if}
      </div>
    </div>

    {/block}

