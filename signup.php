<?php
   require_once 'logininfo.php';
 
   $con = new mysqli($server, $username, $password, $db);
   if($con->connect_error){
       die("Error Conneting to DB".$con->connect_error);
   }
   else{
       //Make email and password was created before allowing the user to signup
       if(isset($_POST['email']) && !empty($_POST['psw'])){
           $lname = $_POST['lastName'];
           $fname = $_POST['firstName'];
           $user = $_POST['email'];
           $paswd = $_POST['psw'];
           $repaswd = $_POST['psw-repeat'];
 
           //before running query clean up data
           $cleanLName = get_Post($con, $lname);
           $cleanFName = get_Post($con, $fname);
           $cleanUser = get_Post($con, $user);
           $cleanPaswd = get_Post($con, $paswd);
           $cleanRepaswd = get_Post($con, $repaswd);
 
           //if password and retype password are the same
           if($cleanPaswd == $cleanRepaswd){
               add_user($con, $cleanLName, $cleanFName, $cleanUser, $cleanPaswd);
           }
 
           //if password and retype password are not the same
           else{
               header("Location: http://localhost/ABET/signup.html");
           }
 
          
       }
   }
 
   //function calls real_escape_string
   //remove special characters for data
   function get_Post($con, $var){
       return $con->real_escape_string($var);
   }
 
   //function to add user to database and hash the password
   //and if query runs it takes user to the target page
   function add_user($con, $l, $f, $e, $p){
       $stmt = $con->prepare('INSERT INTO professors (last_name, first_name, email, paswd) VALUES(?,?,?,?)');
       $pswdHash = password_hash($p, PASSWORD_DEFAULT); //hashing password
      
       $stmt->bind_param("ssss",$l, $f, $e, $pswdHash);
 
       $stmt->execute();
       header("Location: http://localhost/ABET/login.html");
   }
 
 
   $con->close();
?>
 

