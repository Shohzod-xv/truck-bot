<?php
function tx($shart){
    global $tx;
    return $tx == $shart;
}
function admin($chatID){
    $db = query("Select status from users WHERE user_id = '$chatID'");
    foreach ($db as $item):
        return $item['status'];
    endforeach;
}
function admin_list($chat_id){
    $admin = query("SELECT user_id FROM `users` where status = 'admin' && `user_id` = '{$chat_id}'");
    foreach ($admin as $item):
        return $item['user_id'];
    endforeach;
}
function driver_all_delete_date($chatId){
    return query("Update driver Set 
                  `fio` = null, 
                  `number` = null, 
                  `auto_num` = null, 
                  `auto_type` = null, 
                  `auto_hajm` = null, 
                  `send_loc` = null, 
                  `next_loc` = null, 
                  `status` = 'inactive',
                  `step` = 0 
              where user_id ='$chatId'");
}
function query($sorov){
    global $conn;
    return mysqli_query($conn,$sorov);
}
function check_user($user_id){
    $a = query("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
    if (mysqli_num_rows($a) == 0)
        return false;
    else
        return true;
}
function check_driver($chatId)
{
    $a = query("SELECT * FROM `driver` WHERE `user_id` = '{$chatId}'");
    if (mysqli_num_rows($a) == 0)
        return false;
    else
        return true;
}
function check_client($chatId)
{
    $a = query("SELECT * FROM `client` WHERE `user_id` = '{$chatId}'");
    if (mysqli_num_rows($a) == 0)
        return false;
    else
        return true;
}
function step($chatId){
    $sorov= query("Select step From `driver` Where user_id ='{$chatId}' ");
    foreach ($sorov as $s):
        return $s['step'];
    endforeach;
}
function state($chatId, $num){
    $n = step($chatId) == $num;
    return $n;
}
function pstep($chatId,$num){
    return query("Update driver Set step = '{$num}' where `user_id` = '{$chatId}'");
}
function client_step($chatId)
{
    $sorov= query("Select step From `client` Where user_id ='{$chatId}' ");
    foreach ($sorov as $s)
    {
        return $s['step'];
    }
}
function client_state($chatId, $num)
{
    return client_step($chatId) == $num;
}
function client_pstep($chatId,$num)
{
    return query("Update client Set step = '{$num}' where `user_id` = '{$chatId}'");
}
function home($chat_id)
{
    return bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "<b>🏡 Bosh Menu</b>",
        'reply_markup' => json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "Yuk Yuborish"],['text' => "Haydovchiman"]],
            ]
        ]),
        'parse_mode' => "html"
    ]);
}
function anketa($chatId)
{
    $db = query("Select * from driver where user_id = '$chatId'");
    while ($row = mysqli_fetch_array($db)) {
        $driver_id = $row['user_id'];
        $fio = $row['fio'];
        $phone = $row['number'];
        $auto_type = $row['auto_type'];
        $auto_hajm = $row['auto_hajm'];
        $auto_number = $row['auto_num'];
        $send_loc = $row['send_loc'];
        $next_loc = $row['next_loc'];
        $status = $row['status'];
        if ($status == "active"){
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Sizning ma'lumotlaringiz\n<b>Sizning 🆔  #$driver_id\nStatus: 🟢 Faol\n\n1. Ism Familya: </b> $fio\n<b>2. Telefon:</b> $phone\n\n<b>3. Avto turi:</b> $auto_type\n<b>4. Avto hajmi:</b> $auto_hajm\n<b>5. Avto raqami:</b> $auto_number\n<b>6. Yuborish manzili:</b> $send_loc\n<b>7. Qabul qilish manzili:</b> $next_loc\n\n📝 Quyidagi tugamalar orqali barcha ma'lumotlarni o'zgartishingiz mumkin",
                'parse_mode' => 'html',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "1️⃣", 'callback_data' => "fio"], ['text' => "2️⃣", 'callback_data' => "phone"],['text' => "3️⃣", 'callback_data' => "auto_type"],['text' => "4️⃣", 'callback_data' => "auto_hajm"]],
                        [['text' => "5️⃣", 'callback_data' => "auto_number"],['text' => "6️⃣", 'callback_data' => "send_loc"],['text' => "7️⃣", 'callback_data' => "last_loc"],['text' => "🗑", 'callback_data' => "delete_all_data"]]
                    ]
                ])
            ]);
        }elseif ($status == "progress"){
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Sizning ma'lumotlaringiz\n<b>Sizning 🆔  #$driver_id\nStatus: 🟡 Ko'rib chiqilmoqda..\n\n1. Ism Familya: </b> $fio\n<b>2. Telefon:</b> $phone\n\n<b>3. Avto turi:</b> $auto_type\n<b>4. Avto hajmi:</b> $auto_hajm\n<b>5. Avto raqami:</b> $auto_number\n<b>6. Yuborish manzili:</b> $send_loc\n<b>7. Qabul qilish manzili:</b> $next_loc\n\n📝 Quyidagi tugamalar orqali barcha ma'lumotlarni o'zgartishingiz mumkin",
                'parse_mode' => 'html',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "1️⃣", 'callback_data' => "fio"], ['text' => "2️⃣", 'callback_data' => "phone"],['text' => "3️⃣", 'callback_data' => "auto_type"],['text' => "4️⃣", 'callback_data' => "auto_hajm"]],
                        [['text' => "5️⃣", 'callback_data' => "auto_number"],['text' => "6️⃣", 'callback_data' => "send_loc"],['text' => "7️⃣", 'callback_data' => "last_loc"],['text' => "🗑", 'callback_data' => "delete_all_data"]]
                    ]
                ])
            ]);
        }elseif ($status == "inactive"){
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "Sizning ma'lumotlaringiz\n<b>Sizning 🆔  #$driver_id\nStatus: 🔴 Faol Emas\n\n1. Ism Familya: </b> $fio\n<b>2. Telefon:</b> $phone\n\n<b>3. Avto turi:</b> $auto_type\n<b>4. Avto hajmi:</b> $auto_hajm\n<b>5. Avto raqami:</b> $auto_number\n<b>6. Yuborish manzili:</b> $send_loc\n<b>7. Qabul qilish manzili:</b> $next_loc\n\n📝 Quyidagi tugamalar orqali barcha ma'lumotlarni o'zgartishingiz mumkin",
                'parse_mode' => 'html',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "1️⃣", 'callback_data' => "fio"], ['text' => "2️⃣", 'callback_data' => "phone"],['text' => "3️⃣", 'callback_data' => "auto_type"],['text' => "4️⃣", 'callback_data' => "auto_hajm"]],
                        [['text' => "5️⃣", 'callback_data' => "auto_number"],['text' => "6️⃣", 'callback_data' => "send_loc"],['text' => "7️⃣", 'callback_data' => "last_loc"],['text' => "🗑", 'callback_data' => "delete_all_data"]]
                    ]
                ])
            ]);
        }

    }

}
function Otmen($chatId){
    pstep($chatId, 0);
    bot('sendMessage', [
        'chat_id' => $chatId,
        'text' => "Bosh Menu",
        'reply_markup' => json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "Yuk Yuborish"], ['text' => "Haydovchiman"]],
            ]
        ])
    ]);
}
function auto_number($tx){
    if (substr($tx, 0, 2) == ("01" || "10" || "20" || "30" || "40" || "50" || "60" || "70" || "80" || "90" || "95") && (strlen($tx) == 8)){
        return true;
    }else{
        return false;
    }
}
function send_loc($chatId){
    $db = query("Select send_loc from driver where user_id = '{$chatId}'");
    foreach ($db as $item):
        return $item['send_loc'];
    endforeach;
}
function next_loc($chatId){
    $db = query("Select next_loc from driver where user_id = '{$chatId}'");
    foreach ($db as $item):
        return $item['next_loc'];
    endforeach;
}
class user_data{
    public function send_loc($chat_id){
        $db = query("SELECT `send_loc` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['send_loc'];
        endforeach;
    }
    public function user_id($chat_id){
        $db = query("SELECT `user_id` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['user_id'];
        endforeach;
    }
    public function next_loc($chat_id){
        $db = query("SELECT `next_loc` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['next_loc'];
        endforeach;
    }
    /** function auto_type foreach return auto_type */
    public function auto_type($chat_id)
    {
        $db = query("SELECT `auto_type` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['auto_type'];
        endforeach;
    }
    /** function auto_hajm foreach return auto_hajm */
    public function auto_hajm($chat_id)
    {
        $db = query("SELECT `auto_hajm` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['auto_hajm'];
        endforeach;
    }
    public function number($chat_id)
    {
        $db = query("SELECT `number` FROM `client` WHERE `user_id` = '{$chat_id}'");
        foreach ($db as $item):
            return $item['number'];
        endforeach;
    }
}
