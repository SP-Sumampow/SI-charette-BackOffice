<?php
if(isset($_COOKIE["iduser"])) {
    setcookie("iduser", "", time() - 6000);
    $response = array("logout"=>true);
    $json = json_encode($response);

    // Display the output
    echo($json);
    die();
} else {
    $response = array("logout"=>true);
    $json = json_encode($response);

    // Display the output
    echo($json);
    die();
}

?>