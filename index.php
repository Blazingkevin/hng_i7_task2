<?php
// $store=["kevin"];
// exec("node index.js", $store);
// print_r($store);

// get al files from scirpts folder
$scripts_init = scandir("scripts/");
$scripts = array_splice($scripts_init, 2); // the forst two index contain "." and ".." which is not needed
$out = [];

//loop through all files in directory and run based on file extension
// print_r($scripts);
foreach($scripts as $script){
    // check extension of the script and run appropriately 
    // switch(pathinfo())
    $matches = [];
    $script_location ="scripts/".$script;
    $temp_value="";
    switch(pathinfo($script)['extension']){
        case 'py':
             $temp_value = exec("python ".$script_location);
        break; 
        case 'js':
            $temp_value = exec("node ".$script_location, $output);
        break;
    }
    // get an array of detail for a user using regular expression 
    preg_match_all("/\[(.*?)\]/", $temp_value, $matches);
    $intern = new stdClass();
    $intern->name = $matches[0][0]; 
    $intern->id = $matches[0][1] ; 
    $intern->language = $matches[0][2] ; 
    array_push($out, $intern);
    // print_r($intern);
    // array_push($output, $intern);

}

echo json_encode($out);
// print_r($output);

// if ($_SERVER['QUERY_STRING'] == "json") {
//     //  return output in json format
//     echo json_encode($output);
// }

