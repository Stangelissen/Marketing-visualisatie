<!DOCTYPE html>
<meta charset="utf-8">
<style> /* set the CSS */

.axis { font: 14px sans-serif; }

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 2px;
}

table {
 border-collapse: collapse;

 font: 12px sans-serif;
}

td {

    padding: 5px;
}

</style>
<body>


<div id="linkedin_overzicht">

    <div class="titelrapport">
        <h2 class="titelonderdeel">LinkedIn overzicht</h2>
    </div>




  <div id="bezoekersgrafiek">
    


  </div>


  <table id="linkedin_table">
    <tr>
      <th>Titel</th>
      <th>Datum</th>
      <th>Impressies</th>
      <th>Clicks</th>
      <th>CTR</th>
      <th>Likes</th>
      <th>Comments</th>
      <th>Engagement</th>
      <th>Video views</th>
   </tr>


  </table>

    <div id="linkedin_feedback">
    
    </div>

  <form id="texttoevoegen2">
      <div><textarea class="example-default-value" id="textarea2">Typ hier je feedback of advies.</textarea>
      </div>
      <div><br><input type="button" id="formknop" value="Plaats feedback" onclick="example_append2()"/> <input type="button" id="formknop" value="Sluit veld" onclick="sluit2()" /></div>
  </form>


<!-- load the d3.js library -->     
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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
      var valueline3 = d3.line()
          .x(function(d) { return x(d.Date); })
          .y(function(d) { return y(d["Total page views (total)"]); });

      // define the second line
      var valueline4 = d3.line()
          .x(function(d) { return x(d.Date); })
          .y(function(d) { return y(d["Total unique visitors (total)"]); });    

      // append the svg obgect to the body of the page
      // appends a 'group' element to 'svg'
      // moves the 'group' element to the top left margin
      var chart1 = d3.select("#bezoekersgrafiek").append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
        .append("g")
          .attr("transform",
                "translate(" + margin.left + "," + margin.top + ")");

      // Get the data
      d3.json("/wp-content/plugins/morres-marketing-tool/upload/linkedin_1.json", function(error, data) {
        if (error) throw error;

        // format the data
        data.forEach(function(d) {
            d.Date = parseTime(d.Date);
            d["Total page views (total)"] = +d["Total page views (total)"];
            d["Total unique visitors (total)"] = +d["Total unique visitors (total)"];
            //console.log(d["Total page views (total)"]);
        });

        

        // Scale the range of the data
        x.domain(d3.extent(data, function(d) { return d.Date; }));
        y.domain([0, d3.max(data, function(d) { return Math.max(d["Total page views (total)"], d["Total unique visitors (total)"]); })]);

        // Add the valueline path.
        chart1.append("path")
            .data([data])
            .attr("class", "line")
            .attr("d", valueline3);

        // Add the second valueline path.
          chart1.append("path")
            .data([data])
            .attr("class", "line")
            .style("stroke", "red")
            .attr("d", valueline4);    

        // Add the X Axis
        chart1.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x)
                    .tickFormat(d3.timeFormat("%Y-%m-%d")))
            .selectAll("text")  
              .style("text-anchor", "end")
              .attr("dx", "-.8em")
              .attr("dy", ".15em")
              .attr("transform", "rotate(-65)");

        // Add the Y Axis
        chart1.append("g")
            .attr("class", "axis")
            .call(d3.axisLeft(y));

            
        chart1.append("text")
          .attr("x", (width / 2))             
          .attr("y", 0 - (margin.top / 7))
          .attr("text-anchor", "middle")  
          .style("font-size", "16px")
          .style("font-family", "Mont-semibold") 
          .text("Totale pagina views vs Unieke bezoekers");   

      });
  </script>


  <script>

    $( document ).ready(function() {
    $.getJSON("/wp-content/plugins/morres-marketing-tool/upload/linkedin_2.json", function(data){ 
      dataPlain = JSON.stringify(data);
      dataPlain = dataPlain.replace(/Update title/g,'Updatetitle');
      dataPlain = dataPlain.replace(/Created date/g,'Createddate');
      dataPlain = dataPlain.replace(/Video views/g,'Videoviews');
      dataPlain = dataPlain.replace(/Click through rate \(CTR\)/g,'ClickTroughtRate');
      dataPlain = dataPlain.replace(/Engagement rate/g,'EngagementRate');

      data = JSON.parse(dataPlain);
      //console.log(dataPlain);
       var update_engagement = '';
        $.each(data, function(key, value){
          $.each(value, function(key, value){
            
            var procent = 100
            var CTR = value.ClickTroughtRate ;
            var CTRprocent = CTR*procent; 
            var CTRnum = CTRprocent.toFixed(2);

            var EnRate = value.EngagementRate ;
            var EnRateprocent = EnRate*procent; 
            var EnRateNum = EnRateprocent.toFixed(2);  
            var LongTitle = value.Updatetitle;  
            var titel = LongTitle.substring(0,60)

            update_engagement += '<tr>';
            update_engagement += '<td>'+titel+'...</td>';
            update_engagement += '<td>'+value.Createddate+'</td>';
            update_engagement += '<td>'+value.Impressions+'</td>';
            update_engagement += '<td>'+value.Clicks+'</td>';
            update_engagement += '<td>'+CTRnum+'%</td>';
            update_engagement += '<td>'+value.Likes+'</td>';
            update_engagement += '<td>'+value.Comments+'</td>';
            update_engagement += '<td>'+EnRateNum+'%</td>';
            update_engagement += '<td>'+value.Videoviews+'</td>';
            update_engagement += '</tr>';
        });
           }); 
        $('#linkedin_table').append(update_engagement);    
    });
   });
  </script>

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
    function example_append2() {
        $('#linkedin_feedback').append($('#textarea2').val());
    }



    function sluit2() {
      var x = document.getElementById("texttoevoegen2");
      if (x.style.display === "none") {
        x.style.display = "block";

      } else {
        x.style.display = "none";
      }
    }
    
  </script>


</div>
</body>

