<?php

$curl = curl_init();

curl_setopt_array(
    $curl, [
<<<<<<< HEAD
    CURLOPT_URL => "https://jikan1.p.rapidapi.com/top/manga/1/upcoming",
=======
    CURLOPT_URL => "https://jikan1.p.rapidapi.com/search/anime?q=One%20Piece",
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: jikan1.p.rapidapi.com",
        "x-rapidapi-key: b40354067cmsh5b68cf2b90a00dfp1987bajsn7598a33a65c0"
    ],
    ]
);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
<<<<<<< HEAD
    
    echo $response;
}


=======
    echo $response;
}
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
