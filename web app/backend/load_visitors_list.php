

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

    $sql = "SELECT * FROM visitors ORDER BY Heure ASC";

    $var=array();

    if ($result=mysqli_query($conn,$sql))
    {
      while ($row=mysqli_fetch_row($result)) //fetch row for only one 
      {

        $tableRow = array(
        'Names' => $row[0],
        'Mail' => $row[1],
        'Phone' => $row[2],
        'Profession' => $row[3],
        'ID_piece' => $row[4],
        'Motif' => $row[5],
        '_to' => $row[6],
        'Heure' => $row[7],
        'Date' => $row[8]
        );

        array_push($var, $tableRow);

      }

      echo json_encode($var, JSON_FORCE_OBJECT);
      // Free result set
      mysqli_free_result($result);
    }

 
    mysqli_close($conn);
?>
 