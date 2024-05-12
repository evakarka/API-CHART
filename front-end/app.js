var chartDate = [], chartTemp = []

async function dummyChart() {
  await getDummyData()

let ctx = document.getElementById('myChart').getContext('2d');

let chart = new Chart(ctx, {
    type: 'bar',

    data: {
        labels: chartCumulative_deaths,
        datasets: [{
            label: 'Country',
            backgroundColor: 'blue',
            borderColor: 'rgb(255, 255, 255)',
            data: chartDate
        },
        {
          label: 'Date',
          backgroundColor: 'orange',
          borderColor: 'rgb(255, 255, 255)',
          data: chartTemp
        }
      ]
    },

    options: {
      tooltips: {
        mode: 'index'
      } 
    }
});
}

dummyChart()

//Fetch Data from API

async function getDummyData() {
  const apiUrl = "http://localhost/API-CHART/API/api/read.php"

  const response = await fetch(apiUrl)
  const barChatData = await response.json()

  const Date = barChatData.data.map((x) => x.Date)
  const Temp = barChatData.data.map((x) => x.Temp)

  chartDate  = Date
  chartTemp  = Temp
}

