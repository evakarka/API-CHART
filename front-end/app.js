var chartDate_reported = [], chartCountry_code = [], chartCountry = [], chartWHO_region = [], 
chartNew_cases = [], chartCumulative_cases = [], chartNew_deaths = [], chartCumulative_deaths = []

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
            data: chartCountry
        },
        {
          label: 'Date',
          backgroundColor: 'orange',
          borderColor: 'rgb(255, 255, 255)',
          data: chartDate_reported
        },
        {
          label: 'New Deaths',
          backgroundColor: 'red',
          borderColor: 'rgb(255, 255, 255)',
          data: chartNew_deaths
        },
        {
          label: 'Cumulative Deaths',
          backgroundColor: 'green',
          borderColor: 'rgb(255, 255, 255)',
          data: chartCumulative_deaths
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

  const Date_reported = barChatData.data.map((x) => x.Date_reported)
  const Country_code = barChatData.data.map((x) => x.Country_code)
  const Country = barChatData.data.map((x) => x.Country)
  const WHO_region = barChatData.data.map((x) => x.WHO_region)
  const New_cases = barChatData.data.map((x) => x.New_cases)
  const Cumulative_cases = barChatData.data.map((x) => x.Cumulative_cases)
  const New_deaths = barChatData.data.map((x) => x.New_deaths)
  const Cumulative_deaths = barChatData.data.map((x) => x.Cumulative_deaths)

  chartDate_reported  = Date_reported
  chartCountry_code  = Country_code
  chartCountry   = Country
  chartWHO_region  = WHO_region
  chartNew_cases  = New_cases
  chartCumulative_cases  = Cumulative_cases
  chartNew_deaths  = New_deaths
  chartCumulative_deaths  = Cumulative_deaths

}

