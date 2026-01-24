$(document).on('click', '.add-to-cart', function () {
    let productId = $(this).data('id');
    let qty = $('#qty').val();

    $.post('/cart/add', {
        id: productId,
        qty: qty,
        csrf: $('meta[name="csrf"]').attr('content')
    }, function (res) {
        $('#cart-feedback').html(
            `<div class="alert alert-success">Added to cart</div>`
        );
    }).fail(function () {
        $('#cart-feedback').html(
            `<div class="alert alert-danger">Failed to add to cart</div>`
        );
    });
});


$(document).on('click', '.remove-item', function () {
    let id = $(this).data('id');

    $.post('/cart/remove', {
        id: id,
        csrf: $('meta[name="csrf"]').attr('content')
    }, function () {
        location.reload();
    });
});

