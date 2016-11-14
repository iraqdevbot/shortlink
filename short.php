<?php
define('API_KEY', '265951062:AAHSzUfmatNYY_HwRGgRgNLwnSc24Jga0VY'); // token here
define('ADMIN', '249010980'); // id here
function iluli($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$CallbackQueryid = $update->id;
$Cfrom =  $update->from->id;
$Cm =  $update->message->message_id;
$Cd = $update->data;
$answerCallbackQuery = $update->callback_query_id;
$answertext = $update->text;
$show_alert = $update->show_alert;
$message = $update->message;
$mid = $message->message_id;
$chat_id = $update->message->chat->id;
$admin = ADMIN;
$id = $message->from->id;
$firstname = $message->from->first_name;
$lastname = $message->from->last_name;
$username = $message->from->username;
$text = $update->message->text;
$from = $update->message->from->id;
  if(preg_match('/^([Hh]ttp|[Hh]ttps)(.*)/',$text)){
    $short = file_get_contents('http://yeo.ir/api.php?url='.urlencode($text));
    $short3 = file_get_contents("http://api.gpmod.ir/shorten/?url=".urlencode($text)."&username=mersad565@gmail.com");
    $short4 = file_get_contents('http://u2s.ir/?api=1&return_text=1&url='.urlencode($text));
    $short5 = file_get_contents("http://llink.ir/yourls-api.php?signature=a13360d6d8&action=shorturl&url=".urlencode($text)."&format=simple");
    $U = "[$firstname](https://telegram.me/$username)" or $firstname;
    iluli('sendChatAction',[
    'chat_id'=>$chat_id,
    'action'=>'typing'
    ]);
    iluli('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"*Hi,* $U  \n\n [Short by yeo.ir]($short) \n\n [Short by gpmod.ir]($short3) \n\n [Short by u2s.ir]($short4) \n\n [Short by llink.ir]($short5)",
      'disable_web_page_preview'=>'true',
      'parse_mode'=>'Markdown',
      'reply_to_message_id'=>$mid,
      'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Short by yeo.ir','url'=>$short]
        ],
        [
          ['text'=>'Short by gpmod.ir','url'=>$short3]
        ],
        [
          ['text'=>'Short by u2s.ir','url'=>$short4]
        ],
        [
          ['text'=>'Short by llink.ir','url'=>$short5]
        ],
	[
          ['text'=>'Channel','url'=>'https://telegram.me/joinchat/CY6yfEB5Mcy6TL5KPKEVcQ']
        ]
      ]
    ])
    ]);
  }
  if(preg_match('/^\/([sS]tart)/',$text)){
     $U = "[$firstname](https://telegram.me/$username)" or $firstname;
    iluli('sendChatAction',[
    'chat_id'=>$chat_id,
    'action'=>'typing'
    ]);
	  iluli('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"Hi, $U 😉👋\nIm Bot Short LInker 😃\nPlease Send Your Link 🙌\n\n[Channel](https://telegram.me/joinchat/CY6yfEB5Mcy6TL5KPKEVcQ)",
      'disable_web_page_preview'=>'true',
      'parse_mode'=>'Markdown',
      'reply_to_message_id'=>$mid,
      'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Channel','url'=>'https://telegram.me/joinchat/CY6yfEB5Mcy6TL5KPKEVcQ']
        ]
      ]
    ])
    ]);
  }
  if(preg_match('/^\/([Ss]tats)/',$text) and $from == $admin){
    $user = file_get_contents('user.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    iluli('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"👤 members : $member_count",
      'disable_web_page_preview'=>'true',
      'parse_mode'=>'Markdown',
      'reply_to_message_id'=>$mid,
    ]);
}
$user = file_get_contents('user.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('user.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('user.txt',$add_user);
    }
	?>
