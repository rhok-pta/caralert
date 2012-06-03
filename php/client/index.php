<?php

?>
<!DOCTYPE html>
<html lang="en" manifest="offline.manifest">
<head>
	<meta charset="utf-8">
   	<title>Car Alert</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="script/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="script/lawnchair/Lawnchair.js" type="text/javascript"></script>
        <script src="script/lawnchair/adapters/webkit-sqlite.js"></script>
        <script src="script/lawnchair/adapters/dom.js"></script>
        <script src="script/caralert.js" type="text/javascript"></script>
        <script src="script/caralert.unit.js" type="text/javascript"></script>

        <script type="text/javascript">
            function refresh(){
                function doSuccess(count){
                   alert("Downloaded "+count+" record(s)")
                }
                function doFail(error){
                    alert("Could not update - failed with:"+error)
                }
                if (navigator.onLine) {
                    CA.getDocument('http://localhost/caralertphp/index.php?q=list_incident',doSuccess, doFail)
                } else {
                    alert("Not online");
                }
            }


            function doSearch(searchStr){
                var div = document.getElementById("result")

                if(searchStr.length>0){
                    CA.find(searchStr, writeResults) 
                    
                    function writeResults(result){
                        var s = "<table class='table table-bordered table-striped' >"
                            s +="<thead>"
                            s +="  <tr>"
                            s +="    <th>License Plate</th>"
                            s +="    <th>Make/model</th>"
                            s +="    <th>Description</th>"
                            s +="    <th>Date</th>"
                            s +="  </tr>"
                            s +="</thead>"
                            s +="<tbody>"

                        for(var i=0; i< result.length; i++) {
                            s += "<tr><td>"+result[i].CarRegNo+"</td><td>"+result[i].CarMakeModel+"</td><td>"+result[i].IncDesc+"</td><td>"+result[i].IncDate+"</td></tr>"
                        }
                        s += "</tbody></table>"
                        div.innerHTML = s
                   }
               } else {
                   div.innerHTML = "<i>Enter text to search</i>"
               }
            }
           $(document).ready(function() { doSearch("")});
        </script>

        <link href="css/bootstrap.css" rel="stylesheet">

        <style type="text/css">
          body {
          padding-top: 60px;
          padding-bottom: 40px;
          }
        </style>

        <link href="css/bootstrap-responsive.css" rel="stylesheet">

</head>

<body>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="#">Car Alert</a>
          <ul class="nav">
            <li><a href="javascript:refresh()">Refresh</a></li>
          </ul>
      </div>
    </div>
  </div>
  
<div class="container">

  <div class="hero-unit">
    <h2>Use Car Alert!</h2>
    <!-- <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p> -->
    <input id="searchText" onkeyup="javascript:doSearch(this.value);" class="span11"/>
	<div id="result"></div>


  </div>

</div>


</body>
</html>
