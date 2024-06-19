<?php 
/**
 * 前端文件
 * BY：Sensen
 */
$directoryPath = './';
require './core/core.php'; ?>
<?php
// 读取JSON文件
$webFile = './config/web.json';
$web = json_decode(file_get_contents($webFile), true);

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $web['title'] = $_POST['title'];
    $web['keywords'] = $_POST['keywords'];
    file_put_contents($webFile, json_encode($web, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../core/favicon.ico" type ="image/x-icon">
    <title><?php echo htmlspecialchars($web['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlspecialchars($web['keywords']); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .software-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        .software-card img {
            max-width: 100%;
            border-radius: 8px;
        }
        .software-card h2 {
            margin-top: 0;
        }
        .software-card a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .layout-default .software-card img,
        .layout-grid .software-card img {
            width: 100%;
            max-height: 150px; /* 调整这个值以控制高度 */
            object-fit: cover;
            margin-bottom: 10px;
        }
        .layout-vertical .software-card {
            display: flex;
            align-items: center;
        }
        .layout-vertical .software-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .layout-vertical .software-info {
            flex-grow: 1;
        }
        .layout-vertical .software-card a {
            margin-left: auto;
        }
        .layout-grid .software-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .layout-grid .software-card a {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $json = file_get_contents('./config/data.json');
        if ($json === false) {
            die('无法读取 数据库 文件');
        }
        $softwareList = json_decode($json, true);
        if ($softwareList === null) {
            die('数据库文件读取失败或者还没有数据！');
        }
        $layout = file_exists('./config/layout.txt') ? file_get_contents('./config/layout.txt') : 'default';
        ?>
        <div class="software-list layout-<?php echo htmlspecialchars($layout); ?>">
            <?php foreach ($softwareList as $data): ?>
                <div class="software-card">
                    <img src="<?php echo htmlspecialchars($data['image']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
                    <div class="software-info">
                        <h2><?php echo htmlspecialchars($data['name']); ?></h2>
                        <p><?php echo htmlspecialchars($data['description']); ?></p>
                    </div>
                    <a href="<?php echo htmlspecialchars($data['download_link']); ?>">下载</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>