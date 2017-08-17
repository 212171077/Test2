<?php


if(isset($_SESSION["role"]))
 {
     
    $currUserID=$_SESSION["currUserID"];
    $role=$_SESSION["role"];
    if(!$role=='Admin')
    {
        //header('location:login.php');
    }
 
 }
 else
 {
     //header('location:login.php'); 
 }
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
        if(isset($_POST["btnDelete"]))
        {
            //echo ' <label id="delete">No</label>';
            //echo '<input type="text" id="delete" name="delete" value="No" >';
            $ids= array();
            $ids=$_POST["party_id"];
            $mssg="";
             foreach ($ids as $id) 
             {
               /*?>
                <script>
                    var confirmDel=confirm("Are you sure you want to delete selected political paties?");
                    var yesNo;
                    if(confirmDel==true)
                    {
                        
                       
                       
                    }
                    else
                    {
                        
                       document.write(" <?php
                        
                                   echo 'False';

                            ?>");
                       
                    }
                    document.getElementById("delete").innerHTML=yesNo;
                </script>
               <?php*/
                 
                   require_once './PHP/dbConnect.php';
                 //======================================================
                    $sql = "select * from party WHERE party_id='$id'";
                    $image = "";
                    $check = mysqli_fetch_array(mysqli_query($con,$sql));

                    $result = array();
                    if(isset($check))
                    {
                        $result = $con->query($sql);

                        if ($result->num_rows > 0)
                        {
                            

                            while($row = $result->fetch_assoc()) 
                            {
                                    $image = $row["image"];

                            }

                          
                        }
                    }
                    //======================================================
		
                    $sql = "DELETE FROM party WHERE party_id ='$id'";
                    
                    if ($con->query($sql) === TRUE) 
                    {
                            unlink($image);
                           
                            $mssg= "Party successfully deleted";
                    } 
                    else
                    {
                            $mssg= "Error deleting record: " . $con->error;
                    }
             }
             //$_SESSION["mssg"]=$mssg;
             //header('location:feedback.php');
             dispalyMessage($mssg);
            
        }
       
         dispalyMessage($mssg);
                    
	
       
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
                                        
                    <?php  echo "<center><P style=color:white><b>Welcome Admin</b></p></center>" ;?> 
                    <?php include 'Time.html';
                    
                    ?>
                      
                </div> 
                 </a>
                 
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                     <li>
                         <a class="glyphicon glyphicon-home " style="color:white; font-size: 20px" href="adminLogin.php"></a>
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





    
      <section id="removeParty">
        <article class="col-xs-12 maincontent">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading" > <h4 class="thin text-center">Remove Political Party</h4></div>
                    <div class="panel-body">
                       
                        
                             <form name="form3" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" onsubmit="return validateForm()">
    
                                
                               <?php
                                    require_once './PHP/dbConnect.php';
                                    $sql = "SELECT * from voting_status";
                                    $available=false;
                                    $isOpen=true;
                                    $check = mysqli_fetch_array(mysqli_query($con,$sql));

                                    $result = array();

                                    if(isset($check))
                                    {
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0)
                                        {
                                           
                                            while($row = $result->fetch_assoc()) 
                                            {       
                                                if($row["status"]=="Open")
                                                {
                                                    $sql = "SELECT * from party";
                                                    
                                                    $check2 = mysqli_fetch_array(mysqli_query($con,$sql));
                                                    if(isset($check2))
                                                    {
                                                        $result = $con->query($sql);

                                                        if ($result->num_rows > 0)
                                                        {
                                                            $available=true;


                                                            while($row = $result->fetch_assoc()) 
                                                            {
                                                                $image=$row["image"];
                                                                echo ' <center>
                                                                        <div class="container" >
                                                                           <div class="row">
                                                                               <center>
                                                                               <div class="col-lg-2 col-md-1">
                                                                                   <div class="service-box">
                                                                                       <table class="table table-bordered">
                                                                                           <tr>
                                                                                           <td>
                                                                                                <img src="'.$image.'"  class="img-rounded" alt="logo" height="100" width="100" />
                                                                                                <input type="checkbox" name="party_id[]"  id="party_id[]" value="'.$row["party_id"].'">
                                                                                           </td>
                                                                                           </tr>
                                                                                       </table>
                                                                                   </div>
                                                                               </div>
                                                                               <div class="col-lg-3 col-md-12 text-left col-lg-offset-0">
                                                                                   <div class="service-box">
                                                                                       <table class="table table-bordered" >
                                                                                           <tr>

                                                                                               <td>Party name: '.$row["party_name"].'</td>
                                                                                           </tr>
                                                                                           <tr>

                                                                                               <td>President: Jacob '.$row["president"].'</td>
                                                                                           </tr>
                                                                                           <tr>

                                                                                               <td>Desc: '.$row["description"].'</td>
                                                                                           </tr>
                                                                                          
                                                                                       </table>
                                                                                   </div>
                                                                               </div>
                                                                               </center> 
                                                                           </div>
                                                                       </div>
                                                                      </center>';
                                                            }

                                                        }

                                                    }
                                                }
                                                else
                                                {
                                                    $isOpen=false;
                                                }

                                            }

                                        }
                                           				
                                    }
                                    
                                    if($isOpen==false)
                                    {
                                        
                                         echo "<center><P style=color:orange>Online voting is closed</p></center>";
                                    }
                                    else if($available==false)
                                    {
                                         echo "<center><P style=color:orange>No Political parties available...!!</p></center>";
                                    }
                                    else
                                    {
                                        echo ' <div class="panel panel-primary">
                                                <div class="panel-heading " > </div>
                                            </div>
                                           <center>
                                           <table>
                                               <tr>
                                               <td>
                                               <center> <button type="submit" name="btnDelete"  id="btnDelete" class="btn btn-primary btn-lg active">Detele</button></center>
                                               </td>
                                               <td>
                                           </table>
                                           </center>';
                                               }
                               
                               
                               ?> 
                              
                                


                            </form>

                    </div>
                    </div>
                </div>
                </article>
        
        
        
        
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
