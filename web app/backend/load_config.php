<?php

header('Content-Type : application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agent_tracking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Database Connection failed: " . $conn->connect_error);
}

//Get current date and time
$d = date("Y-m-d");
//echo " Date:".$d."<BR>";
$t = date("H:i:s");

$var = array();
$dataToSend = array();

$str;

//print_r(explode("\r\n",$str));
$str;

$elt;

$lastEntered = null;

$sqlx = "SELECT * FROM card_swap WHERE `status` = '0' LIMIT 1" ;
$visitorstime = array();

if ($id = mysqli_query($conn, $sqlx))
{

    while ($row = mysqli_fetch_assoc($id))
    {

        $lastEntered = $row["card_uid"];
        $time_index =  $row["timestamp"];
    }

}




if ($lastEntered == null)
{
    $statusx = array(
        '0' => array(
            'status' => 'non-change'
        )
    );
    array_push($dataToSend, $statusx);

}
else
{   
    $statusx = array(
        '0' => array(
            'status' => 'Detected'
        )
    );
    array_push($dataToSend, $statusx);
    $card_id = $lastEntered;


    $sqlx = "UPDATE `card_swap` SET `status` = '1' WHERE `timestamp` = '". $time_index ."' ";

    mysqli_query($conn, $sqlx);
;
    //do request after comminting the last_id file
    

    $query = "SELECT * FROM id_tag_record  WHERE CARD_UID = '" . $card_id . "'";

    $values = array();

    if ($result = $conn->query($query))
    {

        if ($result->num_rows > 0) //check if the ID currently exist , if yes the continue
        
        {

            $conf = "SELECT * FROM config";

            $conf = $conn->query($conf);

            $config = $conf->fetch_assoc();

            $heure_a = $config['heure-arrivee-a'];
            $heure_a = explode(":", $heure_a); //remove : from the string and reimplode it back in to string
            $heure_a = implode("", $heure_a);

            $heure_b = $config['heure-arrivee-b'];
            $heure_b = str_replace(":", "", $heure_b); //another quick why is to replace : with ""
            

            $heure_sa = $config['heure-sortie-a'];
            $heure_sa = str_replace(":", "", $heure_sa); //another quick why is to replace : with ""
            $heure_sb = $config['heure-sortie-b'];
            $heure_sb = str_replace(":", "", $heure_sb); //another quick why is to replace : with ""
            

            $heure_a = intval($heure_a, 10);
            $heure_b = intval($heure_b, 10);

            $heure_sa = intval($heure_sa, 10);
            $heure_sb = intval($heure_sb, 10);

            $now = str_replace(":", "", $t);

            $now = intval($now, 10);

            if ($now >= $heure_a && $now <= $heure_b)
            { //user is going to  to sign entrance
                $result = $conn->query($query);
                $values = $result->fetch_assoc(); //the value picked from the user tag record
                $check_date = "SELECT `Date` FROM attendance_arrival WHERE Names='" . $values['Names'] . "' AND Date = '" . $d . "'";
                $check_date = $conn->query($check_date);

                if ($check_date->num_rows === 0)
                { //user has not yet signed
                    $entrance = "INSERT INTO attendance_arrival VALUES('" . $values['Employee_ID'] . "', '" . $values['Names'] . "', '" . $values['Function'] . "', '" . $values['Departement'] . "', '" . $t . "','" . $d . "')";

                    if ($conn->query($entrance) == true)
                    { //user can sign
                        $result = $conn->query($query);
                        $tableRow = array(
                            'Employee_ID' => $values['Employee_ID'],
                            'Names' => $values['Names'],
                            'Function' => $values['Function'],
                            'Departement' => $values['Departement'],
                            'image' => $values['image'],
                            'Date' => $d,
                            'Time' => $t,
                            'status' => 'Enregistre avec success',
                            'target' => 'Entrance'
                        );

                        
                    array_push($dataToSend, $tableRow);

                    }
                    else
                    { //user has signed
                        $tableRow = array(
                            'Employee_ID' => '',
                            'Names' => 'Pardon erreur',
                            'Function' => '',
                            'Departement' => '',
                            'Date' => $d,
                            'Time' => $t,
                            'status' => 'Erreur d\'Enregistrement dans la Base de donnee'
                        );

                    array_push($dataToSend, $tableRow);

                    }
                }

                else
                { //user signed before
                    $tableRow = array(
                        'Employee_ID' => $values['Employee_ID'],
                        'Names' => $values['Names'],
                        'Function' => $values['Function'],
                        'Departement' => $values['Departement'],
                            'image' => $values['image'],
                        'Date' => $d,
                        'Time' => $t,
                        'status' => 'Attention, Vous aviez signer votre entree deja'
                    );

                    array_push($dataToSend, $tableRow);
                }

            }

            else if ($now >= $heure_sa && $now <= $heure_sb)
            { //user is going to sign sortance
                $result = $conn->query($query);
                $values = $result->fetch_assoc(); //the value picked from the user tag record
                

                $check_sign_entrance = "SELECT `Date` FROM attendance_arrival WHERE Names='" . $values['Names'] . "' AND Date = '" . $d . "'";
                $check_date = $conn->query($check_sign_entrance);

                if ($check_date->num_rows === 1)
                { //user has signed entrance,now he can sign sortance
                    $check_exit_exist = "SELECT `Date` FROM attendance_exit WHERE Names='" . $values['Names'] . "' AND Date = '" . $d . "'";
                    $check_exit_exist = $conn->query($check_exit_exist);
                    if ($check_exit_exist->num_rows === 0)
                    { //user has not yet signed sortance;
                        $entrance = "INSERT INTO attendance_exit VALUES('" . $values['Employee_ID'] . "', '" . $values['Names'] . "', '" . $values['Departement'] . "', '" . $values['Function'] . "', '" . $t . "','" . $d . "')";

                        if ($conn->query($entrance) == true)
                        { //user has signed sortance
                            $tableRow = array(
                                'Employee_ID' => $values['Employee_ID'],
                                'Names' => $values['Names'],
                                'Function' => $values['Function'],
                                'Departement' => $values['Departement'],
                                'image' => $values['image'],
                                'Date' => $d,
                                'Time' => $t,
                                'status' => 'Enregistre avec success',
                                'target' => 'Exit'
                            );

                    array_push($dataToSend, $tableRow);

                        }

                        else
                        { //user has got errror signing
                            $tableRow = array(
                                'Employee_ID' => '',
                                'Names' => 'Pardon erreur',
                                'Function' => '',
                                'Departement' => '',
                                'Date' => $d,
                                'Time' => $t,
                                'status' => 'Erreur d\'Enregistrement'
                            );

                    array_push($dataToSend, $tableRow);

                        }
                    }

                    else
                    { //user signed before
                        $result = $conn->query($query);
                        $values = $result->fetch_assoc(); //the value picked from the user tag record
                        $tableRow = array(
                            'Employee_ID' => $values['Employee_ID'],
                            'Names' => $values['Names'],
                            'Function' => $values['Function'],
                            'Departement' => $values['Departement'],
                            'image' => $values['image'],
                            'Date' => $d,
                            'Time' => $t,
                            'status' => 'Attention, Vous aviez deja signer votre sortie'
                        );

                    array_push($dataToSend, $tableRow);
                    }
                }
                else
                {
                    $result = $conn->query($query);
                    $values = $result->fetch_assoc(); //the value picked from the user tag record
                    $tableRow = array(
                        'Employee_ID' => $values['Employee_ID'],
                        'Names' => $values['Names'],
                        'Function' => $values['Function'],
                        'Departement' => $values['Departement'],
                        'image' => $values['image'],
                        'Date' => $d,
                        'Time' => $t,
                        'status' => 'Attention, Vous tentez de signer la sortie mais votre entree n\'a pas etre enregistré, cette sortie est ignorée, vous etes consideré absent'
                    );

                    array_push($dataToSend, $tableRow);
                }
            }

            else
            { //if time is out side the range
                $result = $conn->query($query);
                $values = $result->fetch_assoc(); //the value picked from the user tag record
                $tableRow = array(
                    'Employee_ID' => $values['Employee_ID'],
                    'Names' => $values['Names'],
                    'Function' => $values['Function'],
                    'Departement' => $values['Departement'],
                    'image' => $values['image'],
                    'Date' => $d,
                    'Time' => $t,
                    'status' => 'Ce n\'est pas encore le moment d\'effectuer des operations'
                );

                    array_push($dataToSend, $tableRow);

            }
        }

        else
        { //user ID is not recognised
            $result = $conn->query($query);
            $values = $result->fetch_assoc(); //the value picked from the user tag record
            $tableRow = array(
                'Employee_ID' => '',
                'Names' => 'Une erreur, s\'est produite',
                'Function' => '',
                'Departement' => '',
                'image' => 'img/avatar.png',
                'Date' => $d,
                'Time' => $t,
                'status' => 'Erreur d\'Enregistrement, cette carte n\'est pas reconnue dans notre base de donnée'
            );

            array_push($dataToSend, $tableRow);
        }
    }

    else
    { //query problem
        
    }

}


$sql = "SELECT Names FROM attendance_arrival WHERE `Date` = '" . $d . "'";
$numberOfAttendee = $conn->query($sql);
$attendees = $numberOfAttendee->num_rows;
//echo "\ntoday attendees ".$attendees;


$sql = "SELECT Names FROM id_tag_record";
$numberOfAgents = $conn->query($sql);
$agents = $numberOfAgents->num_rows;
#echo "\ntotalAgent " .$agents;


$absent = $agents - $attendees;

#echo "\nabsents ".$absent;
$sql = "SELECT Noms FROM visitors WHERE `Date` = '" . $d . "'";
$NumberOfvisitors = $conn->query($sql);
$visitors = $NumberOfvisitors->num_rows;
#echo "\nVisitorsToday" .$visitors;


$sql = "SELECT `Heure` FROM visitors WHERE `Date` = '" . $d . "'";
$str = array();
$visitorstime = array();

if ($visitorsCheckperHour = mysqli_query($conn, $sql))
{

    while ($row = mysqli_fetch_row($visitorsCheckperHour))
    {

        array_push($visitorstime, $row[0]);
    }

}

$heureVisit = array();

for ($x = 0;$x < sizeof($visitorstime);$x++)
{
    $tmp = explode(":", $visitorstime[$x]);
    $tmp = "H" . $tmp[0]; //the hour
    array_push($heureVisit, $tmp);
}

for ($x = 8;$x <= 17;$x++)
{
    $key = "H";
    if ($x < 10) $key .= '0' . $x;

    else $key .= $x;

    $activeVisit[$key] = '0';

}

$activeVisit = array_merge($activeVisit, array_count_values($heureVisit));

$uixData = array(
    'uixData' => array_merge($activeVisit, array(
        'visitors' => $visitors,
        'attendees' => $attendees,
        'agents' => $agents
    ))
);

array_push($dataToSend, $uixData);
array_push($dataToSend, $var);

echo json_encode($dataToSend);
//echo json_encode($var);
$numberOfAttendee->free_result();
$numberOfAgents->free_result();
$NumberOfvisitors->free_result();
$visitorsCheckperHour->free_result();

$conn->close();

?>
