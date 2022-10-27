<?php

require 'autoload.php';
include "connect.php";

$cli = new MongoDB\Client('mongodb://127.0.0.1:27017');
$collection = $cli->project_dmds->project_dmds;

$genre = $_POST['genre'];
$age = $_POST['age'];
$negara = $_POST['negara'];
$hitungnetflix = 0;
$hitungdisney = 0;


if ($genre == "All" && $age != "All" && $negara != "All") {
    $sql = "SELECT * FROM `movies` WHERE AgeRatingID=" . $age . " and ProductionCountryID=" . $negara . ";";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $platform = $row['Platform'];
        if ($platform == 'Netflix') {
            $hitungnetflix = $hitungnetflix + 1;
        } else {
            $hitungdisney = $hitungdisney + 1;
        }
    }
} elseif ($genre != "All" && $age == "All" && $negara != "All") {
    $cursor = $collection->find(['Genres' => $genre]);
    foreach ($cursor as $document) {
        $id = $document['ShowID'];
        $sql = "SELECT * FROM `movies` WHERE ProductionCountryID=" . $negara . " and ShowID='" . $id . "'";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['Platform'] == "Netflix") {
                $hitungnetflix = $hitungnetflix + 1;
            } else {
                $hitungdisney = $hitungdisney + 1;
            }
        }
    }
} elseif ($genre != "All" && $age != "All" && $negara == "All") {
    $cursor = $collection->find(['Genres' => $genre]);
    foreach ($cursor as $document) {
        $id = $document['ShowID'];
        $sql = "SELECT * FROM `movies` WHERE AgeRatingID=" . $age . " and ShowID='" . $id . "'";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['Platform'] == "Netflix") {
                $hitungnetflix = $hitungnetflix + 1;
            } else {
                $hitungdisney = $hitungdisney + 1;
            }
        }
    }
} elseif ($genre == "All" && $age == "All" && $negara != "All") {
    $sql = "SELECT * FROM `movies` WHERE ProductionCountryID=" . $negara . ";";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $platform = $row['Platform'];
        if ($platform == 'Netflix') {
            $hitungnetflix = $hitungnetflix + 1;
        } else {
            $hitungdisney = $hitungdisney + 1;
        }
    }
} elseif ($genre != "All" && $age == "All" && $negara == "All") {
    $cursor = $collection->find(['Genres' => $genre]);
    foreach ($cursor as $document) {
        $id = $document['ShowID'];
        $sql = "SELECT * FROM `movies` WHERE ShowID='" . $id . "'";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['Platform'] == "Netflix") {
                $hitungnetflix = $hitungnetflix + 1;
            } else {
                $hitungdisney = $hitungdisney + 1;
            }
        }
    }
} elseif ($genre == "All" && $age != "All" && $negara == "All") {
    $sql = "SELECT * FROM `movies` WHERE AgeRatingID=" . $age . ";";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $platform = $row['Platform'];
        if ($platform == 'Netflix') {
            $hitungnetflix = $hitungnetflix + 1;
        } else {
            $hitungdisney = $hitungdisney + 1;
        }
    }
} elseif ($genre != "All" && $age != "All" && $negara != "All") {
    $cursor = $collection->find(['Genres' => $genre]);
    foreach ($cursor as $document) {
        $id = $document['ShowID'];
        $sql = "SELECT * FROM `movies` WHERE AgeRatingID=" . $age . " and ProductionCountryID=" . $negara . " and ShowID='" . $id . "';";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['Platform'] == "Netflix") {
                $hitungnetflix = $hitungnetflix + 1;
            } else {
                $hitungdisney = $hitungdisney + 1;
            }
        }
    }
} elseif ($genre == "All" && $age == "All" && $negara == "All") {
    $sql = "SELECT * FROM `movies`";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $platform = $row['Platform'];
        if ($platform == 'Netflix') {
            $hitungnetflix = $hitungnetflix + 1;
        } else {
            $hitungdisney = $hitungdisney + 1;
        }
    }
}



$myArr = array($hitungdisney, $hitungnetflix);

$myJSON = json_encode($myArr);

echo $myJSON;
