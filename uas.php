<?php
require 'autoload.php';
include "includes/connect.php";

$cli = new MongoDB\Client('mongodb://127.0.0.1:27017');
$collection = $cli->project_dmds->project_dmds;
$cursor = $collection->distinct('Genres');
foreach ($cursor as $document) {
    $hasilgenre .= "<option>" . $document . "</option>";
}

$hasilage = "<option>All</option>";
$sql = "SELECT * FROM `agerating`;";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    $hasilage .= "<option value=" . $row['AgeRatingID'] . ">" . $row['AgeRating'] . "</option>";
}

$hasilnegara = "<option>All</option>";
$sql = "SELECT * FROM `productioncountry` ";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    $hasilnegara .= "<option value=" . $row['ProductionCountryID'] . ">" . $row['ProductionCountry'] . "</option>";
}


?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(document).ready(function() {
            $("#negara").on("change", function() {
                var genre = $("#genre").val();
                var negara = $("#negara").val();
                var age = $("#age").val();
                $.ajax({
                    type: "post",
                    data: {
                        genre: genre,
                        age: age,
                        negara: negara
                    },
                    url: "prosesuas.php",
                    success: function(result) {
                        const myObj = JSON.parse(result);
                        disney = myObj[0];
                        netflix = myObj[1];
                        google.charts.load('current', {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            // Define the chart to be drawn.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Element');
                            data.addColumn('number', 'Percentage');
                            data.addRows([
                                ['Netflix', netflix],
                                ['Disney', disney]
                            ]);

                            // Instantiate and draw the chart.
                            if (disney == 0 && netflix == 0) {
                                alert("masok");
                                $("#myPieChart").html("No data found");
                            } else {
                                var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
                                chart.draw(data, null);
                            }
                        }

                    },
                    error: function() {
                        alert('Maaf, Server Petra sedang Down');
                    }
                });
            })
            $("#genre").on("change", function() {
                var genre = $("#genre").val();
                var negara = $("#negara").val();
                var age = $("#age").val();
                $.ajax({
                    type: "post",
                    data: {
                        genre: genre,
                        age: age,
                        negara: negara
                    },
                    url: "prosesuasgenre.php",
                    success: function(result) {
                        const myObj = JSON.parse(result);
                        disney = myObj[0];
                        netflix = myObj[1];
                        google.charts.load('current', {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            // Define the chart to be drawn.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Element');
                            data.addColumn('number', 'Percentage');
                            data.addRows([
                                ['Netflix', netflix],
                                ['Disney', disney]
                            ]);

                            // Instantiate and draw the chart.
                            if (disney == 0 && netflix == 0) {
                                alert("masok");
                                $("#myPieChart").html("No data found");
                            } else {
                                var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
                                chart.draw(data, null);
                            }
                        }

                    },
                    error: function() {
                        alert('Maaf, Server Petra sedang Down');
                    }
                });
            })
            $("#age").on("change", function() {
                var genre = $("#genre").val();
                var negara = $("#negara").val();
                var age = $("#age").val();
                $.ajax({
                    type: "post",
                    data: {
                        genre: genre,
                        age: age,
                        negara: negara
                    },
                    url: "prosesuasgenre.php",
                    success: function(result) {
                        const myObj = JSON.parse(result);
                        disney = myObj[0];
                        netflix = myObj[1];
                        google.charts.load('current', {
                            packages: ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            // Define the chart to be drawn.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Element');
                            data.addColumn('number', 'Percentage');
                            data.addRows([
                                ['Netflix', netflix],
                                ['Disney', disney]
                            ]);

                            // Instantiate and draw the chart.
                            if (disney == 0 && netflix == 0) {
                                // alert("masok");
                                $("#myPieChart").html("No data found");
                            } else {
                                var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
                                chart.draw(data, null);
                            }
                        }

                    },
                    error: function() {
                        alert('Maaf, Server Petra sedang Down');
                    }
                });
            })
        });
    </script>
</head>

<body>

    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Genre</label>
        <select class="form-select" id="genre">
            <?php
            echo $hasilgenre;
            ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">negara</label>
        <select class="form-select" id="negara">
            <?php
            echo $hasilnegara;
            ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">age</label>
        <select class="form-select" id="age">
            <?php
            echo $hasilage;
            ?>
        </select>
    </div>
    <div style="width: 500px; height: 500px;" id="myPieChart" />

</body>

</html>