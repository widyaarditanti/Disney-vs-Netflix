<?php
require 'autoload.php';

$cli = new MongoDB\Client('mongodb://127.0.0.1:27017');
$col = $cli->project_dmds->project_dmds;
// $col = $cli->project_dmds->project_dmds;

// $cursor = $col->distinct('Genres');

// foreach ($cursor as $c) {
//     echo $c;
//     echo '<br>';
// }



// require 'autoload.php';

// $cli = new MongoDB\Client('mongodb://127.0.0.1:27017');

// // $col = $cli->test->forum;

// // $collection = (new MongoDB\Client)->proyek_dmds->proyek_dmds;
// $col = $cli->project_dmds->project_dmds;

// $genre = 'Comedy';
// $id = 's20';

$cursor = $col->find(['ShowID' => 's20']);
// $jokes = $collection->find();
// $jokesArray = iterator_to_array($jokes[0]);
// var_dump($jokesArray);
foreach ($cursor as $document) {
    foreach ($document['Genres'] as $g) {
        echo $g;
        echo '<br>';
    }
    // echo $document;
}
// if (in_array("s20", $cursor['ShowID'])) {
//     echo "found";
// } else {
//     echo "not found";
// }







// <?php

include "includes/connect.php";

// $sql = "select max(year(DateAdded)) as maxyear from movies";
// $pk = mysqli_query($con, $sql);
// $row = mysqli_fetch_assoc($pk);
// $maxyear =  floatval($row['maxyear']);
// // $minyear1 = floatval($row['minyear']) + (1 / 12);

// //     $sql = "select YEAR(DateAdded) as year from movies 
// // group by year
// // order by year";
// //     $x = mysqli_query($con, $sql);

// $c = 1;
// $r = '["Year", "Disney+", "Netflix"]';

// for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
//     // echo "The number is: $x <br>";
//     $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $n = $row['n'];
//     $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $d = $row['d'];

//     // if ($c == 1) {
//     //     $r = $r . '[' . strval($x) . ',' . $n . ',' . $d . ']';
//     //     $c = $c + 10;
//     // } else {
//     $r = $r . ',[' . strval($x) . ',' . $d . ',' . $n . ']';
//     // }
// }
// echo $r;

// $genre = 'Comedy';
// $n = 0;
// $d = 0;
// $maxyear = 2021;
// $c = 1;
// $r = '["Year", "Disney+", "Netflix"]';
// for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
//     // echo "The number is: $x <br>";
//     $n = 0;
//     $d = 0;
//     $cursor = $col->find(['Genres' => $genre]);
//     foreach ($cursor as $document) {
//         $id = $document['ShowID'];
//         $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
//         $result = $con->query($sql);
//         while ($row = $result->fetch_assoc()) {
//             if ($row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Netflix") {
//                 $n = $n + 1;
//             } elseif (
//                 $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Disney+"
//             ) {
//                 $d = $d + 1;
//             }
//         }
//     }
//     if ($n > 0 or $d > 0) {
//         $c += 1;
//     }
//     $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
// }

// echo $r;
// if ($result = mysqli_query($con, $sql)) {
//     // Return the number of rows in result set
//     $rowcount = mysqli_num_rows($result);
//     printf("Result set has %d rows.\n", $rowcount);
//     // Free result set
//     mysqli_free_result($result);
// }
// $minyear1 = floatval($row['minyear']) + (1 / 12);

//     $sql = "select YEAR(DateAdded) as year from movies 
// group by year
// order by year";
//     $x = mysqli_query($con, $sql);

// $c = 1;
// $yr = array();
// $did = array();
// $net = array();
// // $hasil[] = array();
// $r = '["Year", "Disney+", "Netflix"]';

// for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
//     // echo "The number is: $x <br>";
//     $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $n = $row['n'];
//     $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $d = $row['d'];

//     // if ($c == 1) {
//     //     $r = $r . '[' . strval($x) . ',' . $n . ',' . $d . ']';
//     //     $c = $c + 10;
//     // } else {
//     // array_push($yr, $x);
//     // array_push($did, $d);
//     // array_push($net, $n);
//     $r = $r . ',[' . strval($x) . ',' . $d . ',' . $n . ']';
//     // }
// }
// // $myObj->Year = $yr;
// // $myObj->Disney = $did;
// // $myObj->Netflix = $net;
// // $myJSON = json_encode($myObj);
// // echo $myJSON;
// echo $r;










// // include "includes/connect.php";

// $sql = "select min(year(DateAdded)) as minyear, max(year(DateAdded)) as maxyear from movies";
// $pk = mysqli_query($con, $sql);
// $row = mysqli_fetch_assoc($pk);
// $minyear =  floatval($row['minyear']);
// // $minyear1 = floatval($row['minyear']) + (1 / 12);

// $sql = "select YEAR(DateAdded) as year from movies 
//                 group by year
//                 order by year";
// $x = mysqli_query($con, $sql);

// $c = 1;
// $r = '["Year", "Disney+", "Netflix"]';

// while ($a = mysqli_fetch_array($x)) {
//     $sql = "select count(ShowID) as n from movies where year(DateAdded) = " . $a['year'] . " and Platform = 'Netflix'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $n = $row['n'];
//     $sql = "select count(ShowID) as d from movies where year(DateAdded) = " . $a['year'] . " and Platform = 'Disney+'";
//     $pk = mysqli_query($con, $sql);
//     $row = mysqli_fetch_assoc($pk);
//     $d = $row['d'];

//     $r = $r . ',[' . strval($a['year']) . ',' . $d . ',' . $n . ']';
// }



$maxyear = 2021;
$c = 1;
$r = '["Year", "Disney+", "Netflix"]';
$rate = 4;
$neg = 2;

for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
    // echo "The number is: $x <br>";
    $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix' and AgeRatingID=" . $rate . " and ProductionCountryID = " . $neg;
    $pk = mysqli_query($con, $sql);
    if (mysqli_num_rows($pk) == 0) {
        $n = 0;
    } else {
        $row = mysqli_fetch_assoc($pk);
        if ($row['n'] != 0) {
            $c += 1;
        }
        $n = $row['n'];
    }
    $n = 0;
    $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+' and AgeRatingID=" . $rate . " and ProductionCountryID = " . $neg;
    $pk = mysqli_query($con, $sql);
    if (mysqli_num_rows($pk) == 0) {
        $d = 0;
    } else {
        $row = mysqli_fetch_assoc($pk);
        if ($row['d'] != 0) {
            $c += 1;
        }
        $d = $row['d'];
    }
    $d = 0;
    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
}
echo $r;
