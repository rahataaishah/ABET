//Function that creates the cookies for the assessment table
function view(n){
    var code = document.getElementById("a" + n).value;
    document.cookie = "assign="+ code;
    location.href = "http://localhost/ABET/assessment.php";
 }
  
  //Sort the tables in course.php and assessment.php
 function sortTab(n){
    var tab, row, exchan, i, x, y, shouldExch, dir, exchanCount = 0;
    tab = document.getElementById("asseTab");
    exchan = true;
     dir = "min";
    //Loop until no switching has been done
    while(exchan){
        exchan = false;
        row = tab.rows;
         //Loop through all table rows except the first)
        for(i = 1; i <(row.length - 1); i++){
            shouldExch = false;
             //Get the two elements needing comparing from current row
            x = row[i].getElementsByTagName("td")[n];
            y = row[i+1].getElementsByTagName("td")[n];
             //checks what direction they are switching and if they need to be switch
            if(dir == "min"){ //orders from min to max
                if(Number(x.innerHTML) > Number(y.innerHTML)){
                    shouldExch = true;
                    break;
                }
            }else if(dir == "max"){ //orders from max to min
                if(Number(x.innerHTML) < Number(y.innerHTML)){
                    shouldExch = true;
                    break;
                }
            }
          
        }
         //should the rows need to be exchanged, do so or if they done and the direction in min change to max
        if(shouldExch){
            row[i].parentNode.insertBefore(row[i+1], row[i]);
            exchan = true;
            exchanCount++;
        } else if(exchanCount == 0 && dir == "min"){
            dir = "max";
            exchan = true;
        }
     }
 }
  
 
 