<?php

include "connect.php";

require 'autoload.php';

$cli = new MongoDB\Client('mongodb://127.0.0.1:27017');
$col = $cli->project_dmds->project_dmds;

if (isset($_POST['genres'])) {
    $cursor = $col->distinct('Genres');
    echo '<option value="All" selected>All</option>';
    foreach ($cursor as $c) {
        // echo $node->getProperty("companyName");
        echo '<option value="' . $c . '">' . $c . '</option>';
    }
} elseif (isset($_POST['negara'])) {
    $sql = "select * from productioncountry";
    $result = $con->query($sql);
    echo '<option value="All" selected>All</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['ProductionCountryID'] . '">' . $row['ProductionCountry'] . '</option>';
    }
} elseif (isset($_POST['rating'])) {
    $sql = "select * from agerating";
    $result = $con->query($sql);
    echo '<option value="All" selected>All</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['AgeRatingID'] . '">' . $row['AgeRating'] . '</option>';
    }
} elseif (isset($_POST['bar'])) {
    $sql = "select max(year(DateAdded)) as maxyear from movies";
    $pk = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($pk);
    $maxyear =  floatval($row['maxyear']);
    $gen = $_POST['gen'];
    $rate = $_POST['rate'];
    $neg = $_POST['neg'];

    $c = 1;
    $r = '["Year", "Disney+", "Netflix"]';

    if ($gen == 'All') {
        if ($rate == 'All') {
            if ($neg == 'All') {
                // gen rate neg all
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix'";
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+'";
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen rate all, neg filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix' and ProductionCountryID= " . $neg;
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+' and ProductionCountryID = " . $neg;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        } else {
            if ($neg == 'All') {
                // gen neg all, rate filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix' and AgeRatingID=" . $rate;
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Disney+' and AgeRatingID=" . $rate;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen all, neg rate filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = year(RelaseYear) and year(DateAdded) = " . $x . " and Platform = 'Netflix' and AgeRatingID = " . $rate . " and ProductionCountryID = " . $neg;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        }
    } else {
        if ($rate == 'All') {
            if ($neg == 'All') {
                // rate neg all, gen filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if (
                                $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Netflix"
                            ) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Disney+"
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if ($n > 0 or $d > 0) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // rate all, gen neg filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Netflix" and $row['ProductionCountryID'] == $neg) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] ==
                                "Disney+" and $row['ProductionCountryID'] == $neg
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        } else {
            if ($neg == 'All') {
                // neg all, gen rate filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Netflix" and $row['AgeRatingID'] == $rate) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] ==
                                "Disney+" and $row['AgeRatingID'] == $rate
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen neg rate filter
                for ($x = $maxyear - 5; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] == "Netflix" and $row['AgeRatingID'] == $rate and $row['ProductionCountryID'] == $neg) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $row['yrel'] and $row['yad'] == $x and $row['Platform'] ==
                                "Disney+" and $row['AgeRatingID'] ==
                                $rate and $row['ProductionCountryID'] == $neg
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        }
    }

    if ($c == 1)
        echo 'gada';
    else
        echo $r;
} elseif (isset($_POST['line'])) {
    $sql = "select min(year(DateAdded)) as minyear, max(year(DateAdded)) as maxyear from movies";
    $pk = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($pk);
    $maxyear =  floatval($row['maxyear']);
    $minyear =  floatval($row['minyear']);
    $gen = $_POST['gen'];
    $rate = $_POST['rate'];
    $neg = $_POST['neg'];

    $c = 1;
    $r = '["Year", "Disney+", "Netflix"]';

    if ($gen == 'All') {
        if ($rate == 'All') {
            if ($neg == 'All') {
                // gen rate neg all
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = " . $x . " and Platform = 'Netflix'";
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = " . $x . " and Platform = 'Disney+'";
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen rate all, neg filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = " . $x . " and Platform = 'Netflix' and ProductionCountryID= " . $neg;
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = " . $x . " and Platform = 'Disney+' and ProductionCountryID = " . $neg;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        } else {
            if ($neg == 'All') {
                // gen neg all, rate filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = " . $x . " and Platform = 'Netflix' and AgeRatingID=" . $rate;
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = " . $x . " and Platform = 'Disney+' and AgeRatingID=" . $rate;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen all, neg rate filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $sql = "select count(ShowID) as n from movies where year(DateAdded) = " . $x . " and Platform = 'Netflix' and AgeRatingID=" . $rate . " and ProductionCountryID = " . $neg;
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
                    $sql = "select count(ShowID) as d from movies where year(DateAdded) = " . $x . " and Platform = 'Disney+' and AgeRatingID=" . $rate . " and ProductionCountryID = " . $neg;
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
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        }
    } else {
        if ($rate == 'All') {
            if ($neg == 'All') {
                // rate neg all, gen filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    // echo "The number is: $x <br>";
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if (
                                $row['yad'] == $x and $row['Platform'] == "Netflix"
                            ) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $x and $row['Platform'] == "Disney+"
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if ($n > 0 or $d > 0) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // rate all, gen neg filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $x and $row['Platform'] == "Netflix" and $row['ProductionCountryID'] == $neg) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $x and $row['Platform'] == "Disney+" and $row['ProductionCountryID'] == $neg
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        } else {
            if ($neg == 'All') {
                // neg all, gen rate filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $x and $row['Platform'] == "Netflix" and $row['AgeRatingID'] == $rate) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $x and $row['Platform'] == "Disney+" and $row['AgeRatingID'] == $rate
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            } else {
                // gen neg rate filter
                for ($x = $minyear; $x <= $maxyear; $x++) {
                    $n = 0;
                    $d = 0;
                    $cursor = $col->find(['Genres' => $gen]);
                    foreach ($cursor as $document) {
                        $id = $document['ShowID'];
                        $sql = "select *, year(DateAdded) as yad, year(RelaseYear) as yrel from movies where ShowID='" . $id . "'";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['yad'] == $x and $row['Platform'] == "Netflix" and $row['AgeRatingID'] == $rate and $row['ProductionCountryID'] == $neg) {
                                $n = $n + 1;
                            } elseif (
                                $row['yad'] == $x and $row['Platform'] == "Disney+" and $row['AgeRatingID'] == $rate and $row['ProductionCountryID'] == $neg
                            ) {
                                $d = $d + 1;
                            }
                        }
                    }
                    if (
                        $n > 0 or $d > 0
                    ) {
                        $c += 1;
                    }
                    $r = $r . ', [' . strval($x) . ',' . $d . ',' . $n . ']';
                }
            }
        }
    }

    if ($c == 1)
        echo 'gada';
    else
        echo $r;
}
