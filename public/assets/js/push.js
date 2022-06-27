//Barchart
var databars = <?php echo $databars; ?>;
console.log(databars);
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBarChart);
function drawBarChart() {
var databar = google.visualization.arrayToDataTable(databars);
var options = {
    chart: {
    title: 'Hasil Kuesioner',
    subtitle: 'Perhitungan Kuesioner Berdasarkan Softskill & Hardskill {!! $period !!}',
    },
    bars: 'vertical' // Required for Material Bar Charts.
};
var chart = new google.charts.Bar(document.getElementById('barchart'));
chart.draw(databar, options);
}

//Gauge Chart
var datavariables = <?php echo $datavariables; ?>;
console.log(datavariables);
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable(datavariables);
var options = {
    title: 'Evaluasi Kinerja Alumni Berdasarkan Periode',
    width: 400, height: 400,
    redFrom: 0, redTo: 60,
    yellowFrom: 60, yellowTo: 70,
    greenFrom: 70, greenTo: 100,
    majorTicks: ['0','10','20','30','40','50','60','70','80','90', '100'],
    minorTicks: 10

};

var chart = new google.visualization.Gauge(document.getElementById('gaugechart'));
chart.draw(data, options);
}

//High Chart
