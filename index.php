<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID-101</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0L53DX8TB1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0L53DX8TB1');
    </script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="img" width="200" class="d-inline-block">
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="card mb-3 border-0" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-7">
                    <img src="img/4.jpg" alt="...">
                </div>
                <div class="col-md-5 shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title"><b><u>Bihar Status</u></b></h5>
                        <?php
                        $json = file_get_contents('https://api.covid19india.org/state_district_wise.json');
                        $result = json_decode($json, true);
                        $val = $result['Bihar']['districtData'];
                        $active = 0;
                        $confir = 0;
                        $death = 0;
                        $recovered = 0;
                        $arr1 = array("a" => " ");
                        $arr2 = array("a" => " ");
                        $arr3 = array("a" => " ");
                        $arr4 = array("a" => " ");

                        foreach ($val as $x => $value) {
                            $active += (int)$value['active'];
                            $confir += (int)$value['confirmed'];
                            $death += (int)$value['deceased'];
                            $recovered += (int)$value['recovered'];
                            $arr1[$x] = (int)$value['active'];
                            $arr2[$x] = (int)$value['confirmed'];
                            $arr3[$x] = (int)$value['deceased'];
                            $arr4[$x] = (int)$value['recovered'];
                        }
                        unset($arr1["a"]);
                        unset($arr2["a"]);
                        unset($arr3["a"]);
                        unset($arr4["a"]);
                        ?>
                        <p class="card-text"><br>Confirmed case : <?= $confir ?><br>
                            Active : <?= $active ?><br>
                            Death : <?= $death ?><br>
                            Recovered : <?= $recovered ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive shadow p-3 mb-5 bg-body rounded ">
            <table class="table table-hover" style="text-align: center;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">District</th>
                        <th scope="col">Active case</th>
                        <th scope="col">Total case</th>
                        <th scope="col">Total Death</th>
                        <th scope="col">Total Recovered</th>
                        <th scope="col">+ve Today</th>
                        <th scope="col">Died Today</th>
                        <th scope="col">Recovered Today</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($val as $x => $value) {
                    ?>
                        <tr>
                            <th scope="row"><?= $x ?></th>
                            <td><?= $value['active'] ?></td>
                            <td><?= $value['confirmed'] ?></td>
                            <td><?= $value['deceased'] ?></td>
                            <td><?= $value['recovered'] ?></td>
                            <td><?= $value['delta']['confirmed'] ?></td>
                            <td><?= $value['delta']['deceased'] ?></td>
                            <td><?= $value['delta']['recovered'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>  
        <div class="row">
            <div class="col-sm-6">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                    <div id="donutchart1" style="width: 100%;object-fit: fill;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                    <div id="donutchart2" style="width: 100%;object-fit: fill;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                    <div id="donutchart3" style="width: 100%;object-fit: fill;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                    <div id="donutchart4" style="width: 100%;object-fit: fill;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%"></div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart1);
    google.charts.setOnLoadCallback(drawChart2);
    google.charts.setOnLoadCallback(drawChart3);
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart1() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'District');
        data.addColumn('number', 'Active');

        data.addRows([
            <?php
            foreach ($arr1 as $x => $value) {
                echo "['" . $x . "'," . $value . "],";
            }
            ?>
        ]);

        var options = {
            title: 'District wise active case',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
    }

    function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'District');
        data.addColumn('number', 'Total case');

        data.addRows([
            <?php
            foreach ($arr2 as $x => $value) {
                echo "['" . $x . "'," . $value . "],";
            }
            ?>
        ]);

        var options = {
            title: 'District wise Total case',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
    }

    function drawChart3() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'District');
        data.addColumn('number', 'Death');

        data.addRows([
            <?php
            foreach ($arr3 as $x => $value) {
                echo "['" . $x . "'," . $value . "],";
            }
            ?>
        ]);

        var options = {
            title: 'District wise death',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
        chart.draw(data, options);
    }

    function drawChart4() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'District');
        data.addColumn('number', 'Recovery');

        data.addRows([
            <?php
            foreach ($arr4 as $x => $value) {
                echo "['" . $x . "'," . $value . "],";
            }
            ?>
        ]);

        var options = {
            title: 'District wise recovered',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
        chart.draw(data, options);
    }
</script>

</html>
