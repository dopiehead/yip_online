

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
