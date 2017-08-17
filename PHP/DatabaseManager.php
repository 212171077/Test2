<?php
session_start();
class DatabaseManager 
{
    
   //=========================USER TABLE SQL STATEMENT==========================
    function addUser(User $user,  Login $login) 
    {
         require_once ('dbConnect.php');
         $mssg="";
         $user_id=$user->getUser_id();
         $name=$user->getName();
         $surname=$user->getSurname();
         $province=$user->getProvince();
         $phone=$user->getPhone();
         $email=$user->getEmail();
         
         $username=$login->getUsername();
         $password=$login->getPassword();
         $role=$login->getRole();
         
         //encrypting username and password
          $username=password_hash($username, PASSWORD_DEFAULT);
          $password=password_hash($password, PASSWORD_DEFAULT);
         
         $sql = "INSERT INTO user(user_id,name,surname,province,phone,email) VALUES('$user_id','$name','$surname','$province','$phone','$email')";
       
         
        $loginSql = "INSERT INTO login(user_id,user_name,password,role,status) VALUES('$user_id','$username','$password','$role','Active')";
       
        
       $sqlCheckId = "SELECT * FROM user WHERE user_id ='$user_id'";
        
       $sqlCheckEmail = "SELECT * FROM user WHERE email ='$email'";
			
       $CheckId = mysqli_fetch_array(mysqli_query($con,$sqlCheckId));
       $CheckEmail = mysqli_fetch_array(mysqli_query($con,$sqlCheckEmail));
			
	if(isset($CheckId))
	{
            //echo 'cell phone or email address used alredy exist';
	    $mssg="User id  allready registered....!!";
            //header('location:feedback.php');
	}
        else if(isset($CheckEmail))
        {
            
           $mssg="Email address allready exist in our database please provide different email address";
           //header('location:feedback.php');
           
        }
        else
        {
        
             if(mysqli_query($con,$sql))
             {
                if(mysqli_query($con,$loginSql))
                {
                    //===============Send Email=================================
                    $to = $email;
                    $subject ="ICE";
                    $message = "Your ICE account has been created, you can now login and vote.";

                    $headers = 'From: ICE' . "\r\n" .
                                            'Reply-To: info@ice.co.za' . "\r\n" .
                                            'Hello '.$name ;

                    mail($to, $subject, $message, $headers);
                    //==========================================================
                    $mssg= "You are succefully registered...!! ";
                    //header('location:feedback.php');
                }
                else
                {
                    
                    $mssg= "Failed to add login details. Try Again in 5 minutes".  mysqli_error($con);
                    //header('location:feedback.php');
                }

             
             }
             else
             {
                 
                  $mssg= "Failed to add user details. Try again in 5 minutes".  mysqli_error($con);
                  //header('location:feedback.php');
             }
        }
        //header('location:feedback.php');
        
        
       mysqli_close($con);
       return $mssg;
        
        
    }
    
    function getUser($user_id) 
    {
       
        //require_once('dbConnect.php');
        include 'User.php';
        
        $user=null;
        $sql = "select * from user where user_id='$user_id'";

        $check = mysqli_fetch_array(mysqli_query($con,$sql));
        $result = array();
        if(isset($check))
        {
            $result = $con->query($sql);
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                    $user=new User($row["user_id"], $row["name"], $row["surname"], $row["province"], $row["phone"], $row["email"]);
                   
                }
                
            }
            
        }
        
        mysqli_close($con);
        
        return $user;
    }
    
    function updateUser(User $user) 
    {
        require_once ('dbConnect.php');
        $user_id=$user->getUser_id();
        $name=$user->getName();
        $surname=$user->getSurname();
        $province=$user->getProvince();
        $phone=$user->getPhone();
        $email=$user->getEmail();
        $mssg="";

        $sql = "UPDATE user SET name ='$name', surname = '$surname',province='$province' ,phone='$phone',email='$email'"
                . "WHERE user_id ='$user_id'";

        if ($con->query($sql) === TRUE) 
        {
             //encrypting username and password
             $username=password_hash($email, PASSWORD_DEFAULT);
        
             $sql = "UPDATE login SET user_name ='$username'"
                . "WHERE user_id ='$user_id'";
             $con->query($sql);
             $mssg="Profile Successfully Updated";
             //==============================Geting User=====================
               $sql = "select * from user where user_id='$user_id'";

                $check = mysqli_fetch_array(mysqli_query($con,$sql));
                $result = array();
                if(isset($check))
                {
                    $result = $con->query($sql);
                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            $_SESSION["name"]=$row["name"];
                            $_SESSION["surname"]=$row["surname"];
                            
                            $_SESSION["province"]=$row["province"];
                            $_SESSION["phone"]=$row["phone"];
                            $_SESSION["email"]=$row["email"];

                        }

                    }

                }


             //==============================================================
            // header('location:feedback.php'); 
        } 
        else
        {
            $mssg="Profile not updated, ERROR: " . $con->error;
            //header('location:feedback.php');

        }
         mysqli_close($con);
        return $mssg;
       
    }
    
    function deleteUser( $user_id) 
    {
        require_once('dbConnect.php');
	$mssg="";	
        $sql = "DELETE FROM user WHERE user_id ='$user_id'";

        if ($con->query($sql) === TRUE) 
        {
                $mssg= "User successfully deleted";
                //header('location:feedback.php');
        } 
        else
        {
                $mssg=  "Error deleting record: " . $con->error;
                //header('location:feedback.php');
        }
        
       
         mysqli_close($con);
         return $mssg;
    }
    
   //=========================LOGIN TABLE SQL STATEMENT==========================
    
   function login($username,$password)
   {
       require_once('dbConnect.php');
       $mssg="";
       $sql= "SELECT * FROM login";

        $check = mysqli_fetch_array(mysqli_query($con,$sql));
       $grantAccess=false;
        $result = array();
        
        if(isset($check))
        {
           $result = $con->query($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                        
                     if(password_verify($username, $row["user_name"]) && password_verify($password, $row["password"]) && $row["status"]=="Active" )
                     //if($username==$row["username"] && $password== $row["password"] && $row["status"]=="Active")
                     {
                         session_start();

                         $grantAccess=true;
                         $role=$row["role"];
                         $user_id=$row["user_id"];
                         $user=$row["role"];
                         if($row["role"]=="user")
                         {
                             $user="User";
                         }
                          $_SESSION["role"]=$user;
                          $_SESSION["password"]=$row["password"];
                          $_SESSION["username"]=$row["user_name"];
                          $_SESSION["user_id"]=$row["user_id"];
                          
                         //==============================Geting User=====================
                           $sql = "select * from user where user_id='$user_id'";

                            $check = mysqli_fetch_array(mysqli_query($con,$sql));
                            $result = array();
                            if(isset($check))
                            {
                                $result = $con->query($sql);
                                if ($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc()) 
                                    {
                                        $_SESSION["name"]=$row["name"];
                                        $_SESSION["surname"]=$row["surname"];
                                        $_SESSION["province"]=$row["province"];
                                        $_SESSION["phuser_idone"]=$row["phone"];
                                        $_SESSION["email"]=$row["email"];

                                    }

                                }

                            }
                         
                         
                         //==============================================================
                         
                         
                         
                         if($role=="Admin")
                         {  
                            header('location:adminLogin.php'); 
                         }
                         else
                         {
                             
                            header('location:usersLogin.php'); 
                         }
                         
                     }
                    
                }

            } 
        }
        
        if($grantAccess==false)
        {
            $mssg="Invalid login details....!!";
            //echo  $_SESSION["mssg"];
            //header('location:feedback.php'); 
        }
        
        
        mysqli_close($con);
        return $mssg;
       
   }
   
   function updatePassword($user_id,$password)
   {
       require_once('dbConnect.php');
       $mssg="";
       $password=password_hash($password, PASSWORD_DEFAULT);
         
       $sql = "UPDATE login SET password ='$password'"
                . "WHERE user_id ='$user_id'";

        if ($con->query($sql) === TRUE) 
        {

            $mssg="Password Successfully Updated";
            //header('location:feedback.php'); 
        } 
        else
        {
            $mssg="Password not updated, ERROR: " . $con->error;
            //header('location:feedback.php');

        }
        
        mysqli_close($con);
        return $mssg;
       
   }
   
   function resetLogin($user_id,$email)
   {
      //====================================
        $mssg="";
       require_once ('dbConnect.php');
        
        $sql= "SELECT * FROM user WHERE user_id='$id' AND email='$email'";

        $check = mysqli_fetch_array(mysqli_query($con,$sql));
        $isValid=false;
        $result = array();
        if(isset($check))
        {
             $isValid=true;
        }
         mysqli_close($con);
       
      //===================================
        
        if($isValid)
        {
           
            $password=password_hash($user_id, PASSWORD_DEFAULT);

            $sql = "UPDATE login SET password ='$password'"
                     . "WHERE user_id ='$user_id'";

             if ($con->query($sql) === TRUE) 
             {
                  $sql = "select * from user where user_id='$user_id'";

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
                             $message = "Your ICE password has been reseted, Note your new password is :".$user_id;

                             $headers = 'From: ICE Admin' . "\r\n" .
                                                     'Reply-To: info@ice.co.za' . "\r\n" .
                                                     'Hello '.$name ;

                             mail($to, $subject, $message, $headers);
                             //==========================================================
                         }

                     }

                 }
                 $mssg="Password Successfully reseted...!!";
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
        return $mssg;
       
   }
   
   //=====================VOTING===============================================
   function closeOpenVoting($status)
   {
       require_once('dbConnect.php');
       
       $sql = "UPDATE voting_status SET status ='$status'";
               

        if ($con->query($sql) === TRUE) 
        {
            if($status=="Open")
            {
               $_SESSION["mssg"]="Voting web form is now open...!!"; 
               //header('location:feedback.php'); 
               $sql = "select * from user";

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
                            $subject ="ICE Voting";
                            $message = "ICE voting is now open, not you can go to our website and vote online...!!";

                            $headers = 'From: ICE Admin' . "\r\n" .
                                                    'Reply-To: info@ice.co.za' . "\r\n" .
                                                    'Hello '.$name ;

                            mail($to, $subject, $message, $headers);
                            //==========================================================
                        }

                    }

                }
            }
            else
            {
                 $_SESSION["mssg"]="Voting web form is now closed...!!";
                 //header('location:feedback.php'); 
            }
           
            
        } 
        else
        {
            $_SESSION["mssg"]="Status not updated, ERROR: " . $con->error;
            //header('location:feedback.php');

        }
        mysqli_close($con);
        header('location:feedback.php');
        //return $mssg;
       
   }
   
   //=========================VOTING RESULTS==========================
    function addVote($user_id,  $party_id) 
    {
         require_once ('dbConnect.php');
        
         $mssg="";
         $sql = "INSERT INTO vote_results(fk_user_id,fk_party_id) VALUES('$user_id','$party_id')";
       
        
       $sqlCheck = "SELECT * FROM vote_results WHERE fk_user_id ='$user_id'";
       		
       $CheckId = mysqli_fetch_array(mysqli_query($con,$sqlCheck));
      		
	if(isset($CheckId))
	{
           
	    $mssg="Your vote has not been submited because you voted before....!!";
            //header('location:feedback.php');
	}
        else
        {
        
             if(mysqli_query($con,$sql))
             {
                   //include './User.php';
                   $mssg="Your vote has  been submited....!!";
                   //header('location:feedback.php');
                   $user= $this->getUser($user_id);
                   //===============Send Email=================================
                    $to = $user->getEmail();
                    $subject ="ICE";
                    $message = "Your vote has beed submited. Note: you can also"
                            . " view live results on this website by clicking "
                            . "RESULT link";

                    $headers = 'From: ICE' . "\r\n" .
                                            'Reply-To: info@ice.co.za' . "\r\n" .
                                            'Hello '.$user->getName() ;

                    mail($to, $subject, $message, $headers);
                    //==========================================================
             
             }
             else
             {
                 
                 $mssg= "Failed to submit you vote. Try again in 5 minutes".  mysqli_error($con);
                 //header('location:feedback.php');
             }
        }
        //header('location:feedback.php');
        
       mysqli_close($con);
       return $mssg;
        
    }
    
    
    function checkUser( $id,$email)
    {
        require_once ('dbConnect.php');
        //$email=password_hash($email, PASSWORD_DEFAULT);
      
        $sql= "SELECT * FROM user WHERE user_id='$id' AND email='$email'";

        $check = mysqli_fetch_array(mysqli_query($con,$sql));
        $isValid=false;
        $result = array();
        if(isset($check))
        {
             $isValid=true;
        }
         mysqli_close($con);
        return $isValid;
        
        
    }
}
