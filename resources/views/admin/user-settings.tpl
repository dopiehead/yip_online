{extends file="layouts/admin.tpl"}

{block name="content"}

    <style>
    #popupOverlay{
       backdrop-filter: blur(2px); 
    }

</style>

<div class="container py-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">User Profile</h4>
        <button class="btn btn-success" onclick="openPopup()">
            <i class='fas fa-edit'></i>
        </button>
    </div>

    <!-- User Info Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="text-secondary small">Full Name</label>
                    <div class="fs-5 fw-semibold">{$userDetails.user_name}</div>
                </div>

                <div class="col-md-6">
                    <label class="text-secondary small">Email</label>
                    <div class="fs-6 text-danger" readonly>{$userDetails.user_email}</div>
                </div>

                <div class="col-md-6">
                    <label class="text-secondary small">Joined</label>
                    <div class="fs-6">{$userDetails.created_at}</div>
                </div>

            </div>

        </div>
    </div>

</div>

{* modal for editing user details *}

<div  style='display:none;width:400px;z-index:1040;' class="popup-content p-3 position-fixed translate-middle top-50 start-50 shadow bg-light rounded" >
    
<div class="text-end">
    <button type="button" class="btn-close" onclick="closePopup()"></button>
</div>

<div class="popup-header">
    <h5 class="popup-title mb-4">Edit Profile</h5>
</div>

<div class="popup-body">

    <form method="POST" id="update-user">

        <!-- CSRF TOKEN -->
        <input type="hidden" name="csrf_token" value="{$csrf_token}">

        <div class="mb-3">
            <label class="form-label text-secondary small">Full Name</label>
            <input class="form-control" name="name" type="text"
                   value="{$userDetails.user_name|escape}" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small">Email</label>
            <input class="form-control text-danger" name="email" type="email"
                   value="{$userDetails.user_email|escape}" readonly>
        </div>



        <div class="mb-3">
            <label class="form-label text-secondary small">Password</label>
            <input class="form-control text-danger" name="password" type="text"
                   value="">
        </div>

        <input type="hidden" name="user_id" value="{$userDetails.id|escape}">

        <button type='submit' class="btn btn-success w-100 mt-2">Save Changes</button>
    </form>
</div>

</div>

<div style='display:none;opacity:0.6;' class='w-100 h-100 top-0  full-height bg-dark position-fixed' id="popupOverlay"></div>

<script src='../js/user-settings.js'></script>

{/block}
