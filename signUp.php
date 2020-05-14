<?php

//var_dump($_POST);

//session_start();

/*if (isset($_SESSION['iduser'])) {
    echo "login";
    die();
}*/

if (isset($_GET["email"])) {
    $email = $_GET["email"];
} else {
    echo "error : email required";
    die();
}

if (isset( $_GET["name"])) {
    $name =  $_GET["name"];
} else {
    echo "error : name required";
    die();
}

if (isset( $_GET["password"])) {
    $password =  $_GET["password"];
} else {
    echo "error : password required";
    die();
}


$sql = "insert INTO user (name, email, password)
VALUES (?, ?, ?)";


$host="localhost";
$dbName="movie";
$user="root";
$pass="root";

try {
    $dbh = new PDO("mysql:host=".$host.";dbname=".$dbName, $user, $pass);

    $preparedSQL = $dbh->prepare($sql);
    $preparedSQL->execute([$name, $email, $password]);


    $sqlGetUserId = "SELECT iduser from user WHERE email = ? AND password = ?";
    $preparedSQLGetUserId = $dbh->prepare($sqlGetUserId);
    $preparedSQLGetUserId->execute([$email, $password]);
    $userInfo = $preparedSQLGetUserId->fetch();

    //var_dump($userInfo["iduser"]);

    setcookie("iduser", $userInfo["iduser"], time() + 6000);

    $response = array(
        "iduser"=>$userInfo["iduser"],
        "status"=>true);

    $json = json_encode($response);

    // Display the output
    echo($json);




} catch (PDOException $e) {
    $response = array(
        "status"=>false);

    $json = json_encode($response);

    // Display the output
    echo($json);
    die();
}


?>