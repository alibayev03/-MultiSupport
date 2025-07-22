<?php

require_once __DIR__ . '/../bot/config.php';

// Функция для получения полного URL файла Telegram по file_id
function getTelegramFileUrl($file_id) {
    global $TOKEN;
    $response = file_get_contents("https://api.telegram.org/bot$TOKEN/getFile?file_id=$file_id");
    $data = json_decode($response, true);
    if (!empty($data['result']['file_path'])) {
        return "https://api.telegram.org/file/bot$TOKEN/" . $data['result']['file_path'];
    }
    return false;
}

// Удаление заявки
if (isset($_GET['delete_request'])) {
    $stmt = $pdo->prepare("DELETE FROM requests WHERE id = ?");
    $stmt->execute([$_GET['delete_request']]);
    header("Location: index.php");
    exit;
}

// Удаление пользователя
if (isset($_GET['delete_user'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['delete_user']]);
    header("Location: index.php");
    exit;
}

// Получаем данные
$requests = $pdo->query("SELECT * FROM requests ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #f0f0f0; }
        .delete-btn { color: red; text-decoration: none; }
        h1 { margin-top: 40px; }
        .stats { margin: 20px 0; font-size: 18px; }
        img.thumbnail {
            max-width: 80px;
            max-height: 80px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }
        /* Модальное окно */
        #photoModal {
            display: none;
            position: fixed; 
            z-index: 9999; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%;
            overflow: auto; 
            background-color: rgba(0,0,0,0.8);
            align-items: center;
            justify-content: center;
        }
        #photoModal span.closeBtn {
            position: absolute; 
            top: 20px; 
            right: 35px; 
            color: #fff; 
            font-size: 40px; 
            font-weight: bold; 
            cursor: pointer;
            user-select: none;
        }
        #photoModal img {
            margin: auto; 
            display: block; 
            max-width: 90%; 
            max-height: 90%; 
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>📋 Список заявок</h1>
    <div class="stats">
        Всего заявок: <?= count($requests) ?> | Пользователей: <?= count($users) ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Chat ID</th>
                <th>Проблема</th>
                <th>Блок</th>
                <th>Этаж</th>
                <th>Квартира</th>
                <th>Время</th>
                <th>Фото</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $r): ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= $r['chat_id'] ?></td>
                <td><?= htmlspecialchars($r['problem']) ?></td>
                <td><?= $r['block'] ?></td>
                <td><?= $r['floor'] ?></td>
                <td><?= $r['apartment'] ?></td>
                <td><?= $r['created_at'] ?></td>
                <td>
                    <?php if (!empty($r['photo'])): ?>
                        <?php
                        if (strpos($r['photo'], 'http') === 0) {
                            $photo_url = $r['photo'];
                        } else {
                            $photo_url = getTelegramFileUrl($r['photo']);
                        }
                        ?>
                        <?php if ($photo_url): ?>
                            <img src="<?= htmlspecialchars($photo_url) ?>" class="thumbnail" alt="Фото" onclick="showModal('<?= htmlspecialchars($photo_url) ?>')">
                        <?php else: ?>
                            <code><?= htmlspecialchars($r['photo']) ?></code>
                        <?php endif; ?>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td><a href="?delete_request=<?= $r['id'] ?>" class="delete-btn" onclick="return confirm('Удалить эту заявку?')">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1>👥 Список пользователей</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Chat ID</th>
                <th>Username</th>
                <th>Язык</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['chat_id'] ?></td>
                <td>@<?= htmlspecialchars($u['username']) ?></td>
                <td><?= $u['lang'] ?></td>
                <td><a href="?delete_user=<?= $u['id'] ?>" class="delete-btn" onclick="return confirm('Удалить этого пользователя?')">Удалить</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Модальное окно для фото -->
    <div id="photoModal" onclick="hideModal()">
        <span class="closeBtn" onclick="hideModal(); event.stopPropagation();">&times;</span>
        <img id="modalImg" src="" alt="Фото">
    </div>

    <script>
    function showModal(src) {
        var modal = document.getElementById('photoModal');
        var modalImg = document.getElementById('modalImg');
        modal.style.display = 'flex';
        modalImg.src = src;
    }

    function hideModal() {
        var modal = document.getElementById('photoModal');
        var modalImg = document.getElementById('modalImg');
        modal.style.display = 'none';
        modalImg.src = '';
    }

    // Чтобы клик по модальному окну закрывал его, а по картинке — нет
    document.getElementById('modalImg').onclick = function(event) {
        event.stopPropagation();
    };
    </script>

    <script>
        if (window.location.search.includes("delete_")) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
</body>
</html>
