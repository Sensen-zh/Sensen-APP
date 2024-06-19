<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发布软件 - 后台管理</title>
    <link rel="icon" href="../core/favicon.ico" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            display: flex;
            height: 100vh;
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
            color: #333;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff;
            color: #fff;
        }
        .main-content {
            flex-grow: 1;
            padding: 40px;
            margin-left: 240px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .update-button, button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }
        .update-button:hover, button:hover {
            background-color: #0056b3;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>发布软件</h2>
            <a href="index.php">首页</a>
            <a href="add.php" class="active">发布软件</a>
            <a href="edit.php">修改软件</a>
            <a href="layout.php">模板切换</a>
            <a href="set.php">系统设置</a>
            <form method="post" action="logout.php">
                <button type="submit" class="update-button">退出登录</button>
            </form>
        </div>
        <div class="main-content">
            <div class="card">
                <h1>发布软件</h1>
                <form action="submit.php" method="post">
                    <input type="text" name="name" placeholder="软件名称" required>
                    <input type="text" name="image" placeholder="图片链接" required>
                    <textarea name="description" placeholder="软件介绍" required></textarea>
                    <input type="text" name="download_link" placeholder="下载链接" required>
                    <button type="submit">发布</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>