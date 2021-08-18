

<?php
    //Connect to database and create table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agent_tracking";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        $vl="Erreur d'acces";
        echo json_encode($vl)."\r\n";
    }

    $sql = "SELECT * FROM attendance_arrival ORDER BY Heure ASC";

    $var=array();

    if ($result=mysqli_query($conn,$sql))
    {
      while ($row=mysqli_fetch_row($result)) //fetch row for only one 
      {
        

        $sql2 = "SELECT Heure FROM attendance_exit WHERE `Names`= '".$row[1]."' AND Date = '".$row[5]."'";
        $heureSortie=mysqli_query($conn,$sql2);
        $heureSortieDB=mysqli_fetch_row($heureSortie);
        mysqli_free_result($heureSortie);

        $sql3 = "SELECT image FROM id_tag_record WHERE `Names`= '".$row[1]."'";
        $image=mysqli_query($conn,$sql3);
        $photo=mysqli_fetch_row($image);
        mysqli_free_result($image);


        if($heureSortieDB !== null){
            $heureSortieDBArray=explode(":", implode("",$heureSortieDB));
            $heureEntreeDBArray=explode(":", $row[4]);

            if($heureSortieDBArray[0] > $heureEntreeDBArray[0]){

                $WorkTime=array();
                if($heureSortieDBArray[1] >= $heureEntreeDBArray[1]){ //comp on minutes
                    $WorkTime[0]=$heureSortieDBArray[0]-$heureEntreeDBArray[0];
                    $WorkTime[1]=$heureSortieDBArray[1]-$heureEntreeDBArray[1];
                    $WorkTime = implode("H:", $WorkTime);
                } 

                else{
                    $WorkTime[0]=($heureSortieDBArray[0]-1) - $heureEntreeDBArray[0];
                    $WorkTime[1]=(60+$heureSortieDBArray[1]) - $heureEntreeDBArray[1];
                    $WorkTime =implode("H:", $WorkTime);
                    $WorkTime = $WorkTime."min";
                }
            }

            else{
               $WorkTime="Erreur"; 
            }

        }

        else{
            $WorkTime="Sortie-Non assignée";
        }


        $tableRow = array(
        'Employee_id' => $row[0],
        'Names' => $row[1],
        'Function' => $row[2],
        'Departement' => $row[3],
        'Date' => $row[5],
        'TimeArrival' => $row[4],
        'TimeSortieDB' => $heureSortieDB[0],
        'WorkTime' => $WorkTime,
        'image' => $photo
        );

        array_push($var, $tableRow);

      }

      echo json_encode($var, JSON_FORCE_OBJECT);
      // Free result set
      mysqli_free_result($result);
    }

 
    mysqli_close($conn);
?>
 