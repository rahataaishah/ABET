<?php
require_once 'logininfo.php';
$con = new mysqli($server, $username, $password, $db);

if($con->connect_error)
{
   die("Error connecting to DB - ".$con->connect_error);
}
else{
   // Gets cookie containing course number and gets the course name
   if(isset($_COOKIE['course'])){
       $c_num = $_COOKIE['course'];
       $query = "SELECT course_name FROM courses WHERE course_number = '$c_num'";
       $result = $con->query($query);
       if(!$result){
           die("ERROR executing the courses SELECT query");
       }
       $rows = $result->num_rows;
       if($rows >1){
           echo "MULTIPLE ROWS FOUND";
       }
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $c_nam = $row['course_name'];
  
   }
   $qy  = "SELECT * FROM courses WHERE course_number = '$c_num'"; //get all information about that course
   $result = $con->query($qy);
   if(!$result) die("ERROR executing the courses SELECT query");
   $rows = $result->num_rows;
   if($rows >1) echo "MULTIPLE ROWS FOUND";
   $row = $result->fetch_array(MYSQLI_ASSOC);
    //get course name and syllabus
   $c_nam = $row['course_name'];
   $c_syl = $row['course_syllabus'];
    //Displays the title and header
   echo <<< _END
       <html>
           <head>
               <link rel ="stylesheet" types = "/text/css" href = "CSS/table.css">
               <script src= "sorting.js" type="text/javascript"></script>
               //Style for the button class
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
               <title> COURSE: $c_nam </title>
               <h1>COURSE: $c_nam </h1>
           </head>
   _END;
    //Displays the fist the outcome and pI for this specific course
   echo <<< _END
       <br><br>
       <div class ="table_users:>
       <div class="header"> <h2>Course Outcomes & Performance Indicator<h2> </div>
       <table cellspacing ="0">
           <tr>
               <th> Outcomes </th>
               <th> Performance Indicator </th>
           </tr>
   _END;
   //query to get course outcome and performance indicators
   $qy  = "SELECT * FROM course_outcome WHERE course = '$c_num'";
   $result = $con->query($qy);
   if(!$result) die("ERROR executing the courses SELECT query");
   $rows = $result->num_rows;
   if($rows == 0) echo "NO COURSE OUTCOME FOUND";
   for($j=0; $j<$rows; $j++){
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $out = $row['outcome'];
       $perf = $row['performIndicator'];
       echo <<< _END
             <tr>
             <script src= "alert.js" type="text/javascript"></script>
             <td><button onclick="alertout()">$out</button></td>
             <td><button onclick="alertperf()">$perf</button></td>
             </tr>
       _END;
   }
   echo <<< _END
       </table>
       </div>
       <br><br>
   _END;
   //Create table to display the Staticis for the course
   echo <<< _END
       <br><br>
       <div class ="table_users:>
       <div class="header"> <h2>General Assessments Statistics<h2> </div>
       <table cellspacing ="0">
           <tr>
               <th> Class Average Grade </th>
               <th> Highest Average Assessment </th>
               <th> Lowest Average Assessment </th>
           </tr>
   _END;
   //Get the average class grade, the highest assessment grade and the lowest assessment grade and display onto the table
   $qy = "SELECT ROUND(AVG(asse.assessment_average),2), MAX(asse.assessment_average), MIN(asse.assessment_average) FROM reference ref, assessments asse WHERE ref.course_number = '$c_num' AND ref.assessment_number = asse.assessment_number";
   $result = $con->query($qy);
   if(!$result) die("ERROR executing the assessment SELECT query");
   $rows = $result->num_rows;
   if($rows >1) echo "MORE THAN ONE ROW FOUND";
   $row = $result->fetch_array(MYSQLI_NUM);
   $course_avg = $row[0];
   $max_avg = $row[1];
   $min_avg = $row[2];
   echo <<< _END
            <tr>
                <td> $course_avg </td>
                <td> $max_avg </td>
                <td> $min_avg </td>
            </tr>
        </table>
        </div>
        <br><br>
   _END;
   //Creates table that shows the assessments of that
   echo <<< _END
       <div class ="table_users:>
       <div class="header" > <h2>Class Assessment<h2> </div>
       <table cellspacing ="0" id = "asseTab">
           <tr>
               <th onclick="sortTab(0)"> No. </th>
               <th> Assessment </th>
               <th onclick="sortTab(2)"> Average Grade </th>
               <th> View Assessment </th>
           </tr>
   _END;
   //Query to get assessment information for this particular course
   $qy = "SELECT asse.assessment_name, asse.assessment_number, asse.assessment_average FROM reference ref, assessments asse WHERE ref.course_number = '$c_num' AND ref.assessment_number = asse.assessment_number";
   $result = $con->query($qy);
   if(!$result) die("ERROR executing the assessment SELECT query");
   $rows = $result->num_rows;
   if($rows == 0) echo "NO ASSESSMENTS FOUND";
   for($j=0; $j<$rows; $j++){
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $assg_nam = $row['assessment_name'];
       $assg_num = $row['assessment_number'];
       $assg_avg = $row['assessment_average'];
       $r = $j + 1;
   
       echo <<< _END
           <tr>
               <td> $r </td>
               <td> $assg_nam </td>
               <td> $assg_avg </td>
               <td>
                   <form>
                       <input type = "hidden" id = "a$r" value = "$assg_num">
                       <a href = "#" id = "link" onclick="view($r)" class="button"> View </a>
                   <form>
               </td>
           </tr>
       _END;
  
   }
   echo <<< _END
        </div>
        </table>
       </html>
   _END;
}
$con->close();
?>
 