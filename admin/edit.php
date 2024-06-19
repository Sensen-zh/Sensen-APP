<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
// 获取现有软件数据
$json = file_get_contents('../config/data.json');
$dataList = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改软件-后台管理</title>
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
            flex-grow: 0.3;
            padding: 40px;
            margin-left: 280px;
            overflow-y: auto;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 10px;
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
        .delete-btn {
            display: inline-block;
            background-color: #ff6347;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
        }
        .delete-btns {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>修改软件</h2>
            <a href="index.php">首页</a>
            <a href="add.php">发布软件</a>
            <a href="edit.php" class="active">修改软件</a>
            <a href="layout.php">模板切换</a>
            <a href="set.php">系统设置</a>
            <form method="post" action="logout.php">
                <button type="submit" class="update-button">退出登录</button>
            </form>
        </div>
        <div class="main-content">
            <div class="card">
                <?php if (!empty($dataList)): ?>
                    <?php foreach ($dataList as $index => $data): ?>
                        <div class="data-item">
                            <h2><?php echo $data['name']; ?></h2>
                            <p><?php echo $data['description']; ?></p>
                            <a class="delete-btns" href="software.php?index=<?php echo $index; ?>">编辑</a>
                            <a href="#" class="delete-btn" onclick="confirmDelete(<?php echo $index; ?>)">删除</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>还没有数据</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(index) {
            if (confirm("确定要删除这个软件吗？")) {
                // 使用 AJAX 请求删除数据
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert('软件已删除');
                        location.reload(); // 刷新页面
                    }
                };
                xhr.send('index=' + index);
            }
        }
    </script>
</body>
</html>