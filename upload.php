<?php
include("config.php");
?>
<?php
/*
BY：云猫
QQ：3522934828
blog：lwcat.confi
项目地址：https://gitee.com/ximami/picys/
*/
$allowed_formats = array('image/png', 'image/jpeg', 'image/jpg');

if (empty($_FILES['files']['tmp_name'][0])) {
  echo "请提交图片";
} elseif ($_FILES["files"]["error"][0] > 0) {
  echo "Error: " . $_FILES["files"]["error"][0] . "<br>";
} else {
  $quality = isset($_POST['quality']) ? $_POST['quality'] : 75;

  foreach ($_FILES['files']['tmp_name'] as $key => $temp_file) {
    $file_info = getimagesize($temp_file);
    $file_mime = $file_info['mime'];

    if (!in_array($file_mime, $allowed_formats)) {
      echo "只允许上传 PNG、JPEG 和 JPG 格式的文件";
      continue;
    }

    $original_image = imagecreatefromstring(file_get_contents($temp_file));

    // 生成10位随机数字作为文件名
    $filename = '';
    for ($i = 0; $i < 10; $i++) {
      $filename .= mt_rand(0, 9);
    }

    $output_file = "pic/" . $filename . '.' . pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);

    // 保存图片，保留原始格式
    switch ($file_info[2]) {
      case IMAGETYPE_PNG:
        imagepng($original_image, $output_file);
        break;
      case IMAGETYPE_JPEG:
        imagejpeg($original_image, $output_file, $quality);
        break;
      default:
        echo "只允许上传 PNG、JPEG 和 JPG 格式的文件";
        continue 2; // 继续处理下一个文件
    }

    imagedestroy($original_image);
    echo $url . $output_file . "\n";
  }
}

?>