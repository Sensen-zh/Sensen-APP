<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $file_path = '../config/user.json';

    // 检查文件是否存在
    if (!file_exists($file_path)) {
        die("文件不存在: " . $file_path);
    }

    // 读取JSON文件内容
    $user_data = json_decode(file_get_contents($file_path), true);

    // 更新索引为A的用户信息
    if (isset($user_data['A'])) {
        $user_data['A']['username'] = $new_username;
        $user_data['A']['password'] = $new_password;

        // 将更新后的数据写回JSON文件
        if (file_put_contents($file_path, json_encode($user_data, JSON_PRETTY_PRINT))) {
            echo "<script>alert('用户信息已更新。');</script>";
        } else {
            echo "更新失败，请检查文件权限。";
        }
    } else {
        echo "用户信息不存在。";
    }
}
?>
<?php
// 读取JSON文件
$webFile = '../config/web.json';
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
    <title>系统设置 - 后台管理</title>
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
            <h2>系统设置</h2>
            <a href="index.php">首页</a>
            <a href="add.php">发布软件</a>
            <a href="edit.php">修改软件</a>
            <a href="layout.php">模板切换</a>
            <a href="set.php" class="active">系统设置</a>
            <form method="post" action="logout.php">
                <button type="submit" class="update-button">退出登录</button>
            </form>
        </div>
        <div class="main-content">
            <div class="card">
                <h1>系统设置</h1>
                <form method="post">
                    <label for="title">网页标题:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($web['title']); ?>"><br><br>
                    <label for="keywords">SEO关键词:</label>
                    <input type="text" id="keywords" name="keywords" value="<?php echo htmlspecialchars($web['keywords']); ?>"><br><br>
                    <input type="submit" class="update-button" value="保存">
                </form>
            </div>
            <div class="card">
                <h1>管理员账号修改</h1>
                <form method="post" action="">
                    <label for="new_username">新用户名:</label>
                    <input type="text" id="new_username" name="new_username" required><br><br>
                    <label for="new_password">新密码:</label>
                    <input type="password" id="new_password" name="new_password" required><br><br>
                    <input type="submit" class="update-button" value="保存">
                </form>
            </div>
        </div>
    </div>
</body>
</html>