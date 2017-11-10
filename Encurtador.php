<?php

// URL to short
$url = "http://seusite.com.br/umenderecoaquideboas";

// generate a new hash to this URL
function genHash($url, $iters)
{
    // map the URL
    $url_path = [];
    $url_parse = parse_url($url);

    // create a array to store the mapped endpoints
    $url_path["host"] = $url_parse["host"];

    // check if array key host exists.
    if (!array_key_exists("host", $url_path)) throw new Exception("The host format is invalid.");

    // get a random hash algorithm
    $hash_algos = hash_algos();
    $hash_rand = array_rand($hash_algos);

    // generate a rand string
    $hash = hash($hash_algos[$hash_rand], $url);
    $hash_aux = str_split($hash, 3);

    // shuffle the array content
    shuffle($hash_aux);

    // aux for the new URL
    $new_url = "";

    // iteration counts
    $iter = 0;

    // get only 3 array elements
    while ($iter <= $iters){

        // get a random value
        $rand = rand(0, count($hash_aux) - 1);

        // adds into the new URL
        if(($rand % 2) == 0) $new_url .= strtoupper($hash_aux[$rand]);
        else $new_url .= $hash_aux[$rand];

        // count iteration
        $iter++;
    }

    return $new_url;
}

// final result
echo("http://uni.so/" . genHash($url, 2));

?>