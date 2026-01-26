{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Checkout</h2>

<form id="paymentForm">
    <input type="hidden" name="csrf" value="{$csrf_token}">
    <input type="hidden" id="buyer_id" value="{$buyer}">
    <input type="hidden" id="amount" value="{$subtotal}">
    <input type="hidden" id="email" value="{$email}">
    <input type="hidden" id="key" value="{$paystackKey}">
    <input type="hidden" id="txn_ref" value="{$txn_ref}">

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

<script>
$(function () {

    $('#paymentForm').on('submit', function (e) {
        e.preventDefault();

        let address = $('#address').val().trim();
        let phone   = $('#phone').val().trim();
        let buyer   = $('#buyer_id').val();
        let email   = $('#email').val();
        let key     = $('#key').val();
        let ref     = $('#txn_ref').val();
        let amount  = Math.round(parseFloat($('#amount').val()) * 100); // Kobo

        if (!address || !phone || !buyer || !email || !key || !ref || !amount) {
            alert('Missing required fields');
            return;
        }

        let handler = PaystackPop.setup({
            key: key,
            email: email,
            amount: amount,
            currency: "NGN",
            ref: ref,

            metadata: {
                custom_fields: [
                    {
                        display_name: "Buyer ID",
                        variable_name: "buyer_id",
                        value: buyer
                    },
                    {
                        display_name: "Phone",
                        variable_name: "phone",
                        value: phone
                    },
                    {
                        display_name: "Address",
                        variable_name: "address",
                        value: address
                    }
                ]
            },

            callback: function (response) {
                // ✅ ALWAYS use response.reference
                window.location.href =
                    "cart/verify-transaction" +
                    "?status=success" +
                    "&reference=" + encodeURIComponent(response.reference) +
                    "&id=" + encodeURIComponent(buyer) +
                    "&amount=" + encodeURIComponent(amount / 100);
            },

            onClose: function () {
                alert("Payment cancelled");
            }
        });

        handler.openIframe();
    });

});
</script>

{/block}
