{extends file="layouts/main.tpl"}

{block name="content"}
<h1 class="mb-4">Products</h1>

<div class="row">
  {foreach $products as $product}
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="{$product.image}" class="card-img-top" alt="{$product.name}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{$product.name}</h5>
          <p class="card-text">$ {$product.price}</p>
          <a href="product?id={$product.id}" class="btn btn-primary mt-auto">View</a>
        </div>
      </div>
    </div>
  {/foreach}
</div>
{/block}
