<?php
require_once 'config.php';

// Получаем входящие данные
$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("log.txt", json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

// Загружаем сессии
$sessions = file_exists('session.json') ? json_decode(file_get_contents('session.json'), true) : [];
$langs = [
    'ru' => '🇷🇺 Русский',
    'en' => '🇬🇧 English',
    'uz' => '🇺🇿 O‘zbek',
    'ar' => '🇸🇦 العربية',
    'cn' => '🇨🇳 中文',
    'kr' => '🇰🇷 한국어',
    'tr' => '🇹🇷 Türkçe'
];


// Примеры заявок
$examples = [
    'ru' => "📋 *Пример заявки:*\nПроблема: Вода\nБлок: A\nЭтаж: 3\nКвартира: 27\nОписание: Течёт из крана",
    'en' => "📋 *Sample:*\nProblem: Water\nBlock: A\nFloor: 3\nApt: 27\nDescription: Leaking faucet",
    'uz' => "📋 *Namuna:*\nMuammo: Suv\nBlok: A\nQavat: 3\nKv: 27\nTavsif: Krandan suv chiqmoqda",
    'ar' => "📋 *مثال:*\nالمشكلة: ماء\nالبلوك: A\nالطابق: 3\nالشقة: 27\nالوصф: تسرب من الحنفية",
    'cn' => "📋 *示例:*\nПроблема: Вода\nБлок: A\nЭтаж: 3\nКвартира: 27\nОписание: Течёт из крана",
    'kr' => "📋 *예시:*\n문제: 물\n블록: A\n층: 3\n아파트: 27\n설명: 수도꼭지 누수",
    'tr' => "📋 *Örnek başvuru:*\nSorun: Su\nBlok: A\nKat: 3\nDaire: 27\nAçıklama: Musluk su sızdırıyor"
];








$phrases = [
    'ru' => "Добро пожаловать! Выберите действие:",
    'en' => "Welcome! Choose an action:",
    'uz' => "Xush kelibsiz! Harakatni tanlang:",
    'ar' => "مرحبًا! اختر إجراءً:",
    'cn' => "欢迎！请选择操作：",
    'kr' => "환영합니다! 작업을 선택하세요:",
    'tr' => "Hoş geldiniz! Bir işlem seçin:",

    'enter_problem' => [
        'ru' => "📝 Выберите тип проблемы:",
        'en' => "📝 Select the problem type:",
        'uz' => "📝 Muammo turini tanlang:",
        'ar' => "📝 اختر نوع المشكلة:",
        'cn' => "📝 选择问题类型：",
        'kr' => "📝 문제 유형을 선택하세요:",
        'tr' => "📝 Sorun türünü seçin:"
    ],
    'enter_block' => [
        'ru' => "🏢 Выберите блок (например: A)",
        'en' => "🏢 Select the block (e.g. A)",
        'uz' => "🏢 Blokni tanlang (masalan: A)",
        'ar' => "🏢 اختر البلوك (مثال: A)",
        'cn' => "🏢 选择楼栋（例如：A）",
        'kr' => "🏢 블록을 선택하세요 (예: A)",
        'tr' => "🏢 Blok seçin (örnek: A)"
    ],
    'enter_floor' => [
        'ru' => "🏬 Выберите этаж:",
        'en' => "🏬 Select the floor:",
        'uz' => "🏬 Qavatni tanlang:",
        'ar' => "🏬 اختر الطابق:",
        'cn' => "🏬 选择楼层：",
        'kr' => "🏬 층을 선택하세요:",
        'tr' => "🏬 Katı seçin:"
    ],
    'enter_apartment' => [
        'ru' => "🚪 Введите номер квартиры (например: 27):",
        'en' => "🚪 Enter the apartment number (e.g. 27):",
        'uz' => "🚪 Kvartira raqamini kiriting (masalan: 27):",
        'ar' => "🚪 أدخل رقم الشقة (مثال: 27):",
        'cn' => "🚪 输入房号（例如：27）：",
        'kr' => "🚪 아파트 번호를 입력하세요 (예: 27):",
        'tr' => "🚪 Daire numarasını girin (örnek: 27):"
    ],
    'check_data' => [
        'ru' => "📋 Проверьте данные:",
        'en' => "📋 Check the data:",
        'uz' => "📋 Ma’lumotlarni tekshiring:",
        'ar' => "📋 تحقق من البيانат:",
        'cn' => "📋 请检查数据：",
        'kr' => "📋 데이터를 확인하세요:",
        'tr' => "📋 Bilgileri kontrol edin:"
    ],
    'confirm_send' => [
        'ru' => "✅ Всё верно?",
        'en' => "✅ Is everything correct?",
        'uz' => "✅ Hammasi to‘g‘rimi?",
        'ar' => "✅ هل كل شيء صحيح؟",
        'cn' => "✅ 一切正确吗？",
        'kr' => "✅ 모두 맞습니까?",
        'tr' => "✅ Her şey doğru mu?"
    ],
    'start_required' => [
        'ru' => "⚠️ Нажмите /start, чтобы начать",
        'en' => "⚠️ Press /start to begin",
        'uz' => "⚠️ Boshlash uchun /start tugmasini bosing",
        'ar' => "⚠️ اضغط /start للبدء",
        'cn' => "⚠️ 点击 /start 开始",
        'kr' => "⚠️ 시작하려면 /start 를 누르세요",
        'tr' => "⚠️ Başlamak için /start yazın"
    ]


];

$phrases2['photo_attached'] = [
    'ru' => "📷 Фото: прикреплено",
    'en' => "📷 Photo: attached",
    'uz' => "📷 Rasm: biriktirildi",
    'ar' => "📷 الصورة: مرفقة",
    'cn' => "📷 照片：已附加",
    'kr' => "📷 사진: 첨부됨",
    'tr' => "📷 Fotoğraf: eklendi"
];



$msg_templates = [
    'ru' => "🔔 Новая заявка\n\nID: {id}\nПроблема: {problem}\nБлок: {block}\nЭтаж: {floor}\nКвартира: {apartment}\nСтатус: В ОЖИДАНИИ\n🕒 Время: {time}\n👤 Пользователь: @{user}",
    'en' => "🔔 New request\n\nID: {id}\nProblem: {problem}\nBlock: {block}\nFloor: {floor}\nApartment: {apartment}\nStatus: PENDING\n🕒 Time: {time}\n👤 User: @{user}",
    'uz' => "🔔 Yangi ariza\n\nID: {id}\nMuammo: {problem}\nBlok: {block}\nQavat: {floor}\nKvartira: {apartment}\nHolat: KUTILMOQDA\n🕒 Vaqt: {time}\n👤 Foydalanuvchi: @{user}",
    'ar' => "🔔 طلب جديد\n\nID: {id}\nالمشكلة: {problem}\nالبلوك: {block}\nالطابق: {floor}\nالشقة: {apartment}\nالحالة: قيد الانتظار\n🕒 الوقت: {time}\n👤 المستخدم: @{user}",
    'cn' => "🔔 新请求\n\nID: {id}\n问题: {problem}\n楼栋: {block}\n楼层: {floor}\n房号: {apartment}\n状态: 等待中\n🕒 时间: {time}\n👤 用户: @{user}",
    'kr' => "🔔 새 요청\n\nID: {id}\n문제: {problem}\n블록: {block}\n층: {floor}\n아파트: {apartment}\n상태: 대기 중\n🕒 시간: {time}\n👤 사용자: @{user}",
    'tr' => "🔔 Yeni talep\n\nID: {id}\nSorun: {problem}\nBlok: {block}\nKat: {floor}\nDaire: {apartment}\nDurum: BEKLEMEDE\n🕒 Zaman: {time}\n👤 Kullanıcı: @{user}"
];




$buttons = [
    'ru' => [
    'problem' => '🔧 Указать проблему',
    'submit'  => '✅ Отправить заявку',
    'edit'    => '✏️ Изменить',
    'attach_photo' => '📷 Прикрепить фото (необязательно)'
],
'en' => [
    'problem' => '🔧 Specify the problem',
    'submit'  => '✅ Submit request',
    'edit'    => '✏️ Edit',
    'attach_photo' => '📷 Attach photo (optional)'
],
'uz' => [
    'problem' => '🔧 Muammoni kiriting',
    'submit'  => '✅ Arizani yuborish',
    'edit'    => '✏️ O‘zgartirish',
    'attach_photo' => '📷 Rasm biriktirish (ixtiyoriy)'
],
'ar' => [
    'problem' => '🔧 حدد المشكلة',
    'submit'  => '✅ إرسال الطلب',
    'edit'    => '✏️ تعديل',
    'attach_photo' => '📷 أرفق صورة (اختياري)'
],
'cn' => [
    'problem' => '🔧 说明问题',
    'submit'  => '✅ 提交申请',
    'edit'    => '✏️ 修改',
    'attach_photo' => '📷 附加照片（可选）'
],
'kr' => [
    'problem' => '🔧 문제 입력',
    'submit'  => '✅ 요청 제출',
    'edit'    => '✏️ 수정',
    'attach_photo' => '📷 사진 첨부 (선택사항)'
],
'tr' => [
    'problem' => '🔧 Sorunu belirtin',
    'submit'  => '✅ Talebi gönder',
    'edit'    => '✏️ Düzenle',
    'attach_photo' => '📷 Fotoğraf ekle (isteğe bağlı)'
]


    
];





// Ответ на callback кнопки
if (isset($data['callback_query'])) {
    $cb = $data['callback_query'];
    $chat_id = $cb['from']['id'];
    $data_str = $cb['data'];
    $username = $cb['from']['username'] ?? 'Без username';

    if (!isset($sessions[$chat_id]['lang'])) {
        $sessions[$chat_id]['lang'] = 'ru'; // Устанавливаем русский как язык по умолчанию
    }
    $lang = $sessions[$chat_id]['lang'];

    // Выбор языка
    if (strpos($data_str, 'lang_') === 0) {
    $lang = str_replace('lang_', '', $data_str);
    $sessions[$chat_id] = ['lang' => $lang, 'step' => 'problem'];
    file_put_contents('session.json', json_encode($sessions));

    // Обновить переменную $lang после сохранения
    $lang = $sessions[$chat_id]['lang'];

    $keyboard = ['inline_keyboard' => [
        [['text' => getProblemLabel('electricity', $lang), 'callback_data' => 'problem_electricity']],
        [['text' => getProblemLabel('water', $lang), 'callback_data' => 'problem_water']],
        [['text' => getProblemLabel('heating', $lang), 'callback_data' => 'problem_heating']]
    ]];
    sendMessage($chat_id, $phrases['enter_problem'][$lang], false, $keyboard);
    exit;
}


    if ($data_str === 'set_problem') {
        $sessions[$chat_id]['step'] = 'problem';
        file_put_contents('session.json', json_encode($sessions));

        $keyboard = ['inline_keyboard' => [
            [['text' => '⚡ Электричество', 'callback_data' => 'problem_electricity']],
            [['text' => '💧 Вода', 'callback_data' => 'problem_water']],
            [['text' => '🔥 Отопление', 'callback_data' => 'problem_heating']]
        ]];
        sendMessage($chat_id, $phrases['enter_problem'][$lang], false, $keyboard);
        exit;
    }

    if (strpos($data_str, 'problem_') === 0) {
        $sessions[$chat_id]['problem'] = str_replace('problem_', '', $data_str);
        $sessions[$chat_id]['step'] = 'block';
        file_put_contents('session.json', json_encode($sessions));

        $keyboard = ['inline_keyboard' => [
            [['text' => 'A', 'callback_data' => 'block_A']],
            [['text' => 'B', 'callback_data' => 'block_B']],
            [['text' => 'C', 'callback_data' => 'block_C']],
            [['text' => 'E', 'callback_data' => 'block_E']]
        ]];
        sendMessage($chat_id, $phrases['enter_block'][$lang], false, $keyboard);
        exit;
    }
if (strpos($data_str, 'block_') === 0) {
    $block = str_replace('block_', '', $data_str);
    $sessions[$chat_id]['block'] = $block;
    $sessions[$chat_id]['step'] = 'floor';
    file_put_contents('session.json', json_encode($sessions));

    // Количество этажей по блоку
    $maxFloors = [
        'A' => 51,
        'B' => 25,
        'C' => 20,
        'E' => 7
    ];

    $floorLimit = $maxFloors[$block] ?? 10;

    $floorButtons = [];
    $row = [];
    for ($i = 1; $i <= $floorLimit; $i++) {
        $row[] = ['text' => "$i", 'callback_data' => "floor_$i"];
        if (count($row) === 5) {
            $floorButtons[] = $row;
            $row = [];
        }
    }
    if (!empty($row)) $floorButtons[] = $row;

    $keyboard = ['inline_keyboard' => $floorButtons];
    sendMessage($chat_id, $phrases['enter_floor'][$lang], false, $keyboard);
    exit;
}


    if (strpos($data_str, 'floor_') === 0) {
        $sessions[$chat_id]['floor'] = str_replace('floor_', '', $data_str);
        $sessions[$chat_id]['step'] = 'apartment';
        file_put_contents('session.json', json_encode($sessions));

        sendMessage($chat_id, $phrases['enter_apartment'][$lang]);
        exit;
    }

if ($data_str === 'attach_photo') {
    $sessions[$chat_id]['step'] = 'awaiting_photo';
    file_put_contents('session.json', json_encode($sessions));

    $lang = $sessions[$chat_id]['lang'] ?? 'ru';

    $photoPrompts = [
        'ru' => "📸 Отправьте фото как файл или нажмите ❌ чтобы пропустить.",
    'en' => "📸 Send the photo as a file or press ❌ to skip.",
    'uz' => "📸 Rasmni fayl sifatida yuboring yoki ❌ tugmasini bosib o'tkazib yuboring.",
    'ar' => "📸 أرسل الصورة كملف أو اضغط ❌ لتخطي.",
    'cn' => "📸 作为文件发送照片，或点击 ❌ 跳过。",
    'kr' => "📸 사진을 파일로 보내거나 ❌ 건너뛰기를 누르세요.",
    'tr' => "📸 Fotoğrafı dosya olarak gönderin veya ❌ tuşuna basarak atlayın."
    ];

    $skipButtonLabels = [
        'ru' => '❌ Пропустить',
        'en' => '❌ Skip',
        'uz' => '❌ O‘tkazib yuborish',
        'ar' => '❌ تخطي',
        'cn' => '❌ 跳过',
        'kr' => '❌ 건너뛰기',
        'tr' => '❌ Atla'
    ];

    sendMessage($chat_id, $photoPrompts[$lang] ?? $photoPrompts['en'], false, [
        'inline_keyboard' => [
            [['text' => $skipButtonLabels[$lang] ?? $skipButtonLabels['en'], 'callback_data' => 'skip_photo']]
        ]
    ]);

    exit;
}




if ($data_str === 'skip_photo') {
    $sessions[$chat_id]['step'] = 'ready';
    file_put_contents('session.json', json_encode($sessions));

    $s = $sessions[$chat_id];
    $lang = $s['lang'];

$preview = $phrases['check_data'][$lang] . "\n"
    . "🔧 " . getProblemLabel($s['problem'], $lang) . "\n"
    . "🏢 " . $s['block'] . "\n"
    . "🏬 " . $s['floor'] . "\n"
    . "🚪 " . $s['apartment'] . "\n\n"
    . $phrases['confirm_send'][$lang];


    $btn = ['inline_keyboard' => [[
        ['text' => $buttons[$lang]['edit'], 'callback_data' => 'edit_request'],
        ['text' => $buttons[$lang]['submit'], 'callback_data' => 'submit_request']
    ]]];

    sendMessage($chat_id, $preview, false, $btn);
    exit;
}

if ($data_str === 'edit_request') {
    // Переводим пользователя на шаг выбора проблемы
    $sessions[$chat_id]['step'] = 'problem';
    file_put_contents('session.json', json_encode($sessions));

    $keyboard = ['inline_keyboard' => [
        [['text' => getProblemLabel('electricity', $lang), 'callback_data' => 'problem_electricity']],
        [['text' => getProblemLabel('water', $lang), 'callback_data' => 'problem_water']],
        [['text' => getProblemLabel('heating', $lang), 'callback_data' => 'problem_heating']]
    ]];

    sendMessage($chat_id, $phrases['enter_problem'][$lang], false, $keyboard);
    exit;
}

    
if ($data_str === 'submit_request') {
    $s = $sessions[$chat_id];
    $lang = $s['lang'] ?? 'ru';

    // Проверка обязательных полей
    $requiredFields = ['problem', 'block', 'floor', 'apartment'];
    foreach ($requiredFields as $field) {
        if (empty($s[$field])) {
            sendMessage($chat_id,
"❌ Заполните все поля перед отправкой!\n" .
"❌ Please fill in all fields before submitting!\n" .
"❌ Yuborishdan oldin barcha maydonlarni to‘ldiring!\n" .
"❌ الرجاء ملء جميع الحقول قبل الإرسال!\n" .
"❌ 提交前请填写所有字段！\n" .
"❌ 제출하기 전에 모든 항목을 입력하세요!\n" .
"❌ Lütfen göndermeden önce tüm alanları doldurun!",

    false
);

            exit;
        }
    }

    $req_id = "REQ-" . date("Y") . "-" . rand(10000, 99999);

   $stmt = $pdo->prepare("INSERT INTO requests (chat_id, problem, block, floor, apartment, photo) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $chat_id,
    getProblemLabelRu($s['problem']),
    $s['block'],
    $s['floor'],
    $s['apartment'],
    $s['photo'] ?? null
]);



// Для группы (всегда по-русски)
$msg_ru = str_replace(
    ['{id}', '{problem}', '{block}', '{floor}', '{apartment}', '{time}', '{user}'],
    [$req_id, getProblemLabelRu($s['problem']), $s['block'], $s['floor'], $s['apartment'], date("d.m.Y H:i"), $username],
    $msg_templates['ru']
);

// Для пользователя (на его языке)
$msg_user = str_replace(
    ['{id}', '{problem}', '{block}', '{floor}', '{apartment}', '{time}', '{user}'],
    [$req_id, getProblemLabel($s['problem'], $lang), $s['block'], $s['floor'], $s['apartment'], date("d.m.Y H:i"), $username],
    $msg_templates[$lang]
);




   // Отправка в группу — всегда на русском
file_get_contents("https://api.telegram.org/bot$TOKEN/sendMessage?" . http_build_query([
    'chat_id' => $group_chat_id,
    'text' => $msg_ru
]));

if (!empty($s['photo'])) {
    file_get_contents("https://api.telegram.org/bot$TOKEN/sendDocument?" . http_build_query([
        'chat_id' => $group_chat_id,
        'document' => $s['photo'],
        'caption' => "📎 Фото по заявке: $req_id"
    ]));
}





    $successMessages = [
    'ru' => "✅ Заявка отправлена!",
    'en' => "✅ Request submitted!",
    'uz' => "✅ Ariza yuborildi!",
    'ar' => "✅ تم إرسال الطلب!",
    'cn' => "✅ 申请已提交！",
    'kr' => "✅ 요청이 제출되었습니다!"
];

sendMessage($chat_id, $successMessages[$lang] . "\n\n" . $msg_user);



    unset($sessions[$chat_id]);
    file_put_contents('session.json', json_encode($sessions));
    exit;
}



}

// Обработка текстовых сообщений
if (isset($data['message'])) {
    $chat_id = $data['message']['chat']['id'];
    $text = trim($data['message']['text']);
    $username = $data['message']['from']['username'] ?? 'Без username';

    // Команда /start
    // Команда /start
if ($text === '/start') {
    unset($sessions[$chat_id]);
    file_put_contents('session.json', json_encode($sessions));

    // ✅ Добавляем пользователя в базу, если его ещё нет
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE chat_id = ?");
    $stmt->execute([$chat_id]);
    if ($stmt->fetchColumn() == 0) {
        $langDefault = 'ru';
        $insert = $pdo->prepare("INSERT INTO users (chat_id, username, lang) VALUES (?, ?, ?)");
        $insert->execute([$chat_id, $username, $langDefault]);
    }

    // Вывод выбора языка
    $buttons = [];
    foreach ($langs as $code => $label) {
        $buttons[] = [['text' => $label, 'callback_data' => 'lang_' . $code]];
    }
    sendMessage($chat_id, "🌐 Выберите язык:", false, ['inline_keyboard' => $buttons]);
    exit;
}


if ((isset($data['message']['photo']) || isset($data['message']['document'])) &&
    isset($sessions[$chat_id]) && $sessions[$chat_id]['step'] === 'awaiting_photo') {

    if (isset($data['message']['photo'])) {
        // Получаем file_id самого большого фото
        $photos = $data['message']['photo'];
        $file_id = end($photos)['file_id'];
    } elseif (isset($data['message']['document'])) {
        // Получаем file_id документа
        $file_id = $data['message']['document']['file_id'];
    }

    // Получаем URL файла
    $getFile = json_decode(file_get_contents("https://api.telegram.org/bot$TOKEN/getFile?file_id=$file_id"), true);
    if (!empty($getFile['result']['file_path'])) {
        $file_path = $getFile['result']['file_path'];
        $photo_url = "https://api.telegram.org/file/bot$TOKEN/$file_path";
        $sessions[$chat_id]['photo'] = $file_id;

    }

    $sessions[$chat_id]['step'] = 'ready';
    file_put_contents('session.json', json_encode($sessions));

    // Показать превью заявки снова
    $s = $sessions[$chat_id];
    $lang = $s['lang'];

    $preview = $phrases['check_data'][$lang] . "\n"
       . "🔧 " . getProblemLabel($s['problem'], $lang) . "\n"
        . "🏢 " . $s['block'] . "\n"
        . "🏬 " . $s['floor'] . "\n"
        . "🚪 " . $s['apartment'] . "\n"
        . $phrases2['photo_attached'][$lang] . "\n\n"

        . $phrases['confirm_send'][$lang];

    $btn = ['inline_keyboard' => [[
        ['text' => $buttons[$lang]['edit'], 'callback_data' => 'edit_request'],
        ['text' => $buttons[$lang]['submit'], 'callback_data' => 'submit_request']
    ]]];
    sendMessage($chat_id, $preview, false, $btn);
    exit;
}

    

    // Продолжение заполнения
    if (isset($sessions[$chat_id])) {
        $s = &$sessions[$chat_id];
        $lang = $s['lang'] ?? 'ru';

        switch ($s['step']) {
   case 'apartment':
    $s['apartment'] = $text;
   
    $s['step'] = 'ready';

    $preview = $phrases['check_data'][$lang] . "\n"
       . "🔧 " . getProblemLabel($s['problem'], $lang) . "\n"
        . "🏢 " . $s['block'] . "\n"
        . "🏬 " . $s['floor'] . "\n"
        . "🚪 " . $s['apartment'] . "\n\n"
        . $phrases['confirm_send'][$lang];

    $btn = ['inline_keyboard' => [
    [['text' => $buttons[$lang]['attach_photo'], 'callback_data' => 'attach_photo']],
    [['text' => $buttons[$lang]['edit'], 'callback_data' => 'edit_request'],
     ['text' => $buttons[$lang]['submit'], 'callback_data' => 'submit_request']]
]];

    sendMessage($chat_id, $preview, false, $btn);
    break;

        }

        file_put_contents('session.json', json_encode($sessions));
        exit;
    }

    // Если нет сессии
    sendMessage($chat_id, "⚠️ Нажмите /start, чтобы начать");
}
exit;

// === ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ ===
function sendMessage($chat_id, $text, $markdown = false, $keyboard = null) {
    global $TOKEN;
    $data = ['chat_id' => $chat_id, 'text' => $text];
    if ($markdown) $data['parse_mode'] = 'Markdown';
    if ($keyboard) $data['reply_markup'] = json_encode($keyboard);
    file_get_contents("https://api.telegram.org/bot$TOKEN/sendMessage?" . http_build_query($data));
}

function showMainMenu($chat_id, $lang) {
    global $examples, $phrases, $buttons;

    $keyboard = ['inline_keyboard' => [
        [['text' => $buttons[$lang]['problem'], 'callback_data' => 'set_problem']],
        [['text' => $buttons[$lang]['submit'], 'callback_data' => 'submit_request']]
    ]];

    sendMessage($chat_id, $examples[$lang], true);
    sendMessage($chat_id, $phrases[$lang], false, $keyboard);
}

function getProblemLabel($type, $lang) {
   $labels = [
    'electricity' => [
        'ru' => '⚡ Электричество',
        'en' => '⚡ Electricity',
        'uz' => '⚡ Elektr',
        'ar' => '⚡ الكهرباء',
        'cn' => '⚡ 电力',
        'kr' => '⚡ 전기',
        'tr' => '⚡ Elektrik'
    ],
    'water' => [
        'ru' => '💧 Вода',
        'en' => '💧 Water',
        'uz' => '💧 Suv',
        'ar' => '💧 ماء',
        'cn' => '💧 水',
        'kr' => '💧 물',
        'tr' => '💧 Su'
    ],
    'heating' => [
        'ru' => '🔥💧 Кондиционер',
        'en' => '🔥💧 Air conditioner',
        'uz' => '🔥💧 Konditsioner tizimi',
        'ar' => '🔥💧 مكيف الهواء',
        'cn' => '🔥💧 空调系统',
        'kr' => '🔥💧 에어컨 시스템',
        'tr' => '🔥💧 Klima sistemi'
    ]
];


    return $labels[$type][$lang] ?? $labels[$type]['en'];
}

function getProblemLabelRu($type) {
    $labels = [
        'electricity' => '⚡ Электричество',
        'water' => '💧 Вода',
        'heating' => '🔥💧 Кондиционер'
    ];
    return $labels[$type] ?? $type;
}


?>