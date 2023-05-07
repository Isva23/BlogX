<?php
namespace views;
require '../../../app/autoloader.php';
include "../layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
is_null($ua->sessionValidate()) ? header('Location: /resources/views/auth/login.php') : '';
head($ua);
?>

<section class="container pt-5">
    <h1 class="border-bottom">Nueva publicacion</h1>
    <form action="/app/app.php" method="POST">
    <div class="card">
        <div class="card-body">
            <input type="hidden" name="id" value="3">
            <input type="hidden" name="_ep" value="true">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Titulo de la publicacion" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Texto</label>
            <textarea name="body" id="body" cols="80" rows="10" class="form-control" required></textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary float-end" type="submit">Guardar</button>
        </div>
    </div>

    </form>
</section>
<?php 
    scripts();
    foot();
?>