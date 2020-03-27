<?php error_reporting(0);
ob_start();
// 123456789:MSX15Awesome => بجای این قسمت، توکن ربات خود  را قرار دهید.
define('API_KEY','123456789:MSX15Awesome');
// Use Bot Manual Methods //
function bot($method,$datas=[]){
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
// Config //
// درون ارایه زیر، شناسه عددی مدیریت را وارد کنید.
$Dev = array("847144455","712126566");
// ********************************************************************************************************** //
// نام کاربری ربات بدون @
$usernamebot = "RedChatRobot";
// ********************************************************************************************************** //
// نام کاربری کانال بدون @
$channel = "MSXtm";
// ********************************************************************************************************** //
// نام کاربری پشتیبان بدون @
$poshtibani = "MSXadmin";
// ********************************************************************************************************** //
// نام کاربری پشتیبانی برای افراد ریپورت (ترجیحا ربات پیامرسان)
$botsupport = "MahdyMirzadeBot";
// ********************************************************************************************************** //
// آدرس درگاه شما، همچنین در صورت نداشتن درگاه میتونید مثل ما آیدی پشتیبان رو بزارید تا دستی فرآیند خرید صورت گیرد.
$meinipa = "https://t.me/MahdyMirzade"; 
// Variables //
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$bot = $message->text;

@$firstname = $update->callback_query->from->first_name;
@$usernames = $update->callback_query->from->username;
@$chatid = $update->callback_query->message->chat->id;
@$fromid = $update->callback_query->from->id;
@$membercall = $update->callback_query->id;

@$forward_from_chat = $update->message->forward_from_chat;
@$from_chat_id = $forward_from_chat->id;
@$data = $update->callback_query->data;
@$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
@$gpname = $update->callback_query->message->chat->title;
@$namegroup = $update->message->chat->title;
@$forward_from = $update->message->forward_from;
@$forward_from_id = $forward_from->id;
@$forward_from_username = $forward_from->username;
@$reply = $update->message->reply_to_message->forward_from->id;

$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
@$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
@$tchq = $forchannelq->result->status;

@$select = file_get_contents("data/$from_id/select.txt");
@$chat = file_get_contents("data/$from_id/chat.txt");
@$member = file_get_contents('data/chat.txt');
@$nashnas = file_get_contents("data/$from_id/nashnas.txt");
@$nashnas2 = file_get_contents("data/$fromid/nashnas.txt");
@$jenstyat = file_get_contents("data/$from_id/jenstyat.txt");
@$age = file_get_contents("data/$from_id/age.txt");
@$city = file_get_contents("data/$from_id/city.txt");
@$adds = file_get_contents("data/$from_id/member.txt");
@$adds2 = file_get_contents("data/$fromid/member.txt");
@$numchat = file_get_contents("data/$from_id/numchat.txt");
@$step = file_get_contents("data/$from_id/file.txt");
@$vip = file_get_contents("data/$from_id/vip.txt");
@$editinfo = file_get_contents("data/$from_id/edit.txt");
@$name = file_get_contents("data/$from_id/name.txt");
@$blocklist = file_get_contents('data/blocklist.txt');
@$like = file_get_contents("data/$from_id/like.txt");
@$deslike = file_get_contents("data/$from_id/deslike.txt");
@$blacklist = file_get_contents("data/$from_id/blacklist.txt");
@$frinds = file_get_contents("data/$from_id/frinds.txt");
@$vipbutton = file_get_contents("data/$from_id/vipbutton.txt");
@$vipbutton2 = file_get_contents("data/$from_id/vipbutton2.txt");
$token = API_KEY; // Don't Change This
// Functions //
function SendMessage($chat_id, $text){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
 function Forward($berekoja,$azchejaei,$kodompayam)
{
bot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function  getUserProfilePhotos($token,$from_id) {
  $url = 'https://api.telegram.org/bot'.$token.'/getUserProfilePhotos?user_id='.$from_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
// Create User's Data //
@mkdir("data/$from_id");
@$user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
     $add_user = file_get_contents('Member.txt');
     $add_user .= $chat_id."\n";
     file_put_contents('Member.txt',$add_user);
    }
// Source Code //
if(strpos($blocklist, "$from_id") !== false  ) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"با توجه به نقض قوانین، مسدود شده اید. از ارسال مجدد پیام خودداری کنید.",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
    		]);
}else{
if ( strpos($bot , '/start ') !== false  ) {
$start = str_replace("/start ","",$bot);
if($start == $from_id ) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما قبلا عضو ربات بوده اید، نمیتوانید اکنون دعوت کسی را بپذیرید.",
    		]);
}
else 
{
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
if ($start > 0){
file_put_contents("data/$from_id/numchat.txt","5");
file_put_contents("data/$from_id/member.txt","0");
file_put_contents("data/$from_id/like.txt","0");
file_put_contents("data/$from_id/deslike.txt","0");
file_put_contents("data/$from_id/keyboard.txt","false");
$adds1 = file_get_contents("data/$start/member.txt");
$newmember = $adds1 +1;
file_put_contents("data/$start/member.txt","$newmember");
$adds2 = file_get_contents("data/$start/member.txt");
file_put_contents("data/$chat_id/select.txt","jensiyat");
file_put_contents("data/$from_id/vipbutton.txt","کاربری ویژه");
file_put_contents("data/$from_id/warn.txt","0");
	bot('sendmessage',[
	'chat_id'=>$start,
	'text'=>"کاربر جدیدی با دعوت شما عضو شد. زیرمجموعه های شما: $adds2",
    		]);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام کاربر گرامی، به ربات دوست یابی خوش آمدی...
	
با این ربات:
بصورت ناشناس دوست پیدا کنی
یا یه دوست هم استانی پیدا کنی
و یا با استفاده از مکان یابی هم صحبت بشی

برای ادامه کار، باید جنسیت خودتو تایین کنی.«نکته مهم، تغییر جنسیت به هیچ وجه ممکن نیست.»

🤖 @$usernamebot",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"دختر هستم"],['text'=>"پسر هستم"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/name.txt","$first_name");
}
else
{
$id = base64_decode($start);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"درخواست گفتگو به شخص ارسال شده است، درصورت تأیید،‌ وصل میشوید.",
    		]);
bot('sendmessage',[
	'chat_id'=>$id,
	'text'=>"درخواست گفتگو جدید از طرف $name برای شما ارسال شده است.
	
از دکمه های زیر استفاده کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"پذیرفتن گفتگو"],['text'=>"نادیده گرفتن"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/chat.txt","chatnashnas");
file_put_contents("data/$id/chat.txt","chatnashnas");
file_put_contents("data/$id/nashnas.txt","$from_id");
file_put_contents("data/$from_id/nashnas.txt","$id");
}
}
else
{
				bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"دوست گرامی، شما در کانال ما عضو نیستید و امکان استفاده از این ربات برای شما فراهم نیست، باید در کانال سازنده عضو بشید تا حمایت خودتون رو به ما نشون بدین و بعد،‌ از کار با ربات لذت ببرید.
	
@$channel

بعد از عضویت، با ارسال دستور /start ربات برای شما فعال می شود.",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"ورود به کانال",'url'=>"https://t.me/$channel"],
	],
		[
	['text'=>"عضو شدم!",'callback_data'=>"lockchannel"],
	],
              ]
        ])
    		]);	
file_put_contents("data/$from_id/inviter.txt","$start");
}
}
}
if($bot=="/start" && $tc == "private"){	
if (strpos($user, "$from_id")!== false) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به صفحه اصلی خوش آمدید، از منوی زیر استفاده کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
else
{
file_put_contents("data/$from_id/numchat.txt","3");
file_put_contents("data/$from_id/member.txt","0");
file_put_contents("data/$from_id/like.txt","0");
file_put_contents("data/$from_id/deslike.txt","0");
file_put_contents("data/$from_id/keyboard.txt","false");
file_put_contents("data/$chat_id/select.txt","jensiyat");
file_put_contents("data/$from_id/vipbutton.txt","کاربری ویژه");
file_put_contents("data/$from_id/warn.txt","0");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام کاربر گرامی، به ربات دوست یابی خوش آمدی...
	
با این ربات:
بصورت ناشناس دوست پیدا کنی
یا یه دوست هم استانی پیدا کنی
و یا با استفاده از مکان یابی هم صحبت بشی

برای ادامه کار، باید جنسیت خودتو تایین کنی.«نکته مهم، تغییر جنسیت به هیچ وجه ممکن نیست.»

🤖 @$usernamebot",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"دختر هستم"],['text'=>"پسر هستم"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/name.txt","$first_name");
}
}
elseif($select == "jensiyat"){
if($bot == "دختر هستم" || $bot == "پسر هستم"){
if($bot=="دختر هستم" && $tc == "private"){
file_put_contents("data/$from_id/jenstyat.txt","دختر");
file_put_contents("data/$from_id/select.txt","age");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما با موفقیت جنسیت خود را مشخص کردید، حال باید سن خودتون رو وارد کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"12"],['text'=>"13"],['text'=>"14"],['text'=>"15"]
				],
								[
				['text'=>"16"],['text'=>"17"],['text'=>"18"],['text'=>"19"]
				],
								[
				['text'=>"20"],['text'=>"21"],['text'=>"22"],['text'=>"23"]
				],
								[
				['text'=>"24"],['text'=>"25"],['text'=>"26"],['text'=>"27"]
				],
								[
				['text'=>"28"],['text'=>"29"],['text'=>"30"],['text'=>"31"]
				],
								[
				['text'=>"32"],['text'=>"33"],['text'=>"34"],['text'=>"35"]
				],
								[
				['text'=>"36"],['text'=>"37"],['text'=>"38"],['text'=>"39"]
				],
								[
				['text'=>"40"],['text'=>"41"],['text'=>"42"],['text'=>"43"]
				],
								[
				['text'=>"44"],['text'=>"45"],['text'=>"46"],['text'=>"47"]
				],
								[
				['text'=>"48"],['text'=>"49"],['text'=>"50"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
elseif($bot=="پسر هستم" && $tc == "private"){
file_put_contents("data/$from_id/jenstyat.txt","پسر");
file_put_contents("data/$from_id/select.txt","age");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما با موفقیت جنسیت خود را مشخص کردید، حال باید سن خودتون رو وارد کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"12"],['text'=>"13"],['text'=>"14"],['text'=>"15"]
				],
								[
				['text'=>"16"],['text'=>"17"],['text'=>"18"],['text'=>"19"]
				],
								[
				['text'=>"20"],['text'=>"21"],['text'=>"22"],['text'=>"23"]
				],
								[
				['text'=>"24"],['text'=>"25"],['text'=>"26"],['text'=>"27"]
				],
								[
				['text'=>"28"],['text'=>"29"],['text'=>"30"],['text'=>"31"]
				],
								[
				['text'=>"32"],['text'=>"33"],['text'=>"34"],['text'=>"35"]
				],
								[
				['text'=>"36"],['text'=>"37"],['text'=>"38"],['text'=>"39"]
				],
								[
				['text'=>"40"],['text'=>"41"],['text'=>"42"],['text'=>"43"]
				],
								[
				['text'=>"44"],['text'=>"45"],['text'=>"46"],['text'=>"47"]
				],
								[
				['text'=>"48"],['text'=>"49"],['text'=>"50"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"فقط میتونی از دکمه های زیر استفاده کنی:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"دختر هستم"],['text'=>"پسر هستم"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
}
elseif($select == "age" && $tc == "private"){
if ($bot <= 50 && $bot >= 12){
file_put_contents("data/$from_id/age.txt","$bot");
file_put_contents("data/$from_id/select.txt","city");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما با موفقیت سن خود را تایید کردید، استان خود را مشخص کنید:",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"آذربایجان شرقی"],['text'=>"اردبیل"],['text'=>"اصفهان"]
				],
								[
				['text'=>"آذربایجان غربی"],['text'=>"البرز"],['text'=>"بوشهر"]
				],
								[
				['text'=>"چهارمحال و بختیاری"],['text'=>"تهران"],['text'=>"ایلام"]
				],
								[
				['text'=>"خراسان جنوبی"],['text'=>"خوزستان"],['text'=>"زنجان"]
				],
								[
				['text'=>"خراسان شمالی"],['text'=>"سمنان"],['text'=>"فارس"]
				],
								[
				['text'=>"خراسان رضوی"],['text'=>"قزوین"],['text'=>"قم"]
				],
												[
				['text'=>"سیستان و بلوچستان"],['text'=>"کردستان"],['text'=>"کرمان"]
				],
																[
				['text'=>"کهگیلویه و بویراحمد"],['text'=>"کرمانشاه"],['text'=>"گیلان"]
				],
																				[
				['text'=>"گلستان"],['text'=>"لرستان"],['text'=>"مازندران"]
				],
																								[
				['text'=>"مرکزی"],['text'=>"هرمزگان"],['text'=>"همدان"],['text'=>"یزد"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سن شما باید بصورت اعداد انگلیسی وارد شده باشد و بین ۱۲تا۵۰سال باشد، بهتر هست از دکمه های زیر استفاده کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"12"],['text'=>"13"],['text'=>"14"],['text'=>"15"]
				],
								[
				['text'=>"16"],['text'=>"17"],['text'=>"18"],['text'=>"19"]
				],
								[
				['text'=>"20"],['text'=>"21"],['text'=>"22"],['text'=>"23"]
				],
								[
				['text'=>"24"],['text'=>"25"],['text'=>"26"],['text'=>"27"]
				],
								[
				['text'=>"28"],['text'=>"29"],['text'=>"30"],['text'=>"31"]
				],
								[
				['text'=>"32"],['text'=>"33"],['text'=>"34"],['text'=>"35"]
				],
								[
				['text'=>"36"],['text'=>"37"],['text'=>"38"],['text'=>"39"]
				],
								[
				['text'=>"40"],['text'=>"41"],['text'=>"42"],['text'=>"43"]
				],
								[
				['text'=>"44"],['text'=>"45"],['text'=>"46"],['text'=>"47"]
				],
								[
				['text'=>"48"],['text'=>"49"],['text'=>"50"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
       		]);
}
}
if($select == "city" && $tc == "private"){
if($bot == "آذربایجان شرقی" || $bot == "اردبیل" || $bot == "اصفهان" || $bot == "آذربایجان غربی" || $bot == "چهارمحال و بختیاری" || $bot == "خراسان جنوبی" || $bot == "خراسان شمالی" || $bot == "خراسان رضوی" || $bot == "سیستان و بلوچستان" || $bot == "کهگیلویه و بویراحمد" || $bot == "گلستان" || $bot == "مرکزی" || $bot == "البرز" || $bot == "بوشهر" || $bot == "تهران" || $bot == "ایلام" || $bot == "خوزستان" || $bot == "زنجان" || $bot == "سمنان" || $bot == "فارس" || $bot == "قزوین" || $bot == "قم" || $bot == "کردستان" || $bot == "کرمان" || $bot == "کرمانشاه" || $bot == "گیلان" || $bot == "لرستان" || $bot == "مازندران" || $bot == "هرمزگان" || $bot == "همدان" || $bot == "یزد"){
file_put_contents("data/$from_id/city.txt","$bot");
file_put_contents("data/$from_id/select.txt","none");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما با موفقیت در ربات عضو شدید و کاربر سطح نقره ای هستید، هم اکنون صفحه اصلی ربات برای شما باز شده است. از این دکمه ها استفاده کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"حتما باید استان شما، در این لیست باشد:",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"آذربایجان شرقی"],['text'=>"اردبیل"],['text'=>"اصفهان"]
				],
								[
				['text'=>"آذربایجان غربی"],['text'=>"البرز"],['text'=>"بوشهر"]
				],
								[
				['text'=>"چهارمحال و بختیاری"],['text'=>"تهران"],['text'=>"ایلام"]
				],
								[
				['text'=>"خراسان جنوبی"],['text'=>"خوزستان"],['text'=>"زنجان"]
				],
								[
				['text'=>"خراسان شمالی"],['text'=>"سمنان"],['text'=>"فارس"]
				],
								[
				['text'=>"خراسان رضوی"],['text'=>"قزوین"],['text'=>"قم"]
				],
												[
				['text'=>"سیستان و بلوچستان"],['text'=>"کردستان"],['text'=>"کرمان"]
				],
																[
				['text'=>"کهگیلویه و بویراحمد"],['text'=>"کرمانشاه"],['text'=>"گیلان"]
				],
																				[
				['text'=>"گلستان"],['text'=>"لرستان"],['text'=>"مازندران"]
				],
																								[
				['text'=>"مرکزی"],['text'=>"هرمزگان"],['text'=>"همدان"],['text'=>"یزد"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
}
if($bot == "پذیرفتن گفتگو") {
$getuserprofile = getUserProfilePhotos($token,$nashnas);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
$getuserprofile2 = getUserProfilePhotos($token,$from_id);
$cuphoto2 = $getuserprofile2->total_count;
$getuserphoto2 = $getuserprofile2->photos[0][0]->file_id;
$like = file_get_contents("data/$nashnas/like.txt");
$deslike = file_get_contents("data/$nashnas/deslike.txt");
$like2 = file_get_contents("data/$from_id/like.txt");
$deslike2 = file_get_contents("data/$from_id/deslike.txt");
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: گفتگوی شما آغاز گردید.
یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			  bot('sendphoto',[
  'chat_id'=>$nashnas,
'photo'=>$getuserphoto2,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like2] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike2] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"سیستم: گفتگوی شما آغاز گردید.
یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],	
				[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="نادیده گرفتن" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به صفحه اصلی خوش آمدید، از منوی زیر استفاده کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendmessage',[
				'chat_id'=>$nashnas,
	'text'=>"درخواست شما توسط $name رد شد.",
    		]);
file_put_contents("data/$from_id/chat.txt","none");
file_put_contents("data/$nashnas/chat.txt","none");
}
elseif($bot=="گفتگوی ناشناس" && $tc == "private"){
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به بخش گفتگوی ناشناس خوش آمدی...
میتوانی ویژگی خاصی رو برای متصل شدن به شخص رو ملاک قرار بدی:",
   'reply_markup'=>json_encode([
            	'keyboard'=>[			
																[
				['text'=>"برگشت"]
				],		
				[
				['text'=>"شانسی"],['text'=>"هم سن"]
				],
												[
				['text'=>"پسر"],['text'=>"دختر"]
				],	
												[
				['text'=>"گفتگو با GPS"],['text'=>"هم استانی"]
				],		
 	],
            	'resize_keyboard'=>false
       		])
    		]);
$add = fopen("data/chat.txt",'a') or die("Unable to open file!");  
fwrite($add, "$from_id\n");
fclose($add);
}
else
{
				bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"دوست گرامی، شما در کانال ما عضو نیستید و امکان استفاده از این ربات برای شما فراهم نیست، باید در کانال سازنده عضو بشید تا حمایت خودتون رو به ما نشون بدین و بعد،‌ از کار با ربات لذت ببرید.
	
@$channel

بعد از عضویت، با ارسال دستور /start ربات برای شما فعال می شود.",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"ورود به کانال",'url'=>"https://t.me/$channel"]
	],
              ]
        ])
    		]);	
}
}
elseif($bot=="شانسی" or $bot=="آغاز گفتگو" && $tc == "private"){
if ($vip == "") {
if ($numchat > 0){
$memberex = explode("\n",$member);
$howmember = count($memberex) - 1;
$randmember = $memberex[mt_rand(0,$howmember)];
if ($randmember != "" && $randmember != $from_id){
file_put_contents("data/$from_id/chat.txt","chatnashnas");
file_put_contents("data/$randmember/chat.txt","chatnashnas");
file_put_contents("data/$randmember/nashnas.txt","$from_id");
file_put_contents("data/$from_id/nashnas.txt","$randmember");
$aval = str_replace("$from_id\n","",$member);
file_put_contents("data/chat.txt","$aval");
$member = file_get_contents('data/chat.txt');
$dovom = str_replace("$randmember\n","",$member);
file_put_contents("data/chat.txt","$dovom");
$getuserprofile = getUserProfilePhotos($token,$randmember);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
$getuserprofile2 = getUserProfilePhotos($token,$from_id);
$cuphoto2 = $getuserprofile2->total_count;
$getuserphoto2 = $getuserprofile2->photos[0][0]->file_id;
$like = file_get_contents("data/$randmember/like.txt");
$deslike = file_get_contents("data/$randmember/deslike.txt");
$like2 = file_get_contents("data/$from_id/like.txt");
$deslike2 = file_get_contents("data/$from_id/deslike.txt");
			bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
						bot('sendmessage',[
	'chat_id'=>$randmember,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
						  bot('sendphoto',[
  'chat_id'=>$randmember,
'photo'=>$getuserphoto2,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like2] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike2] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
$newnumchat = $numchat -1;
file_put_contents("data/$from_id/numchat.txt","$newnumchat");
$numchat1 = file_get_contents("data/$nashnas/numchat.txt");
$newnumchat1 = $numchat1 -1;
file_put_contents("data/$nashnas/numchat.txt","$newnumchat1");
}
else 
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: خطا! اتصال برقرار نشد.
حدس میزنیم یکی از دلایل زیر میتواند باعث بروز این خطا باشد:
- کاربر از گفتگو انصراف داده باشد.
- تعداد کاربران کم بوده و هریک درحال گفتگو می باشند.

شما در صف انتظار قرار دارید، درصورت وارد شدن کاربر جدیدی، گفتگو آغاز می شود اما برای سریع تر بودن این پروسه، میتوانید خودتان مجدد امتحان کنید.",
	]);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"میزان اعتبار شما به پایان رسیده است. لطفا حساب خود را ارتقا دهید.",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"دعوت دوستان",'callback_data'=>"vip"]
	],
		[
	['text'=>"پرداخت هزینه",'callback_data'=>"by"]
	],
	],
        ])
    		]);

}
}
else
{
$memberex = explode("\n",$member);
$howmember = count($memberex) - 1;
$randmember = $memberex[mt_rand(0,$howmember)];
if ($randmember != "" && $randmember != $from_id){
file_put_contents("data/$from_id/chat.txt","chatnashnas");
file_put_contents("data/$randmember/chat.txt","chatnashnas");
file_put_contents("data/$randmember/nashnas.txt","$from_id");
file_put_contents("data/$from_id/nashnas.txt","$randmember");
$aval = str_replace("$from_id\n","",$member);
file_put_contents("data/chat.txt","$aval");
$member = file_get_contents('data/chat.txt');
$dovom = str_replace("$randmember\n","",$member);
file_put_contents("data/chat.txt","$dovom");
$getuserprofile = getUserProfilePhotos($token,$randmember);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
$getuserprofile2 = getUserProfilePhotos($token,$from_id);
$cuphoto2 = $getuserprofile2->total_count;
$getuserphoto2 = $getuserprofile2->photos[0][0]->file_id;
$like = file_get_contents("data/$randmember/like.txt");
$deslike = file_get_contents("data/$randmember/deslike.txt");
$like2 = file_get_contents("data/$from_id/like.txt");
$deslike2 = file_get_contents("data/$from_id/deslike.txt");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
						  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
			
						bot('sendmessage',[
	'chat_id'=>$randmember,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
						  bot('sendphoto',[
  'chat_id'=>$randmember,
'photo'=>$getuserphoto2,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like2] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike2] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: خطا! اتصال برقرار نشد.
حدس میزنیم یکی از دلایل زیر میتواند باعث بروز این خطا باشد:
- کاربر از گفتگو انصراف داده باشد.
- تعداد کاربران کم بوده و هریک درحال گفتگو می باشند.

شما در صف انتظار قرار دارید، درصورت وارد شدن کاربر جدیدی، گفتگو آغاز می شود اما برای سریع تر بودن این پروسه، میتوانید خودتان مجدد امتحان کنید.",
	]);
}
}
}
elseif($bot=="هم سن" or $bot=="دختر" or $bot=="پسر" or $bot=="هم استانی" && $tc == "private"){
if ($vip != "") {
$memberex = explode("\n",$member);
$howmember = count($memberex) - 1;
$randmember = $memberex[mt_rand(0,$howmember)];
if ($randmember != "" && $randmember != $from_id){
file_put_contents("data/$from_id/chat.txt","chatnashnas");
file_put_contents("data/$randmember/chat.txt","chatnashnas");
file_put_contents("data/$randmember/nashnas.txt","$from_id");
file_put_contents("data/$from_id/nashnas.txt","$randmember");
$aval = str_replace("$from_id\n","",$member);
$member = file_get_contents('data/chat.txt');
file_put_contents("data/chat.txt","$aval");
$dovom = str_replace("$randmember\n","",$member);
file_put_contents("data/chat.txt","$dovom");
$getuserprofile = getUserProfilePhotos($token,$randmember);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
$getuserprofile2 = getUserProfilePhotos($token,$from_id);
$cuphoto2 = $getuserprofile2->total_count;
$getuserphoto2 = $getuserprofile2->photos[0][0]->file_id;
$like = file_get_contents("data/$randmember/like.txt");
$deslike = file_get_contents("data/$randmember/deslike.txt");
$like2 = file_get_contents("data/$from_id/like.txt");
$deslike2 = file_get_contents("data/$from_id/deslike.txt");
			bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
						bot('sendmessage',[
	'chat_id'=>$randmember,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],
[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
						  bot('sendphoto',[
  'chat_id'=>$randmember,
'photo'=>$getuserphoto2,
  'caption'=>"نظرت رو درمورد این پروفایل با این علامتای زیر اعلام کن:",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"[$like2] 👍🏻",'callback_data'=>"like"],['text'=>"[$deslike2] 👎🏻",'callback_data'=>"deslike"]
	],
	],
        ])
   ]);
}
else 
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: خطا! اتصال برقرار نشد.
حدس میزنیم یکی از دلایل زیر میتواند باعث بروز این خطا باشد:
- کاربر از گفتگو انصراف داده باشد.
- تعداد کاربران کم بوده و هریک درحال گفتگو می باشند.

شما در صف انتظار قرار دارید، درصورت وارد شدن کاربر جدیدی، گفتگو آغاز می شود اما برای سریع تر بودن این پروسه، میتوانید خودتان مجدد امتحان کنید.",
	]);
	
}
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما دسترسی به این قسمت را ندارید. باید حساب شما طلایی باشد!

افراد دعوت شده توسط شما: $adds
تعداد افراد مورد نیاز برای فعال شدن حساب طلایی: ۱۰نفر",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"دعوت دوستان",'callback_data'=>"vip"]
	],
		[
	['text'=>"پرداخت هزینه",'callback_data'=>"by"]
	],
	],
        ])
    		]);

}
}
elseif($bot=="گفتگو با GPS" && $tc == "private"){
if ($vip != "" && $adds > 5) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"برای شروع گفتگو، باید موقعیت مکانی خود را بفرستید.",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اشتراک گذاری موقعیت مکانی","request_location" =>true],['text'=>"برگشت"]
				],	
 	],
            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/file.txt","sendloc");
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما دسترسی به این قسمت را ندارید.

افراد دعوت شده توسط شما: $adds
تعداد افراد مورد نیاز برای فعال شدن این بخش: ۵نفر
تعداد افراد مورد نیاز برای فعال شدن حساب طلایی: ۱۰نفر",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"⭐️ دعوت دوستان",'callback_data'=>"vip"]
	],
		[
	['text'=>"پرداخت هزینه",'callback_data'=>"by"]
	],
	],
        ])
    		]);

}
}
elseif($step == "sendloc" && $tc == "private"){   
if($update->message->location){	
$rand = rand(4,30);
$rand2 = rand(1,10);
			bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"📍 مکان شما در سیستم ذخیره شد در حال جست جو ...",
	]);	
			bot('sendmessage',[       
			'chat_id'=>$chat_id,
	'text'=>"یک نفر برای دوست یابی پیدا شد.
	
قوانین:
 - خودداری از کلمات رکیک و تبلیغات.
 - عدم دادن اطلاعات و ادامه دادن گفتگوی ناشناس.
 - از توهین یا بستن بیهوده کفتگو جدا جلوگیری شود.
 
 یه پیام دلنشین بفرست.(احوال پرسی میتونه ایده ی خوبی باشه)
 
 فاصله شما تا شخص: $rand.$rand2 KM",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"برگشت"]
				],		
				[
				['text'=>"آغاز گفتگو"]
				],
 	],
            	'resize_keyboard'=>false
       		])
	]);	
file_put_contents("data/$from_id/file.txt","none");
	}
	}
if($bot=="برگشت" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به صفحه اصلی بازگشتید، از دکمه های زیر استفاده کنید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/chat.txt","none");
$now = str_replace("$from_id\n","",$member);
file_put_contents("data/chat.txt","$now");
file_put_contents("data/$from_id/file.txt","none");
}
if($chat == "chatnashnas" && $tc == "private"){
if($bot != "اتمام گفتگو" && $bot != "پذیرفتن گفتگو" && $bot != "نادیده گرفتن" && $bot != "گزارش تخلف" && $bot != "بله" && $bot != "خیر، ادامه میدهم" && $bot != "مشاهده پروفایل" &&$bot != "+ لیست سیاه من" && $bot != "نه، مسدود نکن" && $bot != "نفر بعدی" && $bot != "+ دوستان من" && $bot != "آره، نفر بعدی") {
if ($vip == "") {
if ($update->message->text) {
bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"`$bot`",
	'parse_mode'=>'MarkDown',
    		]);
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما توانایی ارسال انواع رسانه را ندارید. با ارتقا حساب خود به سطح طلایی، این امکان را فعال کنید.",
    		]);
}
}
else
{
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
$get = bot('getfile',['file_id'=>$file]);
$patch = $get->result->file_path;
file_put_contents("data/$from_id/photo.png",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
$voice = $message->voice;
$file = $voice->file_id;
$get = bot('getfile',['file_id'=>$file]);
$patch = $get->result->file_path;
file_put_contents("data/$from_id/voice.ogg",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
$document = $update->message->document;
$file = $document->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
file_put_contents("data/$from_id/document.gif",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
$sticker = $update->message->sticker;
$file = $sticker->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
file_put_contents("data/$from_id/sticker.webp",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"`$bot`",
	'parse_mode'=>'MarkDown',
    		]);
			bot('sendphoto',[
	'chat_id'=>$nashnas,
	'photo'=>new CURLFile("data/$from_id/photo.png"),
    		]);
						bot('senddocument',[
	'chat_id'=>$nashnas,
	'document'=>new CURLFile("data/$from_id/document.gif"),
    		]);
									bot('sendsticker',[
	'chat_id'=>$nashnas,
	'sticker'=>new CURLFile("data/$from_id/sticker.webp"),
    		]);
											bot('sendvoice',[
	'chat_id'=>$nashnas,
	'voice'=>new CURLFile("data/$from_id/voice.ogg"),
    		]);
unlink("data/$from_id/voice.ogg");
unlink("data/$from_id/sticker.webp");
unlink("data/$from_id/photo.png");
unlink("data/$from_id/document.gif");
}
}
}
if($bot=="مشاهده پروفایل" && $tc == "private"){
if ($vip != "") {
$namenashnas = file_get_contents("data/$nashnas/name.txt");
$sennashnas = file_get_contents("data/$nashnas/age.txt");
$shahrnashans = file_get_contents("data/$nashnas/city.txt");
$jensyatnashans = file_get_contents("data/$nashnas/jenstyat.txt");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: $nashnas
پروفایل فرد مقابل
ـــــــــــــــــــــــ
نام: $namenashnas
جنسیت: $jensyatnashans
سن: $sennashnas
موقعیت مکانی: $shahrnashans",
    		]);
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما دسترسی ندارید، لطفا حساب کاربری خود را به سطح طلایی ارتقا دهید.",
    		]);
}
}
if($bot=="گزارش تخلف" && $tc == "private"){
$warnings = file_get_contents("data/$nashnas/warn.txt");
if($warnings >= 10){
$adduser = file_get_contents("data/blocklist.txt");
$adduser .= $nashnas . "\n";
file_put_contents("data/blocklist.txt", $adduser);
rmdir("data/$nashnas");
bot('sendmessage',[
'chat_id'=>$Dev[0],
	'text'=>"فردی بخاطر گزارش های مکرر کاربران مسدود گشت. فرد خاطی: [$nashnas](tg://user?id=$nashnas)",
	'parse_mode'=>"MarkDown",
    		]);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"گزارش تخلف ارسال شد.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"]
				],	
				[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
   ]);
}
if($warnings <= 10){
$warning1s = file_get_contents("data/$nashnas/warn.txt");
$new_warnings = $warning1s+1;
file_put_contents("data/$nashnas/warn.txt",$new_warnings);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"گزارش تخلف ارسال شد.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"]
				],	
				[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
   ]);
}
}
if($bot=="اتمام گفتگو" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: آیا از اتمام گفتگو رضایت دارید؟",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"بله"],['text'=>"خیر، ادامه میدهم"]
				],
			
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="نفر بعدی" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: میخوای این گفت گو رو قطع کنی و به یک چت ناشناس دیگه بری ؟",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"آره، نفر بعدی"],['text'=>"خیر، ادامه میدهم"]
				],
			
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="+ لیست سیاه من" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: مطمعنی میخوای این چت رو پایان بدی و دیگه هیچ وقت به این کاربر وصل نشی ؟",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اره مسدود کن"],['text'=>"نه، مسدود نکن"]
				],			
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="خیر، ادامه میدهم" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: خب باشه؛ به گفتگو ادامه بده...",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],	
				[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
												[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="+ دوستان من" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: فرد به دوستان تو اضافه شد، به گفتگو ادامه بده...",
    		]);
$id = base64_encode($nashnas);
$name = file_get_contents("data/$nashnas/name.txt");
$gpadd = fopen("data/$from_id/frinds.txt",'a') or die("Unable to open file!");  
fwrite($gpadd,"[$name](https://t.me/$usernamebot?start=$id)\n");
fclose($gpadd);
}
if($bot=="نه، مسدود نکن" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سیستم: باشه؛ به گفتگو ادامه بده...",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"اتمام گفتگو"],['text'=>"گزارش تخلف"]
				],	
				[				
				['text'=>"مشاهده پروفایل"],['text'=>"+ لیست سیاه من"]
				],
								[				
				['text'=>"نفر بعدی"],['text'=>"+ دوستان من"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="بله" && $tc == "private"){
file_put_contents("data/$from_id/chat.txt","none");
file_put_contents("data/$nashnas/chat.txt","none");
$now = str_replace("$from_id\n","",$member);
file_put_contents("data/chat.txt","$now");
$members = file_get_contents('data/chat.txt');
$now1 = str_replace("$nashnas\n","",$members);
file_put_contents("data/chat.txt","$now1");
if ($vip == "") {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"گفتگو با موفقیت بسته شد.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>"http://iranianfrance.com/wp-content/uploads/2017/06/chat-rencontre-520x245.jpg",
	'caption'=>"با فعال کردن حساب کاربری ویژه، این امکانات برای شما فعال می شود:
- انتخاب کاملا آزادانه ویژگی فرد برای انتخاب کسی که باهاش هم صحبت میشی دردسترس میشه
- دیگه محدودیت تو تعداد گفتگو کردن صحت نداره
- توی گفتگو دیگه میتونی هرچیزی رو که میخوای رو بفرستی

ربات خودت رو ویژه کن:",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"دعوت دوستان",'callback_data'=>"vip"]
	],
		[
	['text'=>"پرداخت هزینه",'callback_data'=>"by"]
	],
	],
        ])
    		]);
if(strpos($blocklist, "$nashnas") !== false  ) {
bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"متاسفانه تیم مدیریت تصمیم گرفته که شما مسدود شوید، اگر فکر می کنید اشتباهی شده، به مدیریت پیام دهید.
	
@MahdyMirzade",
]);
}else{
			bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"گفتگو توسط فرد مقابل به پایان رسید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendphoto',[
	'chat_id'=>$nashnas,
	'photo'=>"http://iranianfrance.com/wp-content/uploads/2017/06/chat-rencontre-520x245.jpg",
	'caption'=>"با فعال کردن حساب کاربری ویژه، این امکانات برای شما فعال می شود:
- انتخاب کاملا آزادانه ویژگی فرد برای انتخاب کسی که باهاش هم صحبت میشی دردسترس میشه
- دیگه محدودیت تو تعداد گفتگو کردن صحت نداره
- توی گفتگو دیگه میتونی هرچیزی رو که میخوای رو بفرستی

ربات خودت رو ویژه کن:",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"دعوت دوستان",'callback_data'=>"vip"]
	],
		[
	['text'=>"پرداخت هزینه",'callback_data'=>"by"]
	],
	],
        ])
    		]);
    		}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"گفتگو با موفقیت پایان یافت.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"چت توسط طرف مقابل بسته شد. از دکمه های زیر استفاده کنید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
}
if($bot=="آره، نفر بعدی" && $tc == "private"){
file_put_contents("data/$from_id/chat.txt","none");
file_put_contents("data/$nashnas/chat.txt","none");
$add = fopen("data/chat.txt",'a') or die("Unable to open file!");  
fwrite($add, "$from_id\n");
fclose($add);
$members = file_get_contents('data/chat.txt');
$now1 = str_replace("$nashnas\n","",$members);
file_put_contents("data/chat.txt","$now1");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"چت توسط شما بسته شد و همچنین شما در لیست انتظار قرار گرفتین. از دکمه های زیر استفاده کنید.",
'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"برگشت"]
				],	
				[
				['text'=>"آغاز گفتگو"]
				],	
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"چت توسط طرف مقابل بسته شد. از دکمه های زیر استفاده کنید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
if($bot=="اره مسدود کن" && $tc == "private"){
file_put_contents("data/$from_id/chat.txt","none");
file_put_contents("data/$nashnas/chat.txt","none");
$now = str_replace("$from_id\n","",$member);
file_put_contents("data/chat.txt","$now");
$members = file_get_contents('data/chat.txt');
$now1 = str_replace("$nashnas\n","",$members);
file_put_contents("data/chat.txt","$now1");
$gpadd = fopen("data/$from_id/blacklist.txt",'a') or die("Unable to open file!");  
$name = file_get_contents("data/$nashnas/name.txt");
$id = base64_encode($nashnas);
fwrite($gpadd,"[$name](https://t.me/$usernamebot?start=$id)\n");
fclose($gpadd);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"گفتگو پایان یافت و کاربر در لیست سیاه شما قرار گرفت.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
			bot('sendmessage',[
	'chat_id'=>$nashnas,
	'text'=>"چت توسط طرف مقابل بسته شد و همچنین شما در لیست سیاه او قرار گرفتین. از دکمه های زیر استفاده کنید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
    		]);
}
elseif($data=="lockchannel"){
if($tchq == 'member' or $tchq == 'creator' or $tchq == 'administrator'){
$invite = file_get_contents("data/$fromid/inviter.txt");
$adds1 = file_get_contents("data/$invite/member.txt");
$newmember = $adds1 +1;
file_put_contents("data/$invite/member.txt","$newmember");
	bot('sendmessage',[
	'chat_id'=>$invite,
	'text'=>"کاربر جدیدی با دعوت شما عضو شد. زیرمجموعه های شما: $adds1",
    		]);
bot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"سلام کاربر گرامی، به ربات دوست یابی خوش آمدی...
	
با این ربات:
بصورت ناشناس دوست پیدا کنی
یا یه دوست هم استانی پیدا کنی
و یا با استفاده از مکان یابی هم صحبت بشی

برای ادامه کار، باید جنسیت خودتو تایین کنی.«نکته مهم، تغییر جنسیت به هیچ وجه ممکن نیست.»

🤖 @$usernamebot",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"دختر هستم"],['text'=>"پسر هستم"]
				],
 	],
            	'resize_keyboard'=>false
       		])
    		]);
	}
else
{
        bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "شما هنوز عضوی از کانال نیستید.",
            'show_alert' =>true
        ]);
}
}
elseif($data=="like"){
$like = file_get_contents("data/$nashnas2/like.txt");
$pluslike = $like +1;
file_put_contents("data/$nashnas2/like.txt","$pluslike");
$getuserprofile = getUserProfilePhotos($token,$nashnas2);
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
 bot('editMessageMedia',[
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'media'=> json_encode([
            'type'=> "photo",
            'media' => $getuserphoto,
            'caption' => "شما از پروفایل شخص خوشتون اومد.",
            ]),
            'reply_markup' => json_encode([
                'inline_keyboard' => [
	[['text'=>"👍🏻 $pluslike", 'callback_data'=>"null_like"]],
                ],
            ])
            ]);
	}
	elseif($data=="deslike"){
$like = file_get_contents("data/$nashnas2/deslike.txt");
$pluslike = $like + 1;
file_put_contents("data/$nashnas2/deslike.txt","$pluslike");
$getuserprofile = getUserProfilePhotos($token,$nashnas2);
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
 bot('editMessageMedia',[
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'media'=> json_encode([
            'type'=> "photo",
            'media' => $getuserphoto,
            'caption' => "شما از پروفایل شخص خوشتون نیومد.",
            ]),
            'reply_markup' => json_encode([
                'inline_keyboard' => [
	[['text'=>"👎🏻 $pluslike", 'callback_data'=>"null_disslike"]],
                ],
            ])
            ]);
	}
	
 elseif($data=="null_like"){
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تعداد لایک های شخص",
'show_alert'=>true]);
}

 elseif($data=="null_disslike"){
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تعداد دیسلایک های شخص",
'show_alert'=>true]);
}
 elseif($data=="null_likes"){
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تعداد لایک های شما",
'show_alert'=>true]);
}

 elseif($data=="null_disslikes"){
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تعداد دیسلایک های شما",
'show_alert'=>true]);
}
elseif($bot=="پروفایل" || $bot=="برگشت به پروفایل" && $tc == "private"){
if ($vip != "") {
$getuserprofile = getUserProfilePhotos($token,$chat_id);
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
bot('sendPhoto',[
	'chat_id'=>$chat_id,
	'photo'=>$getuserphoto,
	'caption'=>"نام شما: $name
جنسیت شما: $jenstyat
سن شما: $age
محل زندگی شما: $city

نوع حساب شما: طلایی (ویژه)",
 'reply_markup'=>json_encode([
 'inline_keyboard'=>[
 [['text'=>"👍🏻 $like",'callback_data'=>"null_likes"],['text'=>"👎🏻 $deslike",'callback_data'=>"null_disslikes"]]
 ]
 ])
 ]);
 bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما می توانید از دکمه های زیر استفاده کنید:",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"ویرایش پروفایل"],['text'=>"برگشت"]
				],
				],
       		])
    		]);
}
else
{
$getuserprofile = getUserProfilePhotos($token,$chat_id);
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
bot('sendPhoto',[
	'chat_id'=>$chat_id,
		'photo'=>$getuserphoto,
	'caption'=>"نام شما: $name
جنسیت شما: $jenstyat
سن شما: $age
محل زندگی شما: $city

نوع حساب شما: نقره ای (رایگان)
تعداد افراد دعوت شده: $adds
گفتگو های باقی مانده: $numchat",
 'reply_markup'=>json_encode([
 'inline_keyboard'=>[
 [['text'=>"👍🏻 $like",'callback_data'=>"null_likes"],['text'=>"👎🏻 $deslike",'callback_data'=>"null_disslikes"]]
 ]
 ])
 ]);
 bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما می توانید از دکمه های زیر استفاده کنید:",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"ویرایش پروفایل"],['text'=>"برگشت"]
				],
				],
       		])
    		]);
}
}
elseif($bot=="ویرایش پروفایل" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"در این قسمت اطلاعات خودتان را تغییر بدید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
												[
				['text'=>"برگشت به پروفایل"]
				],
								[
				['text'=>"ویرایش سن"],['text'=>"ویرایش استان"]
				],
								[
['text'=>"ویرایش جنسیت"],['text'=>"ویرایش نام"]
				],
				],
				            	'resize_keyboard'=>false
       		])
			]);
}
elseif($bot=="ویرایش سن" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سن جدید خود را وارد کنید:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"12"],['text'=>"13"],['text'=>"14"],['text'=>"15"]
				],
								[
				['text'=>"16"],['text'=>"17"],['text'=>"18"],['text'=>"19"]
				],
								[
				['text'=>"20"],['text'=>"21"],['text'=>"22"],['text'=>"23"]
				],
								[
				['text'=>"24"],['text'=>"25"],['text'=>"26"],['text'=>"27"]
				],
								[
				['text'=>"28"],['text'=>"29"],['text'=>"30"],['text'=>"31"]
				],
								[
				['text'=>"32"],['text'=>"33"],['text'=>"34"],['text'=>"35"]
				],
								[
				['text'=>"36"],['text'=>"37"],['text'=>"38"],['text'=>"39"]
				],
								[
				['text'=>"40"],['text'=>"41"],['text'=>"42"],['text'=>"43"]
				],
								[
				['text'=>"44"],['text'=>"45"],['text'=>"46"],['text'=>"47"]
				],
								[
				['text'=>"48"],['text'=>"49"],['text'=>"50"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
			]);
file_put_contents("data/$from_id/select.txt","editage");
}
elseif($select == "editage" && $tc == "private"){
if ($bot <= 50 && $bot >= 12){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سن شما با موفقیت تغییر کرد.",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
												[
				['text'=>"برگشت به پروفایل"]
				],
								[
				['text'=>"ویرایش سن"],['text'=>"ویرایش استان"]
				],
								[
				['text'=>"ویرایش جنسیت"],['text'=>"ویرایش نام"]
				],
				],
				            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/age.txt","$bot");
file_put_contents("data/$from_id/select.txt","none");
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سن شما باید بصورت اعداد انگلیسی وارد شده باشد و بین ۱۲تا۵۰سال باشد، بهتر هست از دکمه های زیر استفاده کنید:",
	]);
}
}
elseif($bot=="ویرایش استان" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"استان خود را وارد کنید:",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"آذربایجان شرقی"],['text'=>"اردبیل"],['text'=>"اصفهان"]
				],
								[
				['text'=>"آذربایجان غربی"],['text'=>"البرز"],['text'=>"بوشهر"]
				],
								[
				['text'=>"چهارمحال و بختیاری"],['text'=>"تهران"],['text'=>"ایلام"]
				],
								[
				['text'=>"خراسان جنوبی"],['text'=>"خوزستان"],['text'=>"زنجان"]
				],
								[
				['text'=>"خراسان شمالی"],['text'=>"سمنان"],['text'=>"فارس"]
				],
								[
				['text'=>"خراسان رضوی"],['text'=>"قزوین"],['text'=>"قم"]
				],
												[
				['text'=>"سیستان و بلوچستان"],['text'=>"کردستان"],['text'=>"کرمان"]
				],
																[
				['text'=>"کهگیلویه و بویراحمد"],['text'=>"کرمانشاه"],['text'=>"گیلان"]
				],
																				[
				['text'=>"گلستان"],['text'=>"لرستان"],['text'=>"مازندران"]
				],
																								[
				['text'=>"مرکزی"],['text'=>"هرمزگان"],['text'=>"همدان"],['text'=>"یزد"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
			]);
file_put_contents("data/$from_id/select.txt","editcity");
}
elseif($select == "editcity" && $tc == "private"){
if($bot == "آذربایجان شرقی" || $bot == "اردبیل" || $bot == "اصفهان" || $bot == "آذربایجان غربی" || $bot == "چهارمحال و بختیاری" || $bot == "خراسان جنوبی" || $bot == "خراسان شمالی" || $bot == "خراسان رضوی" || $bot == "سیستان و بلوچستان" || $bot == "کهگیلویه و بویراحمد" || $bot == "گلستان" || $bot == "مرکزی" || $bot == "البرز" || $bot == "بوشهر" || $bot == "تهران" || $bot == "ایلام" || $bot == "خوزستان" || $bot == "زنجان" || $bot == "سمنان" || $bot == "فارس" || $bot == "قزوین" || $bot == "قم" || $bot == "کردستان" || $bot == "کرمان" || $bot == "کرمانشاه" || $bot == "گیلان" || $bot == "لرستان" || $bot == "مازندران" || $bot == "هرمزگان" || $bot == "همدان" || $bot == "یزد"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"استان شما با موفقیت تغییر کرد.",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
												[
				['text'=>"برگشت به پروفایل"]
				],
								[
				['text'=>"ویرایش سن"],['text'=>"ویرایش استان"]
				],
								[
				['text'=>"ویرایش جنسیت"],['text'=>"ویرایش نام"]
				],
				],
				            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/city.txt","$bot");
file_put_contents("data/$from_id/select.txt","none");
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"استان شما حتما باید درون لیست باشد، دوباره امتحان کنید:",
			]);

}
}
elseif($bot=="ویرایش جنسیت" && $tc == "private"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"جنسیت خود را وارد کنید:",
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"دختر هستم"],['text'=>"پسر هستم"]
				],
 	],
            	'resize_keyboard'=>false
       		])
			]);
file_put_contents("data/$from_id/select.txt","editsex");
}
elseif($select == "editsex" && $tc == "private"){
if($bot == "دختر هستم" || $bot == "پسر هستم"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"جنسیت شما با موفقیت تغییر کرد.",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
												[
				['text'=>"برگشت به پروفایل"]
				],
								[
				['text'=>"ویرایش سن"],['text'=>"ویرایش استان"]
				],
								[
				['text'=>"ویرایش جنسیت"],['text'=>"ویرایش نام"]
				],
				],
				            	'resize_keyboard'=>false
       		])
    		]);
    		if($bot=="پسر هستم"){
file_put_contents("data/$from_id/jenstyat.txt","پسر");
file_put_contents("data/$from_id/select.txt","none");
    		}
    		if($bot=="دختر هستم"){
file_put_contents("data/$from_id/jenstyat.txt","دختر");
file_put_contents("data/$from_id/select.txt","none");
    		}
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"تنها می توانید از دکمه های زیر استفاده کنید:",
			]);
}
}
elseif($bot=="ویرایش نام" && $tc == "private"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"نام جدید خود را بفرستید:",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
]);
file_put_contents("data/$from_id/select.txt","editname");
}
elseif($select == "editname" && $tc == "private"){
$n = strlen($bot);
if($n >= 3 && $n <= 32){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"نام شما با موفقیت تغییر کرد.",
 'reply_markup'=>json_encode([
            	'keyboard'=>[
												[
				['text'=>"برگشت به پروفایل"]
				],
								[
				['text'=>"ویرایش سن"],['text'=>"ویرایش استان"]
				],
								[
				['text'=>"ویرایش جنسیت"],['text'=>"ویرایش نام"]
				],
				],
				            	'resize_keyboard'=>false
       		])
    		]);
file_put_contents("data/$from_id/name.txt","$bot");
file_put_contents("data/$from_id/select.txt","none");
}else{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"اسم شما باید حداقل ۳کارکتر و حداکثر ۳۲کارکتر باشد.",
			]);
}
}
elseif($bot=="کاربری ویژه" && $tc == "private"){
$cheghadr = 10 -$adds;
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"با فعال کردن حساب کاربری ویژه، این امکانات برای شما فعال می شود:
- انتخاب کاملا آزادانه ویژگی فرد برای انتخاب کسی که باهاش هم صحبت میشی دردسترس میشه
- دیگه محدودیت تو تعداد گفتگو کردن صحت نداره
- توی گفتگو دیگه میتونی هرچیزی رو که میخوای رو بفرستی

این ویژگی ها از این دو طریق قابل فعال شدن هست:",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"برگشت"]
				],
								[
				['text'=>"دعوت دیگران"],['text'=>"پرداخت هزینه"]
				],
				],
				            	'resize_keyboard'=>false
       		])
			]);
}
elseif($bot=="لیست سیاه من" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"لیست سیاه شما:
$blacklist",
'parse_mode'=>'MarkDown',
'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"برگشت"],['text'=>"حذف لیست"]
				],
				],
				            	'resize_keyboard'=>false
       		])
			]);
}
elseif($bot=="دوستان من" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"دوستان شما، به این صورت لیست شده اند:
$frinds",
'parse_mode'=>'MarkDown',
'disable_web_page_preview'=>true,
			]);
}
elseif($bot=="حذف لیست" && $tc == "private"){
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"لیست سیاه با موفقیت پاک گردید.",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
			]);
unlink("data/$from_id/blacklist.txt");
}
elseif($bot=="/invite" || $bot=="دعوت دیگران" && $tc == "private"){
$cheghadr = 10 -$adds;
			bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>"https://linestore.ir/wp-content/uploads/2018/04/%D9%85%D8%B9%D8%B1%D9%81%DB%8C-%D8%B1%D8%A8%D8%A7%D8%AA-%D8%AA%D9%84%DA%AF%D8%B1%D8%A7%D9%85.jpg",
	'caption'=>"یه ربات دوست یابی آوردم 😁

با این ربات میتونی هرکسی رو با هر جنسیتی که دوست داری باهاش چت کنی... خیلی باحاله 😼

خب اگه پایه یکم شیطونی هستی، بزن رو لینک زیر 👩🏼👇🏻

🌐 https://t.me/$usernamebot?start=$from_id",
    		]);
			bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"بنر شما حاوی لینک دعوت شما است که با کلیک کردن این لینک، توسط افرادی که عضو این ربات نیستن، فردی به جمع افرادی که شما دعوت کردین اضافه میشه...
* فرد حتما باید حساب نقره ای خودش رو فعال کنه تا برای شما هم اعتبار اضافه بشه

افراد دعوت شده توسط شما: $adds2
افراد باقی مانده تا طلایی شدن حساب شما: $cheghadr",
    		]);
}
elseif($data == "vip"){
$cheghadr = 10 -$adds2;
			bot('sendphoto',[
	'chat_id'=>$chatid,
	'photo'=>"https://linestore.ir/wp-content/uploads/2018/04/%D9%85%D8%B9%D8%B1%D9%81%DB%8C-%D8%B1%D8%A8%D8%A7%D8%AA-%D8%AA%D9%84%DA%AF%D8%B1%D8%A7%D9%85.jpg",
	'caption'=>"یه ربات دوست یابی آوردم 😁

با این ربات میتونی هرکسی رو با هر جنسیتی که دوست داری باهاش چت کنی... خیلی باحاله 😼

خب اگه پایه یکم شیطونی هستی، بزن رو لینک زیر 👩🏼👇🏻

🌐 https://t.me/$usernamebot?start=$fromid",
    		]);
			bot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"بنر شما حاوی لینک دعوت شما است که با کلیک کردن این لینک، توسط افرادی که عضو این ربات نیستن، فردی به جمع افرادی که شما دعوت کردین اضافه میشه...
* فرد حتما باید حساب نقره ای خودش رو فعال کنه تا برای شما هم اعتبار اضافه بشه

افراد دعوت شده توسط شما: $adds2
افراد باقی مانده تا طلایی شدن حساب شما: $cheghadr",
    		]);
}
elseif($data == "by"){
			bot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"با پرداخت هزینه می توانید حساب خود را ویژه کنید و لذت ببرید.
با پرداخت ۵هزارتومان، این ربات را به طور کامل و دائمی برای شما امکانات خودش را دراختیار می گذارد.
	
امکانات کاربری ویژه:
۱. تفکیک بندی گفتگو با شخص
۲. مشاهده پروفایل شخص
۳. چت با افراد نزدیک(gps)
۴. گفتگوی بدون محدودیت

*** حتما در قسمت شماره دانشجویی درگاه، شناسه اکانت خودتون رو وارد کنید تا بعد از بررسی حساب شما فعال شود وگرنه درصورت پرداخت نکردن، وجه قابل بازگشت نیست. ***
شناسه شما: $from_id


اگر هم مایل باشید، میتوانید از طریق دعوت کردن دوستانتان به ربات، حساب کاربری طلایی(ویژه) رو فعال کنید.",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"خرید",'url'=>"$meinipa"]
	],
              ]
        ])
    		]);
}
elseif($bot=="پرداخت هزینه" && $tc == "private"){
			bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"با پرداخت هزینه می توانید حساب خود را ویژه کنید و لذت ببرید.
با پرداخت ۵هزارتومان، این ربات را به طور کامل و دائمی برای شما امکانات خودش را دراختیار می گذارد.
	
امکانات کاربری ویژه:
۱. تفکیک بندی گفتگو با شخص
۲. مشاهده پروفایل شخص
۳. چت با افراد نزدیک(gps)
۴. گفتگوی بدون محدودیت

*** حتما در قسمت شماره دانشجویی درگاه، شناسه اکانت خودتون رو وارد کنید تا بعد از بررسی حساب شما فعال شود وگرنه درصورت پرداخت نکردن، وجه قابل بازگشت نیست. ***
شناسه شما: $from_id


اگر هم مایل باشید، میتوانید از طریق دعوت کردن دوستانتان به ربات، حساب کاربری طلایی(ویژه) رو فعال کنید.",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"خرید",'url'=>"$meinipa"]
	],
              ]
        ])
    		]);
}
elseif ($vip == "") {
if($adds  >= 10 && $tc == "private"){
file_put_contents("data/$from_id/vip.txt","true");
file_put_contents("data/$from_id/vipbutton.txt","⭐️");
file_put_contents("data/$from_id/vipbutton2.txt","⭐️");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"مژده، حساب شما ویژه شد. دعوت های شما:$adds",
    		]);
}
}
if($bot=="⭐️" && $tc == "private"){
file_put_contents("data/$from_id/vipbutton.txt","");
file_put_contents("data/$from_id/vipbutton2.txt","");
		bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"شما هم اکنون حساب طلایی را دارید، شما محدودیتی در استفاده نخواهید داشت!",
     'reply_markup'=>json_encode([
            	'keyboard'=>[
			[
				['text'=>"گفتگوی ناشناس"],['text'=>"پروفایل"]
				],
								[
				['text'=>"دوستان من"],['text'=>"لیست سیاه من"]
				],
																[
				['text'=>"$vipbutton"],['text'=>"راهنما"],['text'=>"$vipbutton2"]
				],
				
 	],
            	'resize_keyboard'=>false
       		])
	]);
	}
if($bot=="/help" || $bot=="راهنما" && $tc == "private"){
				bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"این یک ربات دوست یابی هست که خیلی راحت می تونید با دکمه هایی که براتون قرار میگیره، از ربات استفاده کنید.
موقعی که بدون دعوت عضو ربات شده باشین، به شما ۳تا فرصت برای گفتگو داده میشه که با هربار وصل شدن و گفتگو کردن از فرصت های شما کم میشه.
اما اگه با دعوت کسی عضو شده باشین، ۵تا فرصت بهتون اهدا میشه و میتونین استفاده کنین.

قوانین گفتگو با اعضا پس از هربار متصل شدن به شخصی براتون ارسال میشه تا از توجه بهش کوتاهی رخ نده!

گفتگو با gps تنها بخش غیر رایگانی هست که نیاز به حساب طلایی ندارید و با ۵تا زیرمجموعه میتونید فعالش کنید.
یه حد وسط بین سطح نقره ای و طلایی هست.

⚡️ @MSXtm",
	]);
	}
	
//bot//

if($bot=="/panel"){
if(in_array($from_id,$Dev) != false) {
if ($tc == "private") {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"به پنل خوش آمدی",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"/status"],['text'=>"/set_vip"]                    
		 ],
 	[
	  	['text'=>"/s2a"],['text'=>"/forward2a"]
	  ],
	   	[
	  	['text'=>"برگشت"]
	  ],
   ],
      'resize_keyboard'=>false
   ])
 ]);
}
}
}
elseif($bot=="/status"){
    $mmemcount = count($members) -1 ;
	$member1 = file_get_contents("data/chat.txt");
	$member2 = explode("\n",$member1);
                        $how = count($member2) -1 ;
				bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"تعداد اعضا : $mmemcount
تعداد افراد در صف انتظار: $how",
                'hide_keyboard'=>true,
		]);
		}
elseif ($bot == '/s2a' ) {
if($from_id == $Dev['0']){
file_put_contents("data/$from_id/file.txt","sendtoall");
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت"] 
	]
   ],
      'resize_keyboard'=>false
   ])
 ]);
 }
}
elseif ($step == 'sendtoall') {
file_put_contents("data/$from_id/file.txt","none");
if ($bot != "برگشت") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
$mem = fopen( "Member.txt", 'r');
    while( !feof( $mem)) {
    $memuser = fgets( $mem);
     bot('sendmessage',[
          'chat_id'=>$memuser,        
		  'text'=>$bot,
        ]);
    }
}
}
elseif ($bot == '/forward2a') {
if($from_id == $Dev['0']){
file_put_contents("data/$from_id/file.txt","fortoall");
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را فوروارد کنید 🚀",
				  'reply_to_message_id'=>$message_id,
				   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت"] 
	]
   ],
      'resize_keyboard'=>false
   ])
    		]);
}
}
elseif ($step == 'fortoall') {
file_put_contents("data/$from_id/file.txt","none");
if ($bot != "برگشت") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
$mem = fopen( "Member.txt", 'r');
    while( !feof( $mem)) {
    $memuser = fgets( $mem);
Forward($memuser, $chat_id,$message_id);
    }
}
}
if ($bot == 'بازگشت') {
file_put_contents("data/$from_id.txt","none");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦ادمین عزیز به پنل مدریت ربات خوش امدید",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"/status"],['text'=>"/set_vip"]                    
		 ],
 	[
	  	['text'=>"/s2a"],['text'=>"/forward2a"]
	  ],
	   	[
	  	['text'=>"/whoisonline"],['text'=>"برگشت"]
	  ],
   ],
      'resize_keyboard'=>false
   ])
 ]);
}
elseif ($bot == '/set_vip') {
if($from_id == $Dev['0']){
file_put_contents("data/$from_id/file.txt","setvip");
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید🚀",
				  'reply_to_message_id'=>$message_id,
				     'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت"] 
	]
   ],
      'resize_keyboard'=>false
   ])
    ]);
    }
}
elseif ($step == 'setvip') {
if ($bot != "برگشت") {
if ($forward_from == true) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر با موفقیت ویژه شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username",
	  'reply_to_message_id'=>$message_id,
 ]);
file_put_contents("data/$forward_from_id/vip.txt","true");
file_put_contents("data/$forward_from_id/member.txt","10");
file_put_contents("data/$forward_from_id/vipbutton.txt","⭐️");
file_put_contents("data/$forward_from_id/vipbutton2.txt","⭐️");
file_put_contents("data/$from_id/file.txt","none");
bot('sendmessage',['chat_id'=>$forward_from_id,'text'=>"حساب کاربری شما با موفقیت به سطح طلایی ارتقا یافت.",]);
}
else
{
if ($bot != "برگشت") {
	         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر با موفقیت ویژه شد ✔️

🔹ایدی : $bot",
	  'reply_to_message_id'=>$message_id,
 ]);
file_put_contents("data/$bot/vip.txt","true");
file_put_contents("data/$bot/member.txt","10");
file_put_contents("data/$bot/vipbutton.txt","⭐️");
file_put_contents("data/$bot/vipbutton2.txt","⭐️");
file_put_contents("data/$from_id/file.txt","none");
bot('sendmessage',['chat_id'=>$bot,'text'=>"حساب کاربری شما با موفقیت به سطح طلایی ارتقا یافت.",]);
}
}
}
}
}

?>
