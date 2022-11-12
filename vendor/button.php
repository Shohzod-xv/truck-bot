<?php

class Button
{
    public function home()
    {
        return json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "Yuk Yuborish"],['text' => "Haydovchiman"]],
            ]
        ]);
    }
    public function reg($reg,$back2)
    {
        return json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => $reg]],
                [['text' => $back2]],
            ]
        ]);
    }
    public function regions($back,$region_name)
    {
        switch ($region_name) {
            case "Xorazm viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Qoraqalpog`iston Respublikasi"]],
                        [['text' => "Toshkent shahri"], ['text' => "Andijon viloyati"]],
                        [['text' => "Qashqadaryo viloyati"], ['text' => "Farg`ona viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Qoraqalpog`iston Respublikasi":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Toshkent shahri"], ['text' => "Andijon viloyati"]],
                        [['text' => "Qashqadaryo viloyati"], ['text' => "Farg`ona viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Toshkent shahri":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Andijon viloyati"]],
                        [['text' => "Qashqadaryo viloyati"], ['text' => "Farg`ona viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Andijon viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Qashqadaryo viloyati"], ['text' => "Farg`ona viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Qashqadaryo viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Farg`ona viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Farg`ona viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Namangan viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Namangan viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Surxondaryo viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Surxondaryo viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Sirdaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Sirdaryo viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Samarqand viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Samarqand viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Navoiy viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Navoiy viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Samarqand viloyati"], ['text' => "Jizzax viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Jizzax viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Samarqand viloyati"], ['text' => "Navoiy viloyati"]],
                        [['text' => "Buxoro viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Buxoro viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Samarqand viloyati"], ['text' => "Navoiy viloyati"]],
                        [['text' => "Jizzax viloyati"], ['text' => "Toshkent viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            case "Toshkent viloyati":
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Samarqand viloyati"], ['text' => "Navoiy viloyati"]],
                        [['text' => "Jizzax viloyati"], ['text' => "Buxoro viloyati"]],
                        [['text' => "$back"]],
                    ]
                ]);
                break;
            default:
                return json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Xorazm viloyati"]],
                        [['text' => "Qoraqalpog`iston Respublikasi"], ['text' => "Toshkent shahri"]],
                        [['text' => "Andijon viloyati"], ['text' => "Qashqadaryo viloyati"]],
                        [['text' => "Farg`ona viloyati"], ['text' => "Namangan viloyati"]],
                        [['text' => "Surxondaryo viloyati"], ['text' => "Sirdaryo viloyati"]],
                        [['text' => "Samarqand viloyati"], ['text' => "Navoiy viloyati"]],
                        [['text' => "Jizzax viloyati"], ['text' => "Buxoro viloyati"]],
                        [['text' => "Toshkent viloyati"]],
                    ]
                ]);
                break;
        }
    }
    public function back($back)
    {
        return json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "$back"]],
            ]
        ]);
    }
    public function auto($back)
    {
        return json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "Kamaz"], ['text' => "Shackman"]],
                [['text' => "Isuzu"], ['text' => "Fura"]],
                [['text' => "$back"]]
            ]
        ]);
    }
    public function tonna($back)
    {
        return json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "5t"], ['text' => "8t"], ['text' => "10t"], ['text' => "12t"]],
                [['text' => "15t"], ['text' => "20t"], ['text' => "25t"], ['text' => "30t"]],
                [['text' => "40t"], ['text' => "50t"], ['text' => "60t"]],
                [['text' => "$back"]]
            ]
        ]);
    }
}
