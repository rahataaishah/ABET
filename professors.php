<?php
   require_once 'logininfo.php';
   $con = new mysqli($server, $username, $password, $db);
   if($con->connect_error){
       die("Error Conneting to DB".$con->connect_error);
   }
 
   else{
       //Get the userID to obtain users information form the database
       if(isset($_COOKIE['userID'])){
           $pid = $_COOKIE['userID'];
           $query2 = "SELECT *  FROM professors WHERE prof_id = '$pid'";
           $result2 = $con->query($query2);
           $row = $result2->fetch_array(MYSQLI_ASSOC);
           $fname = $row['first_name'];
           echo "<p><b> Welcome $fname to your profile <p></b>";
       }
 
 
       echo <<< _END
           <html>
               <head>
               <link rel ="stylesheet" types="/text/css" href="CSS/table.css">
               <link rel ="stylesheet" types="/text/css" href="CSS/modal.css">
               <script src = "https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js" type="text/javascript"></script>
              
               <script>
                   function alertView(x){
                       var string1 = document.getElementById("c" + x).innerText;
                       document.cookie = "course=" + string1;
                       location.href = "http://localhost/ABET/course.php"
                   }
 
                   function alertgood(){
                       alert("Password change Successful");
                   }
 
                   function alertbad(){
                       alert("Password change Not Successful");
                   }
 
                   function addCourse(){
                       var crnum = document.getElementById("crnum").value;
                       var crname = document.getElementById("crname").value;
                       alert(crnum + " " + crname);
                   }
 
                   function changePass(){
                       var request = new XMLHttpRequest();
 
                       formData = new FormData(document.getElementById("editp"));
                       request.open("POST", "professors.php");
 
                       request.onreadystatechange = function(){
                           if(this.readyState === 4 && this.status === 200){
                               document.getElementById("result").innerHTML = this.responseText
                           }
                       }
                       request.send(formData);
 
                   }
 
                   function togglePopup(){
                       document.getElementById("popup-1").classList.toggle("active");
                   }
               </script>
 
               <style>
 
 
 
                   .button{
                       font:bold 11px Arial;
                       text-decoration: none;
                       background-color: #EEEEEE;
                       color: #333333;
                       padding: 2px 6px 2px 6px;
                       border-top: 1px solid #CCCCCC;
                       border-right: 1px solid #333333;
                       border-bottom: 1px solid #333333;
                       border-left: 1px solid #CCCCCC;
                   }
 
               </style>
 
               </head>
               <body>
                   <h2>$fname's Profile</h2>
               </body>
           </html>
              
        _END;
 
 
        //show courses of the professor
        $query3 = "SELECT *  FROM professors WHERE prof_id = '$pid'";
        $result3 = $con->query($query3);
        $row2 = $result3->fetch_array(MYSQLI_ASSOC);
        $lname = $row2['last_name'];
        $email = $row2['email'];
 
        $query = "SELECT DISTINCT course_number, year, semester from reference WHERE prof_id = $pid";
        $result = $con->query($query);
        if(!$result) die("Error executing the select query");
        $rows = $result->num_rows;
 
       echo <<< _END
           <div class = "table_users">
           <table cellspacing = "10">
           <tr>
               <th>Course</th>
               <th>Year</th>
               <th>Semester</th>
               <th></th>
           </tr>
 
        _END;
 
       for($j = 0; $j < $rows; $j++){
           $row = $result-> fetch_array(MYSQLI_ASSOC);
           $course = $row['course_number'];
           $year = $row['year'];
           $sem = $row['semester'];
 
           echo <<< _END
           <tr>
               <td id="c$j">$course</td>
               <td id="y$j">$year</td>
               <td id="s$j">$sem</td>
               <td>
                   <form>
                       <a href = "#" id="link" onclick="alertView($j)" class="button">View</a>
                             
                      
                   </form>
               </td>
 
              
           </tr>
 
       _END;
       }
       //Code for the Edit Profile Section of this page
       echo <<< _END
       </table>
 
      
 
       </div>
 
 
       <div>
       <h3> EDIT PROFILE</h3>
       <table>
       <div id="result"></div>
       <form id="editp" action="professors.php" >
           <tr>
               <th>
                   <label>ID:</label>
               </th>
               <th>
                   <input type = "text" id="ID" name= "ID" placeholder="$pid" disabled><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>Last Name:</label>
               </th>
               <th>
                   <input type = "text" id="lastname" name= "lastname" placeholder="$lname" disabled><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>First Name:</label>
               </th>
               <th>
                   <input type = "text" id="firstname" name= "firstname" placeholder="$fname" disabled><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>Email:</label>
               </th>
               <th>
                   <input type = "text" id="email" name= "email" placeholder="$email" disabled><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>Old Password:</label>
               </th>
               <th>
                   <input type = "password" id="op" name= "op" placeholder="Old Password"><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>New Password:</label>
               </th>
               <th>
                   <input type = "password" id="np" name= "np" placeholder="New Password"><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <label>Retype New Password:</label>
               </th>
               <th>
                   <input type = "password" id="rnp" name= "rnp" placeholder="New Password"><br>
               </th>
           </tr>
 
           <tr>
               <th>
                   <input type="submit" value="Save" name = "Save" onclick="changePass();">
               </th>
           </tr>
       </form>
       </table>
       </div>
 
 
     
 
 
       _END;
 
       //Code to change the password in the database
       if($_SERVER["REQUEST_METHOD"] == "POST"){
           //Make sure that old password is inputted before the password could be changed
            if(!empty($_POST['op'])){
               $old = $_POST['op'];
               $new = $_POST['np'];
               $rnew = $_POST['rnp'];
               $hp = $row['paswd'];

               //Make sure that new password matches when retyped
               if($new == $rnew){
                   if(password_verify($old, $hp)){
                       $hnew = password_hash($new, PASSWORD_DEFAULT);
                       $stmt = $con->prepare('UPDATE professors SET paswd = ? WHERE prof_id = ?');
                       $stmt->bind_param("si", $hnew, $pid);
                       $stmt->execute();
                       if($stmt->execute()){
                            echo '<script type="text/javascript"> alertgood();</script>';
                        }
 
                        else{
                            echo '<script type="text/javascript"> alertbad();</script>';
                        }
                   }
 
                   else{
                        echo '<script type="text/javascript"> alertbad();</script>';
                   }
 
               }
              
           }
       }
 
   //closing connection
   $con->close();
 
      
      
   }
?>
 
 
 
 
