{extends file="layouts/admin.tpl"}

{block name="content"}

    <div class="container-fluid">

        <h4 class="mb-3">📦 My Inventory</h4>
    
        {if $products|count == 0}
            <div class="alert alert-info">
                You have no products yet.
            </div>
        {else}
    
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Price (₦)</th>
                    <th>In Stock</th>
                    <th>Sold</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
    
            {foreach $products as $product}
                <tr>
                    <td>{$product.name}</td>
    
                    <td>
                        ₦{$product.price|number_format:2}
                    </td>
    
                    <td>{$product.quantity}</td>
    
                    <td>{$product.quantity_sold}</td>
    
                    <td>
                        {if $product.quantity == 0}
                            <span class="badge bg-danger">Out of stock</span>
                        {elseif $product.quantity <= 5}
                            <span class="badge bg-warning text-dark">Low stock</span>
                        {else}
                            <span class="badge bg-success">In stock</span>
                        {/if}
                    </td>
    
                    <td>{$product.created_at|date_format:"%b %e, %Y"}</td>
                </tr>
            {/foreach}
    
            </tbody>
        </table>
    
        {/if}
    </div>
     
  </div>

{/block}