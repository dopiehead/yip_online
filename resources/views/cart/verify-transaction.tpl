{extends file="layouts/main.tpl"}

{block name="content"}
<div class="container mt-5">

    {if isset($error)}
        <div class="alert alert-danger text-center">
            <h4>Payment Failed ❌</h4>
            <p>{$error}</p>
            <a href="../checkout" class="btn btn-danger mt-3">Try Again</a>
        </div>
    {/if}

    {if isset($success)}
        <div class="alert alert-success text-center">
            <h3>Payment Successful 🎉</h3>
            <p><strong>Reference:</strong> {$reference}</p>
            <p><strong>Amount Paid:</strong> ₦{$amount|number_format:2}</p>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price (₦)</th>
                            <th>Quantity</th>
                            <th>Subtotal (₦)</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $cart_items as $item}
                        <tr>
                            <td>{$item.name}</td>
                            <td>{$item.price|number_format:2}</td>
                            <td>{$item.total}</td>
                            <td>{$item.price * $item.total|number_format:2}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <p class="mb-1"><strong>Subtotal:</strong> ₦{$subtotal}</p>
                <p class="mb-1"><strong>VAT (5%):</strong> ₦{$VAT|number_format:2}</p>
                <p class="mb-1"><strong>Delivery Fee:</strong> ₦{$delivery_fee|number_format:2}</p>
                <h5 class="mb-0"><strong>Grand Total:</strong> ₦{$grand_total|number_format:2}</h5>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Buyer Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {$userName}</p>
                <p><strong>Email:</strong> {$userEmail}</p>
                <p><strong>Address:</strong> {$userAddress}</p>
            </div>
        </div>

        <div class="text-center mt-4">
        
            <a href="../admin/order-history" class="btn btn-success">View My Orders</a>
            <a href="../index" class="btn btn-primary">Continue Shopping</a>
            <a onclick="window.print()" class="btn btn-dark px-4">Print Receipt</a>
                                 
        </div>
    {/if}

</div>
{/block}
