<?php


if(isset($_SESSION["role"]))
 {
     
    $currUserID=$_SESSION["currUserID"];
    $role=$_SESSION["role"];
    if(!$role=='Admin')
    {
        header('location:login.php');
    }
 
 }
 else
 {
     //header('location:login.php'); 
 }
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
        if(isset($_POST["addParty"]))
	{
            $mssg="";
            $name=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $type=$_FILES['file']['type'];
            $temp_name=$_FILES['file']['tmp_name'];

            $party_name = $_POST["pName"];
            $president = $_POST["pPresident"];
            $description = $_POST["pDesc"];

            $max_size=2097152;//2MB
            if(isset($name))
            {
                    if(!empty($name))
                    {
                        //include './PHP/images/';
                            $allowed=array('jpg','jpeg','gif','png');
                            $file_extn=strtolower(end(explode('.',$name)));
                            if((int)$size<(int)$max_size)
                            {

                                    if(in_array($file_extn,$allowed)==true)
                                    {
                                            $file_name=substr(md5(time()),0,10).'.'.$file_extn;
                                            $location='./PHP/images/'.$file_name;
                                            //echo $file_name;

                                            require_once('./PHP/dbConnect.php');


                                            $sql = "INSERT INTO party(party_name,president,description,image) VALUES('$party_name','$president','$description','$location')";



                                           $sqlCheckPresident = "SELECT * FROM party WHERE president ='$president'";

                                           $sqlCheckPartyName = "SELECT * FROM party WHERE party_name ='$party_name'";

                                           $CheckPresident = mysqli_fetch_array(mysqli_query($con,$sqlCheckPresident));
                                           $CheckPName = mysqli_fetch_array(mysqli_query($con,$sqlCheckPartyName));

                                            if(isset($CheckPresident))
                                            {
                                                //echo 'cell phone or email address used alredy exist';
                                                $mssg=$president." is a president of another party, Please provide different president name....!!";
                                               
                                            }
                                            else if(isset($CheckPName))
                                            {

                                              $mssg="Party name allready exist...!!";
                                              

                                            }
                                            else
                                            {

                                                if(mysqli_query($con,$sql))
                                                {
                                                    move_uploaded_file($temp_name,$location);
                                                    $mssg="Party successfully added...!!";
                                                }
                                                else
                                                {
                                                   $mssg="Error adding data to database...!! ". mysqli_error($con);; 
                                                }

                                            }

                                           mysqli_close($con);
                                    }
                                    else
                                    {
                                            //$_SESSION["mssgPic"] = "Incorrect file type,Allowed file type: ". implode(',',$allowed);
                                            $mssg = "Incorrect file type,Allowed file types: jpg,jpeg,gif and png";

                                    }
                            }
                            else
                            {
                                    $mssg="Please select a picture that have a size of at least 2MB,Size :".$size." KB max:" .$max_size ;
                            }


                    }
                    else
                    {
                            $mssg="Please choose a file";
                    }
            }
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
    <script type="text/javascript" src="validateAddParty.js"></script>


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

 
    
     <section id="addParty">
          <article class="col-xs-12 maincontent">

              
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-primary">
                <div class="panel-heading" > <h4 class="thin text-center">Add political Party</h4></div>
                <div class="panel-body">
                    
               <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">


                <label for="exampleInputName2">Political Party Name </label> <label id="lblpName"></label>
                <input type="text" class="form-control" id="pName" name="pName" onkeyup="validatePartyName()" placeholder="party name" required >

                <label for="exampleInputName2"> political Party President </label> <label id="lblName"></label>
                <input type="text" class="form-control" id="pPresident" name="pPresident" onkeyup="validateName()" placeholder="Name" required >

                <label for="exampleInputName2"> Party description</label> <label id="lblpDesc"></label>
                 <textarea class="form-control" placeholder="Party description *" name="pDesc" onkeyup="validateDesc()" id="pDesc" required></textarea>
               
                <label for="exampleInputName2">Political Party Image </label> <label id="lblImage"></label>
                <input type="file" size="10"  name="file"><br><br>
                <br>
                <center>
                <table>
                <tr>
                <td>
                <center> <button type="submit" name="addParty"  id="addParty" class="btn btn-primary btn-lg active">Submit</button></center>
                </td>
                <td>
                </table>
                </center>


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
