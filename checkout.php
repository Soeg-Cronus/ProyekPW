<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ahihi Store</title>

    <base href="index.php">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="asset/css/stylesindex.css" rel="stylesheet" />
    <link rel="stylesheet" href="asset/css/cekout.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a href="./" class="navbar-brand">Ahihi Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?jenis=Monitor">Monitor</a></li>
                                <li><a class="dropdown-item" href="?jenis=Mouse">Mouse</a></li>
                                <li><a class="dropdown-item" href="?jenis=Mouse%20Pad">MousePad</a></li>
                                <li><a class="dropdown-item" href="?jenis=Audio">Audio</a></li>
                                <li><a class="dropdown-item" href="?jenis=Keyboard">Keyboard</a></li>
                                <li><a class="dropdown-item" href="?jenis=PC">PC</a></li>
                                <li><a class="dropdown-item" href="?jenis=Motherboard">Motherboard</a></li>
                                <li><a class="dropdown-item" href="?jenis=Storage">Storage</a></li>
                                <li><a class="dropdown-item" href="?jenis=RAM">Ram</a></li>
                                <li><a class="dropdown-item" href="?jenis=Processor">Processor</a></li>
                                <li><a class="dropdown-item" href="?jenis=VGA">VGA</a></li>
                                <li><a class="dropdown-item" href="?jenis=PSU">PSU</a></li>
                                <li><a class="dropdown-item" href="?jenis=Cooler">Cooler</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Diskon</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                foreach ($macamdiskon as $key => $value) {
                            ?>
                                    <li><a class="dropdown-item" href="?<?=http_build_query(array('diskon'=>$value['nama_diskon']))?>"><?=$value['nama_diskon']?></a></li>
                            <?php
                                }
                            ?>            
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="" method="post">
                <div class="search_box">
                    <div class="search_btn">
                        <button type="submit" name="cari" style="border: 0; background: transparent">
                            <img src="asset/image/searchwhite.png" width="20" height="17" alt="submit" />
                        </button>
                    </div>
                    <input type="text" class="input_search" placeholder="Search" name="q">
                </div>
            </form>
            <form action="" method="post">
                <!-- <div class="wew">
                    <div class="back"><input type="submit" value="Login" name="btPindahLogin"></div>
                    <div class="reg"><input type="submit" value="Register" name="btPindahRegis"></div>
                </div> -->
                <div class="namae">ini nama</div>
                <div class="wew">
                    <div class="back"><input type="submit" value="Logout" name="btPindahLogin"></div>
                </div>
            </form>
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
        <h1 class="display-4 fw-bolder"> <center>Payment</center> </h1>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                <div class='tainers'>
                    <div class='window'>
                      <div class='order-info'>
                        <div class='order-info-content'>
                          <h2>Order Summary</h2>
                          <div class='line'></div>
                          <table class='order-table'>
                            <tbody>
                              <tr>
                                <td><img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></img>
                                </td>
                                <td>
                                  <br> <span class='thin'>Nike</span>
                                  <br> Free Run 3.0 Women<br> <span class='thin small'> Color: Grey/Orange, Size: 10.5<br><br></span>
                                </td>

                              </tr>
                              <tr>
                                <td>
                                  <div class='price'>$99.95</div>
                                </td>
                              </tr>
                            </tbody>

                          </table>
                          <div class='line'></div>
                          <table class='order-table'>
                            <tbody>
                              <tr>
                                <td><img src='https://dl.dropboxusercontent.com/s/qbj9tsbvthqq72c/Vintage-20L-Backpack-by-Fj%C3%A4llr%C3%A4ven.jpg' class='full-width'></img>
                                </td>
                                <td>
                                  <br> <span class='thin'>Fjällräven</span>
                                  <br>Vintage Backpack<br> <span class='thin small'> Color: Olive, Size: 20L</span>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class='price'>$235.95</div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class='line'></div>
                          <table class='order-table'>
                            <tbody>
                              <tr>
                                <td><img src='https://dl.dropboxusercontent.com/s/nbr4koso8dpoggs/6136C1p5FjL._SL1500_.jpg' class='full-width'></img>
                                </td>
                                <td>
                                  <br> <span class='thin'>Monobento</span>
                                  <br>Double Lunchbox<br> <span class='thin small'> Color: Pink, Size: Medium</span>
                                </td>

                              </tr>
                              <tr>
                                <td>
                                  <div class='price'>$25.95</div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class='line'></div>
                          <div class='total'>
                            <span style='float:left;'>
                              <div class='thin dense'>VAT 19%</div>
                              <div class='thin dense'>Delivery</div>
                              TOTAL
                            </span>
                            <span style='float:right; text-align:right;'>
                              <div class='thin dense'>$68.75</div>
                              <div class='thin dense'>$4.95</div>
                              $435.55
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class='credit-info'>
                        <div class='credit-info-content'>
                          <table class='half-input-table'>
                            <tr>
                              <td>Please select your card: </td>
                              <td>
                                <div class='dropdown' id='card-dropdown'>
                                  <div class='dropdown-btn' id='current-card'>Visa</div>
                                  <div class='dropdown-select'>
                                    <ul>
                                      <li>Master Card</li>
                                      <li>American Express</li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                          <img src='https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png' height='80' class='credit-card-image' id='credit-card-image'></img>
                          Card Number
                          <input class='input-field'></input>
                          Card Holder
                          <input class='input-field'></input>
                          <table class='half-input-table'>
                            <tr>
                              <td> Expires
                                <input class='input-field'></input>
                              </td>
                              <td>CVC
                                <input class='input-field'></input>
                              </td>
                            </tr>
                          </table>
                          <button class='pay-btn'>Checkout</button>

                        </div>

                      </div>
                    </div>
</div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
            </div>
        </footer>

</body>

</html>

<script>
    var cardDrop = document.getElementById('card-dropdown');
var activeDropdown;
cardDrop.addEventListener('click',function(){
  var node;
  for (var i = 0; i < this.childNodes.length-1; i++)
    node = this.childNodes[i];
    if (node.className === 'dropdown-select') {
      node.classList.add('visible');
       activeDropdown = node; 
    };
})

window.onclick = function(e) {
  console.log(e.target.tagName)
  console.log('dropdown');
  console.log(activeDropdown)
  if (e.target.tagName === 'LI' && activeDropdown){
    if (e.target.innerHTML === 'Master Card') {
      document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Master Card';
    }
    else if (e.target.innerHTML === 'American Express') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'American Express';      
    }
    else if (e.target.innerHTML === 'Visa') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Visa';
    }
  }
  else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
    activeDropdown.classList.remove('visible');
    activeDropdown = null;
  }
}

</script>
