$(function () {
  function renderChart(filter = "weekly") {
    $.getJSON(`/api/sales-overview?filter=${filter}`, function (res) {
      var options = {
        series: res.series,
        chart: {
          type: "bar",
          height: 275,
          toolbar: { show: false },
          foreColor: "#adb0bb",
          fontFamily: "inherit",
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "25%",
            endingShape: "rounded",
            borderRadius: 5,
          },
        },
        colors: ["var(--bs-primary)"],
        dataLabels: { enabled: false },
        yaxis: {
          min: 0,
          tickAmount: 5,
          labels: {
            formatter: val => val + "K", // ribuan
          },
        },
        xaxis: {
          categories: res.categories,
          axisBorder: { show: false },
        },
        fill: { opacity: 1 },
        tooltip: { theme: "dark" },
        grid: { show: false },
      };

      $("#sales-overview").html(""); // reset container
      new ApexCharts(document.querySelector("#sales-overview"), options).render();
    });
  }

  // Initial load
  renderChart();

  // On filter change
  $("#salesFilter").on("change", function () {
    renderChart($(this).val());
  });
});
