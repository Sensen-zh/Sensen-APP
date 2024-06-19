<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

$time = date("H");
$greeting = "";

if ($time < 12) {
    $greeting = "早上好";
} elseif ($time < 18) {
    $greeting = "下午好";
} else {
    $greeting = "晚上好";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页-后台管理</title>
    <link rel="icon" href="../core/favicon.ico" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #f8f9fa;
            color: #000;
            padding: 20px;
            height: 100%;
            position: fixed;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar a {
            color: #000;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff; /* 蓝色背景 */
            color: #fff; /* 白色文字 */
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 240px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .update-button {
            background-color: #007bff; /* 蓝色背景 */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }
        .update-button:hover {
            background-color: #0056b3; /* 深蓝色背景 */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>后台首页</h2>
            <a href="index.php" class="active">首页</a>
            <a href="add.php">发布软件</a>
            <a href="edit.php">修改软件</a>
            <a href="layout.php">模板切换</a>
            <a href="set.php">系统设置</a>
            <form method="post" action="logout.php">
                <button type="submit" class="update-button">退出登录</button>
            </form>
        </div>
        <div class="main-content">
            <div class="card">
                <h1><?php echo "$greeting, 管理员!"; ?></h1>
            </div>
            <div class="card">
                <h1>站点信息</h1>
                <?php
                $json = file_get_contents('../config/data.json');
                $dataList = json_decode($json, true);
                $dataCount = count($dataList);
                ?>
                <p>已发布软件数量: <?php echo $dataCount; ?>个</p>
            </div>
            <div class="card">
                <h2>系统信息</h2>
                <p>PHP版本: <?php echo phpversion() ?></p>
                <p>Nginx版本: <?php echo $_SERVER['SERVER_SOFTWARE'] ?></p>
                <p>操作系统: <?php echo php_uname('s'); ?></p>
                <p>系统时区: <?php echo date_default_timezone_get(); ?></p>
            </div>
            <div class="card">
                <h1>程序信息</h1>
                <p>程序名称：森森软件库</p>
                <p>程序版本：V1.0.0</p>
                <p>程序作者：Sensen</p>
                <p>发布地址：<a href="https://github.com/Sensen-zh/Sensen-APP">github</a></p>
                <p>作者博客：<a href="https://sensen.blog/">Sensen-blog</a></p>
                <form action="update.php" method="post">
                    <button type="submit" name="check_update" class="update-button">检测更新</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>