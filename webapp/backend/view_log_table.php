

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

    $sql = "SELECT * FROM logs ORDER BY time ASC";
    $var=array();

    if ($result=mysqli_query($conn,$sql))
    {
      while ($row=mysqli_fetch_row($result)) //fetch row for only one 
      {
        

        $tableRow = array(
        'id' => $row[0],
        'Roll_number' => $row[1],
        'Names' => $row[2],
        'Profile' => $row[3],
        'Date' => $row[4],
        'Time' => $row[5],
        );
        
        array_push($var, $tableRow);

      }

      echo json_encode($var);
      // Free result set
      mysqli_free_result($result);
    }
 
    mysqli_close($conn);
?>
 