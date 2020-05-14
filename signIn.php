<?php

//var_dump($_POST);

//session_start();

/*if (isset($_SESSION['iduser'])) {
    echo "login";
    die();
}*/

if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else {
    echo "error : email required";
    die();
}

if (isset( $_POST["password"])) {
    $password =  $_POST["password"];
} else {
    echo "error : password required";
    die();
}

$host="localhost";
$dbName="movie";
$user="root";
$pass="root";

try {
    $dbh = new PDO("mysql:host=".$host.";dbname=".$dbName, $user, $pass);


    $sqlGetUserId = "SELECT iduser from user WHERE email = ? AND password = ?";
    $preparedSQLGetUserId = $dbh->prepare($sqlGetUserId);
    $preparedSQLGetUserId->execute([$email, $password]);
    $userInfo = $preparedSQLGetUserId->fetch();

    //var_dump($userInfo["iduser"]);

    setcookie("iduser", $userInfo["iduser"], time() + 6000);


    if (isset($userInfo["iduser"])) {
        $response = array("isLogged"=>true);

        $json = json_encode($response);

        // Display the output
        echo($json);
    } else {
        $response = array("isLogged"=>false);
        $json = json_encode($response);

        // Display the output
        echo($json);
    }





} catch (PDOException $e) {
    $response = array(
        "isLogged"=>false);

    $json = json_encode($response);

    // Display the output
    echo($json);
    die();
}


?>