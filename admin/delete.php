<?php
// delete.php
if (isset($_POST['index'])) {
    $index = $_POST['index'];

    // 获取现有软件数据
    $json = file_get_contents('../config/data.json');
    $dataList = json_decode($json, true);

    // 删除指定索引的数据
    if (isset($dataList[$index])) {
        unset($dataList[$index]);

        // 重新索引数组
        $dataList = array_values($dataList);

        // 将数据写回文件
        file_put_contents('../config/data.json', json_encode($dataList, JSON_PRETTY_PRINT));
    }
}
?>