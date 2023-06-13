<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram{
    public function snedMessage($chat_id,$message){
        Http::post('https://api.telegram.org/bot5570623803:AAEhWWYH7SYQ3iQRjaEpGrh4OLvHf4JOloc/sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$message,
            'parse_mode'=>'HTML'
        ]);
    }
}
