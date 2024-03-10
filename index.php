<?php
/*
BY：云猫
QQ：3522934828
blog：lwcat.cn
项目地址：https://gitee.com/ximami/picys/
*/
include("config.php");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="keywords" content="<?php echo $keyword; ?>">
  <meta name="description" content="<?php echo $description; ?>">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <LINK rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- 引入layui框架 -->
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <link rel="stylesheet" href="layui/css/admin.css">
   <script>
    $(document).ready(function() {
      $('#uploadBtn').on('click', function() {
      layer.msg('正在压缩中', {icon: 0}, function(){
      });
        var files = $('#upload').prop('files');
        var quality = $('#quality').val();
        var form_data = new FormData();

        for (var i = 0; i < files.length; i++) {
          form_data.append('files[]', files[i]);
        }

        form_data.append('quality', quality);

        $.ajax({
          url: 'upload.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(response) {
                      layer.msg('压缩成功', {icon: 1}, function(){
      });
            console.log('压缩后的图片路径：' + response);
            $('#result').attr('src', response);
            $('#imgLink').val(response);
          },
          error: function() {
            layer.msg('接口异常');
          }
        });
      });

      $('#copyBtn').on('click', function() {
        var copyText = document.getElementById('imgLink');
        copyText.select();
        document.execCommand('copy');
        layer.msg('链接已复制到剪贴板');
      });
    });
  </script>
</head>
<body>
        <div class="demo-login-container">
            <div class="login-header">
        <a href="index.php"><?php echo $title; ?></a>
      </div>
      <P>数值越小，图片压缩越强，图片大小越小，肉眼几乎看不出有什么区别</P>
         <div class="layui-form-item">
      <input class="layui-btn layui-btn-fluid" type="file" id="upload" multiple>
  </div>
   <div class="layui-form-item">
    <div class="layui-input-group">
      <div class="layui-input-split layui-input-prefix">
        质量（数越小，图越小）
      </div>
      <input type="number" id="quality" value="80"  placeholder="请输入压缩质量（0-100）" class="layui-btn ">
    </div>
  </div>
     <div class="layui-form-item">
  <button class="layui-btn layui-btn-fluid" id="uploadBtn"><i class="layui-icon layui-icon-upload"></i>上传并压缩</button>
  </div>
  <div class="layui-form-item">
  <textarea class="layui-textarea layui-btn-fluid" type="text" id="imgLink"></textarea>

        
  </div>
   <div class="layui-form-item">
  <button class="layui-btn layui-btn-fluid" id="copyBtn">复制链接</button>
    
        </div>
        </div>
 <center>
     <?php echo $foot; ?>
  </center>
  <script src="layui/layui.js"></script>
</body>
</html>