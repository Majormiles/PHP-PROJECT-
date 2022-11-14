<?php
include("connection/connect.php"); 
if(isset($_POST['submit'] )) 
{
     if( empty($_POST['firstname']) || empty($_POST['lastname']) || 
         empty($_POST['email']) || empty($_POST['phone']) ||
         empty($_POST['password']) || empty($_POST['cpassword']) ||
         empty($_POST['cpassword']) ){
			$message = "All fields are Required!";
		}
	else
	{
      $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
      $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
      
      //in later developments, we will make changes to the conditional statements below
      if($_POST['password'] != $_POST['cpassword']){ 	
         echo "<script>alert('Password not match');</script>"; 
      }elseif(strlen($_POST['password']) < 6){
         echo "<script>alert('Password Must be >=6');</script>"; 
      }elseif(strlen($_POST['phone']) < 10){
         echo "<script>alert('Invalid phone number!');</script>"; 
      }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
         echo "<script>alert('Invalid email address please type a valid email!');</script>"; 
      }elseif(mysqli_num_rows($check_username) > 0){
         echo "<script>alert('Username Already exists!');</script>"; 
      }elseif(mysqli_num_rows($check_email) > 0){
         echo "<script>alert('Email Already exists!');</script>"; 
      }else{
         
      
         // $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
         // mysqli_query($db, $mql);

         /*
            There are two options for data entry in this section. One is for using prepared statements, another is with the use of an unprepared statement as above
            I also will be making use of two methods, ur methods are uncommented, but mine will be commented so you follow the procedure u want
         */

         // --using mysqli functions
         //--------------------------------------------------------
         //          METHOD ONE, PREPARED STATEMENTS              |
         //  (PROCEDURAL FORMAT ABOVE, OBJECT ORIENTED COMMENTED) |
         //--------------------------------------------------------
         //an sql prepared statement to prevent sql injection
         $mql = "INSERT INTO users(username, f_name, l_name, email, phone, password, address)
               VALUES (?,?,?,?,?,?,?)
         ";

         //prepare the statement for binding
         //procedural requires you separately bind the database connection first before the actual statement bind
         $stmt = mysqli_stmt_init($db);
         mysqli_stmt_prepare($stmt, $mql);
         // $stmt = $db->prepare($mql)
         
         //bind the parameters
         //the very first section is the data types in ur sql
         /* 
            ----------------
            Data type table
            ----------------
            s -> String [Char, VarChar, Enum, Text, Date]
            d -> Decimal [Decimal, Float, Double, Real]
            i -> Integer [TinyInt, LongInt, Int, Enum]
            b -> Blob   [Boolean]

            These are the only data types passed through the bind statement
         */
         mysqli_stmt_bind_param($stmt, "sssssss", $_POST['username'],$_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["phone"], MD5($_POST["password"]), $_POST["address"]);
         // $db->bind_param("sssssss", $_POST['username'],$_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["phone"], MD5($_POST["password"]), $_POST["address"])

         //execute the bind and send data into the database
         mysqli_stmt_execute($stmt);
         // $stmt->execute();

         /*
            // METHOD 2
            // WITHOUT PREPARED STATEMENT
            
            $mql = "INSERT INTO users(username, f_name, l_name, email, phone, password, address)
               VALUES ({$_POST['username']},{$_POST["firstname"]}, {$_POST["lastname"]}, {$_POST["email"]}, {$_POST["phone"]}, MD5({$_POST["password"]}), {$_POST["address"]})
            ";

            //parse data into database and check if it was successful
            if(mysqli_query($db, $mql)){
            // if($db->query($mql)){
               header("location: login.php");
            }else{
               echo "<script>alert('An error occured. Your data was not added. Please try again later');</script>";
            }

            //The relevance of prepared statements over the unprepared one is for us to prevent what is called 'SQL injection'
            //someone could just use the input elements to inject a code into your database and extract data from it
         */

         //rather send it directly to where u want than refresh the page, it delays it slightly
         //  header("refresh:0.1;url=login.php");
         header("location: login.php");
      }
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once($rootPath."/components/defMeta.php")?>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Page Title -->
    <title>Registration</title>
    
    <?php require_once($rootPath."/components/defLinks.php")?>
    <link rel="icon" href="#">

    <!-- Page style sheet -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
<div style=" background-image: url('images/img/pimg.jpg');">
         <!-- Nav Bar -->
         <?php include_once($rootPath."/components/header.php") ?>
         
         <div class="page-wrapper">
            
            <section class="contact-page inner-page">
               <div class="container ">
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="widget" >
                           <div class="widget-body">
                            
							         <form action="" method="post">
                                 <div class="row">
								            <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">User-Name</label>
                                       <input class="form-control" type="text" name="username" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">First Name</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Last Name</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Email Address</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Phone number</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Confirm password</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2"> 
                                    </div>
									         <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Delivery Address</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                  
						         </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            
            <!-- Footer -->
            <?php include_once($rootPath.'/components/footer.php'); ?>
         
         </div>

      <!-- Default javascript files -->
      <?php include_once($rootPath.'/components/defScripts.php'); ?>
</body>

</html>