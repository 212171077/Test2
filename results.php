

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
                        <a class="page-scroll" href="contact.php">Contact</a>
                    </li>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

  
    
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
                                                    $image=$row["image"];
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
