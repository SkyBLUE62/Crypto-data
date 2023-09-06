let market_cap_percentage_btc = document.getElementById('market_cap_percentage_1').value
let market_cap_percentage_eth = document.getElementById('market_cap_percentage_2').value
let market_cap_percentage_usdt = document.getElementById('market_cap_percentage_3').value
let market_cap_percentage_bnb = document.getElementById('market_cap_percentage_4').value
let market_cap_percentage_usdc = document.getElementById('market_cap_percentage_5').value
let market_cap_percentage_xrp = document.getElementById('market_cap_percentage_6').value
let market_cap_percentage_busd = document.getElementById('market_cap_percentage_7').value
let market_cap_percentage_ada = document.getElementById('market_cap_percentage_8').value
let total_marketcap = document.getElementById('total_market_cap').value


if ($("#market_cap_percentage").length) {
    var areaData = {
        labels: ["BTC", "ETH", "USDT", "BNB", "USDC", "XRP", "BUSD", "ADA", "DOGE", "MATIC"] ,
            datasets : [{
                data: [market_cap_percentage_btc, market_cap_percentage_eth, market_cap_percentage_usdt, market_cap_percentage_bnb, market_cap_percentage_usdc, market_cap_percentage_xrp ,market_cap_percentage_busd,market_cap_percentage_ada],
                backgroundColor: [
                    "#111111", "#00d25b", "#ffab00","#f7f7f7", "#d6595a","#5998d6", "#e71691", "#f8bb00","#4800ff",
                ]
            }
            ]
    };
    var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 70,
        elements: {
            arc: {
                borderWidth: 0
            }
        },
        legend: {
            display: false
        },
        tooltips: {
            enabled: true
        }
    }
    var transactionhistoryChartPlugins = {
        beforeDraw: function (chart) {
            var width = chart.chart.width,
                height = chart.chart.height,
                ctx = chart.chart.ctx;

            ctx.restore();
            var fontSize = 1;
            ctx.font = fontSize + "rem sans-serif";
            ctx.textAlign = 'left';
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#ffffff";

            var text = total_marketcap,
                textX = Math.round((width - ctx.measureText(text).width) / 2),
                textY = height / 2.4;

            ctx.fillText(text, textX, textY);

            ctx.restore();
            var fontSize = 0.75;
            ctx.font = fontSize + "rem sans-serif";
            ctx.textAlign = 'left';
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#6c7293";

            var texts = "",
                textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
                textsY = height / 1.7;

            ctx.fillText(texts, textsX, textsY);
            ctx.save();
        }
    }
    var transactionhistoryChartCanvas = $("#market_cap_percentage").get(0).getContext("2d");
    var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: transactionhistoryChartPlugins
    });
}

