<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{$title}</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  {* <link rel="stylesheet" href="../../assets/css/protected/post-contents.css"/> *}
  <link rel="stylesheet" href="../css/sidebar.css"/>
  <link rel="stylesheet" href="../css/topbar.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

  {include file="admin/components/sidebar.tpl"}

  <div class="main-content">

    {include file="admin/components/topbar.tpl"}

       {block name="content"}{/block}

    </div>


    <script>
    $(document).ready(function () {
    
      $(document).on('click', '.sidebar-toggle', function (e) {
        e.preventDefault(); // important if it's a link or button
    
        $('.sidebar').toggleClass('active');
      });
    
    });
    </script>
    
</body>
</html>
