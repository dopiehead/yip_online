
<div class='text-end my-2'>
      <span class='fw-bold text-secondary'>{$totalRecord}</span> Product(s) found
</div>

<div class="row g-4">

{foreach $products as $product}
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0 product-card">

            <!-- Product Image -->
            <div class="ratio ratio-4x3">
                <img src="{$product.image}" 
                     class="card-img-top object-fit-cover" 
                     alt="{$product.name}">
            </div>

            <div class="card-body d-flex flex-column">

                <h5 class="card-title fw-semibold mb-2 text-truncate">
                    {$product.name}
                </h5>

                <p class="text-danger fw-bold fs-5 mb-3">
                    $ {$product.price}
                </p>

                <a href="product?id={$product.id}" 
                   class="btn btn-primary mt-auto w-100">
                    View Product
                </a>

            </div>
        </div>
    </div>
{/foreach}
<!-- Pagination -->
{$pagination nofilter}
</div>