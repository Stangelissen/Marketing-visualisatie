<!DOCTYPE html>
<meta charset="utf-8">
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="/wp-content/plugins/morres-marketing-tool/css/style.css">

<style> /* set the CSS */

.axis { font: 14px sans-serif; }

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 2px;
}



</style>
<body>

<div id="facebook_overzicht">


    <div class="titelrapport">
        <h2 class="titelonderdeel">Facebook overzicht</h2>
    </div>




  <div id="likesgrafiek">
  </div>

<!-- load the d3.js library -->     


  <script>

    $( document ).ready(function() {
      $.getJSON("/wp-content/plugins/morres-marketing-tool/upload/facebook_1.json", function(data){ 
        dataPlain = JSON.stringify(data);
        dataPlain = dataPlain.replace(/Chatbericht plaatsen/g,'ChatberichtPlaatsen');
        dataPlain = dataPlain.replace(/Gepubliceerd:/g,'Gepubliceerd');
        dataPlain = dataPlain.replace(/Lifetime Post Total Impressions/g,'LifetimePostTotalImpressions');
        dataPlain = dataPlain.replace(/Lifetime Post Total Reach/g,'LifetimePostTotalReach');
        dataPlain = dataPlain.replace(/Lifetime Engaged Users/g,'LifetimeEngagedUsers');
        dataPlain = dataPlain.replace(/Lifetime Total Video Views/g,'LifetimeTotalVideoViews');

        data = JSON.parse(dataPlain);
        //console.log(dataPlain);
         var update_engagement = '';
          $.each(data, function(key, value){
            $.each(value.slice(1), function(key, value){
              var LongTitle = value.ChatberichtPlaatsen;  
              var titel = LongTitle.substring(0,60)
           

              update_engagement += '<tr>';
              update_engagement += '<td>'+titel+'...</td>';
              update_engagement += '<td>'+value.Gepubliceerd+'</td>';
              update_engagement += '<td>'+value.LifetimePostTotalImpressions+'</td>';
              update_engagement += '<td>'+value.LifetimePostTotalReach+'</td>';
              update_engagement += '<td>'+value.LifetimeEngagedUsers+'</td>';
              update_engagement += '<td>'+value.LifetimeTotalVideoViews+'</td>';
              update_engagement += '</tr>';
          });
             }); 
          $('#facebook_table').append(update_engagement);    
      });
     });
    


  </script>

  <script>
          // set the dimensions and margins of the graph
          var margin = {top: 20, right: 20, bottom: 100, left: 50},
                  width = 1000 - margin.left - margin.right,
                  height = 300 - margin.top - margin.bottom;

          // parse the date / time
          var parseTime = d3.timeParse("%m/%d/%Y");

          // set the ranges
          var x = d3.scaleTime().range([0, width]);
          var y = d3.scaleLinear().range([height, 0]);

          // define the line
          var valueline = d3.line()
              .x(function(d) { return x(d.Datum); })
              .y(function(d) { return y(d["Daily New Likes"]); });
          // define the line
          var valueline2 = d3.line()
              .x(function(d) { return x(d.Datum); })
              .y(function(d) { return y(d["Daily Unlikes"]); });
            
          // append the svg obgect to the body of the page
          // appends a 'group' element to 'svg'
          // moves the 'group' element to the top left margin
          var svg = d3.select("#likesgrafiek").append("svg")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
            .append("g")
              .attr("transform",
                    "translate(" + margin.left + "," + margin.top + ")");

          function draw(data, Key) {
            
            var data = data[Key];
            
            // format the data
            data.forEach(function(d) {
                d.Datum = parseTime(d.Datum);
                d["Daily New Likes"] = +d["Daily New Likes"];
                d["Daily Unlikes"] = +d["Daily Unlikes"];
            });
            
            // sort years ascending
            data.sort(function(a, b){
              return a["Datum"]-b["Datum"];
            })
           
            // Scale the range of the data
            x.domain(d3.extent(data, function(d) { return d.Datum; }));
            y.domain([0, d3.max(data, function(d) {
              return Math.max(d["Daily New Likes"], d["Daily Unlikes"]); })]);
            
            // Add the valueline path.
            svg.append("path")
                .data([data])
                .attr("class", "line")
                .attr("d", valueline);
            // Add the valueline path.
            svg.append("path")
                .data([data])
                .attr("class", "line")
                .style("stroke", "red")
                .attr("d", valueline2);  

            svg.append("g")
              .attr("class", "axis")
              .attr("transform", "translate(0," + height + ")")
              .call(d3.axisBottom(x)
                      .tickFormat(d3.timeFormat("%d-%b-%y")))
              .selectAll("text")  
              .style("text-anchor", "end")
              .attr("dx", "-.8em")
              .attr("dy", ".15em")
              .attr("transform", "rotate(-65)");    


            // Add the Y Axis
            svg.append("g")
                .call(d3.axisLeft(y));

            svg.append("text")
              .attr("x", (width / 2))             
              .attr("y", 0 - (margin.top / 7))
              .attr("text-anchor", "middle")  
              .style("font-size", "16px")
              .style("font-family", "Mont-semibold") 
              .text("Pagina likes vs Pagina unlikes");   


            }
          // Get the data
          d3.json("/wp-content/plugins/morres-marketing-tool/upload/facebook_2.json", function(error, data) {
            if (error) throw error;
            
            // trigger render
            draw(data, "Key Metrics");
          });

  </script>






  <table id="facebook_table">
    <tr>
      <th>Titel</th>
      <th>Datum</th>
      <th>Impressies</th>
      <th>Bereik</th>
      <th>User engagement</th>
      <th>Video views</th>
   </tr>
  </table>


  <div id="facebook_feedback">
  </div>

  <form id="texttoevoegen3">
      <div><textarea class="example-default-value" id="textarea3">Typ hier je feedback of advies.</textarea>
      </div>
      <div><br><input type="button" id="formknop" value="Plaats feedback" onclick="example_append3()"/> <input type="button" id="formknop" value="Sluit veld" onclick="sluit3()" /></div>
  </form>


</div>

  <script>

    $('.example-default-value').each(function() {
      var default_value = this.value;
      $(this).focus(function() {
          if(this.value == default_value) {
              this.value = '';
          }
      });
      $(this).blur(function() {
          if(this.value == '') {
              this.value = default_value;
          }
      });
    });
    function example_append3() {
        $('#facebook_feedback').append($('#textarea3').val());
    }



    function sluit3() {
      var x = document.getElementById("texttoevoegen3");
      if (x.style.display === "none") {
        x.style.display = "block";

      } else {
        x.style.display = "none";
      }
    }
    
  </script>
</body>
































