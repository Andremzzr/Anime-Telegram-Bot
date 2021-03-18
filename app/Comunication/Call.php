<?php

namespace App\Comunication;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use App\Comunication\Otaku;



class Call
{
    
    
    /**
     * Send a Message to telegram's chat
     *
     * @param  string $message
     * @return void
     */
    public static function sendMessage($message,$id)
    {

        $bot = new BotApi($_ENV['TELEGRAM_BOT_TOKEN']);
        //SENDING THE MESSAGE
        $bot->sendMessage($id, $message);
    }

<<<<<<< HEAD
    /**
     * Send top animes that will be release
     *
     * @param  array $array
     * @param  int   $id
     * @return void
     */
    public static function sendTopAnimes(array $array, int $id )
=======
    public static function sendTopAnimes(array $array, $id )
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
    {   
        $bot = new BotApi($_ENV['TELEGRAM_BOT_TOKEN']);
        
        $final_message = '';
        $message = '=== TOP 10 ANIMES UPCOMMING === ';
       


        $bot->sendMessage($id, $message);
<<<<<<< HEAD
        $bot->sendMessage($id, "========================");
=======
        $bot->sendMessage($id, "==================");
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
        sleep(3.5);
        foreach ($array as $value) {
            if ($value['start_date'] == null) {
                $value['start_date'] = "Upcomming";
            }
<<<<<<< HEAD
            $final_message =  "TITLE: ".$value['title'].PHP_EOL."START DATE: ".$value['start_date'].PHP_EOL."URL: ".$value['url'];
            //SENDING THE MESSAGE
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "========================");
=======
            $final_message =  "TITLE: ".$value['title'].". START DATE: ".$value['start_date'].". URL: ".$value['url'];
            //SENDING THE MESSAGE
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "==================");
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
            sleep(2);
        }
        
    }

    /**
     * Send anime infos
     *
     * @param array $anime
     * 
     * @return void
     */
    public static function sendInfoAnime(array $anime, int $id)
    {
        $bot = new BotApi($_ENV['TELEGRAM_BOT_TOKEN']);

        $final_message = '';
        $message = '=== THE RESULT WHEN YOU SEARCH THIS === ';

        $bot->sendMessage($id, $message);
<<<<<<< HEAD
        $bot->sendMessage($id, "========================");
=======
        $bot->sendMessage($id, "==================");
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
        sleep(3.5);

        foreach ($anime as $value) {
            if ($value['airing'] == false ) {
                $value['airing'] = "Ended";
            }
            else
            {
                $value['airing'] = "Releasing Episodes";
            }

            $media_array = new \TelegramBot\Api\Types\InputMedia\ArrayOfInputMedia();
            $media = new \TelegramBot\Api\Types\InputMedia\InputMediaPhoto($value['image_url']);
            $media_array->addItem($media);
            $bot->sendMediaGroup($id, $media_array);

<<<<<<< HEAD
            $final_message = "Title: ".$value['title'].PHP_EOL."Id for seach: ".$value['id'].PHP_EOL."Synopsis: ".$value['synopsis'].PHP_EOL."Score: ".$value['score'].PHP_EOL."Status: ".$value['airing'];  
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "========================");
=======
            $final_message = "Title: ".$value['title'].PHP_EOL."Synopsis: ".$value['synopsis'].PHP_EOL."Score: ".$value['score'].PHP_EOL."Status: ".$value['airing'];  
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "==================");
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
            sleep(3.75);
                              
        }
        


    }

<<<<<<< HEAD
    /**
     * Get and set last episode message
     *
     * @param  array   $array
     * @param  integer $id
     * @return void
     */
    public static function getLastEpisode(array $array,int $id)
    {
        $bot = new BotApi($_ENV['TELEGRAM_BOT_TOKEN']);

        $bot->sendMessage($id, "== Last Episode Infos ==");
        $last_episode_date =  substr($array['aired'], 0, 10);
        sleep(2);
        $final_message ='Title: '.$array['title']."- ".$array['title_japanese'].PHP_EOL."Number: ".$array['episode_id'].PHP_EOL."Aired: ".$last_episode_date;
        $bot->sendMessage($id, $final_message);

    }


    /**
     * Get last message from the telegram's chat and activate the commands 
     *
     * @return void
     */
=======


>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
    public static function getLastMessage()
    {
        /**
        * Id da mensagem a ser lida
        */
        $next_id_message = 0;
        /**
         * Id da ultima mensagem 
         */
        $last_id_message = 0;
        /**
         * String ta ultima mensagem
         */
        $last_message = '';

        $key_message = false;

        $array_comandos = [
<<<<<<< HEAD
            "/getinfo","/show10","/lastep"
=======
            "/getinfo","/show10"
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
        ];

        while (true) {
            $website = "http://api.telegram.org/bot".$_ENV['TELEGRAM_BOT_TOKEN']."/getUpdates";
            $update = file_get_contents($website);
            $update=json_decode($update, true);

            foreach ($update['result'] as $key => $lista) {
                $lista_arrays = $update['result'];
        
                //LAST ARRAY IN JSON
                if (end($lista_arrays) == $lista) {
            
                    $last_id_message = $lista['update_id'];
                    
                    if ($next_id_message == 0) {
                        $next_id_message = $last_id_message;
                    }
                    
                    if ($next_id_message == $last_id_message ) {
               
                        $last_message = $lista['message']['text'];
                        if (!in_array($last_message, $array_comandos) and $key_message == false) {
                            $next_id_message =$last_id_message +1;
                            continue;
                        }


                        //ativar o comando /city
                        if ($last_message == '/getinfo') {
                            Call::sendMessage('Tell me your Anime:', $lista['message']['chat']['id']);
                            
                            $next_id_message =$last_id_message +1;
                            $key_message = $last_message;
                            continue;
                        }
<<<<<<< HEAD
                        elseif ($last_message == '/show10') {
=======
                        if ($last_message == '/show10') {
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
                            Call::sendMessage('Wait a second... Send me anything to continue', $lista['message']['chat']['id']);
                            
                            $next_id_message =$last_id_message +1;
                            $key_message = $last_message;
                            continue;
                        }
<<<<<<< HEAD
                        elseif ($last_message == '/lastep') {
                            Call::sendMessage('Tell me the anime id (needs to be a number)', $lista['message']['chat']['id']);
                            $next_id_message =$last_id_message +1;
                            $key_message = $last_message;
                            continue;
                        }

=======
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
                        if (in_array($key_message, $array_comandos)) {
                            switch ($key_message) {
                            case '/getinfo':
                                
                                Call::sendInfoAnime(Otaku::infoAnime($lista['message']['text']), $lista['message']['chat']['id']);
                                
                                $next_id_message =$last_id_message +1;
                                $key_message = false;
                                echo "Enviado".PHP_EOL;
                                echo "=======".PHP_EOL;
                                break;
                                
                            case '/show10':

                                Call::sendTopAnimes(Otaku::getTopTen(), $lista['message']['chat']['id']);
                                
                                $next_id_message =$last_id_message +1;
                                $key_message = false;
                                echo "Enviado".PHP_EOL;
                                echo "=======".PHP_EOL;
                                break;
<<<<<<< HEAD
                            
                            case '/lastep':

                                Call::getLastEpisode(Otaku::getLastEpisode($lista['message']['text']), $lista['message']['chat']['id']);
                                
                                $next_id_message =$last_id_message +1;
                                $key_message = false;
                                echo "Enviado".PHP_EOL;
                                echo "=======".PHP_EOL;
                                break;
                                
                            }
=======
                            }
                            
                               
                                
                                
>>>>>>> b5c3a2f1a7fd0b0d152323d15abdb8c06033807e
                                

                        }
                        
           
                    }
                    else 
                    {
               
                        $last_message = $lista['message']['text'];
                        echo "Next Id: ".$next_id_message.PHP_EOL;
                        echo 'Current Update Id: '.$lista['update_id'].PHP_EOL;
                        echo $last_message."->";
                        echo "Nao enviado".PHP_EOL;
                        echo "=======".PHP_EOL;
                    }
                }
        
     
            }
            sleep(10);
        }
    }

}