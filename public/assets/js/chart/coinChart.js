var sentiment_votes_up = document.getElementById('sentiment_votes_up').value;
var sentiment_votes_down = document.getElementById('sentiment_votes_down').value;

let btn_dropdown_chart = document.getElementById('btn_dropdown_chart');
let btn_dropdown_chart24h = document.getElementById('btn_dropdown_chart24h');
let btn_dropdown_chart7j = document.getElementById('btn_dropdown_chart7j');
let btn_dropdown_chart30j = document.getElementById('btn_dropdown_chart30j');
if (document.getElementById('btn_dropdown_chartAll') != null) var btn_dropdown_chartAll = document.getElementById('btn_dropdown_chartAll');



let div_chart_24h = document.getElementById('div_chart_24h');
let div_chart_7j = document.getElementById('div_chart_7j');
let div_chart_30j = document.getElementById('div_chart_30j');
if (document.getElementById('div_chart_all') != null) var div_chart_all = document.getElementById('div_chart_all');

btn_dropdown_chart24h.addEventListener('click', aff24hChart);
btn_dropdown_chart7j.addEventListener('click', aff7jChart);
btn_dropdown_chart30j.addEventListener('click', aff30jChart);
if (document.getElementById('btn_dropdown_chartAll') != null)btn_dropdown_chartAll.addEventListener('click', affAllChart);
var cpt = 60;



var doughnutPieData = {
    datasets: [{
        data: [sentiment_votes_down, sentiment_votes_up],
        backgroundColor: [
            'rgba(255, 99, 132,0.8)',
            'rgba(54, 162, 235,0.8)',
            'rgba(255, 206, 86,0.8)',
            'rgba(75, 192, 192,0.8)',
            'rgba(153, 102, 255,0.8)',
            'rgba(255, 159, 64,0.8)'
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Bad',
        'Good',
    ]
};

var doughnutPieOptions = {
    responsive: true,
    animation: {
        animateScale: true,
        animateRotate: true
    }
};

if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: doughnutPieData,
        options: doughnutPieOptions
    });
}


var idCoin = document.getElementById('idCoin').value;
let url = 'http://crypto-data/api/chart/' + idCoin
callChartApi();

function callChartApi() {

    fetch(url)
        .then(function (response) {
            return response.json();
        })
        .then(function (response) {
            chartCoin('#chart24h', response['marketDataPrice24h'], response['marketDataTime24h']);
            chartCoin('#chart7j', response['marketDataPrice7j'], response['marketDataTime7j']);
            chartCoin('#chart30j', response['marketDataPrice1m'], response['marketDataTime1m']);
            if (btn_dropdown_chartAll != null) {
                chartCoin('#chartAll', response['marketDataPriceAll'], response['marketDataTimeAll']);
            }
            aff24hChart();
            document.getElementById('loader').style.display = 'none';
        })
        .catch(function (error) {
            cooldown = document.getElementById('cooldown');
            setInterval(function(){
                if (cpt > 0) {
                --cpt;
                cooldown.innerText  = 'Refresh in '+cpt+' sec';
                 }
                 if (cpt <= 0) {
                    callChartApi();
                    cpt = 60;
                 }
            }, 1000);
        });
}

function chartCoin(idChart, dataPrice, dataTime) {

    let areaData = {
        labels: dataTime,
        datasets: [{
            label: 'Prix du ' + idCoin + ' ($)',
            data: dataPrice,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            fill: true, // 3: no fill
        }]
    };

    let areaOptions = {
        plugins: {
            filler: {
                propagate: true
            }
        },
        scales: {
            yAxes: [{
                gridLines: {
                    color: "rgba(204, 204, 204,0.1)"
                }
            }],
            xAxes: [{
                gridLines: {
                    color: "rgba(204, 204, 204,0.1)"
                }
            }]
        },
        legend: {
            display: false
        },
        elements: {
            point: {
                radius: 0
            }
        }
    }

    if ($(idChart).length) {
        var lineChartCanvas = $(idChart).get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: areaData,
            options: areaOptions
        });
    }

}

function aff24hChart() {
    div_chart_24h.style.display = 'flex';
    div_chart_7j.style.display = 'none';
    div_chart_30j.style.display = 'none';
    if (div_chart_all != null) {
        div_chart_all.style.display = 'none'
    }
    btn_dropdown_chart.innerHTML = '24h'
}

function aff7jChart() {
    div_chart_24h.style.display = 'none';
    div_chart_7j.style.display = 'flex';
    div_chart_30j.style.display = 'none';
    if (div_chart_all != null) {
        div_chart_all.style.display = 'none'
    }
    btn_dropdown_chart.innerHTML = '7j'
}

function aff30jChart() {
    div_chart_24h.style.display = 'none';
    div_chart_7j.style.display = 'none';
    div_chart_30j.style.display = 'flex';
    if (div_chart_all != null) {
        div_chart_all.style.display = 'none'
    }
    btn_dropdown_chart.innerHTML = '30j'
}

function affAllChart() {
    div_chart_24h.style.display = 'none';
    div_chart_7j.style.display = 'none';
    div_chart_30j.style.display = 'none';
    div_chart_all.style.display = 'flex'
    btn_dropdown_chart.innerHTML = 'All'
}
