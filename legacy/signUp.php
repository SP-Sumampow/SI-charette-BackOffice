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

$userid = null;

try {
    $dbh = new PDO("mysql:host=".$host.";dbname=".$dbName, $user, $pass);

    $preparedSQL = $dbh->prepare($sql);
    $preparedSQL->execute([$name, $email, $password]);


    $sqlGetUserId = "SELECT iduser from user WHERE email = ? AND password = ?";
    $preparedSQLGetUserId = $dbh->prepare($sqlGetUserId);
    $preparedSQLGetUserId->execute([$email, $password]);
    $userInfo = $preparedSQLGetUserId->fetch();

    var_dump($userInfo["iduser"]);

    setcookie("iduser", $userInfo["iduser"], time() + 6000);

    $userid = $userInfo["iduser"];


} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>


<!DOCTYPE html>
<html>
<body>

<h1>hey this is the user id </h1>
<?php if (isset($userid)) { ?>
    <h1><?php echo $userid ?> </h1>
<?php } else { ?>
    <h1>oups there is no user id</h1>
<?php } ?>
</body>
</html>