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
                                    <button onclick="window.print()" class="btn btn-dark px-4">
                                        Print Receipt
                                    </button>
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