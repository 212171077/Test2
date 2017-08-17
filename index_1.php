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
        else if(isset($_POST["btnlogin"]))
        {
            $username=$_POST["username"];
            $password=$_POST["password"];
            
            include './PHP/DatabaseManager.php';
            $databaseManager=new DatabaseManager();
            
            $mssg=$databaseManager->login($username, $password);
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
    <script type="text/javascript" src="ValidateSendMessage.js"></script>


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
                        <a class="page-scroll" href="help.php">Help</a>
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

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">IEC</h1>
                <hr>
                <p>Electoral Commission of South Africa</p>
                <p>Ensuring Free And fair Elections</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>
    
     <section id="results">
       <form name="form3" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" onsubmit="return validateForm()">

           
            <div class="row">
                <div class="col-lg-48">
                   <article class="col-xs-12 maincontent">

			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
           
			<div class="panel panel-primary">
			  <div class="panel-heading" > <h3 class="thin text-center"> Results </h3></div>
			  <div class="panel-body">
                              <table class="table table-bordered">
                                  <tr>
                                      <td><b>Party</b></td>
                                      <td><b>People Voted</b></td>
                                      <td><b>Votes</b></td>
                                      <td><b>Results %</b></td>
                                  </tr>
                             
                              
                              <?php
                                require_once './PHP/dbConnect.php';
                                
                                $sql = "Select * from vote_results";											
                                $check = mysqli_fetch_array(mysqli_query($con,$sql));
                                
                                $result = array();
                                $totalVotes = 0;

                                if(isset($check))
                                {
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc()) 
                                        {
                                           $totalVotes ++; 
                                        }
                                    }
                                }
                                
                                $sql = "Select COUNT(fk_party_id) as results,party_name,image from vote_results,party WHERE vote_results.fk_party_id=party.party_id"
                                        . "  ORDER BY results DESC";											
                                $check = mysqli_fetch_array(mysqli_query($con,$sql));
                                
                                $result = array();
                                $countV = 0;

                                if(isset($check))
                                {
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0)
                                        {
                                                while($row = $result->fetch_assoc()) 
                                                {
                                                    $percent=($row["results"]/$totalVotes)*100;
                                                    $image="PHP/".$row["image"];
                                                    echo ' <tr>
                                                                <td><img src="'.$image.'"  class="img-rounded" alt="logo" height="100" width="100" /> '.$row["party_name"].'</td>
                                                               <td>'.$totalVotes.' </td>
                                                                <td>'.$row["results"].'</td>
                                                                <td>'.$percent.' %</td>
                                                            </tr>';
                                                    
                                                }
                                        }
                                }
                              
                              
                              
                              ?>
                             </table>
                        </div>
                </div>
            </div>
            </article>
            
            
        
       </div>
     </div>
       </form>
    </section>


    <section class="bg-primary" id="about">
        
       
             
        
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="section-heading">What We Do:</h2>
                    <hr >
                    
                        <ul>
                            <li>
                            We are a permanent body created by the Constitution to manage free and fair elections at all levels of government. Although publicly funded and accountable to parliament, we are independent of the government.
                  
                            </li>

                         </ul>
                     <!--<a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>-->
                </div>
           
                 <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="section-heading">Obligations:</h2>
                    <hr>
                    <p><u><b>In terms of Section 190 of the Constitution of the Republic of South Africa, 1996 (PDF - 1.65 MB), we must -</b></u></p>
                        <ul>
                            <li>
                               manage elections of national, provincial and municipal legislative bodies;
                            </li>

                        
                           <li>
                               ensure that those elections are free and fair; 
                            </li>

                        
                            <li>
                               declare the results of those elections; and
                            </li>

                            <li>
                               compile and maintain a voters' roll.
                            </li>

                         </ul>
                    
                </div>
                
                 <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="section-heading">Duties:</h2>
                    <hr >
                    <p><b><u>Section 5 of the Electoral Commission Act, 1996 (PDF - 183 KB) requires that we:</u></b></p>
                    
                        <ul>
                            <li>
                               compile and maintain a register of parties;
                            </li>
                            
                            <li>
                               undertake and promote research into electoral matters;
                            </li>
                                develop and promote the development of electoral expertise and technology in all spheres of government;
                            <li>
                               continuously review electoral laws and proposed electoral laws, and make recommendations;
                            </li>
                                
                            <li>
                               promote voter education;
                            </li>
                            
                            <li>
                               declare the results of elections for national, provincial and municipal legislative bodies within seven days; and
                            </li>
                            
                            <li>
                               appoint appropriate public administrations in any sphere of government to conduct elections when necessary.
                            </li>
                            

                         </ul>
                     <!--<a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>-->
                </div>
            </div>
        </div>
    </section>
    
    
    

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
				
                                <label for="exampleInputName2">Province</label><label id="lblgander"></label>
				<select name="province"  class="form-control" id="province">
                                  <option >Gauteng</option>
				  <option>Mpumalanga</option>
				  <option>Limpopo</option>
				</select>
                                
                                <label for="exampleInputName2">Phone number </label> <label id="lblEmail"></label>
				<input type="number" class="form-control" id="phone" name="phone" onkeyup="validateEmail()" required placeholder="0729266584" >
				
                                
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
                              
                              <label for="exampleInputName2">Email/username</label>
				<input type="email" class="form-control" id="username" name="username" placeholder="john@gmail" >
				
				<label for="exampleInputName2">Password</label>
				<input type="Password" class="form-control" id="password" name="password" placeholder="nqo_Nqo$$18" >
				
				
				<br>
				
				<center>
				<table>
					<tr>
					
					
					
					<td>
					<center><button type="submit" name="btnlogin"  id="btnlogin" class="btn btn-primary btn-lg active">Login</button></center>
					</td>
					
					</tr>
                                        
                                        <tr><td> <li class="btn btn-link">
                                            <a class="btn-link" href="FogottenPassword.php"> Forgotten password</a>
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
    
     <section id="help">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
           <article class="col-xs-12 maincontent">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading" > <h4 class="thin text-center">Send Us A message</h4></div>
                    <div class="panel-body">

                            <form action="SendMessage.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm1()">


                                <label for="exampleInputName2">Enter Your Email </label> <label id="lblEmail"></label>
                                <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail1()" placeholder="Email" required >

                                <label for="exampleInputName2">Enter Your Name  </label> <label id="lblName"></label>
                                <input type="text" class="form-control" id="name" name="name" onkeyup="validateName1()" placeholder="Name" required >

                                <label for="exampleInputName2">Enter Your Surname </label> <label id="lblSurname"></label>
                                <input type="text" class="form-control" id="surname" name="surname" onkeyup="validateSurname1()" placeholder="Surname" required >

                                <label for="exampleInputName2">Message </label> <label id="lblEmail"></label><label id="lblMssg"></label>
                                <textarea class="form-control" placeholder="Your Message *" name="mssg" onkeyup="validateMssg()" id="mssg" required></textarea>
                                <br>
                                <center>
                                <table>
                                    <tr>
                                    <td>
                                    <center> <button type="submit" name="send"  id="send" class="btn btn-primary btn-lg active">Send</button></center>
                                    </td>
                                    <td>
                                </table>
                                    </center>


                            </form>

                    </div>
                    </div>
                </div>
                </article>
        
        
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p>feedback@startbootstrap.com</p>
                </div>
            </div>
        </div>
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
