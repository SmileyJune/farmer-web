<?php 
    include("../include/init.php");
    include("check_login.php");

    //查询父级导航

    if($_POST){
        $data = array(
          "admin_name"=>$_POST['admin_name'],
          "admin_pwd"=>md5($_POST['admin_pwd']),//加密再将密码放入数据库
        );

        if($_FILES['admin_img']['size'] > 0){
          $img_path = "../static/uploads/";
          $file_path = "static/uploads/";
          $newfile = uploads("admin_img",106666660,$img_path);
          $data['admin_img'] = $file_path.$newfile;
        }
        $insert_id = insert("{$pre_}admin",$data);
        if($insert_id){
          show_msg("添加管理员成功","admin_list.php");
        }else{
          show_msg("添加管理员失败","admin_add.php");
        }

    }


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加管理员</title>

<link rel="stylesheet" href="../static/admin/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../static/admin/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../static/admin/css/invalid.css" type="text/css" media="screen" />

<!-- 加载 验证插件css -->
<link rel="stylesheet" href="../static/css/style-validForm.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../static/plugin/datePicker/datePicker.css" type="text/css" media="screen" />

<script type="text/javascript" src="../static/js/jquery-1.6.2.min.js"></script>

<script type="text/javascript" src="../static/admin/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="../static/admin/scripts/facebox.js"></script>
<script type="text/javascript" src="../static/admin/scripts/jquery.wysiwyg.js"></script>

<!-- 表单验证和时间插件 -->
<script src="../static/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="../static/plugin/datePicker/jquery.datePicker-min.js"></script>



</head>
<body>
<div id="body-wrapper">
  <div id="sidebar">
     <?php include("menu.php");?>
  </div>
  <div id="main-content">
    <noscript>
    <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
        Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
    </noscript>
    <ul class="shortcut-buttons-set">
      <li><a class="shortcut-button" href="admin_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>添加管理员</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" class="nav_form" enctype="multipart/form-data">
            <fieldset>
                <p>
                  <label>管理员</label>
                 <input class="text-input small-input" datatype="*2-20" nullmsg="请填写管理员名称2-20位" type="text" id="small-input" name="admin_name" />
                </p>
                <p>
                  <label>密码</label>
                  <input class="text-input small-input" datatype="*6-20" nullmsg="请填写密码6-20位" type="password" id="small-input" name="admin_pwd" />
                </p>
                
                <p>
                  <label>上传头像</label>
                  <input class="text-input small-input" type="file" id="small-input" name="admin_img" />
                </p>
                
               
                <p>
                  <input class="button" type="submit" value="Submit" />
                </p>
            </fieldset>
            <div class="clear"></div>
          </form>
        </div>
      </div>
    </div>
    
    <div id="footer" style="text-align: center;"> 
      <small>
      &#169; Copyright 2010 Your Company | Powered by <a href="#">农夫乐园</a> 
      </small>
    </div>

  </div>
</div>
</body>
</html>
<script>

$(function(){
  $(".nav_form").Validform({
    tiptype:3
  });
});


</script>
