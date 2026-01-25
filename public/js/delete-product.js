
$(document).ready(function () {

    $(document).on('click', '.delete-product', function (e) {
      e.preventDefault();
    
      const btn = $(this);
      const productId = btn.attr('id');
    
      if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
    
        $.ajax({
          url: '/admin/remove-product', // match your route
          type: 'POST',
          data: { id: productId },
          dataType: 'json',
          success: function (res) {
            if (res.status === 'success') {
              btn.closest('.package').fadeOut(300, function () {
                $(this).remove();
              });
            } else {
              alert(res.message || 'Failed to delete product');
            }
          },
          error: function () {
            alert('Server error. Please try again.');
          }
        });
    
      }
    
    });
    
    });