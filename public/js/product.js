$(document).ready(function () {
    $(".spinner-border").hide();

    $('.add-to-cart').click(function (e) {
        e.preventDefault();

        $(".spinner-border").show();
        $(".submit-note").hide();

        const itemId = $(this).data('id');
        const buyer_id = $('#buyer_id').val();
        const noofitem = $('#noofitem').val();
        const csrf = $('#csrf').val();

        const missing = [];

        if (!itemId) missing.push('Product ID');
        if (!buyer_id) missing.push('Buyer ID');
        if (!noofitem || parseInt(noofitem) <= 0) missing.push('Quantity');

        if (missing.length > 0) {
            swal({
                title: "Missing Information",
                icon: "warning",
                text: "Please provide the following:\n\n" + missing.join(', ')
            });
            $(".spinner-border").hide();
            $(".submit-note").show();
            return;
        }

        const payload = {
            product_id: itemId,
            buyer_id: buyer_id,
            noofitem: noofitem,
            csrf: csrf
        };

        $.ajax({
            type: "POST",
            url: "cart/add",
            data: JSON.stringify(payload),
            contentType: "application/json",
            dataType: "json",
            beforeSend: function () {
                $(".spinner-border").show();
            },
            success: function (response) {
                $(".spinner-border").hide();
                $(".submit-note").show();
                $("#noofitem").val("");
                $(".numbering").html("<span class='rounded rounded-circle text-white bg-danger'>" + noofitem +"</span>");
                if (response.success) {
                    swal({
                        title: "Success",
                        icon: "success",
                        text: response.message || "Item(s) added to cart successfully."
                    });
                } else {
                    swal({
                        title: "Failed",
                        icon: "warning",
                        text: response.message || "Could not add item to cart."
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $(".spinner-border").hide();
                $(".submit-note").show();

                let message = "Something went wrong. Please try again.";

                try {
                    const json = JSON.parse(jqXHR.responseText);
                    if (json && json.message) {
                        message = json.message;
                    }
                } catch (e) {
                    console.error("Invalid JSON response");
                }

                swal({
                    title: "Error",
                    icon: "error",
                    text: message
                });
            }
        });
    });
});

function add() {
    let current = parseInt($("#noofitem").val()) || 0;
    let maximum = parseInt($("#maximum").val());

    if (current < maximum) {
        current++;
        $("#noofitem").val(current);
        $("#subs").removeAttr("disabled");

        if (current === maximum) {
            $("#adds").attr("disabled", "disabled");
        }
    }
}

function subst() {
    let current = parseInt($("#noofitem").val()) || 0;
    let maximum = parseInt($("#maximum").val()) || Infinity;

    if (current > 1) {
        current--;
        $("#noofitem").val(current);
        $("#adds").removeAttr("disabled");
    }

    if (current <= 1) {
        $("#subs").attr("disabled", "disabled");
    }
}

