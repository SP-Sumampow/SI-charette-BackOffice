<?php

//var_dump($_GET);

$sqlFindUserCategory = "SELECT cat.idcategory, cat.name
FROM category AS cat,
category_has_anime_has_user as cau
WHERE cat.idcategory = cau.category_idcategory
AND cau.user_iduser = " . $_GET["userId"];

$user="root";
$pass="root";

$listOfCategoriesWithMovie = array();

try {
    $dbh = new PDO('mysql:host=localhost;dbname=movie', $user, $pass);
    foreach($dbh->query($sqlFindUserCategory) as $row) {

        $category = array();
        $category["id"] = $row["name"];
        $category["name"] = $row["name"];
        $category["anime"] = array(); 

        $sqlSelectAnime = "SELECT anime.idanime, anime.name, anime.picture
        FROM category_has_anime_has_user as cau,
        anime AS anime
        WHERE cau.anime_idanime = anime.idanime
        AND cau.category_idcategory = " . $row["idcategory"];

        foreach($dbh->query($sqlSelectAnime) as $row) { 
            $anime = array(); 
            $anime["name"] = $row["name"];
            $anime["picture"] = $row["picture"];

            array_push($category["anime"], $anime);
        }

        array_push($listOfCategoriesWithMovie, $category);
        
    }

    echo json_encode($listOfCategoriesWithMovie);
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


//var_dump($sqlSelect);

?>