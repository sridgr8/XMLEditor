<?php

$xmlFile = simplexml_load_file("xmlFiles/damFiles/damXML.xml");

// foreach ($data as $userList){
//     echo $userList->username."<br>";
// }
$headerList=array();
echo "<div id='loadForm'>";
echo "<table class='table table-striped' id='loadXML'>";
      $table= "<tr>";
    foreach ($xmlFile->user->children() as $child)
    {
    
      $table = $table . "<th>".$child->getName()."</th>";
      array_push($headerList, $child->getName());
  }
$table=$table . "</th>";

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
echo $table;
echo "</table>";
echo "</div>";



?>
