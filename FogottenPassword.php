<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$mssg="";
       if(isset($_POST["btnlogin"]))
        {
            $username=$_POST["username"];
            $id=$_POST["id"];
            
            include './PHP/DatabaseManager.php';
            $databaseManager=new DatabaseManager();
            
            //$isValid=$databaseManager->checkUser($id,$username);
            //$mssg=$databaseManager->resetLogin($id,$username);
            //====================================
        $mssg="";
       require_once ('./PHP/dbConnect.php');
        
        $sql= "SELECT * FROM user WHERE user_id='$id' AND email='$username'";

        $check = mysqli_fetch_array(mysqli_query($con,$sql));
        $isValid=false;
        $result = array();
        if(isset($check))
        {
             $isValid=true;
        }
         //mysqli_close($con);
       
      //===================================
        
        if($isValid)
        {
           
            $password=password_hash($id, PASSWORD_DEFAULT);

            $sql = "UPDATE login SET password ='$password'"
                     . "WHERE user_id ='$id'";

             if ($con->query($sql) === TRUE) 
             {
                  $sql = "select * from user where user_id='$id'";

                 $check = mysqli_fetch_array(mysqli_query($con,$sql));
                 $result = array();
                 if(isset($check))
                 {
                     $result = $con->query($sql);
                     if ($result->num_rows > 0)
                     {
                         while($row = $result->fetch_assoc()) 
                         {
                             $name=$row["name"];
                             $email=$row["email"];

                             //===============Send Email=================================
                             $to = $email;
                             $subject ="ICE Login";
                             $message = "Your ICE password has been reseted, Note your new password is :".$id;

                             $headers = 'From: ICE Admin' . "\r\n" .
                                                     'Reply-To: info@ice.co.za' . "\r\n" .
                                                     'Hello '.$name ;

                             mail($to, $subject, $message, $headers);
                             //==========================================================
                         }

                     }

                 }
                 $mssg="Password Successfully reseted. Note: your new password is your ID nubmer";
                 //header('location:feedback.php'); 
             } 
             else
             {
                 $mssg="Password not reseted, ERROR: " . $con->error;
                 //header('location:feedback.php');

             }
        
        }
        else
        {
             $mssg="No details found, Please insure that User ID and email is correct";
                
        }
        mysqli_close($con);
            
            dispalyMessage($mssg);
            /*if($isValid)
            {
                
                $mssg=$databaseManager->resetLogin($id,$username);
                 dispalyMessage($mssg);
            }
            else
            {
                $mssg="No details found, Please insure that User ID and email is correct";
                 dispalyMessage($mssg);
            }*/
           
            
             
             
        }
}

function dispalyMessage($mssg) 
{
    ?>
        <script> 
                alert("<?php echo $mssg?>");
        </script>
    <?php
}




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Voting System</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">
    <script type="text/javascript" src="validateResetPass.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                 <img src="logo.png"  class="img-circle" alt="logo" />
                 </a>
                 
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a class="glyphicon glyphicon-home " style="color:white; font-size: 20px" href="index.php"></a>
                    </li>
                    
                     <li>
                        <a class="page-scroll" href="results.php"> Results</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="about.php">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="register.php">Register</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login.php">Login</a>
                    </li>
                    
                    
                    <li>
                        <a class="page-scroll" href="contact.php">Contact</a>
                    </li>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

   

  <section id="login">
       <form name="form3" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" onsubmit="return validateForm()">

        <div class="container">
           
            <div class="row">
                <div class="col-lg-12">
                   <article class="col-xs-12 maincontent">

			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
           
			<div class="panel panel-primary">
			  <div class="panel-heading" > <h3 class="thin text-center"> Login</h3></div>
			  <div class="panel-body">
                              
                              <label for="exampleInputName2">Email</label> <label id="lblEmail"></label>
				<input type="email" class="form-control" id="username" onkeyup="validateEmail()" name="username" placeholder="john@gmail" >
				
				<label for="exampleInputName2">ID Number</label><label id="lblId"></label>
				<input type="number" class="form-control" id="id" onkeyup="validateId()" name="id" placeholder="9304246787987" >
				
				
				<br>
				
				<center>
				<table>
					<tr>
					
					
					
					<td>
					<center><button type="submit" name="btnlogin"  id="btnlogin" class="btn btn-primary btn-lg active">Submit</button></center>
					</td>
					
					</tr>
                                        
                                        <tr><td> <li class="btn btn-link">
                                            <a class="btn-link" href="login.php">Login Page</a>
                                        </li>
                                </td></tr>
				</table>


                        </div>
                </div>
            </div>
            </article>
            
            
        </div>
       </div>
     </div>
       </form>
    </section>
    
    
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

</body>

</html>
