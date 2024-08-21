<?php
   require_once 'logininfo.php';
 
   $con = new mysqli($server, $username, $password, $db);
   //another way to establish connection $con = new mysqli_connect(......);
  
   if($con->connect_error){
       die("Error Conneting to DB".$con->connect_error);
   }
   else{
       if(isset($_POST['email']) && !empty($_POST['password'])){
           $user = $_POST['email'];
           $paswd = $_POST['password'];
 
           //before running query clean up data
           $cleanuser = get_Post($con, $user);
           $cleanpaswd = get_Post($con, $paswd);
 
           //calling the find user function to let user log in
           find_user($con, $cleanuser, $cleanpaswd);
       }
   }
 
   //function calls real_escape_string
   //remove special characters for data
   function get_Post($con, $var){
       return $con->real_escape_string($var);
   }
 
   //function to search user in the database, verify that user exist and password is correct
   //this function uses prepared statments
   function find_user($con, $e, $p){
       //First check if email given by user
       $stmt = $con->prepare('SELECT prof_id from professors where email = ?');
       $stmt->bind_param("s", $e);
 
       $stmt->execute();
       $result = $stmt->get_result(); //get the result
       $userp = $result->fetch_assoc(); //fetch password from query
       $pf_id = ($userp["prof_id"]);
 
       //If user exists checks if the password matches to what is in the database
       if(!$pf_id || $pf_id == NULL){
           //Need to give the user feedback about this
           header("Location: http://localhost/ABET/login.html");
       }
 
       else{
           //Verify that password exists in the database
           $stmt = $con->prepare('SELECT password FROM professors WHERE prof_id = ?');
           $stmt->bind_param("i", $pf_id);
           $stmt->execute();
           $result = $stmt->get_result(); //get the result
           $userp = $result->fetch_assoc(); //fetch the password from the query
           $hp = ($userp["password"]);
           //using password_verify to compare typed password and hashed password in the database
           if(password_verify($p, $hp)){
               setcookie('userID', $pf_id);
               header("Location: http://localhost/ABET/professors.php");
           }
 
           else{
               
               header("Location: http://localhost/ABET/login.html");
           }
       }
 
      
      
   }
 
   //closing connection
   $con->close();
?>
