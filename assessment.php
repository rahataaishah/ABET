<?php
   require_once 'logininfo.php';
  
   $con = new mysqli($server, $username, $password, $db);
   if($con->connect_error)
   {
       die("Error connecting to DB - ".$con->connect_error);
   }
   else{
       //Checks if the cookie to display assessment users wanted to view is created
       if(isset($_COOKIE['assign']) ){
           $assg_num = $_COOKIE['assign'];
       }
       else{
           echo "Assignment Num not found<br>";
       }
       //Query to get relevant information pertaining to the assessment
       $qy  = "SELECT assessment_name FROM assessments  WHERE assessment_number = '$assg_num'";
       $result = $con->query($qy);
       if(!$result) die("ERROR executing the records SELECT query");
       $rows = $result->num_rows;
       if($rows > 1) echo "MULTIPLE ASSESSMENTS FOUND";
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $assg_nam = $row['assessment_name'];
       //echo "Assignment name: $assg_nam";
       echo <<< _END
           <html>
               <head>
                   <link rel ="stylesheet" types = "/text/css" href = "CSS/table.css">
                   <script src = "sorting.js" type="text/javascript"></script>
                   <title> Assessment: $assg_nam </title>
                   <h1>Assessment: $assg_nam </h1>
               </head>
 
       _END;
       
       /*Create the a sortable table to display what grade each student got on this assessment*/
       echo <<< _END
           <div class ="table_users:>
           <div class="header"> <h2>Class Assessment<h2> </div>
           <table cellspacing ="0" id = "asseTab">
               <tr>
                   <th onclick="sortTab(0)"> Student No. </th>
                   <th onclick="sortTab(1)"> Grade </th>
               </tr>
       _END;
       //Query to get student information
       $qy  = "SELECT rec.student_id, rec.grade FROM records rec, assessments asse  WHERE rec.assessment_number = '$assg_num' AND rec.assessment_number = asse.assessment_number";
       $result = $con->query($qy);
       if(!$result) die("ERROR executing the records SELECT query");
       $rows = $result->num_rows;
       if($rows == 0) echo "ASSESSMENT NOT FOUND IN RECORDS";
       for($j=0; $j<$rows; $j++){
           $row = $result->fetch_array(MYSQLI_ASSOC);
           $stu_id = $row['student_id'];
           $grade = $row['grade'];
           echo <<< _END
               <tr>
                   <td> $stu_id </td>
                   <td> $grade </td>
               </tr>
           _END;
 
       }
 
 
       echo <<< _END
           </table>
           </div>
           </html>
       _END;
 
   }
   $con->close();
 
?>
 
 

