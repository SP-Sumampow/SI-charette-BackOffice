<?php
if(isset($_COOKIE["iduser"])) {
    setcookie("iduser", "", time() - 6000);
    echo "logout ok";
    die();
} else {
    echo "logout";
    die();
}

?>