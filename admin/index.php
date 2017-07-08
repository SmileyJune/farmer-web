<?php
    include("../include/init.php");
    include("check_login.php");

    //查询文章总数
    $sql = "SELECT COUNT(*) AS c FROM {$pre_}article";
    $art_count=getOne($sql);

    //查询订单总数
    $sql = "SELECT COUNT(*) AS c FROM {$pre_}order";
    $order_count = getOne($sql);

    //查询产品总数
    $sql = "SELECT COUNT(*) AS c FROM {$pre_}product";
    $pro_count = getOne($sql);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="../static/admin/css/invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="../static/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="../static/admin/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="../static/admin/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="../static/admin/scripts/jquery.wysiwyg.js"></script>
<!-- jQuery Datepicker Plugin -->
<script type="text/javascript" src="../static/admin/scripts/jquery.datePicker.js"></script>
<script type="text/javascript" src="../static/admin/scripts/jquery.date.js"></script>
</head>
<body>
<div id="body-wrapper">

  <div id="sidebar">

    <?php include("menu.php");?><!-- 将菜单分离出来 -->

  </div>
  <div id="main-content">
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
        Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
    </noscript>
    
    <h2 style="padding-top: 30px">Welcome</h2>
    <p id="page-intro">欢迎来到农夫乐园后台管理</p>
    
    
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>后台管理首页</h3>
      </div>

      <div class="content-box-content">
        <div class="tab-content default-tab">
          <h4>操作系统：<?php echo PHP_OS;?></h4>
          <h4>PHP版本：<?php echo PHP_VERSION;?></h4>
          <h4>数据库版本：<?php echo mysql_get_server_info();?></h4>
          <h4>文章总数：<?php echo $art_count['c'];?></h4>
          <h4>产品总数：<?php echo $pro_count['c'];?></h4>
          <h4>订单总数：<?php echo $order_count['c'];?></h4>
        </div>
      </div>
    </div>
    <!-- End .content-box -->
   
    <div class="clear"></div>
    
    <div id="footer" style="text-align: center;"> 
      <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2010 Your Company | Powered by <a href="#">农夫乐园</a> 
      </small>
    </div>

   
  </div>

</div>
</body>
</html>
