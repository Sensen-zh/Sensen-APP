<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $download_link = $_POST['download_link'];

    $data = [
        'name' => $name,
        'image' => $image,
        'description' => $description,
        'download_link' => $download_link
    ];

    $json = file_get_contents('../config/data.json');
    $dataList = json_decode($json, true);
    $dataList[] = $data;
    $json = json_encode($dataList, JSON_PRETTY_PRINT);

    if (file_put_contents('../config/data.json', $json)) {
        echo "<script>alert('发布成功！'); window.location.href = 'add.php';</script>";
    } else {
        echo "<script>alert('发布失败。'); window.location.href = 'add.php';</script>";
    }
    exit();
}
?>