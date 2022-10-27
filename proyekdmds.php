<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Proyek DMDS</title>
    <script>
        $(document).ready(function() {
            load();
            $("#negara").on("change", function() {
                sean();
                yearbasedadd();
                updated();
            });
            $("#genres").on("change", function() {
                sean();
                yearbasedadd();
                updated();
            });
            $("#rating").on("change", function() {
                sean();
                yearbasedadd();
                updated();
            });
        });

        function load() {
            $.ajax({
                url: "includes/ajaxproyek.php",
                method: "POST",
                data: {
                    genres: true
                },
                success: function(show) {
                    $('#genres').html(show);
                }
            });
            $.ajax({
                url: "includes/ajaxproyek.php",
                method: "POST",
                data: {
                    negara: true
                },
                success: function(show) {
                    $('#negara').html(show);
                }
            });
            $.ajax({
                url: "includes/ajaxproyek.php",
                method: "POST",
                data: {
                    rating: true
                },
                success: function(show) {
                    $('#rating').html(show);
                }
            });
            yearbasedadd();
            sean();
            updated();
        }

        function sean() {
            var genre = $("#genres").val();
            var negara = $("#negara").val();
            var age = $("#rating").val();
            if (genre == null) {
                genre = 'All';
            }
            if (negara == null) {
                negara = 'All';
            }
            if (age == null) {
                age = 'All';
            }
            $.ajax({
                type: "post",
                data: {
                    genre: genre,
                    age: age,
                    negara: negara
                },
                url: "includes/prosesuas.php",
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
                            ['Disney', disney],
                            ['Netflix', netflix]
                        ]);

                        // Instantiate and draw the chart.
                        if (disney == 0 && netflix == 0) {
                            $("#jumlahshow").html("No data found");
                        } else {
                            var options = {
                                height: 350
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('jumlahshow'));
                            chart.draw(data, options);
                        }
                    }

                },
                error: function() {
                    alert('Maaf, Server Petra sedang Down');
                }
            });
        }

        function updated() {
            var gen = $("#genres").val();
            var neg = $("#negara").val();
            var rate = $("#rating").val();
            if (gen == null) {
                gen = 'All';
            }
            if (neg == null) {
                neg = 'All';
            }
            if (rate == null) {
                rate = 'All';
            }
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(barchart);

            var r = $.ajax({
                async: false,
                url: "includes/ajaxproyek.php",
                global: false,
                dataType: "json",
                type: "POST",
                data: {
                    bar: true,
                    gen: gen,
                    neg: neg,
                    rate: rate
                }
            }).responseText;

            function barchart() {
                if (r == 'gada') {
                    $("#updated5years").html("No data found");
                } else {
                    r = JSON.parse("[" + r + "]");
                    var data = new google.visualization.arrayToDataTable(r);
                    var options = {
                        vAxis: {
                            format: 'decimal',
                            title: 'Jumlah Show'
                        },
                        hAxis: {
                            format: '',
                            title: 'Tahun'
                        },
                        bars: 'vertical',
                        height: 350
                    };
                    var chart = new google.charts.Bar(document.getElementById('updated5years'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            }
        }

        function yearbasedadd() {
            var gen = $("#genres").val();
            var neg = $("#negara").val();
            var rate = $("#rating").val();
            if (gen == null) {
                gen = 'All';
            }
            if (neg == null) {
                neg = 'All';
            }
            if (rate == null) {
                rate = 'All';
            }
            google.charts.load('current', {
                'packages': ['line']
            });
            google.charts.setOnLoadCallback(linechart);

            var r = $.ajax({
                async: false,
                url: "includes/ajaxproyek.php",
                global: false,
                dataType: "json",
                type: "POST",
                data: {
                    line: true,
                    gen: gen,
                    neg: neg,
                    rate: rate
                }
            }).responseText;


            function linechart() {
                if (r == 'gada') {
                    $("#insertedshows").html("No data found");
                } else {
                    r = JSON.parse("[" + r + "]");
                    var data = new google.visualization.arrayToDataTable(r);
                    var options = {
                        hAxis: {
                            format: '',
                            ticks: [2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021],
                            title: 'Tahun'
                        }, // display labels every 25
                        vAxis: {
                            format: 'decimal',
                            title: 'Jumlah Show'
                        },
                        height: 500
                    };

                    var chart = new google.charts.Line(document.getElementById('insertedshows'));

                    chart.draw(data, google.charts.Line.convertOptions(options));
                }
            }
        }
    </script>


</head>

<body style="background: linear-gradient(90deg, #FFC0CB 50%, #c0efff 50%)">
    <br>
    <br>
    <center>
        <h1 style="color: #E50914; font-weight: bold;">NETFLIX</h1>
        <h5>VS</h5>
        <h1 style="color: #006e99;  font-weight: bold;">DISNEY+</h1>
    </center>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-2">
                <center style="height:50%;">
                    <h5>Genre</h5>
                    <select style="display: inline-block; border: none; border-radius:10px; height:100%;" id="genres"></select>
                </center>
            </div>
            <div class="col-1"></div>
            <div class="col-2">
                <center style="height:50%;">
                    <h5>Negara Produksi</h5>
                    <select style="display: inline-block; border: none; border-radius:10px; height:100%;" id="negara"></select>
                </center>
            </div>
            <div class="col-1"></div>
            <div class="col-2">
                <center style="height:50%;">
                    <h5>Rating Umur</h5>
                    <select style="display: inline-block; border: none; border-radius:10px; height:100%; width:100%;" id="rating"></select>
                </center>
            </div>
            <div class="col-2"></div>
        </div>
        <br>
        <br>
        <br>
        <div class="row" style="height: auto;">
            <div class="col-8">
                <h5>Jumlah Show Ter-Update dalam 5 Tahun Terakhir</h5>
                <div id="updated5years"></div>
            </div>
            <div class="col-4" style="height: auto;">
                <h5>Jumlah Show</h5>
                <div id="jumlahshow" style="height: auto;"></div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <h5>Jumlah Show yang Ditambahkan Berdasarkan Tahun</h5>
                <div id="insertedshows"> </div>
            </div>
        </div>

        <br>
        <br>
        <br>
    </div>
</body>

</html>