<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/external/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cssoverview.css">

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/sidebars.css" rel="stylesheet">
</head>
<body>
    <?php 
        require_once("../backend/conn.php");
        $idactive = '';
        $unameactive = '';
        if (!isset($_SESSION['now'])) {
            header("Location: login.php");
        }
        else {
            $idactive = $_SESSION['now'][0];
            $unameactive = $_SESSION['now'][1];
        }
    ?>

    <main>
        <div id="sidenav" class="flex-shrink-0 p-3 text-white" style="width: 280px;">
            <a href="/" class="d-flex align-items-center isDisabled title-disabled pb-3 mb-3 link-dark text-decoration-none border-bottom justify-content-between">
                <span class="fs-5 fw-semibold" style="color: #1ad3be">Welcome, <?=$idactive?>!</span>
            </a>
            <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                </button>
                <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark isActive rounded" style="color: #1ad3be">Overview</a><i class="arrow left"></i></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Updates</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Reports</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Chats</a></li>
                </ul>
                </div>
            </li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    Dashboard
                </button>
                <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Overview</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Weekly</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Monthly</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Annually</a></li>
                </ul>
                </div>
            </li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                </button>
                <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">New</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Processed</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Shipped</a></li>
                </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../admin/addaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">Add New Admin</a></li>
                    <li><a href="../admin/listaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">List Admin</a></li>
                    <li><a href="../admin/setting.php" class="link-dark rounded" style="color: #1ad3be">Settings</a></li>
                    <li><a href="../admin/logout.php" class="link-dark rounded" style="color: #1ad3be">Sign out</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
        <div class="b-example-divider"></div>
        <div class="isi">
        
        <div class="container">
            <div class="row">
                <div class="test">
                    <div class="counter">
                        <span class="counter-value">555K</span>
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

        
	        <div class="center">
	        	<section class="todo-cmp">
	        		<header class="todo-cmp__header">
	        			<h2>Order List</h2>
	        		</header>

	        		<ul class="todo-cmp__list">
	        			<li>
	        				<label for="todo-01">
	        					<input id="todo-01" type="checkbox">
	        					<span>budi</span>
	        				</label>
	        			</li>
	        			<li>
	        				<label for="todo-02">
	        					<input id="todo-02" type="checkbox">
	        					<span>ivan</span>
	        				</label>
	        			</li>
	        			<li>
	        				<label for="todo-03">
	        					<input id="todo-03" type="checkbox">
	        					<span>anderson</span>
	        				</label>
	        			</li>
	        			<li>
	        				<label for="todo-04">
	        					<input id="todo-04" type="checkbox">
	        					<span>vicktor</span>
	        				</label>
	        			</li>
	        		</ul>
	        	</section>
	        </div>
        

        </div>
    </main>
    <script src="js/external/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>
</html>
