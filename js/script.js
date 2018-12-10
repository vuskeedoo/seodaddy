// Our labels along the x-axis
var keywords = ["spiderman","ps4","xbox","trailer","gameplay","review"];
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
// For drawing the lines
var africa = [86,114,106,106,107,111];
var results = [168,170,178,190,203,276];
var resultsByMonth = [282,350,411,502,635,809,635,502,411,350,282,111];

new Chart(document.getElementById("resultChart"), {
  type: 'bar',
  data: {
    labels: keywords,
    datasets: [
      { 
        data: results,
        label: "results",
        backgroundColor: "#3e95cd",
        hoverBackgroundColor: "#999999"
      }
    ]
  }
});

new Chart(document.getElementById("dateChart"), {
  type: 'bar',
  data: {
    labels: months,
    datasets: [
      { 
        data: resultsByMonth,
        label: "month",
        backgroundColor: "#FF6347",
        hoverBackgroundColor: "#999999"
      }
    ]
  }
});