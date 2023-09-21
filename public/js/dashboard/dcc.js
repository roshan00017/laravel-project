Highcharts.chart('serviceToken', {
    chart: {
        type: 'column'
    },
    credits: {
        enabled: false
    },
    exporting: {
        buttons: {
            contextButton: {
                menuItems: ["downloadPNG", "downloadJPEG", "downloadPDF", "downloadXLS"]
            }
        }
    },
    title: {
        text: "{{ trans('dashboard.chart.title3') }}",
        align: 'center'
    },
    colors: ['#3832a8', '#9e0d0d', '#1d800e'],
    xAxis: {
        categories: ['Baisakh', 'Jestha', 'Asadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik',
            'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Service Token count'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray',
                textOutline: 'none'
            }
        }
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'Start Token',
        data: [2, 3, 4, 6, 7, 8, 6, 2, 7, 12, 4, 6]
    }, {
        name: 'Cancelled Token',
        data: [14, 14, 15, 34, 15, 16, 16, 8, 8, 16, 15, 16]
    }, {
        name: 'Completed',
        data: [2, 2, 0, 1, 1, 0, 0, 1, 2, 1, 1, 1]
    }]
});