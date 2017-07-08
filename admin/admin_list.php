<?php
  include("../include/init.php");
  include("check_login.php");

  $current = isset($_GET['page']) ? $_GET['page'] : 1;//获取当前的页码值

 

  $sql = "SELECT COUNT(*) AS c FROM {$pre_}admin";//查询导航
  $count = getOne($sql);

  $limit = 5;
  $size = 4;

  $str_page = page($current,$count['c'],$limit,$size,"scott");//分页

  $start = ($current-1)*$limit;

  $sql = "SELECT * FROM {$pre_}admin ORDER BY admin_id DESC  LIMIT $start,$limit";

  $admin_list = getAll($sql);

  $admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : 0;//接收删除id
  if($admin_id){
    $admin_dele = delete("{$pre_}admin","admin_id = $admin_id");
    if($admin_dele){
      show_msg("删除管理员成功","admin_list.php");
    }else{
      show_msg("删除管理员失败","admin_list.php");
    }
  }
  


  $admin_all = isset($_POST['admin_dele']) ? $_POST['admin_dele'] :0;
  if($admin_all){
     $admin_all = implode(",",$admin_all);
     $sql = "admin_id IN($admin_all)";
     $delete_all = delete("{$pre_}admin",$sql);
     if($delete_all){
      show_msg("批量删除管理员成功","admin_list.php");
     }else{
      show_msg("批量删除管理员失败","admin_list.php");
     }
  }




?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../static/admin/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="../static/admin/css/invalid.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../static/css/page.css" />

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
  <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    
    <?php include("menu.php");?>

  </div>
  <!-- End #sidebar -->
  <div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
        Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
    </noscript>

    <ul class="shortcut-buttons-set">
      <li>
        <a class="shortcut-button" href="admin_add.php">
          <span><img src="../static/admin/images/icons/pencil_48.png" alt="icon" /><br />添加</span>
        </a>
      </li>
    </ul>

    <div class="clear"></div>

    <div class="content-box">
      <div class="content-box-header">
        <h3>管理员</h3>
        <div class="clear"></div>
      </div>
  
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <form action="#" method="post" name="form_list">
            <table>
              <thead>
                <tr>
                  <th>
                    <input class="check-all" name="checkall" type="checkbox" />
                  </th>
                  <th>主键</th>
                  <th>管理员名称</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td colspan="6">
                      <div class="bulk-actions align-left">
                          <a class="button" href="javascript:document.form_list.submit()">批量删除</a> 
                      </div>
                      <div class="pagination"><?php echo $str_page;?></div>
                      <div class="clear"></div>
                  </td>
                </tr>
              </tfoot>
              <tbody>
              <?php foreach($admin_list as $item) {?>
                  <tr>
                    <td>
                      <input type="checkbox" name="admin_dele[]" value="<?php echo $item['admin_id'];?>" />
                    </td>
                    <td><?php echo $item['admin_id'];?></td>
                    <td><?php echo $item['admin_name'];?></td>
                    <td>
                      <!-- Icons -->
                      <a href="admin_edit.php?admin_id=<?php echo $item['admin_id'];?>" title="Edit"><img src="../static/admin/images/icons/pencil.png" alt="Edit" /></a> 
                      <a href="admin_list.php?admin_id=<?php echo $item['admin_id'];?>" title="Delete"><img src="../static/admin/images/icons/cross.png" alt="Delete" /></a> 
                    </td>
                  </tr>
              <?php }?>
              </tbody>
            </table>
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
