<?php 
    include("../include/init.php");
    include("check_login.php");

    //查询文章分类
    $sql = "SELECT * FROM {$pre_}article_cate";
    $article_cate = getAll($sql);

    $article_id = isset($_GET['article_id']) ? $_GET['article_id'] : 0 ;
    if(!$article_id){
      show_msg("请重新选择文章","article_list.php");
      exit;
    }

    $sql = "SELECT * FROM {$pre_}article WHERE article_id = $article_id";
    $article_list = getOne($sql);
   


    if($_POST){
      $data = array(
        "article_title"=>$_POST['article_title'],
        "article_time"=>strtotime(str_replace("/","-",$_POST['article_time'])),
        "article_author"=>$_POST['article_author'],
        "article_desc"=>$_POST['article_desc'],
        "article_content"=>$_POST['article_content'],
        "artcate_id"=>$_POST['artcate_id'],
        );

      
      if($_FILES['article_img']['size'] > 0){
        $img_path = "../static/uploads/";
        $file_path = "static/uploads/";
        $filename = uploads("article_img",1322453,$img_path);
        $data['article_img'] = $file_path.$filename; 
      }
     //var_dump($data);exit;
      $affect_id = update("{$pre_}article",$data,"article_id = $article_id");
      if($affect_id){
        show_msg("修改文章成功","article_list.php");
      }else{
        show_msg("请修改内容再提交","article_edit.php?article_id=$article_id");
      }
    }
    


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改文章</title>

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
  editor = K.create('textarea[name="article_desc"]', {
    allowFileManager : true
  });
});
KindEditor.ready(function(K) {
  editor = K.create('textarea[name="article_content"]', {
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
      <li><a class="shortcut-button" href="article_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>修改文章</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" enctype="multipart/form-data" class="nav_form">
            <fieldset>
                <p>
                  <label>文章标题</label>
                 <input class="text-input small-input" datatype="*2-20" nullmsg="标题长度不够" type="text" id="small-input" name="article_title" value="<?php echo $article_list['article_title'];?>" />
                </p>
                <p>
                   <label>添加时间</label>
                  <input class="text-input small-input" type="text" id="small-input" name="article_time" value="<?php echo date("Y-m-d H:i:s",$article_list['article_time']);?>" />
                  <div style="display:inline; color: #66ab00;font-weight: 600;" class="Validform_checktip">请按 年-月-日 时:分:秒 格式修改</div>
                </p>
                
                <p>
                  <label>作者</label>
                  <input class="text-input small-input" datatype="*2-20" nullmsg="作者名称长度不够" type="text" id="small-input" name="article_author" value="<?php echo $article_list['article_author'];?>" />
                </p>
                <p>
                  <label>产品图片</label>
                  <input class="text-input small-input" type="file" id="small-input" name="article_img" />
                  <?php if($article_list['article_img']) {?>
                      <img src="../<?php echo $article_list['article_img'];?>" style="width: 100px;height: 100px;" alt="" />
                  <?php }?>
                </p>
                <p>
                  <label>产品概述</label>
                  <textarea name="article_desc" id="" cols="30" rows="10"><?php echo $article_list['article_desc'];?></textarea>
                </p>
                
                <p>
                  <label>产品内容</label>
                  <textarea name="article_content" id="" cols="30" rows="10"><?php echo $article_list['article_content'];?></textarea>
                </p>
               
                <p>
                  <label>文章类别</label>
                  <select name="artcate_id" id="">
                    <option value="">请选择</option>
                    <?php foreach($article_cate as $item) {?>
                    <option value="<?php echo $item['artcate_id'];?>" <?php echo $article_list["artcate_id"] == $item['artcate_id']?"selected":"" ;?>><?php echo $item['artcate_name'];?></option>
                    <?php }?>
                  </select>
                  
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
