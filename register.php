<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$mssg="";
        if(isset($_POST["btnSubmit"]))
        {
            include './PHP/DatabaseManager.php';
            include './PHP/Login.php';
            include './PHP/User.php';
            
            $user =new User($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["province"], $_POST["phone"], $_POST["email"]);
            $login=new Login($_POST["id"], $_POST["email"], $_POST["password"], "user", "Active");
            //($user_id, $name, $surname, $province, $phone, $email)
            $databaseManager=new DatabaseManager();
            
            $mssg=$databaseManager->addUser($user, $login) ;
            dispalyMessage($mssg);
            
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
    <script type="text/javascript" src="registerValidation.js"></script>


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

  
    

    <section id="register">
        <form name="form3" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" onsubmit="return validateForm()">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <article class="col-xs-12 maincontent">

			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
           
			<div class="panel panel-primary">
			  <div class="panel-heading" > <h3 class="thin text-center"> Provide The Following</h3></div>
			  <div class="panel-body">
				
                                <label for="exampleInputName2">ID Number </label> <label id="lblId"></label>
                                <input type="number" class="form-control" id="id" name="id" onkeyup="validateId()" required placeholder="9824342365434" >
                                
                                <label for="exampleInputName2">Surname </label><label id="lblSurname"></label>
                                <input type="text" class="form-control" id="surname" onkeyup="validateSurname()" required name="surname" placeholder="Jane Doe" >
				
				<label for="exampleInputName2">Name </label> <label id="lblName"></label>
				<input type="text" class="form-control" id="name" name="name"  onkeyup="validateName()" required placeholder="Jane Doe" >
				
                                <label for="exampleInputName2">Province</label><label id="lblProvince"></label>
				<select name="province"  class="form-control" id="province">
                                  <option>Select</option>
                                  <option >Gauteng</option>
				  <option>Mpumalanga</option>
				  <option>Limpopo</option>
				</select>
                                
                                <label for="exampleInputName2">Phone number </label> <label id="lblPhone"></label>
				<input type="number" class="form-control" id="phone" name="phone" onkeyup="validatePhone()" required placeholder="0729266584" >
				
                                
				<label for="exampleInputName2">Email Address </label> <label id="lblEmail"></label>
				<input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" required placeholder="john@gmail" >
				
				<label for="exampleInputName2">Password </label><label id="lblPassword"></label>
				<input type="Password" class="form-control" id="password" name="password" onkeyup="validatePassword()" required placeholder="nqo_Nqo$$18" >
				
				<label for="exampleInputName2">Confirm Password </label><label id="lblPasswordTwo"></label>
				<input type="Password" class="form-control" id="confirmPass" name="confirmPass" onkeyup="validatePasswordTwo()" required placeholder="nqo_Nqo$$18" >
				
				<br>
				
				<center>
				<table>
					<tr>
					
					
					<td>
					<center><button type="submit" name="btnSubmit"  id="btnSubmit"  class="btn btn-primary btn-lg active">Submit</button></center>
					</td>
					
					</tr>
				</table>
				</center>
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
