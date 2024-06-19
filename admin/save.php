<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $layout = $_POST['layout'];
    file_put_contents('../config/layout.txt', $layout);
    echo "<script>alert('模板已保存'); window.location.href = 'layout.php';</script>";
}
?>