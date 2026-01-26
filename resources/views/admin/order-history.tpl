{extends file="layouts/admin.tpl"}

{block name="content"}
    <div class="container-fluid">
    <div class="form-container d-flex justify-content-between align-items-center gap-2 flex-md-row flex-column">
    {foreach from=$products item=product}
      <div class='package border border-1 border-mute position-relative'>
        <img style='height:200px;width:250px;' class='img-fluid' src='{$product.image|default:"https://placehold.co/400"}'>
        <div class='d-flex flex-column flex-row p-2'>
          <span class='fw-bold text-capitalize'>{$product.name}</span>
          <span class='text-danger text-capitalize'>{$product.price} ( {$product.total} )</span>
        </div>
      </div>
    {/foreach}
  </div>
     </div>
  </div>
{/block}