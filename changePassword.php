<!DOCTYPE html>
<?php
session_start();
$fromPage="adminLogin.php";
 if(!isset($_SESSION["role"]))
 {
     header('location:login.php');
     
 
 }
 else
 {
    if($_SESSION["role"]=='user' || $_SESSION["role"]=='User')
    {
        $fromPage="usersLogin.php";
    }
 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
        $mssg="";
        if(isset($_POST["btnUpdatePass"]))
	{
            
            if(password_verify($_POST["oldPassword"],$_SESSION["password"]))
            //if($_POST["oldPassword"]==$_SESSION["password"])
            {
                
                $password=$_POST["password"];
                $id=$_SESSION["user_id"];
                
                require_once './PHP/dbConnect.php';
                
                $password=password_hash($password, PASSWORD_DEFAULT);
                
                $sql="UPDATE login SET password='$password' Where user_id='$id'";
                if($con->query($sql))
                {
                     $_SESSION["password"]=$password;
                     $mssg="Your login details have been update...!!";
                     //header('location:feedback.php');
                     dispalyMessage($mssg);

                }
                
            }
            else
            {
                $mssg="Incorrect Old password entered, please rectify...!! ";
                //header('location:feedback.php');
                dispalyMessage($mssg);
            }
         //echo 'Pressed...!!';
                    
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
    <script type="text/javascript" src="validateChangePass.js"></script>


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
                 <br>
                  <div class="btn-primary">
                                        
                    <?php 
                    
                    echo "<center><P style=color:white><b> ".$_SESSION["name"]. " ".$_SESSION["surname"]. "</b></p></center>" ;
                    
                    
                    
                    ?> 
                    <?php include 'Time.html';
                    
                    ?>
                      
                </div> 
                 
                 </a>
                 
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="glyphicon glyphicon-home " style="color:white; font-size: 20px" href=<?php echo $fromPage;?>></a>
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
                        <a class="page-scroll" href="Logout.php">Logout</a>
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
    
   
      <section id="changePassword">
           <article class="col-xs-12 maincontent">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading" > <h4 class="thin text-center">Change Password</h4></div>
                    <div class="panel-body">

                            <form name="form3" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" onsubmit="return validateForm()">


                                <label for="exampleInputName2">Username </label> <label id="lblEmail"></label>
                                <input type="email" class="form-control" id="email" name="email" disabled="true" value="<?php print $_SESSION["email"]; ?>" placeholder="name@gmail.com" required >

                                <label for="exampleInputName2">Old Password </label> <label id="lblEmail"></label>
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" onkeyup="validateEmail()" placeholder="Old pasword" required >
				
				<label for="exampleInputName2">New Password </label><label id="lblPassword"></label>
				<input type="Password" class="form-control" id="password" name="password" onkeyup="validatePassword()" required placeholder="nqo_Nqo$$18" >
				
				<label for="exampleInputName2">Confirm Password </label><label id="lblPasswordTwo"></label>
				<input type="Password" class="form-control" id="confirmPass" name="confirmPass" onkeyup="validatePasswordTwo()" required placeholder="nqo_Nqo$$18" >
				
                                
                                <br>
                                <center>
                                <table>
                                    <tr>
                                    <td>
                                    <center> <button type="submit" name="btnUpdatePass"  id="btnUpdatePass" class="btn btn-primary btn-lg active">Submit</button></center>
                                    </td>
                                    <td>
                                </table>
                                    </center>


                            </form>

                    </div>
                    </div>
                </div>
                </article>
        
        
          <br>
     <br>
     <br>
     <br>
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
