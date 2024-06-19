<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    // 验证密码和重复密码是否一致
    if ($new_password !== $new_password_confirm) {
        echo "<script>alert('密码和重复密码不一致，请重新输入。'); window.history.back();</script>";
        exit;
    }

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
            echo "<script>alert('安装成功！');</script>";

            // 在指定目录新建一个Sensen文件并写入安装锁
            $lock_file_path = '../core/Sensen';
            if (file_put_contents($lock_file_path, '这是一个安装锁文件')) {
                echo "<script>alert('');</script>";
                echo "<script>window.location.href = './install.php';</script>";
            } else {
                echo "创建安装锁文件失败，请检查文件权限。";
            }
        } else {
            echo "更新失败，请检查文件权限。";
        }
    } else {
        echo "用户信息不存在。";
    }
}

// 检查安装锁文件是否存在
$lock_file_path = '../core/Sensen';
if (file_exists($lock_file_path)) {
    echo "程序已安装成功需要重新安装请把 根目录/core/ 下的Sensen文件删除重新访问";
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>系统安装</title>
    <link rel="icon" href="../core/favicon.ico" type ="image/x-icon">
        <style>
            body {
                background-color: #F7F7F7;
                font-family: Arial, sans-serif;
                font-size: 12px;
                line-height: 150%;
            }

            hr {
                margin: 1rem 0;
                color: inherit;
                border: 0;
                border-top: 1px solid;
                opacity: .25;
            }

            .mb10 {
                margin-bottom: 10px;
            }

            .mb20 {
                margin-bottom: 20px;
            }

            .main {
                background-color: #FFFFFF;
                font-size: 12px;
                color: #666666;
                width: 750px;
                margin: 30px auto;
                padding: 50px;
                list-style: none;
                border: #DFDFDF 1px solid;
                border-radius: 4px;
            }

            .logo {
                background: url(../core/favicon.ico) no-repeat center;
                padding: 50px 0 50px 0;
                margin: 0 0;
            }

            .title {
                text-align: center;
                font-size: 14px;
            }

            .input-group {
                position: relative;
                display: flex;
                flex-wrap: wrap;
                align-items: stretch;
                width: 100%;
                margin-top: 30px;
            }

            .input-group-text {
                display: flex;
                align-items: center;
                padding: 0.375rem 0.75rem;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5;
                color: #5e5e5e;
                text-align: center;
                white-space: nowrap;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 0.375rem 0 0 0.375rem;
                width: 80px;
            }

            .form-control {
                display: block;
                padding: 0.375rem 0.75rem;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5;
                color: #5e5e5e;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #dee2e6;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                position: relative;
                flex: 1 1 auto;
                width: 1%;
                min-width: 0;
                border-radius: 0 0.375rem 0.375rem 0;
                margin-left: calc(1px * -1);
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }

            .form-label {
                margin-bottom: 0.5rem;
            }

            .btn {
                cursor: pointer;
                color: #008cff;
                letter-spacing: .5px;
                padding-right: 3rem !important;
                padding-left: 3rem !important;
                display: inline-block;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                text-align: center;
                text-decoration: none;
                vertical-align: middle;
                user-select: none;
                border: 1px solid #008cff;
                border-radius: 5px;
                background-color: transparent;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }

            .btn:hover {
                color: #fff;
                background-color: #008cff;
                border-color: #008cff;
            }

            .care {
                color: rgb(128, 128, 128);
            }

            .install-title {
                margin-top: 50px;
                margin-bottom: 0;
                font-size: 18px;
                font-weight: normal;
            }

            .next_btn {
                margin: 50px 0 10px 0;
                text-align: center;
            }

            .footer {
                margin: 20px 0 30px 0;
                text-align: center;
            }

            @media (max-width: 768px) {
                .main {
                    width: unset;
                }
            }
        </style>
</head>
<body>
   <form method="post" action="">
        <div class="main">
            <p class="logo"></p>
            <p class="title mb20">森森软件库 V1.0.0</p>
            <div class="c">
                <p class="install-title">管理员设置</p>
                <div class="input-group mb10">
                    <span class="input-group-text">登录名</span>
                    <input type="text" id="new_username" name="new_username" class="form-control" required><br><br>
                </div>
                <div class="input-group mb10">
                    <span class="input-group-text">密码</span>
                    <input type="password" id="new_password" class="form-control" name="new_password" required><br><br>
                </div>
                <div class="input-group mb10">
                    <span class="input-group-text">重复密码</span>
                    <input type="password" id="new_password_confirm" class="form-control" name="new_password_confirm" required><br><br>
                </div>
            </div>
            <div class="next_btn">
                <button type="submit" class="btn">开始安装</button>
            </div>
        </div>
    </form>
    <div class="footer">Powered by <a href="https://sensen.blog/">Sensen</a></div>
</body>
</html>