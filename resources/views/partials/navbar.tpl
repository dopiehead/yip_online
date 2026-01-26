<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">E-Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index">Products</a></li>
        {if isset($smarty.session.user)}
            <li class="nav-item"><a class="nav-link" href="cart">Cart<span class='numbering'></span></a></li>
            <li class="nav-item"><a class="nav-link" href="admin/index"> Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="admin/logout">Logout</a></li>
        {else}
            <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
        {/if}
      </ul>
    </div>
  </div>
</nav>
