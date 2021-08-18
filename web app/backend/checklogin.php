<?php

session_start();

$_SESSION['name'] = "Elvis";

if(isset($_SESSION['name'])){
	echo json_encode($_SESSION);
}
else{
	echo "cant";
}

?>