<?php
/* javascript this pairs with:

        var localjson = getJSON();
        var url = "savejson.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("json=" + document.getElementById("textIO0630").value);//send json

*/

   $str = $_POST["json"]; //get json data from index.html
   $filename = "json".time().".txt";  //make a filename from the UNIX time(this trivially makes sure filename is unique)
   $file = fopen("svg/".$filename,"w");// create new file with this name
   fwrite($file,$str); //write json data to file
   fclose($file);  //close file

   $file = fopen("jsonfeed.txt","r"); //open the jsonfeed.txt file which contains a list of all json txt files in /svg/ directory
   $olddata = fread($file,filesize("jsonfeed.txt")); //read contents of existing file list
   fclose($file);//close the file because computers are insane
   $file = fopen("jsonfeed.txt","w");   //re-open file, I have no idea why this fixed a mysterious bug
   $str = $olddata."\n".$filename;//append a "newline" to string representing contents of feed.txt file ,then append new filename
   fwrite($file,$str);//write string to file
   fclose($file);//close file

?>