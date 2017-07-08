<?php
    include("../include/init.php");

    //接收从menu页面退出时传过来的action值，如果接收到了就退出页面，并且清除session缓存
    $logout = isset($_GET['action']) ? $_GET['action'] : "";
    $auto_login = isset($_COOKIE['auto_login']) ? $_COOKIE['auto_login'] : 0;

    if($logout == "logout"){
        setcookie("auto_login",NULL,time()-1000);
        setcookie("autoname",NULL,time()-1000);
        session_destroy() && show_msg("退出成功","login.php");

    }

    if($auto_login){
      header("Location:index.php");
      exit;
    }

    if($_POST){
        $admin_name = $_POST['admin_name'];//获取文本中输入的账户名密码
        $admin_pwd = md5($_POST['admin_pwd']);//密码一定要加密放置
        $img_code = strtolower($_POST['img_code']);//获取验证码 strtolower是不区分大写小
        $auto_login = $_POST['auto_login'];//接收是否自动登录(从选择框中输入的value值1)

        if($img_code != $_SESSION['img_code']){
            show_msg("输入验证码错误","login.php");
           }
      
        //拿到输入的账户名和密码跟数据库中管理员账号密码作对比
        $sql = "SELECT * FROM {$pre_}admin WHERE admin_name = '$admin_name' AND admin_pwd = '$admin_pwd'";
        $admin_info = getOne($sql);

        if(!empty($admin_info)){//如果查到了账户密码就将账户和状态放置session缓存，并登陆成功

          if($auto_login){//如果接收到的value值是1，设置cookie
            setcookie("auto_login","1",time()+111111);
            setcookie("autoname",$admin_info['admin_name'],time()+111111);
          }

          $_SESSION['admin_name'] = $admin_info['admin_name'];
          $_SESSION['is_login'] = true;
          show_msg("登陆成功","index.php");
          exit;
        }else{
          show_msg("登陆失败","login.php");
          exit;
        }
    }



?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>农夫乐园后台管理</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../static/admin/css/invalid.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../static/css/style-validForm.css" type="text/css" media="screen" />


<script type="text/javascript" src="../static/js/jquery-1.6.2.min.js"></script>

<script type="text/javascript" src="../static/admin/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="../static/admin/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="../static/admin/scripts/jquery.wysiwyg.js"></script>


<script src="../static/js/Validform_v5.3.2_min.js"></script>

</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>农夫乐园后台管理</h1>
    <!-- Logo (221px width) -->
    <a href="#"><img id="logo" src="../static/admin/images/logo.png" alt="Simpla Admin logo" /></a> </div>
  <!-- End #logn-top -->
  <div id="login-content">
    <form action="#" method="post" class="login_form">
      <p>
        <label>用户名</label>
         <input class="text-input" datatype="*2-20" nullmsg="用户名不能为空" type="text" id="small-input" name="admin_name" />
      </p>
      <div class="clear"></div>
      <p>
        <label>密码</label>
        <input class="text-input" datatype="*" nullmsg="密码不能为空" type="password" id="small-input" name="admin_pwd" />
      </p>
      <div class="clear"></div>
      <p>
        <label>验证码</label>
        <input class="text-input" datatype="*" nullmsg="请输入验证码" type="text" id="small-input" name="img_code" />
      </p>
      <div class="clear"></div>
      <p> 
         <img src="./img_code.php" onclick="this.src='img_code.php'" alt="" />
      </p>
      <div class="clear"></div>
      <p id="remember-password">
        <input type="checkbox" name="auto_login" value="1" />自动登录
      </p>
      <div class="clear"></div>
      <p>
        <input class="button" type="submit" value="Sign In" />
      </p>
    </form>
  </div>

</div>

</body>
</html>
<script>
  $(function(){
  $(".login_form").Validform({
    tiptype:3,
  });
});

</script>

