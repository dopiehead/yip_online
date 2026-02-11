

<div style='z-index:9999999' class=' position-relative text-center d-md-none d-block'><span class='sidebar-toggle' id="toggle-bars"><i class='fa fa-bars text-danger'></i></span></div>
<div class="sidebar sidebar-container ">

    <div class="logo d-flex  justify-content-between">
        <a class='text-white text-decoration-none' href='../index'>Yiponline</a>
    </div>
    

    <nav class="nav flex-column">
    {if isset($user) && $user.user_type == 'vendor'}
        <a class="nav-link" href="index"><i class="fas fa-home"></i> <span class='link-label'>Home</span></a>
        <a class="nav-link" href="post-contents"><i class="fas fa-shopping-cart"></i> <span class='link-label'>Post Ad</span></a>
        <a class="nav-link" href="contents"><i class="fas fa-book"></i> <span class='link-label'>Contents</span></a>
        <a class="nav-link" href="sold-history"><i class="fas fa-clock"></i> <span class='link-label'>Sold History</span></a>
    {/if}
        <a class="nav-link" href="order-history"><i class="fas fa-history"></i> <span class='link-label'>Order History</span></a>
        <!-- Settings toggle link -->
        <a class="nav-link" href="user-settings"><i class="fas fa-gear"></i> <span class='link-label'>Account settings</span></a>
    </nav>

    <div class='logout' style="padding: 24px;">
        <div style="margin-top: 16px;">
            <a href="logout" style="color: #a0aec0; text-decoration: none; font-size: 14px;"><i class="fas fa-sign-out-alt"></i><span class='link-label'> Log out</span></a>
        </div>
    </div>
</div>




<!-- End of image upload modal -->





