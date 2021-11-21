<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

body{
    background-image: url("asset/image/home.jpg");
  background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
}

.counter{
    color: white;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    width: 200px;
    padding: 0 0 45px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.row{
    display: flex;
    flex-direction: row;
    margin-left: 20px;
}
.counter:before,
.counter:after{
    content: '';
    background-color: #060b21;
    height: calc(100% - 120px);
    width: 100%;
    border-radius: 0 0 20px 20px;
    position: absolute;
    left: 0;
    bottom: 20px;
    z-index: -1;
    box-shadow: 0 0 40px #020daf;
}
.counter:after{
    width: 30px;
    height: 30px;
    border-radius: 0;
    transform: translateX(-50%) rotate(45deg);
    bottom: 6px;
    left: 50%;
}
.counter .counter-value{
    color: #014993;
    background: linear-gradient(#f9f9f9 50%,#f2f2f2 50%);
    font-size: 45px;
    font-weight: 600;
    line-height: 200px;
    width: 200px;
    height: 200px;
    margin: 0 auto 20px;
    border-radius: 50%;
    box-shadow: 0 0 40px #020daf;
    display: block;
}
.counter h3{
    font-size: 17px;
    font-weight: 500;
    text-transform: capitalize;
    margin: 0 10px;
}

.test{
    margin-left: 20vh;
    margin-top: 20vh;
}

@media screen and (max-width:990px){
    .counter{ margin-bottom: 40px; }
}

.judul{
    font-family: 'Mr Dafoe';
  margin: 0;
  font-size: 5.5em;
  margin-top: 0.6em;
  color: white;
  text-shadow: 0 0 0.05em #fff, 0 0 0.2em #2fd5ff, 0 0 0.3em #020daf;
  transform: rotate(-2deg);
}
</style>

<body>
    <header class="judul"> <center>Admin Page</center> </header>
<div class="container">
    <div class="row">
        <div class="test">
            <div class="counter">
                <span class="counter-value">555</span>
                <h3>Profit</h3>
            </div>
        </div>
        <div class="test">
            <div class="counter">
                <span class="counter-value">234</span>
                <h3>Order</h3>
            </div>
        </div>
        <div class="test">
            <div class="counter">
                <span class="counter-value">453</span>
                <h3>Web Visited</h3>
            </div>
        </div>
        <div class="test">
            <div class="counter">
                <span class="counter-value">395</span>
                <h3>Active User</h3>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
    $('.counter-value').each(function(){
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        },{
            duration: 3500,
            easing: 'swing',
            step: function (now){
                $(this).text(Math.ceil(now));
            }
        });
    });
});
</script>