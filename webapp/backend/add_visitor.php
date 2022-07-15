
<?php

#header('Content-type: application/json');

$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "agent_tracking";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
  }


if(isset($_POST['visitor_name'])){

	$name=$_POST['visitor_name'];
	$phone=$_POST['visitor_phone'];
	$mail=$_POST['visitor_mail'];
	$function=$_POST['visitor_function'];
	$motif=$_POST['motif_de_visite'];
	$card_id=$_POST['card_id'];
	$personeAvisiter=$_POST['persone_a_visiter'];
	$d= Date("Y-m-d");
	$t= Date("H:i:s");

	$sql= "INSERT INTO visitors VALUES('".$name."','".$mail."','".$phone."','".$function."','".$card_id."','".$motif."','".$personeAvisiter."','".$t."','".$d."')";

	

	if($conn->query($sql)==TRUE){
		echo "Bienvenu a notre visiteur ".$name;
	} 
	else{
		echo  "Erreur fatale, veuillez reessayer";
	}

}


	else{
		header("location:index.asp");
	}

	
	$conn->close();




?>