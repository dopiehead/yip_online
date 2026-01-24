<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{$title}</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  {* <link rel="stylesheet" href="../../assets/css/protected/post-contents.css"/> *}
  <link rel="stylesheet" href="../../assets/css/protected/sidebar.css"/>
  <link rel="stylesheet" href="../../assets/css/protected/topbar.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

  {include file="../components/sidebar.tpl"}

  <div class="main-content">
    {include file="../components/topbar.tpl"}

    <div class="container-fluid">
    <div class="form-container d-flex justify-content-between align-items-center gap-2 flex-md-row flex-column">
    {foreach from=$products item=product}
      <div class='package border border-1 border-mute position-relative'>
        <a href='edit-content.php' class='text-dark px-2 py-1 text-decoration-none bg-white translate-top right-0 position-absolute'><i class='fa fa-edit'></i></a>
        <img style='height:200px;width:250px;' class='img-fluid' src='{$product.product_image[0]|default:"https://placehold.co/400"}'>
        <div class='d-flex flex-column flex-row p-2'>
          <span class='fw-bold text-capitalize'>{$product.product_name}</span>
          <span class='text-danger text-capitalize'>{$product.product_price}</span>
        </div>
      </div>
    {/foreach}
  </div>
     </div>
  </div>

  </body>
  </html>