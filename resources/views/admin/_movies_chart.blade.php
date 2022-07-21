<div id="movies_chart"> </div>
<script>

       var options = {
           chart: {
               type: 'bar',
               height:300
           },
           plotOptions:{
               bar:{
                   columnWidth:'50%',
                   borderRadius:40
               }
           },
           series: [{
               name: '@lang('movies.total_movies')',
               data: @json($movies->pluck('total_movies')->toArray())
           }],
           xaxis: {
               categories: @json($movies->pluck('month')->toArray())
           }
       };

       var movies_chart = new ApexCharts(document.querySelector("#movies_chart"), options);

       movies_chart.render();


</script>
