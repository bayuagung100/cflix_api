<?php
//server
// $servername = "localhost";
// $username = "u611569177_cflix";
// $password = "n3wd3vc4mp";
// $database = "u611569177_cflix";

//server
$servername = "185.224.137.172";
$username = "u611569177_cflix";
$password = "n3wd3vc4mp";
$database = "u611569177_cflix";

//localpc
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "cflix";
 
// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

function convert_seo($kata) {
    $simbol = array ('/','\\',',','.','#',':',';','\',','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	
	//Menghilangkan simbol pada array $simbol
    $kata = str_replace($simbol, '', $kata); 
	//Ubah ke huruf kecil dan mengganti spasi dengan (-)
    $kata = strtolower(str_replace(' ', '-', $kata)); 
    
	return $kata;
}
?>