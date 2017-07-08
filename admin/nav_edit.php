<?php 
    include("../include/init.php");
    include("check_login.php");

    //查询父级导航
    $sql = "SELECT * FROM {$pre_}nav WHERE parent_id = 0";//查询父级导航
    $nav_list = getAll($sql);

    $nav_id = isset($_GET['nav_id']) ? $_GET['nav_id'] :0;

    if(!$nav_id){
      show_msg("请重新选择导航","nav_list.php");
      exit;
    }
    
    $sql = "SELECT* FROM {$pre_}nav WHERE nav_id = $nav_id";
    $nav_one = getOne($sql);

    if($_POST){
        $data = array(
          "nav_name"=>$_POST['nav_name'],
          "nav_url"=>$_POST['nav_url'],
          "nav_order"=>$_POST['nav_order'],
          "nav_time"=>strtotime($_POST['nav_time']),
          "parent_id"=>$_POST['parent_id']
        );

        $affect_id = update("{$pre_}nav",$data,"nav_id = $nav_id");
        if($affect_id){
          show_msg("修改导航成功","nav_list.php");
        }else{
          show_msg("请修改内容再提交","nav_edit.php?nav_id=$nav_id");
        }

    }


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改导航</title>

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
      <li><a class="shortcut-button" href="nav_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>修改导航</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" class="nav_form">
            <fieldset>
                <p>
                  <label>导航名称</label>
                 <input class="text-input small-input" datatype="*2-20" nullmsg="导航名称长度不够" type="text" id="small-input" name="nav_name" value="<?php echo $nav_one['nav_name'];?>" />
                </p>
                <p>
                  <label>导航地址</label>
                  <input class="text-input small-input" datatype="*" nullmsg="导航地址填写错误" type="text" id="small-input" name="nav_url" value="<?php echo $nav_one['nav_url'];?>" />
                </p>
                
                <p>
                  <label>导航排序</label>
                  <input class="text-input small-input" datatype="n" nullmsg="导航排序填写失败" type="text" id="small-input" name="nav_order" value="<?php echo $nav_one['nav_order'];?>" />
                </p>
                
                <p>
                  <label>添加时间</label>
                  <input class="text-input small-input" type="text" id="small-input" name="nav_time" value="<?php echo date("Y-m-d H:i:s",$nav_one['nav_time']);?>" />
                  <div style="display:inline; color: #66ab00;font-weight: 600;" class="Validform_checktip">请按 年-月-日 时:分:秒 格式修改</div>
                </p>
                
                <p>
                  <label>选择导航</label>
                  <select name="parent_id" class="small-input">
                    <option value="0" <?php echo $nav_one['parent_id'] ? "" : "selected";?>>顶级导航</option>
                    <?php foreach($nav_list as $item) {?>
                    <option <?php echo $nav_one['parent_id'] == $item['nav_id'] ? "selected":""?> value="<?php echo $item['nav_id'];?>"><?php echo $item['nav_name'];?></option>
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
      <!-- Remove this notice or replace it with whatever you want -->
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
