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

    public static function sendTopAnimes(array $array, $id )
    {   
        $bot = new BotApi($_ENV['TELEGRAM_BOT_TOKEN']);
        
        $final_message = '';
        $message = '=== TOP 10 ANIMES UPCOMMING === ';
       


        $bot->sendMessage($id, $message);
        $bot->sendMessage($id, "==================");
        sleep(3.5);
        foreach ($array as $value) {
            if ($value['start_date'] == null) {
                $value['start_date'] = "Upcomming";
            }
            $final_message =  "TITLE: ".$value['title'].". START DATE: ".$value['start_date'].". URL: ".$value['url'];
            //SENDING THE MESSAGE
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "==================");
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
        $bot->sendMessage($id, "==================");
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

            $final_message = "Title: ".$value['title'].PHP_EOL."Synopsis: ".$value['synopsis'].PHP_EOL."Score: ".$value['score'].PHP_EOL."Status: ".$value['airing'];  
            $bot->sendMessage($id, $final_message);
            $bot->sendMessage($id, "==================");
            sleep(3.75);
                              
        }
        


    }



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
            "/getinfo","/show10"
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
                        if ($last_message == '/show10') {
                            Call::sendMessage('Wait a second... Send me anything to continue', $lista['message']['chat']['id']);
                            
                            $next_id_message =$last_id_message +1;
                            $key_message = $last_message;
                            continue;
                        }
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
                            }
                            
                               
                                
                                
                                

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