<?php
// 获取软件索引
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;

// 获取现有软件数据
$json = file_get_contents('../config/data.json');
$dataList = json_decode($json, true);
$data = isset($dataList[$index]) ? $dataList[$index] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 处理表单提交
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $download_link = $_POST['download_link'];

    $dataList[$index]['name'] = $name;
    $dataList[$index]['image'] = $image;
    $dataList[$index]['description'] = $description;
    $dataList[$index]['download_link'] = $download_link;

    // 更新 JSON 文件
    file_put_contents('../config/data.json', json_encode($dataList, JSON_PRETTY_PRINT));

    echo "<script>alert('软件数据已更新'); window.location.href = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑软件-后台管理</title>
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
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
        }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 10px;
        }
        form button:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>编辑软件</h1>
        <form action="software.php?index=<?php echo $index; ?>" method="post">
            <input type="text" name="name" placeholder="软件名称" value="<?php echo htmlspecialchars($data['name']); ?>" required>
            <input type="text" name="image" placeholder="图片链接" value="<?php echo htmlspecialchars($data['image']); ?>" required>
            <textarea name="description" placeholder="软件介绍" required><?php echo htmlspecialchars($data['description']); ?></textarea>
            <input type="text" name="download_link" placeholder="下载链接" value="<?php echo htmlspecialchars($data['download_link']); ?>" required>
            <button type="submit">更新</button>
        </form>
    </div>
</body>
</html>