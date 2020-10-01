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

  <?php
  function loadXMLDoc1($xml){
    global $table1;
    $xmlFile = simplexml_load_file("xmlFiles/damFiles/".$xml.".xml");
    
    $headerList=array();
    $table1= "<table class='table table-striped' id='loadDAMXML'><tr>";
    foreach ($xmlFile->user->children() as $child)
    {
    
    $table1 = $table1 . "<th>".$child->getName()."</th>";
    array_push($headerList, $child->getName());
    }
    $table1=$table1 . "</tr>";
    
    foreach ($xmlFile->user as $childUser)
    {
    $table1=$table1."<tr>";
    foreach($headerList as $itemList){
    
    foreach ($childUser->$itemList as $child)
    {
    $table1=$table1."<td>". $child."</td>";
    }
    
    }
    $table1=$table1."</tr>";
    
    }
    $table1=$table1."</table>";
     
    }

    function loadXMLDoc2($xml){
      global $table;
      $xmlFile = simplexml_load_file("xmlFiles/ecommFiles/".$xml.".xml");
      
      $headerList=array();
      $table= "<table class='table table-striped' id='loadECommXML'><tr>";
      foreach ($xmlFile->user->children() as $child)
      {
      
      $table = $table . "<th>".$child->getName()."</th>";
      array_push($headerList, $child->getName());
      }
      $table=$table . "</tr>";
      
      foreach ($xmlFile->user as $childUser)
      {
      $table=$table."<tr>";
      foreach($headerList as $itemList){
      
      foreach ($childUser->$itemList as $child)
      {
      $table=$table."<td>". $child."</td>";
      }
      
      }
      $table=$table."</tr>";
      
      }
      $table=$table."</table>";
          
      }

      function loadFinalXML(){
        global $table1;
        echo $table1;
        $table1="";
      }

  ?>
    <div class="container">
      <h2>XML Data Viewer</h2>
      <table class="table table-borderless table-dark table-striped table-hover table-responsive-lg">
        <tr><td><h6>DAM Project</h6></td><td><button type="button" onclick="loadHTMLForm()" class="btn btn-outline-info">Add New Row</button></td>
        
        
        
        <?php
        
            $out1 = array();
            foreach (glob('xmlFiles/damFiles/*.xml') as $filename1) {
                $p1 = pathinfo($filename1);
                $out1[] = $p1['filename'];
            }
            $fileCount1=sizeof($out1);
            while($fileCount1>0){
                ?>
            <td><button type="button" class="btn btn-outline-success" onclick="<?php loadXMLDoc1($out1[$fileCount1-1]); ?> loadDataDiv();">
            <?php echo $out1[$fileCount1-1]; ?></button></td>
                <?php
            $fileCount1 = $fileCount1 - 1;
            }
        
        ?>
</tr>
<tr><td><h6>EComm Project</h6></td><td><button type="button" onclick="loadHTMLForm()" class="btn btn-outline-info">Add New Row</button></td>
        <?php
            $out2 = array();
            foreach (glob('xmlFiles/ecommFiles/*.xml') as $filename2) {
                $p2 = pathinfo($filename2);
                $out2[] = $p2['filename'];
            }
            $fileCount2=sizeof($out2);
            while($fileCount2>0){
                ?>
            <td><button type="button" class="btn btn-outline-success" onclick="<?php loadXMLDoc2($out2[$fileCount2-1]); ?> loadDataDiv();"><?php echo $out2[$fileCount2-1]; ?></button></td>
                <?php
            $fileCount2 = $fileCount2 - 1;
            }
            
        ?>
</tr>
</table>

      <br><br>

      <div id="loadForm"></div>
      <div id="loadData"></div>
      <script>
    

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

      function loadDataDiv(){
        document.getElementById("loadData").innerHTML = "";
        document.getElementById("loadData").innerHTML = "<?php loadFinalXML();?>";
      }

      </script>
  </body>
</html>
