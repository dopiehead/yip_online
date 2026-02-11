{extends file="layouts/main.tpl"}

{block name="content"}

<div class="container py-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Products</h1>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-md-10">
                    <input 
                        type="search" 
                        name="q" 
                        id="q" 
                        class="form-control form-control-lg" 
                        placeholder="Search for anything..."
                    >
                </div>
                <div class="col-md-2 text-md-end">
                    <button class="btn btn-outline-danger w-100"  onclick="openFilter()" id="btn-filter">
                        <i class="fa fa-sliders-h me-2"></i> Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div id="results">
         <div class='w-100 text-center'><span style='width:200px; height:200px;' class='spinner-border text-secondary fs-3 mt-3'></span> </div>
    </div>
 
</div>

{include file="partials/filter-form.tpl"}

<script src='js/filter.js'></script>

{/block}
