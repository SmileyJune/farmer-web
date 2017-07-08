<?php 
    include("../include/init.php");
    include("check_login.php");

    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;//获取编辑的id

    if(!$order_id){
      show_msg("请重新选择订单","order_list.php");
      exit;
    }

    //查询出产品表
    $sql = "SELECT * FROM {$pre_}product";
    $product_list = getAll($sql);

    //查询order表中的对应的order_id信息
    $sql = "SELECT * FROM {$pre_}order WHERE order_id = $order_id";
    $order_one = getOne($sql);
   // var_dump($order_one);exit;
    


    if($_POST){
      $data = array(
        "order_sn"=>$_POST['order_sn'],
        "order_price"=>$_POST['order_price'],
        "order_time"=>strtotime($_POST['order_time']),
        "order_username"=>$_POST['order_username'],
        "order_phone"=>$_POST['order_phone'],
        "order_number"=>$_POST['order_number'],
        "order_date"=>strtotime(str_replace("/","-",$_POST['order_date'])),
        "order_state"=>$_POST['order_state'],
        "product_id"=>$_POST['product_id'],
        );
      
      $sql = "order_id = $order_id";
      $affect_id = update("{$pre_}order",$data,$sql);
      if($affect_id){
        show_msg("修改订单成功","order_list.php");
      }else{
        show_msg("请修改后再提交","order_edit.php");
      }
    }
    


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加订单</title>

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
      <li><a class="shortcut-button" href="order_list.php"><span> <img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />
        返回列表</span></a></li>
    </ul>
    
    <div class="clear"></div>
    
    <div class="content-box">
      
      <div class="content-box-header">
        <h3>修改订单</h3>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
          <form action="#" method="post" enctype="multipart/form-data" class="nav_form">
            <fieldset>
                <p>
                  <label>订单号</label>
                 <input class="text-input small-input" datatype="/^[a-zA-Z]{1,12}$/" nullmsg="请填写大小字母1-12位" type="text" id="small-input" name="order_sn" value="<?php echo $order_one['order_sn'];?>" />
                </p>
                <p>
                  <label>订单价格</label>
                  <input class="text-input small-input" datatype="/^[0-9]+([.]{1}[0-9]{2}){0,1}$/" nullmsg="产品价格填写错误,应填写无小数点或者00.00格式" type="text" id="small-input" name="order_price" value="<?php echo $order_one['order_price'];?>" />
                </p>
                <p>
                  <label>下单时间</label>
                  <input class="text-input small-input" datatype="*1-20" nullmsg="请填写1-20位" type="text" id="small-input" name="order_time" value="<?php echo date("Y-m-d H:i:s",$order_one['order_time']);?>" />
                   <div style="display:inline; color: #66ab00;font-weight: 600;" class="Validform_checktip">请按 年-月-日 时:分:秒 格式修改</div>
                </p>
                <p>
                  <label>取票人</label>
                  <input class="text-input small-input" datatype="*1-20" nullmsg="请填写1-20位" type="text" id="small-input" name="order_username" value="<?php echo $order_one['order_username'];?>" />
                </p>
                <p>
                  <label>手机号码</label>
                  <input class="text-input small-input" datatype="n" nullmsg="不能为空" type="number" id="small-input" name="order_phone" value="<?php echo $order_one['order_phone'];?>" />
                </p>
                <p>
                  <label>订单数量</label>
                  <input class="text-input small-input" datatype="*1-20" nullmsg="请填写1-20位" type="number" id="small-input" name="order_number" value="<?php echo $order_one['order_number'];?>" />
                </p>
                <p>
                  <label>游玩日期</label>
                   <input class="text-input small-input" plugin="datepicker" id="small-input" name="order_date" value="<?php echo date("m/d/Y",$order_one['order_date']);?>" />
                </p>
                <p>
                  <label>订单状态</label>
                  <input class="text-input small-input" datetype="*1" nullmsg="0未付款 1已完成" type="number" id="small-input" name="order_state" value="<?php echo $order_one['order_state'];?>" />
                  <div style="display:inline;color: #57a000; font-weight: 600;" class="Validform_checktip">订单状态 0未付款 1已完成</div>
                </p>
                
                <p>
                  <label>订单对应的产品号</label>
                  <select name="product_id" id="">
                      <option value="">请选择产品</option>
                      <?php foreach($product_list as $item) {?>
                      <option <?php echo $order_one['product_id'] == $item['product_id']?"selected":"";?> value="<?php echo $item['product_id'];?>"><?php echo $item['product_name'];?></option>
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
