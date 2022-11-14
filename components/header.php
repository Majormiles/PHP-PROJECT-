        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/icn.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                            <!-- <li class="nav-item"> <a class="nav-link active" href="admin/dashboard.php">Admin Login <span class="sr-only"></span></a> </li> -->
                            
                           
							<?php
						if(empty($_SESSION["user_id"]) && !isset($_SESSION["adm_id"])) // if user or admin is not logged in
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							    <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
                                //if user is logged in, show a cart button in the header
                                if(isset($_SESSION["user_id"]))
                                    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                
                                // by default show the logout button
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
							 
                        </ul>
						 
                    </div>
                </div>
            </nav>
        </header>