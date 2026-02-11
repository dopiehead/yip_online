{extends file="layouts/admin.tpl"}

{block name="content"}

    <div class="container-fluid mt-4">
      <div class="form-container p-3 border rounded shadow bg-white">

        <form method="POST" action="update-product">
          <input type="hidden" name="id" value="{$product.id}" />
          
          <div class="mb-3">
            <label class="form-label fw-bold">Product Name</label>
            <input type="text" name="name" class="form-control" value="{$product.name|escape}">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Product Price</label>
            <input type="text" name="price" class="form-control" value="{$product.price|escape}">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{$product.quantity|default:1}">
          </div>

          <input type="hidden" name="csrf" value="{$csrf_token|escape}">
          <div>
          
          <button type="submit" class="btn btn-primary">Update Product</button>

          </div>
        </form>
        <button  class="btn btn-danger delete-product form-control mt-2" id="{$product.id}"><i class='fa fa-trash text-white'></i> Delete Product</button>
      </div>
    </div>
    <script src='../js/delete-product.js'></script>
{/block}

