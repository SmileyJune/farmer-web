<?php

  include("../include/extends_helper.php");

    /*
  验证码处理
   1,创建一个验证码图片 imagecreatetruecolor()
   2，给验证码图片添加背景颜色 和文字颜色 imagecolorallocate()
   3, 在指定图片上面，画一个矩形 imagefilledrectangle()
   4, 获取随机数
   5,将随机数写入到这个图片里面去 imagestring()
   6,防止别人去恶意刷我们的验证码 可以在这个图片上面加上一些点 imagesetpixel()
   7,开启session会话  将我们的验证码 存储到session当中与我们表单当中输入的验证码进行匹配
   8,输入图片的 头信息 和 图片资源 删除 header("Content-Type:image/png"); imagepng($img); imagedestroy($img);
   */
  
  $width = 60;
  $height = 30;

  $img = imagecreatetruecolor($width,$height);

  //设置背景颜色
  $back_color = imagecolorallocate($img,155,187,105);

  //文字颜色
  $text_color = imagecolorallocate($img,62,61,61);

  //画矩形
  imagefilledrectangle($img,0,0,$width,$height,$back_color);

  //获取验证码随机数
  $str = GetRandStr(4);//调用函数库中的随机函数

  //将随机数写入图片中
  imagestring($img,5,12,6,$str,$text_color);

  //画点
  for($i = 1;$i <= 120; $i++){
    $x = mt_rand(0,60);
    $y = mt_rand(0,30);
    imagesetpixel($img,$x,$y,imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)));
  }

  //开启session存入缓存中
  session_start();
  $_SESSION['img_code'] = strtolower($str);//将数据转换成小写的

  //写入
  header("Content-type:image/png");
  imagepng($img);
  imagedestroy($img);

?>