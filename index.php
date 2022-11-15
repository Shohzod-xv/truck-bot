<?php
include "vendor/db.php";
include "vendor/button.php";
define('API_KEY', 'BOT_TOKEN');
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$location = $message->location;
$lat = $location->latitude;
$long = $location->longitude;
$chatId = $message->chat->id;
$tx = $message->text;
$num = $message->contact->phone_number;
$miid = $message->message_id;
$num = $message->contact->phone_number;
$first_name = $message->from->first_name;
$user_id = $message->from->id;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$mmid = $callback->inline_message_id;
$cbid = $callback->from->id;
$data = $callback->data;
$otex = "❌ Bekor qilish";
$reg_otex = "✖️Bekor qilish";
$back = "⬅️ Ortga";
$bosh_menu = "🏡 Bosh Menu";
$btn = new Button();
if (tx("/start")) {
    bot('sendMessage', [
        'chat_id' => $chatId,
        'text' => "Assalomu alekum $first_name",
        'reply_markup' => $btn->home()
    ]);
    if (!check_user($user_id)) {
        query("INSERT INTO users(`user_id`,`first_name`,insert_at) values('{$user_id}','{$first_name}',NOW())");
    }
    if (!check_driver($user_id)) {
        query("Insert into driver(`user_id`, `insert_at`) values ('$user_id',NOW())");
    }
    if (!check_client($user_id)) {
        query("Insert into client(`user_id`, `insert_at`) values ('$user_id',NOW())");
    }
    query("Update driver Set `name` = null, `step` = 0 where user_id ='$user_id'");
    query("Update client Set `name` = null, `step_client` = 0 where user_id ='$user_id'");
}
$back2 = "🔙 Orqaga";
$reg =  "🔁 Qayta ro'yxatdan o'tish";
/** case data fio, phone, auto_type, auto_hajm, auto_number, send_loc, last_loc, delete_all_data*/
switch ($data){
    case "fio":
        query("Update driver Set `step` = 201 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Ism Familyani to'liq kiriting\n*Masalan:* `Olimjon`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->back($back2)
        ]);
        break;
    case "phone":
        query("Update driver Set `step` = 202 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Telefon raqamingizni kiriting\n*Masalan:* `998901234567`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->back($back2)
        ]);
        break;
    case "auto_type":
        query("Update driver Set `step` = 203 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Avtomobil turi kiriting\n*Masalan:* `Kamaz`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->auto($back2)
        ]);
        break;
    case "auto_hajm":
        query("Update driver Set `step` = 204 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Avtomobil hajmini kiriting\n*Masalan:* `15 tonna`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->tonna($back2)
        ]);
        break;
    case "auto_number":
        query("Update driver Set `step` = 205 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Avto raqamini kiriting\n*Masalan:* `90A123BA`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->back($back2)
        ]);
        break;
    case "send_loc":
        query("Update driver Set `step` = 206 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        $next = next_loc($cbid);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Yuk yuboriladigan manzilni yozing\n*Masalan:* `Toshkent shahri`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->regions($back2,$next)
        ]);
        break;
    case "last_loc":
        query("Update driver Set `step` = 207 where user_id ='$cbid'");
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "⚠️ Kiritayotgan ma'lumotlaringiz to'g'ri va tushunarli bo'sin bu foydalanuvchilarni sizga bo'lgan ishonchini oshiradi",
            'parse_mode' => 'markdown',
        ]);
        $send = send_loc($cbid);
        bot('sendMessage', [
            'chat_id' => $cbid,
            'text' => "Yukni yetkazish Joyni Manzilini kiriting\nMasalan: `Xorazm viloyati`",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->regions($back2,$send)
        ]);
        break;
    case "delete_all_data":
        driver_all_delete_date($cbid);
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "Barcha Ma'lumotlar o'chirildi"
        ]);
        home($cbid);
        break;
}
if ($tx && state($chatId,201) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        query("Update driver Set `fio` = '$tx', `step` = 0 where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Malumot o'zgartirildi*",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->reg($reg,$back)
        ]);
        anketa($chatId);
    }
}
elseif ($tx && state($chatId,202) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        if (substr($tx,0,3) == "998" && strlen($tx) == 12){
            query("Update driver Set `number` = '$tx', `step` = 0 where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*Malumot o'zgartirildi*",
                'parse_mode' => "Markdown",
                'reply_markup' => $btn->reg($reg, $back)
            ]);
            anketa($chatId);
        }else{
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "⚠️ Telefon raqamni to'g'ri kiriting\n*Masalan:* `998901234567`",
                'parse_mode' => "Markdown",
                'reply_markup' => $btn->back($back2)
            ]);
        }
    }
}
elseif ($tx && state($chatId,203) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        query("Update driver Set `auto_type` = '$tx', `step` = 0 where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Malumot o'zgartirildi*",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->reg($reg,$back)
        ]);
        anketa($chatId);
    }
}
elseif ($tx && state($chatId,204) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        query("Update driver Set `auto_hajm` = '$tx', `step` = 0 where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Malumot o'zgartirildi*",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->reg($reg,$back)
        ]);
        anketa($chatId);
    }
}
elseif ($tx && state($chatId,205) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        if (auto_number($tx) == true){
            query("Update driver Set `auto_num` = '$tx', `step` = 0 where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*Malumot o'zgartirildi*",
                'parse_mode' => "Markdown",
                'reply_markup' => $btn->reg($reg,$back)
            ]);
            anketa($chatId);
        }else{
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "⚠️ Avto raqamini to'g'ri kiriting\n*Masalan:* `90A123BA`",
                'parse_mode' => "Markdown",
                'reply_markup' => $btn->back($back2)
            ]);
        }
    }
}
elseif ($tx && state($chatId,206) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        query("Update driver Set `send_loc` = '$tx', `step` = 0 where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Malumot o'zgartirildi*",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->reg($reg,$back)
        ]);
        anketa($chatId);
    }
}
elseif ($tx && state($chatId,207) == true) {
    if ($tx == $back2){
        Otmen($chatId);
    }else {
        query("Update driver Set `next_loc` = '$tx', `step` = 0 where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Malumot o'zgartirildi*",
            'parse_mode' => "Markdown",
            'reply_markup' => $btn->reg($reg,$back)
        ]);
        anketa($chatId);
    }
}

if (tx("/anketa")){
    anketa($chatId);
}
if (tx("Haydovchiman")) {
    $db = query("
SELECT * FROM `driver` 
        WHERE `user_id` = '{$chatId}' 
           and `fio` != '' 
           and `number` != ''
         ");
    if (mysqli_num_rows($db) != 0) {
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "Siz ro'yxatdan o'tgansiz",
            'reply_markup' => $btn->reg($reg,$bosh_menu)
        ]);

        anketa($chatId);
    query("Update driver Set `step` = 0 where user_id ='$user_id'");
    } else {
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*Siz Ro'yxatdan o'tmagansiz*",
            'parse_mode' => 'markdown'
        ]);
        sleep(0.5);
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "To'liq ro'yxatdan o'tish uchun ishni boshlang\n\nRo'yhatdan o'tish tugmasini bosing",
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'keyboard' => [
                    [['text' => "Ro'yhatdan o'tish"]],
                    [['text' => $bosh_menu]]
                ]
            ]),
            'parse_mode' => 'markdown'
        ]);
        pstep($chatId,777);
        query("Update client Set `step` = 0 where user_id ='$user_id'");
    }
}
elseif (tx("Yuk Yuborish")){

    bot('sendMessage', [
        'chat_id' => $chatId,
        'text' => "Bu bo'limda siz O'zingizga kerakli manzilni tanlab kerakli haydovchi bilan boglanish imkoniyatiga ega bo'lasiz",
        'reply_markup' => json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "🔍 Qidiruv"]],
                [['text' => $bosh_menu]]
            ]
        ])
    ]);
    client_pstep($chatId,888);
    query("Update driver Set `step` = 0 where user_id ='$user_id'");
}elseif ($tx == $bosh_menu){
    home($chatId);
    client_pstep($chatId,0);
    pstep($chatId,0);
}
// ======== ======== =========  Ro'yxatdan o'tish
if (tx("🔁 Qayta ro'yxatdan o'tish") || (tx("Ro'yhatdan o'tish")) && pstep($chatId,777)) {
    driver_all_delete_date($chatId);
    if (tx("🔁 Qayta ro'yxatdan o'tish")){
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "Avvalgi barcha ma'lumotlaringiz o'chirildi qaytadan ro'yhatdan o'tish boshlandi",
        ]);
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "Ism Familtangizni kiriting\n\n*Masalan:* `Ivanov Ivan`",
            'reply_markup' => $btn->back($back),
            'parse_mode' => 'markdown'
        ]);
    }else{
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "Ism Familtangizni kiriting\n\n*Masalan:* `Ivanov Ivan`",
            'reply_markup' => $btn->back($reg_otex),
            'parse_mode' => 'markdown'
        ]);
    }
    pstep($chatId,1);
    if (!check_user($user_id)) {
        query("INSERT INTO users(`user_id`,`first_name`,insert_at) values('{$user_id}','{$first_name}',NOW())");
    }
}
elseif (tx($back)){
    home($chatId);
    driver_all_delete_date($chatId);
    query("Update client Set 
                     `name` = null, 
                     `step` = 0 
              where user_id ='$chatId'");
}
elseif (tx($reg_otex)){
    home($chatId);
    driver_all_delete_date($chatId);
    query("Update client Set `step` = 0 where user_id ='$chatId'");
}
elseif (tx($otex)){
    home($chatId);
    query("Update client Set `step` = 0 where user_id ='$chatId'");
}
else {
    switch ($tx) {
        case state($chatId, 1):
            query("Update driver Set `fio` = '$tx' where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*Telefon raqam kiriting*\n\n*Masalan:* `998901234567`",
                'reply_markup' => $btn->back($reg_otex),
                'parse_mode' => 'markdown'
            ]);
            pstep($chatId, 2);
            break;
        case state($chatId, 2):
            if (substr($num, 0, 3) == "998" && strlen($num) == 12) {
                query("UPDATE driver SET `number` = '$num',`update_at` = NOW() where user_id ='$chatId'");
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "Moshina raqamini yozing\n*Masalan:* `90A123BA`",
                    'parse_mode' => "markdown",
                    'reply_markup' => $btn->back($reg_otex),
                ]);
                pstep($chatId, 2);
            } elseif (substr($tx, 0, 3) == "998" && strlen($tx) == 12) {
                query("UPDATE driver SET `number` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "Moshina raqamini yozing\n*Masalan:* `90A123BA`",
                    'parse_mode' => "markdown",
                    'reply_markup' => $btn->back($reg_otex),
                ]);
                pstep($chatId, 3);
            } else {
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "⚠️ Telefon raqamni to'g'ri kiriting\n\n*Masalan:* `998901234567`",
                    'parse_mode' => 'markdown'
                ]);
            }
            break;
        case state($chatId, 3):
            if (auto_number($tx)) {
                query("UPDATE driver SET `auto_num` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "Moshina turini kitiring\n*Masalan:* `Kamaz`",
                    'parse_mode' => "markdown",
                    'reply_markup' => $btn->auto($reg_otex)
                ]);
                pstep($chatId, 4);
            } else {
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "⚠️ Moshina raqamini to'g'ri kiriting\n\n*Masalan:* `90A123BA`",
                    'parse_mode' => 'markdown'
                ]);
            }
            break;
        case state($chatId, 4):
            query("UPDATE driver SET `auto_type` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Avtomobile yuk hajmi qancha?\n*Masalan:* `10 tonna`",
                'parse_mode' => "markdown",
                'reply_markup' => $btn->tonna($reg_otex),
            ]);
            pstep($chatId, 5);
            break;
        case state($chatId, 5):
            query("UPDATE driver SET `auto_hajm` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*Qayerdan yo'lga chiqasiz?*\n\n*Masalan:* `Toshkent`",
                'reply_markup' => $btn->regions($reg_otex,$tx),
                'parse_mode' => "markdown",
            ]);
            pstep($chatId, 6);
            break;
        case state($chatId, 6):
            query("UPDATE driver SET `send_loc` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*Qaysi viloyatga borasiz?*\n\n*Masalan:* `Xorazm viloyati`",
                'reply_markup' => $btn->regions($reg_otex,$tx),
                'parse_mode' => "markdown",
            ]);
            pstep($chatId, 7);
            break;
        case state($chatId, 7):
            query("UPDATE driver SET `next_loc` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Kiritgan barcha ma'lumotlaringiz to'g'riligini tasdiqlang",
                'parse_mode' => "markdown",
            ]);
            sleep(0.2);
            $sorov = query("Select * from driver where user_id = '$user_id'");
            foreach ($sorov as $item){
                $id = $item['user_id'];
                $fio = $item['fio'];
                $number = $item['number'];
                $auto_num = $item['auto_num'];
                $auto_type = $item['auto_type'];
                $auto_hajm = $item['auto_hajm'];
                $send_loc = $item['send_loc'];
                $next_loc = $item['next_loc'];
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "<b>Haydovchi 🆔  #$id</b>

Fio: <b>$fio</b>
Telefon: <b>$number</b>

Automobile turi: <b>$auto_type</b>
Auto raqam: <b>$auto_num</b>
Yuk hajmi: <b>$auto_hajm</b>

📍 <b>$send_loc</b>dan 🔜 <b>$next_loc</b>ga boraman",
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [['text' => "✅ Tasdiqlash", 'callback_data' => "tasdiqlash"],['text' => "✍️ O'zgartirish", 'callback_data' => "ozgartirish"]],
                        ]
                    ]),
                    'parse_mode' => "html"
                ]);
            }
            break;
    }
}
// =========  =======  ==========  Yangi E'lon
if (tx("🔍 Qidiruv") && client_pstep($chatId,888)){
    bot('sendMessage',[
        'chat_id' => $chatId,
        'text' => "Telefon raqam yuboring\n*Masalan:* `998901234567`",
        'parse_mode' => "markdown",
        'reply_markup' => $btn->back($otex),
    ]);
    client_pstep($chatId, 887);
}elseif ($tx && client_state($chatId, 887)) {
    if (substr($tx, 0, 3) == "998" && strlen($tx) == 12) {
        query("UPDATE client SET `number` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "Yuk qayerdan chiqadi\n*Masalan:* `Toshkent viloyati`",
            'parse_mode' => "markdown",
            'reply_markup' => $btn->regions($otex,$tx),
        ]);
        client_pstep($chatId, 1);
    } else {
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "⚠️ Telefon raqamni to'g'ri kiriting\n\n*Masalan:* `998901234567`",
            'parse_mode' => "markdown",
            'reply_markup' => $btn->back($otex),
        ]);
    }
}
else {
    switch ($tx) {
        case client_state($chatId, 1):
            query("UPDATE client SET `send_loc` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Yuk qayerga borishi Kerak\n*Masalan:* `Xorazm viloyati`",
                'parse_mode' => "markdown",
                'reply_markup' => $btn->regions($otex,$tx),
            ]);
            client_pstep($chatId, 2);
            break;
        case client_state($chatId, 2):
            query("UPDATE client SET `next_loc` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Qanday turdagi moshina kerak?\n*Masalan:* `Kamaz`",
                'parse_mode' => "markdown",
                'reply_markup' => $btn->auto($otex),
            ]);
            client_pstep($chatId, 3);
            break;
        case client_state($chatId, 3):
            query("UPDATE client SET `auto_type` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Yuk hajmi qancha?\n*Masalan:* `5 tonna`",
                'parse_mode' => "markdown",
                'reply_markup' => $btn->tonna($otex),
            ]);
            client_pstep($chatId, 4);
            break;
        case client_state($chatId, 4):
            query("UPDATE client SET `auto_hajm` = '$tx',`update_at` = NOW() where user_id ='$chatId'");
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Kuting......",
            ]);
            $user_data = new user_data();
            $uid = $user_data->user_id($chatId);
            $number = $user_data->number($chatId);
            $send_loc = $user_data->send_loc($chatId);
            $next_loc = $user_data->next_loc($chatId);
            $auto_type = $user_data->auto_type($chatId);
            $auto_hajm = $user_data->auto_hajm($chatId);
            if (admin_list($chatId) == $chatId) {
                query("INSERT INTO second_client_data(`user_id`,`number`,`send_loc`,`next_loc`,`auto_type`,`auto_hajm`,`insert_at`,`status`,`rol`)
                                values ('$chatId','$number','$send_loc','$next_loc','$auto_type','$auto_hajm',NOW(),null,'admin')");
            }else{
                query("INSERT INTO second_client_data(`user_id`,`number`,`send_loc`,`next_loc`,`auto_type`,`auto_hajm`,`insert_at`,`status`,`rol`)
                                values ('$chatId','$number','$send_loc','$next_loc','$auto_type','$auto_hajm',NOW(),null,'client')");
            }
            sleep(1);
            $db = query("SELECT * FROM driver WHERE 
             `send_loc` = '$send_loc' && 
             `next_loc` = '$next_loc' &&
             `auto_type` = '$auto_type' &&
             `status` = 'active'");
            if (mysqli_num_rows($db) != 0) {
                foreach ($db as $item) {
                    $driver_id = $item['user_id'];
                    $fio = $item['fio'];
                    $send_loc = $item['send_loc'];
                    $next_loc = $item['next_loc'];
                    $auto_type = $item['auto_type'];
                    $auto_hajm = $item['auto_hajm'];
                    $auto_number = $item['auto_num'];
                    $phone = $item['number'];
                    bot('sendMessage', [
                        'chat_id' => $chatId,
                        'text' => "*Haydovchi 🆔  #$driver_id*\n\n📍 *$send_loc*dan ➡️ *$next_loc*ga boraman\n\n➖ Moshina turi: *$auto_type*\n➖ Moshina raqami: *$auto_number*\n➖ Yuk orish hajmi: *$auto_hajm*\n\n👨‍✈️ Ism Familya: *$fio*\n☎️ Telefon raqami: `$phone`",
                        'parse_mode' => "markdown",
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [['text' => "📞 Telefon qilish", 'url' => "http://twit.uz/Jalolbek/Site/?tel=+$phone"]]
                            ]
                        ]),
                    ]);
                }
                if ($chatId == admin_list($chatId)) {
                    query("UPDATE client SET `step` = 0,`update_at` = NOW() where user_id ='$chatId'");
                    query("UPDATE driver SET `step` = 0,`update_at` = NOW() where user_id ='$chatId'");
                    bot('sendMessage', [
                        'chat_id' => $chatId,
                        'text' => "Barcha haydovchilarga elon haqida habar bering",
                        'reply_markup' => json_encode([
                            'resize_keyboard' => true,
                            'keyboard' => [
                                [['text' => "Barcha haydovchilarga yuborish"]],
                                [['text' => "$otex"]],
                            ]
                        ]),
                    ]);
                }else{
                    query("UPDATE client SET `step` = 0,`update_at` = NOW() where user_id ='$chatId'");
                    query("UPDATE driver SET `step` = 0,`update_at` = NOW() where user_id ='$chatId'");
                    home($chatId);
                }
            } else {
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "*🙅‍♂️ Bazada bu yo'nalishda haydovchi topilmadi\nBoshqa Yo'nalishda qidirib ko'ring 🔍*",
                    'parse_mode' => "markdown",
                    'reply_markup' => json_encode([
                        'resize_keyboard' => true,
                        'keyboard' => [
                            [['text' => "🔍 Qidiruv"]],
                            [['text' => "$otex"]],
                        ]
                    ]),
                ]);
                client_pstep($chatId, 888);
            }
            break;
    }
}
if ($data == "tasdiqlash"){
    query("UPDATE driver SET `status` = 'progress',`update_at` = NOW() where user_id ='$cbid'");
    bot('editMessageText', [
        'chat_id' => $cbid,
        'message_id' => $mid,
        'inline_message_id' => $mmid,
        'text' => "<b>👨‍💻 Adminga muaffaqiyatli yuborildi</b>",
        'parse_mode' => "html"
    ]);
    bot('sendMessage', [
        'chat_id' => $cbid,
        'text' => "<b>⏳ Ko'rib chiqilmoqda...</b>",
        'parse_mode' => "html"
    ]);
    bot('sendMessage', [
        'chat_id' => $cbid,
        'text' => "<b>✅ Tasdiqlanishini kuting</b>",
        'parse_mode' => "html"
    ]);
    home($cbid);
    pstep($cbid, 111);
    $db = query("Select * from driver where user_id = '$cbid'");
    foreach ($db as $item) {
        $id = $item['user_id'];
        $fio = $item['fio'];
        $number = $item['number'];
        $auto_num = $item['auto_num'];
        $auto_type = $item['auto_type'];
        $auto_hajm = $item['auto_hajm'];
        $send_loc = $item['send_loc'];
        $next_loc = $item['next_loc'];
        $admin = query("SELECT user_id FROM `users` where status = 'admin'");
        foreach ($admin as $item) {
            bot('sendMessage', [
                'chat_id' => $item['user_id'],
                'text' => "<b>Haydovchi 🆔  #$id</b>

Fio: <b>$fio</b>
Telefon: <b>$number</b>

Automobile turi: <b>$auto_type</b>
Auto raqam: <b>$auto_num</b>
Yuk hajmi: <b>$auto_hajm</b>

📍 <b>$send_loc</b>dan 🔜 <b>$next_loc</b>ga boraman",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "✅ Tasdiqlash", 'callback_data' => "adminsuccess_$id"], ['text' => "❌ Bekor qilish", 'callback_data' => "admindanger_$id"]]
                    ]
                ]),
                'parse_mode' => "html"
            ]);
        }
    }
}
elseif ($data == "ozgartirish"){
    bot('editMessageText', [
        'chat_id' => $cbid,
        'message_id' => $mid,
        'inline_message_id' => $mmid,
        'text' => "<b>❗️ Malumot kititayotganda e'tiborli boling</b>",
        'parse_mode' => "html"
    ]);
    home($cbid);
    driver_all_delete_date($cbid);
}
if(mb_stripos($data, "adminsuccess")!==false) {
    $id = explode("_", $data)[1];
    $admin = query("SELECT user_id FROM `users` where status = 'admin'");
    $db = query("SELECT * FROM driver where (status = 'active') && (user_id = '{$id}')");
    if (mysqli_num_rows($db) == 0) {
        foreach ($admin as $item) {
            bot('deleteMessage', [
                'chat_id' => $item['user_id'],
                'message_id' => $mid,
            ]);
            bot('sendMessage', [
                'chat_id' => $item['user_id'],
                'text' => "<b>🆔 #$id</b> Haydovchi ma'lumotlari tasdiqlandi ✅",
                'parse_mode' => "html"
            ]);
        }
        query("UPDATE driver SET `status` = 'active',`update_at` = NOW() where user_id ='$id'");
        bot('sendMessage', [
            'chat_id' => $id,
            'text' => "<b>✅ Ma'lumot Admin tomonidan tasdiqlandi </b>",
            'parse_mode' => "html"
        ]);
    } else {
        bot('editMessageText', [
            'chat_id' => $cbid,
            'message_id' => $mid,
            'inline_message_id' => $mmid,
            'text' => "<b>🆔 #$id</b> Haydovchi malumotlari boshqa Admin tomonidan aktiv holatga keltirilgan",
            'parse_mode' => "html"
        ]);
    }
}
if (tx("Barcha haydovchilarga yuborish") && ($chatId == admin_list($chatId))){
    query("Update users Set `status` = 'admin' where user_id = '$chatId'");
    $user_data = new user_data();
    $number = $user_data->number($chatId);
    $send_loc = $user_data->send_loc($chatId);
    $next_loc = $user_data->next_loc($chatId);
    $auto_type = $user_data->auto_type($chatId);
    $auto_hajm = $user_data->auto_hajm($chatId);
    bot('sendMessage', [
        'chat_id' => $chatId,
        'text' => "*$send_loc -> $next_loc\n$auto_type -- $auto_hajm\n$number*",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "Xabar yuborish 📤", 'callback_data' => "send_all_data"]]
            ]
        ]),
        'parse_mode' => "markdown"
    ]);
}
if (($data == "send_all_data") && admin($cbid) == "admin"){
    $db = query("Select user_id from driver where status = 'active'");
    $user_data = new user_data();
    $number = $user_data->number($cbid);
    $send_loc = $user_data->send_loc($cbid);
    $next_loc = $user_data->next_loc($cbid);
    $auto_type = $user_data->auto_type($cbid);
    $auto_hajm = $user_data->auto_hajm($cbid);
    foreach ($db as $item) {
        $id = $item['user_id'];
        if ($id == $cbid){
            bot('editMessageText', [
                'chat_id' => $cbid,
                'message_id' => $mid,
                'inline_message_id' => $mmid,
                'text' => "Habar barcha faol haydovchilarga yuborildi ✅"
            ]);
        }else{
            bot('sendMessage', [
                'chat_id' => $id,
                'text' => "*#haydovchi_kerak*\n🚚 $auto_type -- $auto_hajm\n\n*📍 $send_loc -> $next_loc*",
                'parse_mode' => "markdown",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "📞 Bog'lanish", 'url' => "http://twit.uz/Jalolbek/Site/?tel=+$number"]]
                    ]
                ])
            ]);
        }
    }
    if (admin_list($cbid) == "admin"):
        query("Update second_client_data Set `status` = 'Yuborilgan xabar' where user_id = '$cbid' ORDER BY id DESC LIMIT 1");
    endif;
}
if ($tx == "/drivers" and admin($chatId) == "admin"){
    $db = query("Select * from driver");
    foreach ($db as $item) {
        $id = $item['user_id'];
        $name = $item['fio'];
        $status = $item['status'];
        switch ($status){
            case "active":
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "<b>Name: $name\n🆔 #$id\nStatus: 🟢 Faol</b>",
                    'parse_mode' => "html",
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [['text' => "❌", 'callback_data' => "inactiveDr_".$id."_".$name]]
                        ]
                    ])
                ]);
                break;
            case "inactive":
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "<b>Name: $name\n🆔 #$id\nStatus: 🔴 Faol emas</b>",
                    'parse_mode' => "html",
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [['text' => "✅", 'callback_data' => "activeDr_".$id."_".$name]]
                        ]
                    ])
                ]);
                break;
            case "progress":
                bot('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => "<b>Name: $name\n🆔 #$id\nStatus: 🟡 Tasdiqlanmoqda...</b>",
                    'parse_mode' => "html",
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [['text' => "✅", 'callback_data' => "activeDr_".$id."_".$name]],
                            [['text' => "❌", 'callback_data' => "inactiveDr_".$id."_".$name]]
                        ]
                    ])
                ]);
                break;
        }
    }
}
if(mb_stripos($data, "inactiveDr")!==false) {
    $id = explode("_", $data)[1];
    $name = explode("_", $data)[2];
    query("UPDATE driver SET `status` = 'inactive' where user_id ='$id'");
    bot('editMessageText', [
        'chat_id' => $cbid,
        'message_id' => $mid,
        'inline_message_id' => $mmid,
        'text' => "<b>Name: $name\n🆔 #$id\nStatus: 🔴 Faol emas</b>",
        'parse_mode' => "html",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "✅", 'callback_data' => "activeDr_".$id."_".$name]]
            ]
        ])
    ]);
}elseif (mb_stripos($data, "activeDr")!==false){
    $id = explode("_", $data)[1];
    $name = explode("_", $data)[2];
    query("UPDATE driver SET `status` = 'active' where user_id ='$id'");
    $db = query("SELECT * FROM driver where user_id = '$id')");
    bot('editMessageText', [
        'chat_id' => $cbid,
        'message_id' => $mid,
        'inline_message_id' => $mmid,
        'text' => "<b>Name: $name\n🆔 #$id\nStatus: 🟢 Faol</b>",
        'parse_mode' => "html",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "❌", 'callback_data' => "inactiveDr_".$id."_".$name]]
            ]
        ])
    ]);
}
