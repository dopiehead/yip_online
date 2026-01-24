<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{$title}</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../../assets/css/protected/sidebar.css"/>
  <link rel="stylesheet" href="../../assets/css/protected/topbar.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

  {include file="../components/sidebar.tpl"}

  <div class="main-content">
    {include file="../components/topbar.tpl"}

    <div class="container-fluid mt-4">
      <div class="form-container p-3 border rounded shadow bg-white">

        <form method="POST" action="/update-product.php">
          <input type="hidden" name="id" value="{$product.id}" />
          
          <div class="mb-3">
            <label class="form-label fw-bold">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{$product.product_name|escape}">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Product Price</label>
            <input type="text" name="product_price" class="form-control" value="{$product.product_price|escape}">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Discount</label>
            <input type="number" name="product_discount" class="form-control" value="{$product.discount|default:0}">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Quantity</label>
            <input type="number" name="product_quantity" class="form-control" value="{$product.product_quantity|default:1}">
          </div>

          <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

      </div>
    </div>
  </div>

</body>
</html>
