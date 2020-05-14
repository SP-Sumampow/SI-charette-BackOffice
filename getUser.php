<?php
 if(isset($_COOKIE["iduser"])) {
     //echo $_COOKIE["iduser"];

     $host="localhost";
     $dbName="movie";
     $user="root";
     $pass="root";

     try {
         $dbh = new PDO("mysql:host=".$host.";dbname=".$dbName, $user, $pass);


         $sqlGetUserId = "SELECT name, iduser, picture from user WHERE iduser = ?";
         $preparedSQLGetUserId = $dbh->prepare($sqlGetUserId);
         $preparedSQLGetUserId->execute([$_COOKIE["iduser"]]);
         $userInfo = $preparedSQLGetUserId->fetch();


         if (isset($userInfo["iduser"])) {
             $response = array(
                 "iduser" => $userInfo["iduser"],
                 "name"=> $userInfo["name"],
                 "picture"=> $userInfo["picture"],
                 "isLogged"=>true
             );

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



 } else {
     echo "logout";
 }
?>