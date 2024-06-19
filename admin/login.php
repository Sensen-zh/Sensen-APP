<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用绝对路径
    $file_path = '../config/user.json';

    // 验证文件是否存在
    if (!file_exists($file_path)) {
        echo "文件不存在: " . $file_path;
        exit();
    }

    $users = json_decode(file_get_contents($file_path), true);

    if ($users === null) {
        echo "无法读取或解析JSON文件。";
        exit();
    }

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $username;
            echo "<script>alert('登录成功！'); window.location.href='index.php';</script>";
            exit();
        }
    }

    echo "<script>alert('用户名或密码无效');</script>";
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link rel="icon" href="../core/favicon.ico" type ="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h1 {
            color: #007bff;
        }
        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>登录-后台管理</h1>
        <form method="post" action="">
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">密码:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">登录</button>
        </form>
    </div>
</body>
</html>