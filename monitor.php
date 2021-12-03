<?php session_start();

    if(isset($_REQUEST["btPindahLogin"])){
        header("Location:login.php");
    }
    if(isset($_REQUEST["btPindahRegis"])){
        header("Location:register.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ahihi Store</title>
        
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="asset/css/stylesindex.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    </head>



    <body>
    <form action="#" method="post">   
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand">Ahihi Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Exit</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="monitor.php">Monitor</a></li>
                                <li><a class="dropdown-item" href="#!">Mouse</a></li>
                                <li><a class="dropdown-item" href="#!">MousePad</a></li>
                                <li><a class="dropdown-item" href="#!">Audio</a></li>
                                <li><a class="dropdown-item" href="#!">Keyboard</a></li>
                                <li><a class="dropdown-item" href="#!">PC</a></li>
                                <li><a class="dropdown-item" href="#!">Motherboard</a></li>
                                <li><a class="dropdown-item" href="#!">Storage</a></li>
                                <li><a class="dropdown-item" href="#!">Ram</a></li>
                                <li><a class="dropdown-item" href="#!">Processor</a></li>
                                <li><a class="dropdown-item" href="#!">VGA</a></li>
                                <li><a class="dropdown-item" href="#!">PSU</a></li>
                                <li><a class="dropdown-item" href="#!">Cooler</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="search_box">
                <div class="search_btn">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" class="input_search" placeholder="Search" name="cari">
            </div>
                    <div class="wew">
                        <div class="back"><input type="submit" value="Login" name="btPindahLogin"></div>
                        <div class="reg"><input type="submit" value="Register" name="btPindahRegis"></div>
                    </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Ahihi Store</h1>
                </div>
            </div>
            
            
        </header>
        <!-- Section-->
        <h1 class="display-4 fw-bolder"> <center>!!Diskon!!</center> </h1>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <div class="col mb-5">
                        <a href="#" style="text-decoration:none; color:inherit;">
                            <div class="card h-100" >
                                <!-- Product image-->
                                <img class="card-img-top" src="asset/image/wallpaperhome.jpg" alt="..."/>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h3>Motherboard</h3>
                                        <!-- Product price-->
                                        <s>Rp. 150.000,-</s><br>
                                        <strong>Rp. 100.000,-</strong>
                                    </div>
                                </div>                                
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="asset/js/scripts.js"></script>
        </form>
    </body>
</html>


<!-- <div class="col mb-5">
    <div class="card h-100">
         Product image
        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
         Product details
        <div class="card-body p-4">
            <div class="text-center">
                 Product name
                <h5 class="fw-bolder">Popular Item</h5>
                 Product reviews
                <div class="d-flex justify-content-center small text-warning mb-2">
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                </div>
                 Product price
                $40.00
            </div>
        </div>
         Product actions
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div>
    </div>
</div> -->