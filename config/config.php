<?php
//localpc
$servername = "localhost";
$username = "u611569177_cflix";
$password = "n3wd3vc4mp";
$database = "u611569177_cflix";
 
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