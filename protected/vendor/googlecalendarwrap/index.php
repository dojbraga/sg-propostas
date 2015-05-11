<?
/*
  MyCurl example
  Author: Skakunov Alex (i1t2b3@gmail.com)
  Date: 26.11.06
  Description: goes to http://a4.users.phpclasses.org/ and parses for header info
*/

include "MyCurl.php"; //class file is required

$mc = new MyCurl(); //create an instance
$mc->getHeaders = false;
$mc->getContent = true;

$contents = $mc->get("http://a4.users.phpclasses.org/"); //get all data from this URL

echo $mc->get_parsed($contents, "<h1>", "</h1>"); //grab header text (it's just an example. This method is useful to get necessary info from

?> 