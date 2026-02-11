{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Shopping Cart</h2>

{if empty($product)}
    <div class="alert alert-info">Your cart is empty</div>
{else}
<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Product</th>
            <th width="120">Qty</th>
            <th width="120">Price</th>
            <th width="120">Total</th>
            <th width="80"></th>
        </tr>
    </thead>
    <tbody>
        {assign var="grandTotal" value=0}
        {foreach $product as $item}
            {assign var="itemTotal" value=$item.total * $item.price}
            {assign var="grandTotal" value=$grandTotal + $itemTotal}
        <tr>
            <td>{$item.name|escape}</td>
            <td>{$item.total|escape}</td>
            <td><span class='fas fa-naira-sign'></span> {$item.price|escape}</td>
            <td><span class='fas fa-naira-sign'></span> {$itemTotal|escape}</td>
            <td>
                <button class="btn btn-sm btn-danger remove-item" data-id="{$item.id|escape}">
                    ✕
                </button>
                <input id='crsf' name='csrf' type='hidden' value='{$csrf_token|escape}'>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>

<div class="d-flex justify-content-between mt-3">
    <h4>Total: <span class='fas fa-naira-sign'></span> {$grandTotal|escape}</h4>
    <a href="checkout" class="btn btn-primary">Proceed to Checkout</a>
</div>
{/if}
<script src='js/remove-item.js'></script>
{/block}
