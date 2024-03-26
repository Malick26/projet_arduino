<!DOCTYPE html>
<html>
<head>
    <title>Valeur de Luminosité de notre capteur</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var visitor = <?php echo $visitor; ?>;
            var data = google.visualization.arrayToDataTable(visitor);
            var options = {
                title: 'Courbe de la Valeur de Luminosité',
                curveType: 'function',
                legend: { position: 'bottom' },
                width: 900,
                height: 500
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Valeur luminosité de notre capteur</h1>
    <div style="display: flex;">
        <div id="valueText" style="width: 50%;">
            <h2>Valeurs de luminosité :</h2>
            <ul>
                @foreach ($values as $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        </div>
        <div id="linechart" style="width: 50%; height: 500px;"></div>
    </div>
</body>
</html>
