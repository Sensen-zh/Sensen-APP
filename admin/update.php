<?php
// 本地版本号
$localVersion = '1.0.0';

// 远程更新信息文件的URL
$remoteUpdateInfoUrl = 'https://sensen.blog/APP/update.php';

// 处理检测更新的逻辑
if (isset($_POST['check_update'])) {
    $updateInfo = json_decode(file_get_contents($remoteUpdateInfoUrl), true);

    if ($updateInfo === null) {
        echo "无法获取远程更新信息。";
    } else {
        if ($updateInfo['version'] > $localVersion) {
            echo "<script>
                    if (confirm('有新版本可用。最新版本: " . $updateInfo['version'] . "\\n更新内容: " . $updateInfo['update_content'] . "\\n是否要更新？')) {
                        window.location.href = 'update.php?action=update';
                    } else {
                        window.location.href = 'index.php'; // 修改这里以指定返回的页面
                    }
                  </script>";
        } else {
            echo "<script>alert('版本相同，无需更新。');</script>";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $updateInfo = json_decode(file_get_contents($remoteUpdateInfoUrl), true);

    if ($updateInfo === null) {
        echo "无法获取远程更新信息。";
    } else {
        echo "<html><head><title>更新中...</title></head><body>";
        echo "<h1>更新中...</h1>";
        echo "<p>正在下载更新包...</p>";
        ob_flush();
        flush();

        echo "<script>setTimeout(function() { document.getElementById('download').style.display = 'block'; }, 2000);</script>";
        echo "<div id='download' style='display: none;'>下载成功！正在解压更新包...</div>";

        $tempFile = $updateInfo['download_dir'] . '/update.zip';
        file_put_contents($tempFile, file_get_contents($updateInfo['download_url']));

        echo "<script>setTimeout(function() { document.getElementById('extract').style.display = 'block'; }, 4000);</script>";
        echo "<div id='extract' style='display: none;'>解压成功！</div>";

        $zip = new ZipArchive;
        if ($zip->open($tempFile) === TRUE) {
            $zip->extractTo($updateInfo['extract_dir']);
            $zip->close();
            unlink($tempFile);
            echo "<script>setTimeout(function() { alert('更新成功！'); window.location.href = 'index.php'; }, 6000);</script>";
        } else {
            echo "解压失败。";
        }
        echo "</body></html>";
    }
}
?>