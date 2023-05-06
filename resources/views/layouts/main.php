<?php
 function head($ua = null) {
    !is_null($ua) ? $ua->sessionValidate() : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <style>
        body{
            font-family: 'Roboto', serif;
        }
    </style>
    <title>Blog X</title>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <header class="row m-0 bg-light">
            <div class="col-9">
                <h1 class="ml-3 mt-2">BLOG X</h1>
            </div>
            <div class="col-3 mt-2">
            <form class="d-flex" role="search">
                <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success" onclick="app.buscarPalabra()" type="button"><i class="bi bi-search"></i></button>
            </form>
            </div>     
        </header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <?php if(!is_null($ua) && $ua->sv){?>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link" 
                            type="button" aria-current="page"
                            onclick="app.view('newpost')"
                            >Nueva publicacion</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link" 
                            type="button" aria-current="page"
                            onclick="app.view('myposts')"
                            >Mis publicaciones</button>
                    </li>
                    
                    <?php }else{}?>
            </ul>
                <ul class="navbar-nav ml-auto mb-2 d-flex">
                <?php if(is_null($ua) || !$ua->sv){?>
                <li class="nav-item">
                        <button type="button" class="nav-link btn btn-link" onclick="app.view('inisession')">Iniciar sesion</button>
                </li>

                <?php }else{ ?>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=$ua->name?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button type="button" class="dropdown-item btn btn-link"
                        onclick="app.view('endsession')">Cerrar Sesion</button></li>
                    </ul>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </nav>
<?php
    }
    function scripts($script=""){

     ?>   
</div>
    <script src="/resources/js/jquery-3.6.3.min.js"></script>
    <script src="/resources/js/bootstrap.js"></script>
    <script src="/resources/js/app.js"></script>
    
    <?php
    if($script != ''){
        echo '<script src="/resources/js/'. $script .'.js"></script>';
    }
    }
    function foot(){
    ?>

</body>
</html>
<?php }


