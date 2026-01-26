
$(document).ready(function() {
    $(document).on('click', '.remove-item', function() {
      
        const button = $(this);
        const orderId = button.data('id');
        const csrfToken = $("#csrf").val(); // make sure session csrf is available

        if (!confirm('Are you sure you want to remove this item?')) return;

        $.ajax({
            url: 'cart/remove',  // your remove action
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({ product_id: orderId, csrf: csrfToken }),
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else if (response.success) {
                    // Remove row from table
                    button.closest('tr').remove();

                    // Update grand total
                    let newTotal = 0;
                    $('tbody tr').each(function() {
                        const rowTotal = parseFloat($(this).find('td:eq(3)').text().replace('$', ''));
                        newTotal += rowTotal;
                    });
                    $('h4:contains("Total")').text('Total: $ ' + newTotal);

                    // Show empty cart message if no rows left
                    if ($('tbody tr').length === 0) {
                        $('table').remove();
                        $('.d-flex').remove();
                        $('.alert-info').remove();
                        $('h2').after('<div class="alert alert-info">Your cart is empty</div>');
                    }
                }
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });
});

