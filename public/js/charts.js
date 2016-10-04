$(function () {
  $.getJSON($('#comments-chart').data('url'),
  function(data) {
    var donut = new Morris.Donut({
      element: 'comments-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a", "#f000a0", "#ffff54", "#00f0ff"],
      data: data,
      hideHover: 'auto'
    });
  });


  $.getJSON($('#comment-chart-5-year').data('url'),
  function(datas) {
    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'comment-chart-5-year',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: datas,
      // The name of the data record attribute that contains x-values.
      xkey: 'year',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Value']
    });
  });

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#articles-chart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData;
  // AJAX =
  $.getJSON($('#articles-chart').data('url'),
  function(data) {
    PieData = data;
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
  });
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 2,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

});
