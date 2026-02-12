{extends file="layouts/main.tpl"}

{block name="content"}
<div class="row">
    <div class="col-md-6 mb-3">
        <img src="{$product.image}" class="img-fluid rounded w-100 h-100" alt="{$product.name}">
    </div>

    <div class="col-md-6">
        <h2 class='text-capitalize'>{$product.name}</h2>
        <h4 class="text-primary mb-3"><span class=' fas fa-naira-sign'></span> {$product.price}</h4>
        {if $userId}
           <input type='hidden' name="buyer_id" id="buyer_id" value="{$userId}">
        {/if}

        <div class="d-flex gap-2 mt-4">
            <input type="button" value="-" id="subs" class="btn btn-light" onclick="subst()">&nbsp;
            <input type="number" id="noofitem" min="1" value="{$product.quantity}" id="qty" class="form-control w-25">
            <input type="button" value="+" id="adds" onclick="add()" class="btn btn-light"> 
          {if $userId != $product.user_id}  
            <button 
                class="btn btn-success add-to-cart"
                data-id="{$product.id}">
                <span class='submit-note'>Add to Cart</span>
                <span style='display:none;' class='spinner-border text-white'></span>
            </button>
         {else}
            <a
            class="btn btn-success"
            href="admin/edit-product?id={$product.id|default:0}">
            <span>Manage this product</span>
           
        </a>
         {/if}


        </div>
        <input type="hidden" value="{$product.quantity}" id="maximum">
        <input type="hidden" name="csrf" id="csrf" value="{$csrf_token|escape}">
        <div id="cart-feedback" class="mt-3"></div>
    </div>
</div>

<script src='js/product.js'></script>
{/block}
