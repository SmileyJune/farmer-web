<?php 
    include("../include/init.php");
    include("check_login.php");

    $set_id = isset($_GET['set_id']) ? $_GET['set_id'] : 0;
    if(!$set_id){
      show_msg("请重新选择配置","setting_list.php");
      exit;
    }

    $sql = "SELECT * FROM {$pre_}settings WHERE set_id = $set_id";
    $set_one = getOne($sql);


    if($_POST){
      $data = array(
        "set_name"=>$_POST['set_name'],
        "set_value"=>$_POST['set_value'],
        "set_title"=>$_POST['set_title'],
        "set_time"=>strtotime($_POST['set_time']),
        );
     
      $sql = "set_id = $set_id";
      $affect_id = update("{$pre_}settings",$data,$sql);
      if($affect_id){
        show_msg("修改配置成功","setting_list.php");
      }else{
        show_msg("请修改内容再提交","setting_edit.php?set_id=$set_id");
      }
    }
    


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改配置</title>

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

<!-- 多行文本器插件 -->
<link rel="stylesheet" href="../include/kindeditor/themes/default/default.css" />
<script src="../include/kindeditor/kindeditor-min.js"></script>
<script src="../include/kindeditor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
  editor = K.create('textarea[name="product_desc"]', {
    allowFileManager : true
  });
});
KindEditor.ready(function(K) {
  editor = K.create('textarea[name="product_content"]', {
    allowFileManager : true
  });
});
</script>


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
      <li><a class="shortcut-button" href="setting_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>修改配置</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" enctype="multipart/form-data" class="nav_form">
            <fieldset>
                <p>
                  <label>配置名称</label>
                 <input class="text-input small-input" datatype="/^[a-zA-Z]{1,20}$/" nullmsg="请填写英文1-20位" type="text" id="small-input" name="set_name" value="<?php echo $set_one['set_name'];?>" />
                </p>
                <p>
                  <label>配置值</label>
                 <input class="text-input small-input" type="text" datatype="*" nullmsg="不能为空" id="small-input" name="set_value" value="<?php echo $set_one['set_value'];?>" />
                </p>
                <p>
                  <label>配置名称[中文]</label>
                 <input class="text-input small-input" datatype="*1-20" nullmsg="请填写中文1-20位" type="text" id="small-input" name="set_title" value="<?php echo $set_one['set_title'];?>" />
                </p>
                <p>
                  <label>添加时间</label>
                 <input class="text-input small-input" datatype="*1-20" nullmsg="请填写1-20位" type="text" id="small-input" name="set_time" value="<?php echo date("Y-m-d H:i:s",$set_one['set_time']);?>" />
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
