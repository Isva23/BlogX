<?php

    namespace views;
    require "../../../app/autoloader.php";
    include "../layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    head();
    
?>

<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="login-form">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="username"
                            placeholder="Nombre de usuario" required>

                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="passwd" 
                            class="form-control" 
                            type="password"
                            name="passwd"
                            required>
                </div>
                <div class="d-grid gap-2">
                    <small class="form-text text-danger d-none mb-2" id="error">
                        Sus datos de inicio de sesion son incorrectos.
                    </small>
                    <button class="btn btn-primary" type="submit">
                        Iniciar sesion <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php scripts(); ?>
<script type="text/javascript">
    $(function(){
        const lf = $("#login-form");
        lf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData();
            data.append("username",$("#username").val());
            data.append("passwd",$("#passwd").val());
            data.append("_login","");
            console.log("hola mundo");

            fetch(app.routes.login, {method: "POST", body: data})
            .then(resp =>resp.json())
            .then(resp =>{
                if(resp.r !== false){
                    location.href = "../home.php";
                    //app.view("home")
                }else{
                    $("#error").removeClass("d-none");
                }
            }).catch(err => c.error(err));
        })
    })
</script>


