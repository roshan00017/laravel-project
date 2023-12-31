// Data retrieved from:
// - https://en.as.com/soccer/which-teams-have-won-the-premier-league-the-most-times-n/
// - https://www.statista.com/statistics/383679/fa-cup-wins-by-team/
// - https://www.uefa.com/uefachampionsleague/history/winners/
Highcharts.chart('container', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Service Token Details',
      align: 'left'
    },
    xAxis: {
      categories: ['Baisakh', 'Jestha', 'Asadh', 'Shrawan','Bhadra', 'Ashwin','Kartik', 'Mangsir','Poush','Magh', 'Falgun','Chaitra']
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Count trophies'
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
    legend: {
      align: 'left',
      x: 70,
      verticalAlign: 'top',
      y: 70,
      floating: true,
      backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || 'white',
      borderColor: '#CCC',
      borderWidth: 1,
      shadow: false
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
      data: [3, 5, 1, 13]
    }, {
      name: 'Cancelled Token',
      data: [14, 8, 8, 12]
    }, {
      name: 'Compl',
      data: [0, 2, 6, 3]
    }]
  });