<?php
/*
BY：云猫
QQ：3522934828
blog：lwcat.confi
项目地址：https://gitee.com/ximami/picys/
*/
include("config.php");
?>
<?php
$password = $_GET['password']; // 从表单获取密码

if ($password === $correctPassword) {
    // 清空指定文件夹中的所有文件
    $folderPath = "pic"; // 指定文件夹路径

    // 遍历文件夹中的文件并删除
    $files = glob($folderPath . '/*'); // 获取文件夹中的所有文件
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); // 删除文件
        }
    }

    echo "文件夹中的文件已成功清除！";
} else {
    echo "密码不正确！";
}

?>
