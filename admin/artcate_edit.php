<?php 
    include("../include/init.php");
    include("check_login.php");

    $artcate_id = isset($_GET['artcate_id']) ? $_GET['artcate_id'] : 0;
    if(!$artcate_id){
      show_msg("请重新选择文章分类","artcate_list.php");
      exit;
    }

    $sql = "SELECT* FROM {$pre_}article_cate WHERE artcate_id = $artcate_id";
    $artcate_list = getOne($sql);

    if($_POST){
        $data = array(
          "artcate_name"=>$_POST['artcate_name'],
          "artcate_time"=>strtotime(str_replace("/","-",$_POST['artcate_time'])),
        );

      if($_FILES['artcate_img']['size'] > 0){
        $img_path = "../static/uploads/";
        $file_path = "static/uploads/";
        $filename = uploads("artcate_img",1322453,$img_path);
        $data['artcate_img'] = $file_path.$filename; 
      }

      $sql = "artcate_id = $artcate_id";
      $affect_id = update("{$pre_}article_cate",$data,$sql);
        if($affect_id){
          show_msg("修改文章分类成功","artcate_list.php");
        }else{
          show_msg("请修改内容再提交","artcate_edit.php");
        }

    }


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改文章分类</title>

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
      <li><a class="shortcut-button" href="artcate_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>修改文章分类</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" enctype="multipart/form-data" class="nav_form">
            <fieldset>
                <p>
                  <label>文章分类名称</label>
                 <input class="text-input small-input" datatype="*1-20" nullmsg="文章分类名称长度2-20" type="text" id="small-input" name="artcate_name" value="<?php echo $artcate_list['artcate_name'];?>" />
                </p>
                <p>
                  <label>添加时间</label>
                  <input class="text-input small-input" id="small-input" name="artcate_time" value="<?php echo date("Y-m-d H:i:s",$artcate_list['artcate_time']);?>" />
                  <div style="display:inline; color: #66ab00;font-weight: 600;" class="Validform_checktip">请按 年-月-日 时:分:秒 格式修改</div>
                </p>
                 <p>
                  <label>分类图片</label>
                  <input class="text-input small-input" type="file" id="small-input" name="artcate_img" />
                  <?php if(!empty($artcate_list['artcate_img'])) {?>
                    <img src="../<?php echo $artcate_list['artcate_img'];?>" style="width: 100px;height: 100px;" alt="" />
                  <?php }?>
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
