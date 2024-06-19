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
    <title>模板切换-台管理</title>
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
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff;
            color: #fff;
        }
        .main-content {
            flex-grow: 0.3;
            padding: 20px;
            margin-left: 240px;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input[type="radio"] {
            margin-right: 5px;
        }
        .form-container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 10px;
        }
        .form-container button:hover {
            background-color: #007bff;
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
        
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>模板切换</h2>
            <a href="index.php">首页</a>
            <a href="add.php">发布软件</a>
            <a href="edit.php">修改软件</a>
            <a href="layout.php" class="active">模板切换</a>
            <a href="set.php">系统设置</a>
            <form method="post" action="logout.php">
                <button type="submit" class="update-button">退出登录</button>
            </form>
        </div>
        <div class="main-content">
            <?php
            $layout = file_exists('../config/layout.txt') ? file_get_contents('../config/layout.txt') : 'default';
            ?>
            <div class="form-container">
                <h2>模板切换</h2>
                <form action="save.php" method="post">
                    <label>
                        <input type="radio" name="layout" value="default" <?php echo $layout === 'default' ? 'checked' : ''; ?>> 默认排列
                    </label>
                    <label>
                        <input type="radio" name="layout" value="vertical" <?php echo $layout === 'vertical' ? 'checked' : ''; ?>> 竖着排列
                    </label>
                    <label>
                        <input type="radio" name="layout" value="grid" <?php echo $layout === 'grid' ? 'checked' : ''; ?>> 网格排列
                    </label>
                    <button type="submit" class="delete-btns">保存模板</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>