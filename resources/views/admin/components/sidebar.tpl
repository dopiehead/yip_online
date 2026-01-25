


<div class="sidebar">

    <div class="logo d-flex  justify-content-between">
        <i class="fas fa-th-large"></i>Yiponline

        <div class="sidebar-toggle"><span class='fa fa-bars text-white'></i></span></div>

    </div>

    <nav class="nav flex-column">
        <a class="nav-link" href="admin"><i class="fas fa-home"></i> Home</a>
        <a class="nav-link" href="post-contents"><i class="fas fa-shopping-cart"></i> Post Ad</a>
        <a class="nav-link" href="contents"><i class="fas fa-book"></i> Contents</a>
        <a class="nav-link" href="order-history"><i class="fas fa-history"></i> Order History</a>

        <!-- Settings toggle link -->

    </nav>

    <div class='logout' style="padding: 24px;">
        <div style="margin-top: 16px;">
            <a href="logout" style="color: #a0aec0; text-decoration: none; font-size: 14px;"><i class="fas fa-sign-out-alt"></i> Log out</a>
        </div>
    </div>
</div>



<script>
 $(document).ready(function () {
    $('.sidebar-toggle').on('click', function () {
      $('.sidebar-container').toggleClass('active');
    });
  });
</script>



<!-- End of image upload modal -->





