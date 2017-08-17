

<?php
session_start();

$_SESSION["mssgPic"] ="";
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
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
			
			$allowed=array('jpg','jpeg','gif','png');
			$file_extn=strtolower(end(explode('.',$name)));
			if((int)$size<(int)$max_size)
			{
				
				if(in_array($file_extn,$allowed)==true)
				{
					$file_name=substr(md5(time()),0,10).'.'.$file_extn;
					$location='images/'.$file_name;
					//echo $file_name;
					
					require_once('dbConnect.php');
					
                                        
                                        $sql = "INSERT INTO party(party_name,president,description,image) VALUES('$party_name','$president','$description','$location')";
       

                                       
                                       $sqlCheckPresident = "SELECT * FROM party WHERE president ='$president'";

                                       $sqlCheckPartyName = "SELECT * FROM party WHERE party_name ='$party_name'";

                                       $CheckPresident = mysqli_fetch_array(mysqli_query($con,$sqlCheckPresident));
                                       $CheckPName = mysqli_fetch_array(mysqli_query($con,$sqlCheckPartyName));

                                        if(isset($CheckPresident))
                                        {
                                            //echo 'cell phone or email address used alredy exist';
                                            $_SESSION["mssg"]=$president." is a president of another party, Please provide different president name....!!";
                                            header('location:feedback.php');
                                        }
                                        else if(isset($CheckPName))
                                        {

                                           $_SESSION["mssg"]="Party name allready exist...!!";
                                           header('location:feedback.php');

                                        }
                                        else
                                        {
                                           
                                            if(mysqli_query($con,$sql))
                                            {
                                                move_uploaded_file($temp_name,$location);
                                                $_SESSION["mssg"]="Party successfully added...!!";
                                            }
                                            else
                                            {
                                                $_SESSION["mssg"]="Error adding data to database...!! ". mysqli_error($con);; 
                                            }
                                            
                                        }

                                       mysqli_close($con);
				}
				else
				{
					//$_SESSION["mssgPic"] = "Incorrect file type,Allowed file type: ". implode(',',$allowed);
					$_SESSION["mssg"] = "Incorrect file type,Allowed file types: jpg,jpeg,gif and png";
					
				}
			}
			else
			{
				$_SESSION["mssg"]="Please select a picture that have a size of at least 2MB,Size :".$size." KB max:" .$max_size ;
			}
			
						
		}
		else
		{
			$_SESSION["mssg"]="Please choose a file";
		}
	}
}

echo $_SESSION["mssg"];
header('location:feedback.php');
?>