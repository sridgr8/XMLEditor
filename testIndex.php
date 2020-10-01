<!DOCTYPE html>
<head>
    <title>XML Data Experiment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>


    <div class="container">
      <h2>XML Data Viewer</h2>
      <table class="table table-borderless table-dark table-striped table-hover table-responsive-lg">
        <tr><td><h6>DAM Project</h6></td><td><button type="button" onclick="loadHTMLForm()" class="btn btn-outline-info">Add New Row</button></td>
        <?php
            $out = array();
            foreach (glob('xmlFiles/damFiles/*.xml') as $filename) {
                $p = pathinfo($filename);
                $out[] = $p['filename'];
            }
            $fileCount=sizeof($out);
            while($fileCount>0){
                ?>
            <td><button type="button" onclick="loadXMLDoc('<?php echo $out[$fileCount-1]; ?>')" class="btn btn-outline-success"><?php echo $out[$fileCount-1]; ?></button></td>
                <?php
            $fileCount = $fileCount - 1;
            }
        
        ?>
</tr>
<tr><td><h6>EComm Project</h6></td><td><button type="button" onclick="loadHTMLForm()" class="btn btn-outline-info">Add New Row</button></td>
        <?php
            $out = array();
            foreach (glob('xmlFiles/ecommFiles/*.xml') as $filename) {
                $p = pathinfo($filename);
                $out[] = $p['filename'];
            }
            $fileCount=sizeof($out);
            while($fileCount>0){
                ?>
            <td><button type="button" onclick="loadXMLDoc('<?php echo $out[$fileCount-1]; ?>')" class="btn btn-outline-success"><?php echo $out[$fileCount-1]; ?></button></td>
                <?php
            $fileCount = $fileCount - 1;
            }
        
        ?>
</tr>
</table>

      <br><br>

      <div id="loadForm"></div>
      <table class="table table-striped" id="loadXML"></table>
    </div>

    <script>
      function loadXMLDoc(xmlFile) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
          }
        };
        var xmlFilePath="xmlFiles/damFiles/";
        xmlFilePath=xmlFilePath.concat(xmlFile,".xml");
        xmlhttp.open("GET", xmlFilePath, true);
        xmlhttp.send();
      }
      function myFunction(xml) {
        var i;
        var xmlDoc = xml.responseXML;
        var table="<tr><th>Username</th><th>Password</th><th>First Name</th><th>Last Name</th><th></th><th></th></tr>";
        var x = xmlDoc.getElementsByTagName("user");
        for (i = 0; i <x.length; i++) { 
          table += "<tr><td>" +
          x[i].getElementsByTagName("username")[0].childNodes[0].nodeValue +
          "</td><td>" +
          x[i].getElementsByTagName("password")[0].childNodes[0].nodeValue +
          "</td><td>" +
          x[i].getElementsByTagName("firstname")[0].childNodes[0].nodeValue +
          "</td><td>" +
          x[i].getElementsByTagName("lastname")[0].childNodes[0].nodeValue +
          "</td>" + 
          "<td><button type=\"button\" class=\"btn btn-outline-warning\">Edit</button></td>" + 
          "<td><button type=\"button\" class=\"btn btn-outline-danger\">Delete</button></td></tr>";
        }
        document.getElementById("loadXML").innerHTML = table;
    }
    function loadHTMLForm(){
        var txtForm="<form action=\"writeToXML.php\" method=\"post\"><table class=\"table\">" +
        "<tr><td>Username: </td><td><input type=\"text\" name=\"username\"></td></tr>" +
        "<tr><td>Password: </td><td><input type=\"text\" name=\"password\"></td></tr>" +
        "<tr><td>First Name: </td><td><input type=\"text\" name=\"firstname\"></td></tr>" +
        "<tr><td>Last Name: </td><td>   <input type=\"text\" name=\"lastname\"></td></tr>" +
        "<tr><td align=\"center\"><input type=\"submit\" name=\"ok\" value=\"Add New XML Data\" class=\"btn btn-outline-primary\"/></td></tr>" +
        "</form><br>";
        document.getElementById("loadForm").innerHTML = txtForm;
      }
      </script>
  </body>
</html>
