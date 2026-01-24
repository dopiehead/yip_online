{extends file="layouts/main.tpl"}

{block name="content"}
<div class="row">
    <div class="col-md-6 mb-3">
        <img src="{$product.image}" class="img-fluid rounded" alt="{$product.name}">
    </div>

    <div class="col-md-6">
        <h2>{$product.name}</h2>
        <h4 class="text-primary mb-3">$ {$product.price}</h4>
        {if $userId}
           <input id="seller_id" value="{$userId}">
        {/if}
        <p>{$product.description|default:"No description available."}</p>

        <div class="d-flex gap-2 mt-4">
            <input type="number" id="noofitem" min="1" value="1" id="qty" class="form-control w-25">
            <button 
                class="btn btn-success add-to-cart"
                data-id="{$product.id}">
                <span class='submit-note'>Add to Cart</span>
                <span style='display:none;' class='spinner-border text-white'></span>
            </button>
        </div>

        <div id="cart-feedback" class="mt-3"></div>
    </div>
</div>

<script src='js/product.js'></script>
{/block}
