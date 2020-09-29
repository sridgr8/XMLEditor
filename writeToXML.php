<?php
if(isset($_REQUEST['ok'])){
  $xml = new DOMDocument("1..0","UTF-8");
  $xml->load("xmlFiles/damFiles/damXML.xml");
  $rootTag = $xml->getElementsByTagName("accounts")->item(0);
  $dataTag = $xml->createElement("user");
  $usernameTag = $xml->createElement("username",$_REQUEST['username']);
  $passwordTag = $xml->createElement("password",$_REQUEST['password']);
  $firstnameTag = $xml->createElement("firstname",$_REQUEST['firstname']);
  $lastnameTag = $xml->createElement("lastname",$_REQUEST['lastname']);
  $dataTag->appendChild($usernameTag);
  $dataTag->appendChild($passwordTag);
  $dataTag->appendChild($firstnameTag);
  $dataTag->appendChild($lastnameTag);
  $rootTag->appendChild($dataTag);
  $xml->save("xmlFiles/damFiles/damXML.xml");
  header("Location: testIndex.php");
}
?>
