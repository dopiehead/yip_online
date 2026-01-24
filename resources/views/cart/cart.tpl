{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Shopping Cart</h2>

{if empty($cart)}
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
        {foreach $cart as $item}
        <tr>
            <td>{$item.name}</td>
            <td>{$item.qty}</td>
            <td>$ {$item.price}</td>
            <td>$ {$item.qty * $item.price}</td>
            <td>
                <button class="btn btn-sm btn-danger remove-item" data-id="{$item.id}">
                    ✕
                </button>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>

<div class="d-flex justify-content-between">
    <h4>Total: $ {$total}</h4>
    <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
</div>
{/if}
{/block}
