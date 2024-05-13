var chartDate = [], chartTemp = [];

async function dummyChart() {
  await getDummyData();

  let ctx = document.getElementById('myChart').getContext('2d');

  let chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartDate,
      datasets: [{
        label: 'Date',
        backgroundColor: 'red',
        borderColor: 'rgb(255, 255, 255)',
        data: chartDate
      },
      {
        label: 'Temp',
        backgroundColor: 'blue',
        borderColor: 'rgb(255, 255, 255)',
        data: chartTemp
      }]
    },
    options: {
      tooltips: {
        mode: 'index'
      } 
    }
  });
}

dummyChart();

async function getDummyData() {
  const apiUrl = "http://localhost/API-CHART/API/api/read.php";
  const response = await fetch(apiUrl);
  const barChatData = await response.json();

  chartDate  = barChatData.data.map((x) => x.Date);
  chartTemp  = barChatData.data.map((x) => x.Temp);
}
