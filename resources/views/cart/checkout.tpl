{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Checkout</h2>

<form id="paymentForm">
    <input type="hidden" name="csrf" value="{$csrf_token|escape}">
    <input type="hidden" id="buyer_id" value="{$buyer|escape}">
    <input type="hidden" id="amount" value="{$subtotal|escape}">
    <input type="hidden" id="email" value="{$email|escape}">
    <input type="hidden" id="key" value="{$paystackKey|escape}">
    <input type="hidden" id="txn_ref" value="{$txn_ref|escape}">

    <div class="mb-3">
        <label>Delivery Address</label>
        <textarea id="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" id="phone" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-100">
        Pay ₦{$subtotal|number_format:2}
    </button>
</form>

<!-- Paystack SDK -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="js/payment.js"></script>

{/block}
