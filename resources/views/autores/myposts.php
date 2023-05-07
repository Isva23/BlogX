<?php
namespace views;
require '../../../app/autoloader.php';
include "../layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
is_null($ua->sessionValidate()) ? header('Location: /resources/views/auth/login.php') : '';
head($ua);
?>
<head>
  <style>
    .modal-content {
      background-color: #f0f0f0; /* Gris claro */
      .modal-content
    }
    .modal-body {
        text-align: justify;
    }
    .panel-body{
        margin-top: 1rem;
    }
  </style>
</head>
<section class="container pt-5">
    <h1 class="border-bottom">Mis publicaciones</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody id="my-posts">

                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
<div class="modal" id="modal-1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal-body1"></div>
    </div>
  </div>
</div>
<div class="modal" id="modal-2" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal-body2"></div>
    </div>
  </div>
</div>
<?php 
    scripts("app_myposts");
    ?>
    <script>
    $(function(){
        app_myposts.getMyPosts(<?=$ua->id?>);

    })
    </script>
    <?php
    foot();
?>