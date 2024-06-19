<?php
/**
 * 后台核心文件
 * BY：Sensen
 */
// 安装锁文件路径
$lockFilePath = __DIR__ . '/Sensen';

// 检测是否存在安装锁文件
function checkForLockFile($lockFilePath) {
    return file_exists($lockFilePath);
}

// 执行检测
$hasLockFile = checkForLockFile($lockFilePath);

if ($hasLockFile) {
    // 系统已安装，什么都不显示
} else {
    // 系统未安装，弹窗提示并在3秒后自动跳转
    echo '<script type="text/javascript">
            alert("系统未安装，1秒后将自动跳转到安装程序。");
            setTimeout(function() {
                window.location.href = "../install/";
            }, 1000);
          </script>';
    exit();
}
?>