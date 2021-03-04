google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawVisualization);

function drawVisualization() {

    const dataChart = [
        ['Sigla', 'Estado', 'Infectados', 'Mortos']
    ];
    for (const dataCovidState of apiDataJson.dataListCovid) {
        dataChart.push(['BR-' + dataCovidState.acronym, dataCovidState.state, dataCovidState.infected, dataCovidState.deaded])
    }
    var data = google.visualization.arrayToDataTable(dataChart);

    var opts = {
        region: 'BR',
        displayMode: 'regions',
        resolution: 'provinces',
        width: chartWidth,
        height: chartHeight,
        colorAxis: {
            colors: ['#080708', '#70FF7E']
        },
        backgroundColor: { fill:'transparent' }
    };
    var geochart = new google.visualization.GeoChart(
        document.getElementById('visualization'));
    geochart.draw(data, opts);
};

function sizeOfThings() {
    chartWidth = parseInt(window.innerWidth / 2) - 10;
    chartHeight = parseInt(window.innerHeight / 2) + 80;

};

sizeOfThings();

window.addEventListener('resize', function() {
    sizeOfThings();
});
