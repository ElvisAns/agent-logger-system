

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
        echo $vl."\r\n";
    }

    $sql = "SELECT * FROM id_tag_record";

    $var=array();

    if ($result=mysqli_query($conn,$sql))
    {
      while ($row=mysqli_fetch_row($result)) //fetch row for only one 
      {

        $tableRow = array(
        'SMART_CARD_ID' => $row[0],
        'image' => $row[1],
        'employee_ID' => $row[2],
        'Names'  => $row[3],
        'function' => $row[4],
        'Departement' => $row[5]
        );

        array_push($var, $tableRow);

      }

      echo json_encode($var, JSON_FORCE_OBJECT);
      // Free result set
      mysqli_free_result($result);
    }

 
    mysqli_close($conn);
?>
 