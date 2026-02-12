$(document).on("click", "#btn-receipt", function (e) {
    
    e.preventDefault();
    $(".loader").show();

    const reference_no = $(this).data("id");

    $.ajax({
        method: "POST",
        url: "get-receipt",
        data: { reference_no },
        dataType: "json", // 🔥 IMPORTANT

            success: function (data) {
                $(".loader").hide();
                $(".popup-receipt").fadeIn();
                $(".bg-overlay").removeClass("d-none");

                if (!Object.keys(data).length) {
                    $("#result").html("<div class='alert alert-warning'>No receipt found</div>");
                    return;
                }
            
                let html = "";
            
                Object.entries(data).forEach(([reference, products]) => {
            
                    let grandTotal = 0;
            
                    html += `
                    <div class="container my-4">
                        <div class="card shadow border-0">
                           <div class='text-end'>
                               <a style='cursor:pointer;' class='closePopup text-secondary px-2'>
                                  <i class='fas fa-close fa-1x'></i>
                               </a>
                           </div>
                            <div class="card-body p-4">
            
                                <!-- Receipt Header -->
                                <div class="text-center mb-4">
                                    <h4 class="fw-bold">Payment Receipt</h4>
                                    <div class="text-muted">Transaction ID: <strong>${reference}</strong></div>
                                </div>
            
                                <!-- Product Table -->
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    `;
            
                    products.forEach(item => {
            
                        let subtotal = parseFloat(item.price) * parseInt(item.total);
                        grandTotal += subtotal;
            
                        html += `
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="${item.image}" 
                                             width="50" height="50" 
                                             class="rounded border">
                                        <span class="fw-semibold">${item.name}</span>
                                    </div>
                                </td>
                                <td>₦${item.price}</td>
                                <td>${item.total}</td>
                                <td class="text-end fw-semibold">₦${subtotal}</td>
                            </tr>
                        `;
                    });
            
                    html += `
                                        </tbody>
                                    </table>
                                </div>
            
                                <!-- Totals -->
                                <div class="border-top pt-3 mt-3">
                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span>Total Paid</span>
                                        <span class="text-success">₦${grandTotal}</span>
                                    </div>
                                </div>
            
                                <!-- Footer -->
                                <div class="text-center mt-4">
                                    <a onclick="window.print()" class="btn btn-dark px-4">
                                        Print Receipt
                                    </a>
                                </div>
            
                            </div>
                        </div>
                    </div>
                  
                    `;
                });
            
                $("#result").html(html);

            },
            
        error: function () {
            $("#result").html("<div class='text-danger'>Failed to load receipt</div>");
            $(".loader").hide();
        }
    });
});


$(document).on("click",".closePopup",function(e){
   e.preventDefault();
   $(".popup-receipt").fadeOut();
   $(".bg-overlay").addClass("d-none");
});


function printReceipt(button) {
    // Find the closest container that wraps the receipt
    const receiptDiv = $(button).closest('.container')[0]; // .container wrapping a single receipt

    if (!receiptDiv) return;

    const newWin = window.open('', '_blank', 'width=800,height=600');
    newWin.document.write(`
        <html>
            <head>
                <title>Receipt</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
            </head>
            <body>
                ${receiptDiv.outerHTML}
            </body>
        </html>
    `);
    newWin.document.close();
    newWin.focus();
    newWin.print();
    newWin.close();
}
