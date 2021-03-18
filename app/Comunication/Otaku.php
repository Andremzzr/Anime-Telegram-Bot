<?php 

namespace App\Comunication;

class Otaku
{

    /**
     * Get top 10 upcomming animes
     *
     * @return array
     */
    public static function getTopTen()
    {

        $curl = curl_init();

        curl_setopt_array(
            $curl, [
            CURLOPT_URL => "https://jikan1.p.rapidapi.com/top/anime/1/upcoming",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: jikan1.p.rapidapi.com",
<<<<<<< HEAD
            "x-rapidapi-key: ".$_ENV['TOKEN_RAPID']
=======
            "x-rapidapi-key: ".$_ENV['RAPID_TOKEN']
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
            ],
            ]
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error // :" . $err;
        } else {

    
            $response = (array) $response;
            $response = (array) $response[0];
            $response = (array) $response[0];

    
    
            $response = json_decode($response[0], true);

            $final_array = [];

            

            $count = 0;
            
            foreach ($response['top'] as $value) {
                if ($count <= 10) {
                    $final_array[] = [
                        "title" => $value['title'],
                        "url" => $value['url'],
                        "start_date" => $value['start_date'],
                        "img" => $value['image_url']
                        ];
                        $count++;
                }
                   
                
            }
            
            

            return $final_array;
        }

    }

    /**
     * Send infos by certain anime
     *
     * @param  string $anime_name
     * @return array
     */
    public static function infoAnime(string $anime_name)
    {
        
        $curl = curl_init();

        $anime = str_replace(' ', '%20', $anime_name);

        curl_setopt_array(
            $curl, [
            CURLOPT_URL => "https://jikan1.p.rapidapi.com/search/anime?q=".$anime,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: jikan1.p.rapidapi.com",
<<<<<<< HEAD
            "x-rapidapi-key: ".$_ENV['TOKEN_RAPID']
=======
            "x-rapidapi-key: ".$_ENV['RAPID_TOKEN']
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
            ],
            ]
        );






        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = (array) $response;
    
    

            $response = json_decode($response[0], true);
    
    
    
            $lista_info = [];
            $count = 0;
            foreach ($response['results'] as $key_info => $array_info) {
                if($count <= 8) {
                    if ($array_info['title'] != "Special" or $array_info['title'] != "OVA" or $array_info['score'] != 0 ) {
                        $lista_info[] = [
                                "title" => $array_info['title'],
                                "image_url" => $array_info['image_url'],
                                "airing" => $array_info['airing'],
                                "score" => $array_info['score'],
<<<<<<< HEAD
                                "synopsis" => $array_info['synopsis'],
                                "id" => $array_info['mal_id']
=======
                                "synopsis" => $array_info['synopsis']
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
                        ];
                        $count++;
                    }
        
                }
        
            }

           
        }

        return $lista_info;
    }


<<<<<<< HEAD
    /**
     * Get last episode from the anime id 
     *
     * @param  integer $id
     * @return array
     */
    public static function getLastEpisode(int $id)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl, [
            CURLOPT_URL => "https://jikan1.p.rapidapi.com/anime/".$id."/episodes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: jikan1.p.rapidapi.com",
            "x-rapidapi-key: ".$_ENV['TOKEN_RAPID']
            ],
            ]
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = (array) $response;
            $response = json_decode($response[0], true);


            $last_episode = end($response['episodes']);

            return $last_episode;

        }
    }
}
=======

}
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
