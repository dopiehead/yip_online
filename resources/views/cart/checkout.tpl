{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Checkout</h2>

<form method="post" action="/checkout/process">
    <input type="hidden" name="csrf" value="{$smarty.session.csrf}">

    <div class="mb-3">
        <label>Delivery Address</label>
        <textarea name="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <button class="btn btn-success w-100">
        Place Order
    </button>
</form>
{/block}
